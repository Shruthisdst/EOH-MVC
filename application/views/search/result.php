<div class="container">
    <div class="row">
        <div class="col-md-12">
<?php foreach ($data as $row) { ?>
        <?=$viewHelper->preProcessDescription($row->description,$row->word,$row->vnum,$row->id)?>
<?php } ?>
        </div>
    </div>    
</div>
