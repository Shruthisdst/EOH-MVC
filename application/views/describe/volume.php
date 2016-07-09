<div class="container">
    <div class="row">
        <div class="col-md-12">
			<h1 class="clr1 gapBelowSmall">Volume : <?=intval($data[0]->vnum)?></h1>
<?php foreach ($data as $row) { ?>

        <?=$viewHelper->preProcessDescription($row->description,$row->word,$row->vnum,$row->id)?>
<?php } ?>
        </div>
    </div>    
</div>
