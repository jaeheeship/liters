<div class="sidebar">
<ul class="nav nav-list bs-docs-sidenav affix-top">
    <li <? if($action=='exhbForm'):?> class="active" <?endif;?>><a href="<?=base_url();?>admin/exhibition/exhbForm"><i class="icon-chevron-right"></i>전시 등록/수정 </a> </li>
    <li <? if($action=='exhbList'):?> class="active" <?endif;?>><a href="<?=base_url();?>admin/exhibition/exhbList"><i class="icon-chevron-right"></i>전시 목록 </a> </li>
    <li <? if($action=='pubExhbList'):?> class="active" <?endif;?>><a href="<?=base_url();?>admin/exhibition/exhbList"><i class="icon-chevron-right"></i>발행한 전시 목록 </a> </li>
    <li <? if($action=='preExhbList'):?> class="active" <?endif;?>><a href="<?=base_url();?>admin/exhibition/exhbList"><i class="icon-chevron-right"></i>발행 예정 전시 목록 </a> </li>
    <li <? if($action=='tagCloud'):?> class="active" <?endif;?>><a href="<?=base_url();?>admin/exhibition/tagCloud"><i class="icon-chevron-right"></i>태그클라우드</a> </li>
</ul>
</div>
