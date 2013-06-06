<div class="sidebar">
<ul class="nav nav-list bs-docs-sidenav affix-top">
    <li <? if($action=='uploadForm'):?> class="active" <?endif;?>><a href="<?=base_url();?>admin/filebox/uploadForm"><i class="icon-chevron-right"></i>파일 업로드 </a> </li>
    <li <? if($action=='fileList'):?> class="active" <?endif;?>><a href="<?=base_url();?>admin/filebox/fileList"><i class="icon-chevron-right"></i>파일 관리</a> </li>
    <li <? if($action=='tagCloud'):?> class="active" <?endif;?>><a href="<?=base_url();?>admin/filebox/tagCloud"><i class="icon-chevron-right"></i>태그클라우드</a> </li>
    <li <? if($action=='trashFileList'):?> class="active" <?endif;?>><a href="<?=base_url();?>admin/filebox/trashFiles"><i class="icon-chevron-right"></i>휴지통</a> </li>
</ul>
</div>
