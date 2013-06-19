<?php $this->load->helper('asset') ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>::</title>
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
    <header class="header">
        <div class="top_nav">
            <div class="container">
            <ul class="pull-right">
                <!--<li><a href="<?=base_url()?>blog"><i class="icon icon-white icon-comment"></i>&nbsp;Blog</a></li>         
                <li><a href="<?=base_url()?>exhibition"><i class="icon icon-white icon-th"></i>&nbsp;Exhibition</a></li>-->
                <li style="padding-right:0px;"><a class="sns_button sns_button_twitter" href="http://www.twitter.com/artgrafii" target="_blank">&nbsp;</a></li>
                <li><a class="sns_button sns_button_facebook" href="http://www.facebook.com/artgrafii" target="_blank">&nbsp;</a></li>
            </ul>
            </div>
        </div>
        <div class="container">
            <div class="row" style="position:relative;"> 
                <div style="position:absolute;top:20px;left:20px;"> 
                    <img src="<?=img_asset_url('3liters_logo.png')?>" style="width:130px;"/>
                </div>
                <div class="span12">
                    <div class="" style="margin-top:60px;text-align:center;">
                    <img src="<?=img_asset_url('exhibition_caption.png','ag_layout_ver1')?>"/>
                    </div>
                </div> 
                
                <!--<div class="span6">
                    <ul class="gnb clearfix">
                        <li style="padding-left:0px;"> 
                            <a href="#">HOME </a>
                        </li>
	                    <li> 
	                        <a href="#">EXHIBITION </a>
	                    </li>
	                    <li> 
	                        <a href="#">BLOG </a>
	                    </li>
	                    <li class="active"> 
	                        <a href="#">TOUR </a>
	                    </li>
                    </ul>
                </div>-->
            </div>

            <hr/>
        </div> 
    </header> 
    <div class="container"> 
        <?= $contents ?>
    </div>
    <footer class="footer">
        <!--<div class="footer_content">
            <div class="container">
                <div class="row">
	                <div class="span3">
	                </div>
	
	                <div class="span3">
                        <h6 style="margin-top:30px;color:#000;"> About US </h6>
	                    <ul> 
	                        <li>아트그라피 소개</li>
	                        <li>전시 등록 요청</li>
	                    </ul>
	                </div>
	
	                <div class="span3"> 
                        <h6 style="margin-top:30px;color:#000;"> Contact US </h6>
                        <ul> 
	                        <li><a href="http://www.twitter.com/artgrafii" target="_blank">twitter</a>  </li>
	                        <li><a href="http://www.facebook.com/artgrafii" target="_blank">facebook</a>  </li>
	                        <li><a href="http://artgrafii.blog.me" target="_blank">blog</a>  </li>
	                    </ul>
	                </div> 
                    <div class="span3" style="background:#00afec;"> 
                        <h6 style="margin-top:30px;color:#fff;"> Newsletter </h6>
                        <form class="form-horizontal" style="margin-bottom:30px;">
                            <div class="control-group" style="margin-bottom:10px;"> 
                                <div class="controls" style="margin-left:0px;"> 
                                    <input type="text"  name="email" placeholder="email" style="background:#ddd;" />
                                </div>
                            </div> 
                            <div class="control-group"> 
                                <div class="controls" style="margin-left:0px;">
                                    <div class="input-append">
                                    <input type="text"  name="username" placeholder="이름" style="background:#ddd;width:149px;" />
                                    <button type="submit" class="btn btn-info">신청 </button>
                                    </div>
                                </div>
                            </div>
                        </form>
	                </div> 
                </div>
            </div>
        </div>-->
        <div class="footer_copyright"> 
        </div>
    </footer> 
    <?= $footer_data ?>

<script type="text/javascript"> 
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
