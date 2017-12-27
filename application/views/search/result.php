<?php 
$data['match'] = array_merge($data['exactMatch'], $data['partialMatch']);
$searchText = $data['word'];
// unset($data['exactMatch']);
// unset($data['partialMatch']);
?>
<div class="container dynamic-page">
    <div class="row justify-content-start">
<?php foreach ($data['match'] as $row) { ?>
        <div class="col-md-4">
            <div class="word search">
                <?php if($row['word']) { ?><div class="head-word"><a href="<?=BASE_URL?>describe/word/<?=$row['word']?>"><?=$viewHelper->highlight($row['word'], $searchText)?></a></div><?php } ?>
                <?php if($row['wordNote']) { ?><div class="head-word-note"><?=$row['wordNote']?></div><?php } ?>
                <?php if($row['description']) { ?><div class="description"><?=$row['description']?></div><?php } ?>
            </div>
        </div>
<?php } ?>
    </div>
    <div class="row justify-content-start">
<?php foreach ($data['descriptionMatch'] as $row) { ?>
        <div class="col-md-12">
            <div class="word search">
                <?php if($row['word']) { ?><div class="head-word"><a href="<?=BASE_URL?>describe/word/<?=$row['word']?>"><?=$row['word']?></a></div><?php } ?>
                <?php if($row['wordNote']) { ?><div class="head-word-note"><?=$row['wordNote']?></div><?php } ?>
                <?php if($row['description']) { ?><div class="description"><?=$row['description']?></div><?php } ?>
            </div>
        </div>
<?php } ?>
    </div>
</div>
