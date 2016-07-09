<?php

class dataModel extends Model {

	public function __construct() {

		parent::__construct();
	}

	public function getMetadaData() {
		
		$fileName = XML_SRC_URL . DB_PREFIX . '.xml';
		echo $fileName . "<br />";

		if (!(file_exists(PHY_XML_SRC_URL . DB_PREFIX . '.xml'))) {
			return False;
		}
		
		$xml = simplexml_load_file($fileName);

		$metaData = array();

		foreach ($xml->volume as $volume)
		{
			$data['vnum'] = (string) $volume['vnum'];
			foreach ($volume->entry as $entry) {
				$data['word'] = (string) $entry->head->word;
				$data['description'] = $entry->saveXML();
				//~ echo $data['description'].'<br />';
				array_push($metaData, $data);
			}
		}
		return $metaData;
	}
}

?>
