<?php $this->load->helper('asset') ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>::</title>
    <meta property="os:title" content="이야기가 함께하는 아트그라피"/>
    <link rel="shortcut icon" href="<?=base_url();?>favicon.ico">

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

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
<body style="padding-top:45px;"> 
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="./index.html">혼자이면서 함께사는 집::3liters</a>
            <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                    <li class="">
                    <a href="<?=base_url();?>"><span class="icon icon-home icon-white"></span>&nbsp;Home</a>
                    </li> 
                </ul>
            </div>
        </div>
    </div>
</div> 
<div> 
    <?= $contents ?>
</div> 
<script type="text/javascript"> 
$('#feedback_btn').tooltip(); 
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-28026935-1']);
_gaq.push(['_trackPageview']);

(function() {
 var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
 ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
 var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
 })();

</script>

</body>
</html>
