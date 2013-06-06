<?php $this->load->helper('url') ?>
<?php $this->load->helper('asset') ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>[로그인]이야기가 함께하는 아트그라피</title>
    <?echo css_asset('bootstrap.css','bootstrap') ?>
    <?echo css_asset('/smoothness/jquery-ui-1.8.20.custom.css','jquery') ?>
    <?echo js_asset('jquery-1.7.2.min.js','jquery') ?>
    <?echo js_asset('bootstrap.min.js','bootstrap') ?>
</head>
<body style="background:#000;">
    <div class="container">
        <div class="hero-unit">
            <h1>Login <small>회원가입부터 먼저 하세요.</small></h1> 
            <hr/>
            <form class="form-horizontal" method="post" action="do_login"> 
                <div class="control-group"> 
                    <label class="control-label"><i class="icon icon-envelope"></i> Email </label>
		            <div class="controls"> 
                        <input type="text" name="login_id" placeholder="abc@abc.com" />
		            </div>
                </div> 
                <div class="control-group"> 
                    <label class="control-label">PASSWORD </label>
		            <div class="controls"> 
                        <input type="password" name="password" />
		            </div>
                </div> 
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-large">로그인 </button>
                    <!--<a class="btn btn-primary btn-large" href="join">회원가입 </a>-->
                </div>
            </form>
        </div>
    </div>
</body>
</html>
