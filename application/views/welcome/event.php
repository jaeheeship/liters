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
<style>
.cyan_box { background : #fff;border-top:5px solid #00aeef;;border-bottom:5px solid #00aeef;;padding:15px; }  
.cyan_box h6 {font-size:1.2em; color:#00aeef;}

.box_background { background:#fafafa;color:#999;}
.thumbnail img { height:162px;}
.corner_lt {position:absolute;top:0px;left:0px;;width:30px;height:30px;border-left:10px solid #ccc;border-top:10px solid #ccc;}

.corner_rb {position:absolute;bottom:0px;right:0px;;width:30px;height:30px;border-right:10px solid #ccc;border-bottom:10px solid #ccc;}
.span4 {margin-bottom:20px;}

.hover { background: #00aeef ;color:#fff;}
.hover h3 {color:#fff;}
.hover strong { color:#fff;}

h3 { font-size:1.3em ;}

</style>
</head>
<body>
        <div style="border:5px solid #00aeef;padding:15px;margin:15px; "> 
            <h6 style="font-size:1.2em; font-weight:bold;color:#00aeef;"> 리뷰쓰고 광주비엔날레 도록 받자~ </h6>
            <p> 이벤트에 참여해주신 분들을 추첨하여, 도록과 티켓을 드립니다. </p>
            <p> 
            </p>
        </div>
    <textarea style=";margin:20px;padding:10px;width:100%;height:100px;;" >
        <div style="border:2px solid #00aeef;padding:15px; "> 
            <h6 style="font-size:1.2em; font-weight:bold;color:#00aeef;"> 리뷰쓰고 광주비엔날레 도록 받자~ </h6>
            <p> 이벤트에 참여해주신 분들을 추첨하여, 도록과 티켓을 드립니다.  

            </p>
        </div> 
    </textarea>
</body>
</html>
