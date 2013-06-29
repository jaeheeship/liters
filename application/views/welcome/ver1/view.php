<div class="container">
    <h3 style="font-family:NanumGothic;font-size:15px;"><span class="icon icon-file"></span>&nbsp;<?=$article->title;?></h3>
</div>

<iframe  id="ifrm" src="<?=$article->link;?>" style="width:100%;border:0px;height:100%;" frameborder="0" scrolling="no"> </iframe>

<script>
jQuery(function() {
        sizeIFrame();
        jQuery("#ifrm").load(sizeIFrame);
});

function sizeIFrame() { 
    var videoBrowser = jQuery("#ifrm");
    var innerDoc = videoBrowser.get(0).contentDocument ?
        videoBrowser.get(0).contentDocument.documentElement :
        videoBrowser.get(0).contentWindow.document.body;
    	videoBrowser.height(900);

	if(innerDoc != null){
    	videoBrowser.height(innerDoc.scrollHeight + 25);
	}else{
    	videoBrowser.height(videoBrowser.get(0).scrollHeight + 25);
	}
}
</script>
