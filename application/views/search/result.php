<div class="container">
    <div class="row">
        <div class="col-md-12">
<?php foreach ($data as $key => $array) { ?>

	<?=$viewHelper->displayTitle($key)?>

	<?php foreach ($array as $row) { ?>
        <?=$viewHelper->preProcessDescription($row->description,$row->word,$row->vnum,$row->id,$key)?>
	<?php } ?>

<?php } ?>
        </div>
    </div>    
</div>
