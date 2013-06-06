<div class="sidebar">
<ul class="nav nav-list bs-docs-sidenav affix-top">
    <li <? if($action=='feedlist'):?> class="active" <?endif;?>><a href="<?=base_url();?>admin/rss/feedlist"><i class="icon-chevron-right"></i>RSS 등록/수정 </a> </li>
    <li <? if($action=='articleList'):?> class="active" <?endif;?>><a href="<?=base_url();?>admin/rss/articleList"><i class="icon-chevron-right"></i>아티클</a> </li>
</ul>
</div>
