<div class="container dynamic-page">
    <div class="row">
		<div class="col-md-12">
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
