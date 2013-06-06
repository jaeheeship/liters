<?php $this->load->helper('asset') ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>이야기가 함께하는 아트그라피</title>
    <meta property="os:title" content="이야기가 함께하는 아트그라피"/>
    <link rel="shortcut icon" href="<?=base_url();?>favicon.ico" />
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <?php echo css_asset('bootstrap.css','bootstrap3') ?>
    <?php echo css_asset('docs.css','bootstrap3') ?>
    <?echo js_asset('jquery-1.7.2.min.js','jquery') ?>
    <?echo js_asset('bootstrap.min.js','bootstrap') ?>

    <script>
    var base_url = '<?=base_url()?>'; 
    </script>
</head>
<body class="bs-docs-home">
    <div class="container"> 
        <div class="row">
            <div class="col col-lg-3">
                <img src="<?=img_asset_url('artgrafii_logo.png','bootstrap3');?>" style="width:150px;" />
                <hr/>
                <ul class="nav nav-pills nav-stacked">
                    <li> <a href="#">About</a> </li>
                    <li> <a href="#">Twitter</a> </li>
                    <li> <a href="#">Facebook</a> </li>
                    <li> <a href="#">Blog</a> </li>
                </ul>
            </div>
            <div class="col col-lg-9">
            <?php  echo $contents ;?>
            </div>
        </div>
    </div>
</body>
</html> 
