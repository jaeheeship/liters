<?php $this->load->helper('url') ?>
<?php $this->load->helper('asset') ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>이야기가 함께하는 아트그라피</title>
    <?echo css_asset('bootstrap.css','bootstrap') ?>
    <?echo css_asset('/smoothness/jquery-ui-1.8.20.custom.css','jquery') ?>
    <?echo js_asset('jquery-1.7.2.min.js','jquery') ?>
    <?echo js_asset('bootstrap.min.js','bootstrap') ?>
</head>
<body>
    <header class="navbar">
        <div class="navbar-inner">
            <div class="container">
                <ul class="nav"> 
                    <li <?php if($this->uri->segment(2)=='dashboard'):?> class="active" <?php endif;?>> 
                        <a href="<?=base_url()?>index.php/admin/dashboard">Dashboard</a>
                    </li>
                    <li <?php if($this->uri->segment(2)=='rss'):?> class="active" <?php endif;?>> 
                        <a href="<?=base_url()?>index.php/admin/rss/feedlist">RSS</a>
                    </li> 
                    <li <?php if($this->uri->segment(2)=='webzine'):?> class="active" <?php endif;?>> 
                        <a href="<?=base_url()?>index.php/admin/webzine/layout_manager">PUBLISHING</a>
                    </li> 
                    <li <?php if($this->uri->segment(2)=='template'):?> class="active" <?php endif;?>> 
                        <a href="<?=base_url()?>index.php/admin/template/showlist">TEMPLATE</a>
                    </li> 

                    <li <?php if($this->uri->segment(2)=='exhibition'):?> class="active" <?php endif;?>> 
                        <a href="#">EXHIBITION</a>
                    </li> 
                </ul> 
            </div>
        </div>
    </header> 
