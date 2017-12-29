<div class="container dynamic-page" id="describeWord">
    <div class="row">
		<div class="col-md-12">
			<p id="prevNextWord">&nbsp;</p>
<?php foreach ($data as $row) { ?>
			<div class="word">
				<?php if($row['word']) { ?><div class="head-word"><?=$row['word']?></div><?php } ?>
				<?php if($row['wordNote']) { ?><div class="head-word-note"><?=$row['wordNote']?></div><?php } ?>
				<?php if($row['alias']) { ?><div class="alias-word"><?=$row['alias']?></div><?php } ?>
				<?php if($row['aliasNote']) { ?><div class="alias-word-note"><?=$row['aliasNote']?></div><?php } ?>
				<?php if($row['description']) { ?><div class="description"><?=$row['description']?></div><?php } ?>
			</div>
<?php } ?>
		</div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {

	// Next and previous links ajax requests
	var word = $('.word div.head-word').html();
	$.get( '<?=BASE_URL?>api/getNeighbours/' + word, function( data ) {
		
		data = JSON.parse(data);
		
		var prevNextContent = '';

		prevNextContent += (data['prev']) ? '<a href="<?=BASE_URL?>describe/word/' + data['prev'] + '">&lt; prev</a>' : '<span>&lt; prev</span>';
		prevNextContent += ' | ';
		prevNextContent += (data['next']) ? '<a href="<?=BASE_URL?>describe/word/' + data['next'] + '">next &gt;</a>' : '<span>next &gt;</span>';
		
		$('#prevNextWord').html(prevNextContent);
	});

	// Word highlighting
    var searchText = decodeURIComponent(getUrlParameter('search'));

    var html = $('.word .description').html();
    var re = new RegExp("\\b" + '(' + searchText + ')' + "\\b", "gi");
    html = html.replace(re, '<span class="highlight">' + "$1" + '</span>');

    $('.word .description').html(html);

    var highlight = $('.highlight');
    if(highlight.length) {
		var jumpLoc = $('.highlight').offset().top - $('#mainNavBar').height() - 50;
		$("body").animate({scrollTop: jumpLoc}, 500);
	}
});
</script>