<?php $this->load->helper('asset') ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>이야기가 함께하는 아트그라피</title>
    <?echo css_asset('bootstrap.css','bootstrap') ?>
    <?echo css_asset('/smoothness/jquery-ui-1.8.20.custom.css','jquery') ?>
    <?echo js_asset('jquery-1.7.2.min.js','jquery') ?>
    <?echo js_asset('jquery-ui-1.8.20.custom.min.js','jquery') ?>
    <?echo js_asset('bootstrap.min.js','bootstrap') ?>
    <?echo css_asset('style.css','ag_layout_ver1') ?>
    <?= $header_data ?>
    <script>
    var base_url = '<?=base_url()?>'; 
    </script>
</head>
<body>
</body>
</html>
