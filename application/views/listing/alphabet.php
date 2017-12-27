<div class="container dynamic-page">
	<div class="row">
		<!-- Column 1 -->
		<div class="col-md-12 text-center">
			<ul class="list-inline alphabet">
				<li><a href="<?=BASE_URL?>listing/alphabet/A">A</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/B">B</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/C">C</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/D">D</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/E">E</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/F">F</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/G">G</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/H">H</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/I">I</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/J">J</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/K">K</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/L">L</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/M">M</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/N">N</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/O">O</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/P">P</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/R">R</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/S">S</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/T">T</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/U">U</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/V">V</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/W">W</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/Y">Y</a></li>
				<li><a href="<?=BASE_URL?>listing/alphabet/Z">Z</a></li>
               </ul>
		</div>
	</div>
</div>
<div class="container">
        <div class="col-md-12 column-7">

<?php foreach ($data as $row) { ?>
            <div><a href="<?=BASE_URL?>describe/word/<?= $row->word ?>"><?= $row->word ?></a></div>    
<?php } ?>
        </div>
</div>
