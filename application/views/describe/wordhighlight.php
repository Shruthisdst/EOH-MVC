 <script type="text/javascript">
    $(document).ready(function() {

        var hloc = <?=$data['innerid']?>;
        var jumpLoc = $( hloc ).offset().top - $('.navbar-default').height();
        $("html, body").animate({scrollTop: jumpLoc}, 1000);
    }); 
</script>
<div class="container">
<?php foreach ($data['data'] as $row) { ?>
    <div class="row">
        <!-- Column 1 -->
        <div class="col-md-12">
        <?=$viewHelper->preProcessDescription($row->description,$row->word)?>
        </div>
    </div>    
<?php } ?>
</div>
