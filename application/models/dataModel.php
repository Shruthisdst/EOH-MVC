<?php

class dataModel extends Model {

	public function __construct() {

		parent::__construct();
	}
	
	public function getWords() {
		
		$fileName = XML_SRC_URL . DB_PREFIX . '.xml';

		if (!(file_exists(PHY_XML_SRC_URL . DB_PREFIX . '.xml'))) {
			return False;
		}
		
		$xml = simplexml_load_file($fileName);

		$words = array();

		foreach ($xml->volume as $volume)
		{
			foreach ($volume->entry as $entry) {
				$data['word'] = (string) $entry->head->word;
				array_push($words, $data);
			}
		}
		return $words;
	}
	public function getMetadaData() {
		
		$fileName = XML_SRC_URL . DB_PREFIX . '.xml';
		echo $fileName . "<br />";

		if (!(file_exists(PHY_XML_SRC_URL . DB_PREFIX . '.xml'))) {
			return False;
		}
		
		$xml = simplexml_load_file($fileName);

		$metaData = array();
		//~ $wordList = $this->getWords();
		//~ array_shift($wordList);

		foreach ($xml->volume as $volume)
		{
			$data['vnum'] = (string) $volume['vnum'];
			foreach ($volume->entry as $entry) {
				$data['word'] = (string) $entry->head->word;
				$data['description'] = $entry->saveXML();
				$aliasword = $data['word'];
				$aliasword = $this->getaliasWords($aliasword);
				$data['aliasWord'] = $aliasword;
				array_push($metaData, $data);
			}
		}
		return $metaData;
	}
	
	private function getaliasWords($aliasword)
	{
		$aliasword = preg_replace('/Ā/','A',$aliasword);
		$aliasword = preg_replace('/ā/','a',$aliasword);
		$aliasword = preg_replace('/Ś/','S',$aliasword);
		$aliasword = preg_replace('/ś/','s',$aliasword);
		$aliasword = preg_replace('/Ū/','U',$aliasword);
		$aliasword = preg_replace('/ū/','u',$aliasword);
		$aliasword = preg_replace('/Ṣ/','S',$aliasword);
		$aliasword = preg_replace('/ṣ/','s',$aliasword);
		$aliasword = preg_replace('/Ī/','I',$aliasword);
		$aliasword = preg_replace('/ī/','i',$aliasword);
		$aliasword = preg_replace('/Ṅ/','N',$aliasword);
		$aliasword = preg_replace('/ṅ/','n',$aliasword);
		$aliasword = preg_replace('/Ṛ/','R',$aliasword);
		$aliasword = preg_replace('/ṛ/','r',$aliasword);
		$aliasword = preg_replace('/Ṭ/','T',$aliasword);
		$aliasword = preg_replace('/ṭ/','t',$aliasword);
		$aliasword = preg_replace('/Ṇ/','N',$aliasword);
		$aliasword = preg_replace('/ṇ/','n',$aliasword);
		$aliasword = preg_replace('/Ḍ/','D',$aliasword);
		$aliasword = preg_replace('/ḍ/','d',$aliasword);
		$aliasword = preg_replace('/Ṁ/','M',$aliasword);
		$aliasword = preg_replace('/ṁ/','m',$aliasword);
		$aliasword = preg_replace('/Ñ/','N',$aliasword);
		$aliasword = preg_replace('/ñ/','n',$aliasword);
		$aliasword = preg_replace('/Ḥ/','H',$aliasword);
		$aliasword = preg_replace('/ḥ/','h',$aliasword);
		$aliasword = preg_replace('/Ḷ/','L',$aliasword);
		$aliasword = preg_replace('/ḷ/','l',$aliasword);
		$aliasword = preg_replace('/Ṝ/','R',$aliasword);
		$aliasword = preg_replace('/ṝ/','r',$aliasword);
		return $aliasword;
	}
}

?>
