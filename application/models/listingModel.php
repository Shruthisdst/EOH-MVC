<?php

class listingModel extends Model {

	public function __construct() {

		parent::__construct();
	}

	public function listWordsOfAlphabet($letter = DEFAULT_LETTER){
		//~ var_dump($letter);
		$dbh = $this->db->connect(DB_NAME);
		if(is_null($dbh))return null;
		$sth = $dbh->prepare('SELECT * FROM ' . METADATA_TABLE . ' WHERE word like :letter order by word ');
		$sth->execute(array("letter"=>$letter.'%'));

		$data = array();

		while($result = $sth->fetch(PDO::FETCH_OBJ)) {

			array_push($data, $result);
		}
		$dbh = null;
		return $data;
	}

	public function listWordsByFragment($fragment){
		
		$dbh = $this->db->connect(DB_NAME);
		if(is_null($dbh))return null;
		$fragment = $this->removeDiacritics($fragment);
		
		$bindFragment = '^' . $fragment;
		
		$sth = $dbh->prepare('SELECT * FROM ' . METADATA_TABLE . ' WHERE aliasWord REGEXP :fragment ');
		$sth->bindParam(':fragment', $bindFragment);

		$sth->execute();
		$data = array();
	
		while($result = $sth->fetch(PDO::FETCH_OBJ)) {
			
			//~ $data[] = array($result['aliasWord'] => $result['word']);
			array_push($data, $result->word);
		}
		$dbh = null;
		
		return json_encode($data);
	}
	
	//~ public function getWordList($word){
		//~ $dbh = $this->db->connect(DB_NAME);
		//~ if(is_null($dbh))return null;
		//~ $sth = $dbh->prepare('SELECT word FROM ' . METADATA_TABLE . ' order by word ');
		//~ $sth->execute();
//~ 
		//~ $data = array();
//~ 
		//~ while($result = $sth->fetch(PDO::FETCH_OBJ)) {
			//~ array_push($data, $result);
		//~ }
		//~ $dbh = null;
		//~ return $data;
		//~ 
	//~ }
}
