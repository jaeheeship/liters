<style>
.itemBox { width : 300px;float:left;padding:9px; }
a {font-family:'NanumGothic','Nanum Gothic','MalgunGothic','Dotum';}
.itemBox .innerItemBox {padding-left:0px;padding-right:0px;padding-top:00px;padding-bottom:0px;border:1px solid #ccc; 
-webkit-box-shadow: #666 2px 2px 5px;
-moz-box-shadow: #ddd 2px 2px 5px;
box-shadow: #e1e1e1 2px 2px 5px;
font-family:'NanumGothic','Nanum Gothic','MalgunGothic','Dotum';

} 
.itemBox .innerItemBox .info_section:hover  { background : #00aefc;}
.itemBox .innerItemBox .exhibition_item .image_section {} 
.itemBox .innerItemBox .exhibition_item .info_section {padding:10px; background:#fff; } 
.itemBox .innerItemBox .exhibition_item .info_section .description {color:#888;font-size:0.85em;padding-bottom:10px; 
font-family:'NanumGothic','Nanum Gothic','MalgunGothic','Dotum';

}

.itemBox .innerItemBox .exhibition_item .tag_section {border-top:1px dotted #efefef;background:#f3f3f3;padding:20px;font-size:0.8em;} 
.banner_item {padding:10px; }
.banner_item h6 { color:#000;font-weight:100;}

.mouseover .info_section { background:#efefef !important;
    -webkit-transition: background .25s linear;
    -moz-transition: background .25s linear;
    transition: background .25s linear;
}
.mouseover .info_section a {color:#484848 !important;}
.mouseover .info_section .description {color:#484848 !important;}
</style>
<br/> 

<? $exhb = $main_exhb ;?>
<div style=";margin-bottom:30px;padding:20px;background:#fff;border:1px solid #ddd;position:relative;" >
    <div style="padding-left:600px;" class="clearfix">
        <div style="margin-left:-600px;width:580px;float:left;">
            <div>
            <a href="<?=base_url();?>exhibition/view/<?=$exhb->exhb_id;?>"><img id="slide_image" src="<?=base_url()?><?=thumbImage('exhibition',$exhb->exhb_id,$exhb->main_image_src,670,470,'width');?>" style="width:100%;" /></a>
            </div>
        </div>
        <div> 
            <div>
               	<h6  id="title"  style="padding:10px 0px 10px 0px;font-size:1.2em;font-family:NanumGothic,Nanum Gothic;"><a style="color:#000;" href="<?=base_url();?>exhibition/view/<?=$exhb->exhb_id;?>"><?=$exhb->title;?></a> </h6> 
				<div> 
					<em><span id="start_date"><?=date("F j ,Y ",strtotime($exhb->start_date));?> </span> ~  <span id="finish_date"><?=date("F j ,Y ",strtotime($exhb->finish_date));?> </span></em>
				</div>
				<hr/>
				<div style="text-align:right;" > 
					@<span id="place_name"><?= $exhb->place_name;?></span>
				</div> 
				
            </div> 
        </div> 
    </div>
</div> 
<hr/> 
<br/>
<div class="row" >
    <div id="content_grid" style="position:relative;"> 
    </div>
</div>


<?echo js_asset('jquery.wookmark.min.js') ;?> 
<?echo js_asset('Common.js') ;?>
<?echo css_asset('style.css','exhibition') ;?>

<script> 
var func ; 
var loading = false ; 
var handler = null ; 
 var options = { 
        //autoResize: true ,
        container : $('#content_grid')
        //offset:20
    } ;
$(window).load(function(){ 
    var page = 1; 

    $(document).ready(function(){
        var li_html = 
            '<div class="itemBox itemBox-hide">'+
		        '<div class="innerItemBox">'+
			        '<div class="exhibition_item">'+
			            '<div class="image_section">'+
			                '<a href="<?=base_url()?>exhibition/view/{exhb_id}"><img src="{thumbnail_url}"/></a>'+
			            '</div>'+
			            '<div class="info_section">'+
			                '<h5 style="text-align:right;"><a href="<?=base_url()?>exhibition/view/{exhb_id}" style="font-family:NanumGothic,Nanum Gothic;">{title}</a></h5>'+
			                '<div class="description" style="text-align:right;">'+
			                    '<i class="icon icon-th"></i>&nbsp;{start_date} ~ {finish_date}'+
                                '</div>'+
                                '<p class="pull-right">{badge}</p>'+
			            '</div>'+
		            '</div>'+
		        '</div>'+
		    '</div>' ; 

        getItems(page,li_html) ; 

        $(window).bind('scroll',function(e){
            var closeToBottom = ($(window).scrollTop() + $(window).height() > $(document).height() -300) ; 
        
            if(closeToBottom && !loading ){ 
                console.log('hello') ; 
                loading = true ; 
                page++ ; 
                var items = $('#content_grid .itemBox') ;

                $('#indicator').fadeIn() ; 
                getItems(page,li_html) ; 
                 
            } 
        }) ; 
    }) ; 

    $('#content_grid .itemBox').wookmark(options) ; 

}) ;


var getItems = function(page,template){
$.getJSON(base_url+'exhibition/getItems/'+page,{},function(data){

    var items = data.items , 
        page = data.page , 
        page_count = data.page_count , 
        li_html = template ,
        html = ''  ; 

    for(var i=0; i < items.length ; i++){ 
        html = html+Common.Util.printf(li_html, items[i] ) ; 
    } 

    $('#content_grid').append(html) ; 

    func = function(){
        var is_complete = true  ; 

        $('#content_grid img').each(function(i,o){
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

            handler = $('#content_grid .itemBox') ; 
            handler.wookmark(options) ;     

            $('.itemBox-hide').removeClass('itemBox-hide') ; 

            if(page == page_count){
                $(document).unbind('scroll') ; 
            } 
        }
    }; 

    setTimeout(func,50) ; 
}) ;


    /*$('.exhibition_item').live('mouseover',function(){ 
        $(this).find('.info_section').effect('highlight',1000) ;      
}); */

} ; 

</script> 
