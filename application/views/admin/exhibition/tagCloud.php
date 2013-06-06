<div class="content">
    <?php 
        $width = round(100/count($tagMap)) ; 
    ?>
	<?php foreach($tagMap as $key => $tag_list):?>
	<div style="float:left;width:<?=$width;?>%">
        <div style="padding-left:10px;padding-right:10px;">
            <div class="well">
		        <h4><?=$key;?> </h4>
		        <ul>
		            <?php foreach($tag_list as $key => $tag):?>
		            <li> 
		                <span><?=$tag->tag_name?></span>
		            </li>
		            <?php endforeach;?>
		        </ul>
            </div>
        </div>
	</div>
	<?php endforeach;?>
</div>
