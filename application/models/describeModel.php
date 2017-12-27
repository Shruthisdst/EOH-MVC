<?php

class describeModel extends Model {

	public function __construct() {

		parent::__construct();
	}

	public function getWordDetails($word) {
	
		$dbh = $this->db->connect(DB_NAME);
		if(is_null($dbh))return null;

		$sth = $dbh->prepare('SELECT * FROM ' . METADATA_TABLE . ' WHERE word = ? ORDER BY word');

		$sth->execute(array($word));
		$data = array();
		
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

	public function extractDetailsFromDescription($word) {
		
		// var_dump($word);
        $xml = simplexml_load_string($word['description']);
        $head = $xml->head;
        $note = $head->note;

        $word['description'] = $xml->description->asXML();
        $word['description'] = preg_replace('/<\/*description>/', '', $word['description']);

        $word['alias'] = (isset($head->alias)) ? (String) $head->alias : '';
        $word['wordNote'] = (sizeof($note) > 1) ? (String) $note[0] : (String) $note;
        $word['aliasNote'] = (sizeof($note) > 1) ? (String) $note[1] : '';

		// $word['head'] = 
		return $word;
	}

	public function xmlToHtml($html) {

		// Reform refs
		$html = str_replace('<ref ', '<a ', $html);
		$html = str_replace('</ref>', '</a>', $html);
		return $html;
	}
}

?>
