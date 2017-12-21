<?php
class viewHelper extends View {
	public function __construct() {
	}
    public function preProcessDescription($description,$word,$vnum,$id){

        $xmlObj=simplexml_load_string($description);
        //~ echo dom_import_simplexml($xmlObj)->textContent;
            $footNote = '';
            echo '<div class="word">';
			echo '<div class="whead">';
            echo '<span class="engWord clr1">'.$xmlObj->head->word;
            foreach ($xmlObj->head->alias as $alias)
			{
				if($alias != '')
				{
					echo ', ' . $alias;
				}
			}
            echo '</span>';
//            echo '<span class="vnum clr1"><a href="'. BASE_URL .'describe/volume/' . $vnum . '">Volume&nbsp;-&nbsp;'.intval($vnum).'</a></span>';
            echo '</div>';
            echo '<div class="grammarLabel">';
			foreach ($xmlObj->head->note as $note)
			{
				if($note != '')
				{
					echo '<span>' . $note . '</span>';
				}
				else
				{
					echo '<span></span>';
				}
			}
			echo '</div>';
			echo '<div class="wBody">';
			$fig = $xmlObj->description->figure;
			$figNum = '';
			foreach ($xmlObj->description->children() as $child)
			{
				$xmlVal = $child->asXML();
				$xmlVal = $this->replaceHeadings($xmlVal);
				if(preg_match('#<aside>(.*?)<\/aside>#', $xmlVal, $match))
				{
					$xmlVal = preg_replace('/<aside>(.*)<\/aside>/', "<span class=\"fntsymbol\">*</span>", $xmlVal);

						echo $xmlVal;

					$footNote = $match[1];
				}
				elseif(preg_match('#<figure>#', $xmlVal, $match))
				{
					$f = 1;
		
					$count = count($fig);
					if($count > 1)
					{
						if($figNum <= $count)
						{
							$figNum = $figNum + $f;
							echo "<span class='crossref'><a href='". PUBLIC_URL . "images/thumbs/" . $word . "_".$figNum.".png' data-lightbox='imgae-".$id."' data-title='". $xmlObj->head->word . "'><img src='". PUBLIC_URL . "images/main/". $word . ""."_".$figNum.".png' alt='Figure:" . $xmlObj->head->word . "' /></a></span><br />";

							echo $xmlVal;
						}
						$f++;
					}
					else
					{
						echo "<span class='crossref'><a href='" . PUBLIC_URL . "images/thumbs/" . $word . ".png' data-lightbox='imgae-".$id."' data-title='". $xmlObj->head->word . "'><img src='". PUBLIC_URL . "images/main/".$word.".png' alt='Figure:" . $xmlObj->head->word . "' /></a></span><br />";

						echo $xmlVal;
					}
				}
				else
				{

					echo $xmlVal;
				}
			}
			if($footNote != '')
			{
				echo "<div class=\"FootNote\">";
				foreach ($xmlObj->description->children() as $child)
				{
					$xmlVal = $child->asXML();
					if(preg_match('#<aside>(.*?)<\/aside>#', $xmlVal, $match))
					{
						echo "<div><span class=\"fntsymbol\">*</span>$match[1]</div>";
					}
				}
				echo '</div>';
			}
			$footNote = '';
            echo '</div>';
			echo '</div>';
    }

    public function preProcessInDescription($description,$word,$vnum,$id,$key){

		$searchword	= $this->getSearchWord();
		$searchwords = preg_split('/ |-/', $searchword);
		array_push($searchwords, $searchword);

		$displayString = '';
		$isempty = 0; 

        $xmlObj=simplexml_load_string($description);
        //~ echo dom_import_simplexml($xmlObj)->textContent;
            $footNote = '';
            $displayString = $displayString . '<div class="word">';
			$displayString = $displayString . '<div class="whead">';
            $displayString = $displayString . '<span class="engWord clr1">'. $xmlObj->head->word;
            foreach ($xmlObj->head->alias as $alias)
			{
				if($alias != '')
				{
					$displayString = $displayString . ', ' . $alias;
				}
			}
            $displayString = $displayString . '</span>';
//            $displayString = $displayString .  '<span class="vnum clr1"><a href="'. BASE_URL .'describe/volume/' . $vnum . '">Volume&nbsp;-&nbsp;'.intval($vnum).'</a></span>';
            $displayString = $displayString . '</div>';
            $displayString = $displayString . '<div class="grammarLabel">';
			foreach ($xmlObj->head->note as $note)
			{
				if($note != '')
				{
					$displayString = $displayString . '<span>'; 
					$textValue =  $this->replaceSearchWords($note,$searchwords); 
					if($textValue != '')
					{
						$isempty = 1;
						$displayString = $displayString . $textValue;
					}	
					$displayString = $displayString . '</span>';
				}
				else
				{
					$displayString = $displayString . '<span></span>';
				}
			}
			$displayString = $displayString . '</div>';
			$displayString = $displayString . '<div class="wBody">';
			$fig = $xmlObj->description->figure;
			$figNum = '';
			foreach ($xmlObj->description->children() as $child)
			{
				$xmlVal = $child->asXML();
				$xmlVal = $this->replaceTags($xmlVal);

				if(preg_match('#<aside>(.*?)<\/aside>#', $xmlVal, $match))
				{
					$xmlVal = preg_replace('/<aside>(.*)<\/aside>/', "<span class=\"fntsymbol\">*</span>", $xmlVal);

					$textValue = $this->replaceSearchWords($xmlVal,$searchwords); 
					if($textValue != '')
					{
						$isempty = 1;
						$displayString = $displayString . $textValue;
					}
					$footNote = $match[1];
				}
				elseif(preg_match('#<figure>#', $xmlVal, $match))
				{
					$f = 1;
					
					$count = count($fig);
					if($count > 1)
					{
						if($figNum <= $count)
						{
							$figNum = $figNum + $f;
							// echo "<span class='crossref'><a href='". PUBLIC_URL . "images/thumbs/" . $word . "_".$figNum.".png' data-lightbox='imgae-".$id."' data-title='". $xmlObj->head->word . "'><img src='". PUBLIC_URL . "images/main/". $word . ""."_".$figNum.".png' alt='Figure:" . $xmlObj->head->word . "' /></a></span><br />";
							// echo $this->replaceSearchWords($xmlVal,$searchwords); 
						}
						$f++;
					}
					else
					{
						// echo "<span class='crossref'><a href='" . PUBLIC_URL . "images/thumbs/" . $word . ".png' data-lightbox='imgae-".$id."' data-title='". $xmlObj->head->word . "'><img src='". PUBLIC_URL . "images/main/".$word.".png' alt='Figure:" . $xmlObj->head->word . "' /></a></span><br />";
	
						// echo $this->replaceSearchWords($xmlVal,$searchwords); 
	
					}
				}
				elseif(preg_match('#<ol>#', $xmlVal))
				{
					// echo "<ol>";
					foreach ($child->children() as $lichild){

						$lixmlVal = $lichild->asXML();
						$textValue = $this->replaceSearchWords($lixmlVal,$searchwords);
						if($textValue != '')
						{
							$isempty = 1;
							$displayString = $displayString . $textValue;
						}
					}
					// echo "</ol>";				
				}				
				elseif(preg_match('#<ul>#', $xmlVal))
				{
					// echo "<ul>";
					foreach ($child->children() as $lichild){

						$lixmlVal = $lichild->asXML();
						$textValue = $this->replaceSearchWords($lixmlVal,$searchwords);
						if($textValue != '')
						{
							$isempty = 1;
							$displayString = $displayString . $textValue;
						}

					}
					// echo "</ul>";				
				}
				else
				{
					$textValue = $this->replaceSearchWords($xmlVal,$searchwords); 
					if($textValue != '')
					{
						$isempty = 1;
						$displayString = $displayString . $textValue;
					}
				}
			}
			if($footNote != '')
			{
				$displayString = $displayString ."<div class=\"FootNote\">";
				foreach ($xmlObj->description->children() as $child)
				{
					$xmlVal = $child->asXML();
					if(preg_match('#<aside>(.*?)<\/aside>#', $xmlVal, $match))
					{
						$textModfied = $this->replaceSearchWords($match[1], $searchwords);
						if($textModfied != ''){
							$isempty = 1;
							$displayString = $displayString . "<div><span class=\"fntsymbol\">*</span>" . $textModfied . "</div>";
						}
					}
				}
				$displayString = $displayString . '</div>';
			}
			$footNote = '';
			$displayString = $displayString . '<p style="float: right;"><a href="'. BASE_URL .'describe/word/'.$word.'" title="for more details click here">....More</a></p>';
            $displayString = $displayString . '</div>';
			$displayString = $displayString .'</div>';
			if($isempty){
				echo $displayString;
			}
    }

    public function replaceHeadings($xmlVal)
	{
		if(preg_match('#<ref href="<span style="color: red">#', $xmlVal, $match))
		{
			$xmlVal = preg_replace('/<span style="color: red">(.*?)<\/span>/', "$1", $xmlVal);
		}
		$xmlVal = preg_replace('/<strong>(.*?)<\/strong>/', "<span class=\"boldText\">$1</span>", $xmlVal);
		$xmlVal = preg_replace('/<h1>(.*)<\/h1>/', "<h1 class=\"normalText\">$1</h1>", $xmlVal);
		$xmlVal = preg_replace('/<h2>(.*)<\/h2>/', "<h2 class=\"italicText\">$1</h2>", $xmlVal);
		$xmlVal = preg_replace('/<p type="poem">(.*)<\/p>/', "<p class=\"poem\">$1</p>", $xmlVal);
		$xmlVal = preg_replace('/<h3>(.*)<\/h3>/', "<h3 class=\"italicBold\">$1</h3>", $xmlVal);
		$xmlVal = preg_replace('/<figcaption>(.*)<\/figcaption>/', "<p class=\"figCaption\">$1</p>", $xmlVal);
		$xmlVal = preg_replace('/<ref href="">(.*?)<\/ref>/', "<span class=\"seecrossref\"><a href=\"#\">$1</a></span>",$xmlVal);
		$xmlVal = preg_replace('/<ref href="(.*?)">(.*?)<\/ref>/', "<span class=\"seecrossref\"><a href=\"". BASE_URL ."describe/word/$1\">$2</a></span>",$xmlVal);
		return($xmlVal);
	}

    public function replaceTags($xmlVal)
	{
		$xmlVal = preg_replace('/<ref href="(.*?)">(.*?)<\/ref>/', "$1",$xmlVal);
		$xmlVal = preg_replace('/<ref href="">(.*?)<\/ref>/', "$1",$xmlVal);
		$xmlVal = preg_replace('/<h1>(.*)<\/h1>/', "<h1 class=\"normalText\">$1</h1>", $xmlVal);
		$xmlVal = preg_replace('/<h2>(.*)<\/h2>/', "<h2 class=\"italicText\">$1</h2>", $xmlVal);
		$xmlVal = preg_replace('/<p type="poem">(.*)<\/p>/', "<p class=\"poem\">$1</p>", $xmlVal);
		$xmlVal = preg_replace('/<h3>(.*)<\/h3>/', "<h3 class=\"italicBold\">$1</h3>", $xmlVal);
		$xmlVal = preg_replace('/<figcaption>(.*)<\/figcaption>/', "<p class=\"figCaption\">$1</p>", $xmlVal);		
		return($xmlVal);
	}

	public function displayVolume($vnum)
	{
		$vnum = preg_replace('/^0+/', '', $vnum);
        $vnum = preg_replace('/\-0+/', '-', $vnum);
        return $vnum;
	}

	public function displayTitle($key){

		$array = array("A" => "Exact Match", "B"=>"Partial Match", "C"=>"In Description");
		echo '<h1 class="search-results" id="'. $key . '_results">' . $array[$key] . '</h1>';
	}

	public function getSearchWord(){

		return filter_input_array(INPUT_GET, FILTER_SANITIZE_SPECIAL_CHARS)['word'];
	}

	public function replaceSearchWords($text,$words){

		foreach($words as $word){

			if(preg_match('/'. $word  .'/i', $text)){

				// $text = preg_replace('/('. $word .')/i', '<span class="searchword">$1</span>' , $text);
				$text = $this->getSorroundingWords($text,$word);
				return $text;				
			}
		}

		return '';
	}

	public function getSorroundingWords($text,$searchWord){

		 $text = preg_replace('/class="linkword"/', '', $text);
		 $text = preg_replace('/<span>/', '', $text);
		 $text = preg_replace('/<\/span>/', '', $text);

		$textWords = preg_split('/ /', $text);
		// var_dump($textWords);

		$searchList = preg_grep('/' . $searchWord . '/i', $textWords);
		$key = key($searchList);
		$left = $key-10;
		$right = $key+10;
		$left = ($left < 0) ? 0 : $left;
		$right = ($right > count($textWords)) ? count($textWords) : $right;
		$right = $right-$left;
		$output = array_slice($textWords, $left, $right);
		$output = implode(" ", $output);
		$output = preg_replace('/(' . $searchWord . ')/i', '<span class="searchword">$1</span>', $output);

		$text = '.......... ' . $output . '..........';

		$text = preg_replace('/<p>|<li>|<td>/','',$text);
		$text = preg_replace('/<\/p>|<\/li>|<\/td>/','',$text);
		$text ='<p>' . $text . '</p>';
		return $text;

	}

}
?>
