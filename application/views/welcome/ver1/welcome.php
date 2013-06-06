<?php $this->load->helper('image') ;  ?>
<style>
    #blog_list { list-style :none; }
    #blog_list li:hover a { color:#fff;}
</style>

<style>
.itemBox-hide { visibility : hidden ; }
.itemBox { width : 218px;float:left;padding:7px;
}
.itemBox .innerItemBox {padding-left:0px;padding-right:0px;padding-top:00px;padding-bottom:0px;border:1px solid #ccc; 
-webkit-box-shadow: #666 2px 2px 5px;
-moz-box-shadow: #ddd 2px 2px 5px;
box-shadow: #e1e1e1 2px 2px 5px;
background:#fff;
behavior:url('/assets/pie/PIE.php') ; 
}

.itemBox .innerItemBox:hover { 
    background : #00aefc;
    -webkit-transition: background .25s linear;
    -moz-transition: background .25s linear;
    transition: background .25s linear;
    }

.itemBox .innerItemBox:hover a { color:#fff;}
</style>


<div class="container">
    <div id="content_grid" style="position:relative;"> 
        <ul id="blog_list">
        <? foreach($recent_post as $key => $post):?> 
                    <li class="itemBox">
                        <div class="innerItemBox"> 
                            <div class="article_item">
                                <div>
                                    <a href="<?=$post->link;?>" target="_blank"><img style="display:block;margin:0 auto;" src="<?=base_url()?><?=thumbImage('rss',$post->article_id,$post->main_image_src,230,240,'width');?>" /></a>
	                            </div>
                                <div style="text-align:center;padding:10px;">
	                                <h6><a href="<?=$post->link;?>" target="_blank"><?=$post->title?></a> </h6>
		                            <p > 
		                            <?=mb_strcut($post->description,0,250).'...';?> 
		                            </p>
	                        
                                </div>
                            </div>
                        </div> 
                    </li>
	    <? endforeach ;?> 
        </ul> 
    </div>
</div>

<div id="temp_area" style="display:none;">

</div>


<?echo js_asset('jquery.wookmark.min.js') ;?>

<?echo js_asset('Common.js') ;?>
<script> 
var func ; 
$(window).load(function(){ 
    var handler = null ; 

    var options = { 
        //autoResize: true ,
        container : $('#content_grid') ,
        offset:00
    } ;

    var page = 1; 

    $(document).ready(function(){
        var li_html = '<li class="itemBox itemBox-hide"><div class="innerItemBox"><div class="article_item"> <div> <a href="{link}" target="_blank"><img style="display:block;margin: 0 auto;" src="{thumbnail_url}" /> </a></div><div <div style="text-align:center;padding:10px;"><h6><a href="{link}" target="_blank">{title} </a></h6><p> {description}</p> </div></div></div> </li>'
        var loading = false ; 
        $(window).bind('scroll',function(e){
            var closeToBottom = ($(window).scrollTop() + $(window).height() > $(document).height() -300) ; 
        
            if(closeToBottom && !loading ){ 
                loading = true ; 
                page++ ; 
                var items = $('#blog_list li') ;

                $('#indicator').fadeIn() ; 

                $.getJSON(base_url+'welcome/welcome/getData/'+page,{page:page},function(data){
                    var items = data.items ; 
                    page = data.page ; 
                    page_count = data.page_count ; 

                    html = ''  ; 

                    for(var i=0; i < items.length ; i++){ 
                        html = html+Common.Util.printf(li_html, items[i] ) ; 
                    } 

                    $('#blog_list').append(html) ; 

                    func = function(){
                        var is_complete = true  ; 
                        $('#blog_list img').each(function(i,o){
                            if($.browser.msie){ 
                                if(($(o).attr('src') && $(o).height() == 0 )){
                                    is_complete = false ; 
                                    setTimeout(func,50) ; 

                                    return false ;  
                                } 

                            }else{ 
                                if(($(o).attr('src') && o.complete == false ) ){
                                    is_complete = false ; 
                                    setTimeout(func,50) ; 

                                    return false ;  
                                } 
                            } 
                        });

                        if(is_complete){ 
                            $('#indicator').fadeOut() ; 
	                        loading = false ; 
	
	                        if(handler) handler.wookmarkClear() ; 
	
	                        handler = $('#blog_list li') ; 
	                        handler.wookmark(options) ;     
                            $('li.itemBox-hide').removeClass('itemBox-hide') ; 
	
	                        if(page == page_count){
	                            $(document).unbind('scroll') ; 
	                        } 
                        }
                    }; 

                    setTimeout(func,50) ; 
                }) ; 
            } 
        }) ; 
    }) ; 

    $('#blog_list li').wookmark(options) ; 

}) ;

</script>
<div class="row">
    <div class="span12">
<div id="indicator" style="display:none;position:fixed;bottom:0px;width:100%;">
    <div style="text-align:center;">
    <img src="<?=img_asset_url('loading-indicator.gif');?>"/>
    </div>
    </div>
    </div>
</div>
