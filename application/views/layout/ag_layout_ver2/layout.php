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
<body style="padding-top:40px;">
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


    <header class="header"> 
        <div class="container" >
            <div class="row" style="height:60px;padding-top:15px;padding-bottom:15px;"> 
                <div class="span2" style="margin-top:7px;"> 
                    <a href="<?=base_url();?>exhibition"><img src="<?=img_asset_url('3liter_logo.png'); ?>" style="width:100px;" /> </a>
                </div>
                <div class="span8"> 
                    <!--<form style="text-align:center;margin-top:25px;" method="get" action="<?=base_url()?>exhibition/search" > 
                        <div class="input-append">
                        <input type="text" name="keyword" class="span5" placeholder="아트그라피와 함께 찾아보는 전시" style="background:#fafafa;" value="<?=@$keyword;?>" />
                        <span class="add-on"><i class="icon icon-search"></i> </span>
                        </div>
                    </form>-->
                </div>
                <div class="span2">

                </div>
            </div> 
        </div> 
        </div>
    </header> 
    <div class="container"> 
        <?= $contents ?>
    </div>
    <footer class="footer">
        <hr/>
        <div style="text-align:center;">
            <br/>
            <br/>
            <br/>
        </div> 
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
        
    </footer> 
    <!--<div style="position:fixed;bottom:0;left:0;right:0;">
        <div class="container">
            <div style="margin: 0 auto;width:200px;background:#000;padding:5px;">
            <div style="text-align:center;"> 
                <a href="<?=base_url();?>thanksForYourLetter" data-toggle="tooltip" title="아트그라피에게 전하고 싶은 말이나,<br/> 희망사항 등을 들려주세요. " id="feedback_btn"><i class="icon icon-white icon-edit"></i>&nbsp;Feedback </a>
            
            </div>
            </div>
        </div>
    </div>-->
    <?= $footer_data ?> 
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
