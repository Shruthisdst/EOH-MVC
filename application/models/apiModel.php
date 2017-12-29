<?php

class apiModel extends Model {

	public function __construct() {

		parent::__construct();
	}

	public function getNeighbours($word) {
	
		$dbh = $this->db->connect(DB_NAME);
		if(is_null($dbh))return null;

		// Prev
		$sth = $dbh->prepare('SELECT word FROM ' . METADATA_TABLE . ' WHERE word < ? ORDER BY word DESC LIMIT 1');
		$sth->execute(array($word));
		$result = $sth->fetch(PDO::FETCH_ASSOC);
		$data['prev'] = $result['word'];

		// Next
		$sth = $dbh->prepare('SELECT word FROM ' . METADATA_TABLE . ' WHERE word > ? ORDER BY word LIMIT 1');
		$sth->execute(array($word));
		$result = $sth->fetch(PDO::FETCH_ASSOC);
		$data['next'] = $result['word'];

		$data['word'] = $word;

		return $data;
	}
}

?>
