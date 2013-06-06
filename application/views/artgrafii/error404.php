<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php echo css_asset('style.css','error404') ; ?>
	<title>아트그라피::잘못된 요청입니다.</title>

</head>

<body>

<div class="container">
	<div class="logo">
		<a href="<?=base_url()?>"><img src="<?=img_asset_url('artgrafii_logo.png')?>" style="width:100px;"/></a>
	</div>
	<div class="clouds"></div>
	<h1>주소를 올바르게 입력하지 않으셨네요.<br/> 처음페이지로 돌아가시려면 아트그라피를 클릭해주세요. </h1>
	<!--<form class="search-box">
		<input type="text" value="What are you looking for?" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'What are you looking for?':this.value;">
		<input type="submit" class="search">	
	</form>-->
    <br/>
	<div class="sitemap">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">Exhibition</a></li>
			<li><a href="#">Blog Archave</a></li>
		</ul>
		<ul>
			<li><a href="#">아트그라피's 트위터 </a></li>
			<li><a href="#">아트그라피's 페이스북</a></li>
			<li><a href="#">아트그라피's 블로그</a></li>
		</ul>
		<ul>
			<li><a href="#">아트그라피 소개</a></li>
			<li><a href="#">Contact ME!</a></li>
		</ul>
	</div>
</div>

<div class="footer"><p>Copyright <strong>YourName</strong> 2011. All Rights Reserved.</p></div>


</body>
</html>
