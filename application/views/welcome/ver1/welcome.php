<style>
.itemBox { width : <?=$width;?>;float:left;padding:9px; }
</style>
<link rel="stylesheet" type="text/css" href="<?=base_url();?><?=$css_file;?>" > </link>
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
			                '<a href="{iframe_link}"><img src="{thumbnail_url}"/></a>'+
			            '</div>'+
			            '<div class="info_section">'+
			                '<h5 style="text-align:right;"><a href="{iframe_link}" style="font-family:NanumGothic,Nanum Gothic;">{title}</a></h5>'+
			                '<div class="description" style="text-align:right;">'+
                                '</div>'+
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
$.getJSON(base_url+'welcome/getData/'+page,{},function(data){

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
