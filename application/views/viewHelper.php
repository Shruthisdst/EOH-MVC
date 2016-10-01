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
            echo '<span class="vnum clr1"><a href="'. BASE_URL .'describe/volume/' . $vnum . '">Volume&nbsp;-&nbsp;'.intval($vnum).'</a></span>';
            echo '</div>';
            echo '<div class="grammarLabel">';
			foreach ($xmlObj->head->note as $note)
			{
				if($note != '')
				{
					echo '<span>'.$note.'</span>';
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
    public function replaceHeadings($xmlVal)
	{
		if(preg_match('#<ref href="<span style="color: red">#', $xmlVal, $match))
		{
			$xmlVal = preg_replace('/<span style="color: red">(.*?)<\/span>/', "$1", $xmlVal);
		}
		$xmlVal = preg_replace('/<strong>(.*?)<\/strong>/', "<span class=\"boldText\">$1</span>", $xmlVal);
		$xmlVal = preg_replace('/<h1>(.*)<\/h1>/', "<p class=\"normalText\">$1</p>", $xmlVal);
		$xmlVal = preg_replace('/<h2>(.*)<\/h2>/', "<p class=\"italicText\">$1</p>", $xmlVal);
		$xmlVal = preg_replace('/<p type="poem">(.*)<\/p>/', "<p class=\"poem\">$1</p>", $xmlVal);
		$xmlVal = preg_replace('/<h3>(.*)<\/h3>/', "<p class=\"italicBold\">$1</p>", $xmlVal);
		$xmlVal = preg_replace('/<figcaption>(.*)<\/figcaption>/', "<p class=\"figCaption\">$1</p>", $xmlVal);
		$xmlVal = preg_replace('/<ref href="">(.*?)<\/ref>/', "<span class=\"seecrossref\"><a href=\"#\">$1</a></span>",$xmlVal);
		$xmlVal = preg_replace('/<ref href="(.*?)">(.*?)<\/ref>/', "<span class=\"seecrossref\"><a href=\"". BASE_URL ."describe/word/$1\">$2</a></span>",$xmlVal);
		return($xmlVal);
	}
	public function displayVolume($vnum)
	{
		$vnum = preg_replace('/^0+/', '', $vnum);
        $vnum = preg_replace('/\-0+/', '-', $vnum);
        return $vnum;
	}
}
?>
