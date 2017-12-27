<?php

class searchModel extends Model {

	public function __construct() {

		parent::__construct();
	}

	public function formExactMatchQuery($data, $table, $orderBy = '') {

		$sqlStatement = 'SELECT * FROM ' . $table . ' WHERE word = ?  ' . $orderBy;

		$data['query'] = $sqlStatement;
		$data['words'] = array($data['word']);
		return $data;
	}

	public function formPartialMatchQuery($data, $table, $orderBy = '') {

		$word = $data['aliasWord'];
		unset($data['word']);

		$data = $this->regexFilter($data);

		$sqlFilter = (count($data['filter'] > 1)) ? implode(' and ', $data['filter']) : array_values($data['filter']);

		$data['query'] = 'SELECT * FROM ' . $table . ' WHERE ' . $sqlFilter . ' AND aliasWord != ?' . $orderBy;

		array_push($data['words'], $word);
		return $data;
	}

	public function formDescriptionMatchQuery($data, $table, $orderBy = '') {

		$word = $data['word'];
		$data['description'] = $word;
		unset($data['word']);
		unset($data['aliasWord']);

		$data = $this->regexFilter($data);
		$sqlFilter = (count($data['filter'] > 1)) ? implode(' and ', $data['filter']) : array_values($data['filter']);

		$sqlStatement = 'SELECT * FROM ' . $table . ' WHERE ' . $sqlFilter . ' AND word != ? ' . $orderBy;

		array_push($data['words'], $word);
		$data['query'] = $sqlStatement;
		return $data;
	}

	public function executeQuery($query, $parameters)  {

		$dbh = $this->db->connect(DB_NAME);

		$sth = $dbh->prepare($query);
		$sth->execute($parameters);

		$data = [];
		while($result = $sth->fetch(PDO::FETCH_ASSOC)) {
			
			// Extract head words and alias words along with their corresponding notes
			$result = $this->extractDetailsFromDescription($result);

			// Form proper html from xml elements
			$result['description'] = $this->xmlToHtml($result['description']);

			array_push($data, $result);
		}
		$dbh = null;

		return $data;
	}

	public function regexFilter($var) {

		$data['filter'] = array();
		$data['words'] = array();

		if (empty($var)) return $data;

		while (list($key, $val) = each($var)) {

			$filterArr = array();

			$val = html_entity_decode($val, ENT_QUOTES);

			// Only paranthesis and hyphen will be quoted to include them in search
		    $val = preg_replace('/(\(|\)|\-)/', "\\\\$1", $val);
		    $words = preg_split('/ /', $val);
		    $words = array_filter($words, 'strlen');
		    
			$data['words'] = array_merge($data['words'], $words);
		    foreach($words as $word) {
		    	$filterArr[] = $key . ' REGEXP ?';
		    }

		    $filter[$key] = implode(' ' . SEARCH_OPERAND . ' ', $filterArr);

		}

		$data['filter'] = $filter;

		return $data;
	}
}

?>
