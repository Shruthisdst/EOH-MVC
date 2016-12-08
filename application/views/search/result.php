<?php $res['A'] = sizeof($data['A']) ?>
<?php $res['B'] = sizeof($data['B']) ?>
<?php $res['C'] = sizeof($data['C']) ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
        <p id="results_nav" style="float: right;">
        	<a href="#A_results">Exact Match(<?=$res['A']?>)</a>&nbsp; | &nbsp;
        	<a href="#B_results">Partial Match(<?=$res['B']?>)</a>&nbsp; | &nbsp;
        	<a href="#C_results">In Description(<?=$res['C']?>)</a> 
        </p>
<?php foreach ($data as $key => $array) { ?>

	<?=$viewHelper->displayTitle($key,$res)?>

	<?php if( ($data[$key]) && ($key != 'C')): ?>
		<?php foreach ($array as $row) { ?>
    	    <?=$viewHelper->preProcessDescription($row->description,$row->word,$row->vnum,$row->id)?>
		<?php } ?>
	<?php elseif(($data[$key]) && ($key == 'C')): ?>
		<?php foreach ($array as $row) { ?>
    	    <?=$viewHelper->preProcessInDescription($row->description,$row->word,$row->vnum,$row->id,$key)?>	
		<?php } ?>
	<?php else: ?>
		<p class="no-results">No Results</p>
	<?php endif; ?>	

<?php } ?>
        </div>
    </div>    
</div>
