<div class="sidebar">
<ul class="nav nav-list bs-docs-sidenav affix-top">
    <li <? if($action=='writeform'):?> class="active" <?endif;?>><a href="<?=base_url();?>admin/place/writeform"><i class="icon-chevron-right"></i>장소 등록/수정 </a> </li>
    <li <? if($action=='placeList'):?> class="active" <?endif;?>><a href="<?=base_url();?>admin/place/placeList"><i class="icon-chevron-right"></i>장소 목록 </a> </li>
    <li <? if($action=='tagCloud'):?> class="active" <?endif;?>><a href="<?=base_url();?>admin/place/tagCloud"><i class="icon-chevron-right"></i>태그클라우드</a> </li>
</ul>
</div>
