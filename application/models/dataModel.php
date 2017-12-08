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
		$wordList = $this->getWords();
		array_shift($wordList);

		foreach ($xml->volume as $volume)
		{
			$data['vnum'] = (string) $volume['vnum'];
			foreach ($volume->entry as $entry)
			{
				$data['word'] = (string) $entry->head->word;
				$data['description'] = $entry->saveXML();
				$aliasword = $data['word'];
				$aliasword = $this->getaliasWords($aliasword);
				$data['aliasWord'] = $aliasword;
				
				foreach($wordList as $eachWord)
				{
					$ucfirst = ucfirst($eachWord['word']);
					$lcfirst = lcfirst($eachWord['word']);
					
					if(preg_match('/^[Ā|ā|Ś|ś|Ū|ū|Ṣ|ṣ|Ī|ī|Ṅ|ṅ|Ṛ|ṛ|Ṭ|ṭ|Ṇ|ṇ|Ḍ|ḍ|Ṁ|ṁ|Ñ|ñ|Ḥ|ḥ|Ḷ|ḷ|Ṝ|ṝ]/', $eachWord['word']))
					{
						$data['description'] = preg_replace('/' . $eachWord['word'] . '/', '<span class="linkword">' . $eachWord['word'] . '</span>', $data['description']);
					}
					elseif (preg_match('/[Ā|ā|Ś|ś|Ū|ū|Ṣ|ṣ|Ī|ī|Ṅ|ṅ|Ṛ|ṛ|Ṭ|ṭ|Ṇ|ṇ|Ḍ|ḍ|Ṁ|ṁ|Ñ|ñ|Ḥ|ḥ|Ḷ|ḷ|Ṝ|ṝ]$/', $eachWord['word']))
					{
						if(preg_match('/^[a-z]/', $eachWord['word']))
						{
							$data['description'] = preg_replace('/' . $ucfirst . '/', '<span class="linkword">' . $ucfirst . '</span>', $data['description']);
						}
						elseif(preg_match('/^[A-Z]/', $eachWord['word']))
						{
							$data['description'] = preg_replace('/' . $lcfirst . '/', '<span class="linkword">' . $lcfirst . '</span>', $data['description']);
						}
						$data['description'] = preg_replace('/' . $eachWord['word'] . '/', '<span class="linkword">' . $eachWord['word'] . '</span>', $data['description']);
					}
					else
					{
						if(preg_match('/^[a-z]/', $eachWord['word']))
						{
							$data['description'] = preg_replace('/\b' . $ucfirst . '\b/', '<span class="linkword">' . $ucfirst . '</span>', $data['description']);
						}
						elseif(preg_match('/^[A-Z]/', $eachWord['word']))
						{
							$data['description'] = preg_replace('/\b' . $lcfirst . '\b/', '<span class="linkword">' . $lcfirst . '</span>', $data['description']);
						}
						$data['description'] = preg_replace('/\b' . $eachWord['word'] . '\b/', '<span class="linkword">' . $eachWord['word'] . '</span>', $data['description']);
					}
					$data['description'] = preg_replace('/<word><span class="linkword">(.*)<\/span><\/word>/', '<word>\1</word>', $data['description']);
					$data['description'] = preg_replace('/<word>(.*)<span class="linkword">(.*)<\/span>(.*)<\/word>/', '<word>\1\2\3</word>', $data['description']);
					$data['description'] = preg_replace('/<note>(.*)<span class="linkword">(.*)<\/span>(.*)<\/note>/', '<note>\1\2\3</note>', $data['description']);
				}
				
				//~ $data['description'] = preg_replace('/<span class="linkword">([a-zA-Z|À-ž|Ḁ-ẕ]+)<\/span>([a-zA-Z|À-ž|Ḁ-ẕ]+)/', '\1\2', $data['description']);
				$data['description'] = preg_replace('/"<span class="linkword">(.*?)<\/span>/', '"\1', $data['description']);
				$data['description'] = preg_replace('/<span class="linkword">(.*?)<\/span>">/', '\1">', $data['description']);
				$data['description'] = preg_replace('/<span class="linkword">([a-zA-Z|À-ž|Ḁ-ẕ]+)<span class="linkword">([a-zA-Z|À-ž|Ḁ-ẕ]+)<\/span><\/span>/', '<span class="linkword">\1\2</span>', $data['description']);
				$data['description'] = preg_replace('/-<span class="linkword">([a-zA-Z|À-ž|Ḁ-ẕ]+)<\/span>/', '-\1', $data['description']);
				$data['description'] = preg_replace('/<span class="linkword">([a-zA-Z|À-ž|Ḁ-ẕ]+)<\/span>-/', '\1-', $data['description']);
				$data['description'] = preg_replace('/<\/span><span class="linkword">/', '', $data['description']);
				$data['description'] = preg_replace('/([a-zA-Z]+)<span class="linkword">([a-zA-Z|À-ž|Ḁ-ẕ]+)<\/span>/', '\1\2', $data['description']);
				$data['description'] = preg_replace('/<span class="linkword">([a-zA-Z|À-ž|Ḁ-ẕ]+)<\/span>([a-zA-Z]+)/', '\1\2', $data['description']);
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
