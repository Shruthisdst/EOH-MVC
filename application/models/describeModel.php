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
	public function getVolumeDetails($vnum) {
		$dbh = $this->db->connect(DB_NAME);
		if(is_null($dbh))return null;

		$sth = $dbh->prepare('SELECT * FROM ' . METADATA_TABLE . ' where vnum=? ORDER BY word');

		$sth->execute(array($vnum));
		$data = array();
		
		while($result = $sth->fetch(PDO::FETCH_OBJ)) {
			array_push($data, $result);
		}
		$dbh = null;
		return $data;
	}

	public function getCrossRefWordDetails($word,$wordid){
		$dbh = $this->db->connect(DB_NAME);
		if(is_null($dbh))return null;

		$sth = $dbh->prepare('SELECT * FROM ' . METADATA_TABLE . ' where id=? ORDER BY word');

		$sth->execute(array($wordid));
		$data = array();
		
		while($result = $sth->fetch(PDO::FETCH_OBJ)) {
			array_push($data, $result);
		}
		$dbh = null;
		return $data;
	}

	public function getInnerCrossRefWordDetails($innerid){
		$dbh = $this->db->connect(DB_NAME);
		if(is_null($dbh))return null;

		// echo 'SELECT * FROM ' . METADATA_TABLE_L1 . ' where description like \'%'. $wordid .'%\'';

		$sth = $dbh->prepare('SELECT * FROM ' . METADATA_TABLE . ' where description like \'%id="'. $innerid .'"%\'');

		$sth->execute();
		$data = array();
		$globData = array();

		while($result = $sth->fetch(PDO::FETCH_OBJ)) {
			$result->description = preg_replace('/id="' . $innerid . '"/', 'class="highlight" id="' . $innerid . '"', $result->description);
			array_push($data, $result);
		}
		$dbh = null;
	
		$globData['innerid'] = "'#" . $innerid . "'";
		$globData['data'] = $data;
	
		return $globData;
	}
}

?>
