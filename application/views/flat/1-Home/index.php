<div class="container-fluid banner firstDiv">
    <div class="row justify-content-center overlay">
        <div class="col-md-12 align-self-center">
        	<h1><small>A Concise</small><br />Encyclopaedia of Hinduism</h1>
            <form action="<?=BASE_URL?>search/field/">
            	<input type="text" name="word" id="word" class="bigSearch mx-auto" placeholder="Search..." />
            </form>
    	</div>
		<a class="homepage scrollMore goTo" data-destination="#wordOfTheDay"><span></span>&nbsp;</a>
	</div>
</div>
<div id="wordOfTheDay" class="container word-of-the-day prelims">
    <div class="row justify-content-center">
        <div class="col-md-9">
        	<h2>&nbsp;</h2>
        	<h1>&nbsp;</h1>
        	<div class="description">&nbsp;</div>
    		<p class="see-more"><a href="#"></a></p>
    	</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {

    // Word of the day

    $.get( '<?=BASE_URL?>api/getWordOfTheDay', function( data ) {
        
        data = JSON.parse(data);
        
        $('.word-of-the-day h2').html('<span>Word of the day</span> <span>' + data['date'] + '</span>');
        $('.word-of-the-day h1').html(data['word']);
        $('.word-of-the-day div.description').html(data['description']);
 
        $('.word-of-the-day p.see-more a').attr('href', '<?=BASE_URL?>describe/word/' + data['word']);
        $('.word-of-the-day p.see-more a').html('read on...');
    });
});
</script>