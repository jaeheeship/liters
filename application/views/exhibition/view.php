<?php echo css_asset('style.css','exhibition')?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/ko_KR/all.js#xfbml=1&appId=161679290564837";
              fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div class="mini_container">
    <h6 style="color:#000;font-family:NanumGothic;font-weight:lighter;font-size:1.8em;text-align:center;margin-bottom:30px;"><?=$exhb->title; ?> </h6>
    <div class="paper exhibition_paper">
        <div class="image_wrapper"> 
            <div class="image">
                <img src="<?=base_url()?><?=thumbImage('exhibition',$exhb->exhb_id,$exhb->main_image_src,700,500)?>" style="width:100%;" />
                
            </div>
            <?php if($exhb->credit):?>
            <div class="caption"  style="display:none;color:#989898;text-align:center;position:absolute;bottom:0px;background:#000;opacity:0.85;width:100%;"> 
                <pre style="width:100%;background-color:transparent;border:0px;font-size:0.8em;color:#999;"><i><?=$exhb->credit;?></i> </pre>
            </div>
            <?php endif;?>
        </div><!-- .image_wrapper-->

        <div class="info_wrapper">
            <div class="exhb_info"> 
                <h3 style="color:#000;font-family:NanumGothic;font-weight:lighter;font-size:1.7em;margin-bottom:20px;"><?=$exhb->title?> </h3>

                <div class="exhb_badge"> 
                    <?php if(date("Y-m-d") > $exhb->finish_date):?> 
                        <img style="width:90%;" src="<?=img_asset_url('badge_expired.png','exhibition')?>"/>
                    <?php elseif(date("Y-m-d") >= $exhb->start_date):?> 
                        <img  style="width:90%;" src="<?=img_asset_url('badge_current.png','exhibition')?>"/>
                    <?php else:?>
                        <img  style="width:90%;" src="<?=img_asset_url('badge_ready.png','exhibition')?>"/> 
                    <?php endif;?>

                </div>
                
                <div style="padding-left:122px;border:1px solid #ccc;background:#e0e0e0;">
                    <div style="background:#e0e0e0;width:119px;margin-left:-122px;float:left;position:relative;">
                        <h5 style="padding:20px;font-weight:100;"><?=$exhb->place_name?> </h5>
                    </div>
		            <table  class="table table-condensed" style="background:#fff;margin:0px;">
			            <tbody> 
			                <tr> 
			                    <th><i class="icon icon-th"></i>&nbsp;<span class="letter2">기간</span> </th>
			                    <td><?=$exhb->start_date?>&nbsp;부터 <?=$exhb->finish_date;?>&nbsp;까지 전시합니다. </td>
			                </tr>
			                <tr> 
			                    <th><i class="icon icon-time"></i>&nbsp;<span class="letter4">개관시간</span> </th>
			                    <td><?=semicolonToBR($exhb->visiting_hours)?> </td>
			                </tr>
			                <tr> 
			                    <th><i class="icon icon-question-sign"></i>&nbsp;<span class="letter3">휴관일</span> </th>
			                    <td><?=semicolonToBR($exhb->closed)?>  </td>
			                </tr>
		                    <tr> 
			                    <th><i class="icon-h"></i>&nbsp;<span class="letter2">가격</span> </th>
			                    <td><?=semicolonToBR($exhb->fee)?> </td>
			                </tr>
			            </tbody>
			        </table>
                </div>
            </div>
        </div>
        <div class="sns_bg" >
            <div class="pull-right">
                <div style="float:left;"><div style="padding-top:10px;padding-right:20px;"><div class="fb-like" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div></div></div> 
                <div style="float:left;margin-top:5px;margin-right:10px;margin-left:10px;;">
                    <a class="sns_icon facebook_icon" target="_blank"> </a>
                </div>
                <div style="float:left;margin-top:5px;margin-right:10px;margin-left:10px;;">
                    <a class="sns_icon twitter_icon"> </a>
                </div>
            </div>
        </div>
        <div class="info_wrapper" style="background:#fdfdfd;"> 
            <div>
                <div class="span1" style="margin-left:-30px;"><img src="<?=img_asset_url('quote.png')?>"/> </div><div style="margin-left:40px;"><p class="note"><?=$exhb->description;?></p></div>
            </div>
        </div>

        <div class="info_wrapper" style="background:#fdfdfd;border-top:1px dashed #aaa;"> 
            <div>
                <div class="span1" style="margin-left:-30px;"><img src="<?=img_asset_url('tag.png')?>"/> </div>
                <div style="margin-left:40px;">
                    <p class="note">
	                    <?foreach($exhb->tag_map as $tag_type => $tag_list):?>
	                    <? for($i=0 ; $i < count($tag_list) ; $i++):?>
	                    <span class="label"><?=$tag_list[$i]?> </span>&nbsp;&nbsp;
	                    <? endfor ; ?>
	                    <?endforeach; ?> 
                    </p>
                </div>
            </div>
        </div>
        <div class="info_wrapper" style="background:#fdfdfd;border-top:1px dashed #aaa;"> 
            <div>
                <div class="span1" style="margin-left:-30px;"><img src="<?=img_asset_url('blog_review_icon.png')?>"/> </div>
                <div style="margin-left:40px;">
	                <div id="search_panel" class="note blog_panel"> </div> 
                </div>
            </div>
        </div>
        <!--<div class="exhibition_paper_footer"> </div> -->
    </div> <!-- .exhibition_paper--> 
    <!--<hr/>
    <div class="paper blog_paper" style="height:450px;position:relative;"> 
        <div class="blog_paper_body">
            <div class="left_column" >
                <ul class="nav"> 
                    <li><a><i class="icon-chevron-right"></i>블로그</a></li>
                    <li><a><i class="icon-chevron-right"></i>연관뉴스</a></li>
                </ul>
            </div> 
            <div class="right_column"> 
                
            </div>
        </div>
    </div> <!-- .blog_paper--> 
</div>

<?echo js_asset('Common.js') ?>
<?echo js_asset('Common.List.js') ?>

<script> 
$(function(){
    var search_keyword = encodeURI('<?=$exhb->search_keyword;?>') ; 
    var image_panel = Common.ListPanel({ 
        url : base_url+'openapi/getBlogSearch/'+search_keyword , 
        target_id : 'search_panel' ,
        pagination : {
            list_count : 20, 
            page_count : 10, 
            endless : true
        }, 
        panel_body : { 
            height : 300 
        },

        tmpl : '<div><ul id="_items_area" class="search_result clearfix"> </ul></div>' ,
 
        item_config : {
            tmpl : '<li class="result_item" ><div style="height:25px;overflow:hidden;"><a class="span3"  href="{bloggerlink}" target="_blank" style="color:#000;font-size:1.1em;">{bloggername}님</a><a href="{link}" target="_blank">{title}</a></div></li>', 
            display_fields : [{
                name : 'title'
            },{
                name : 'link'
            },{ 
                name : 'bloggername'
            },{ 
                name : 'bloggerlink'
            }] 
        }
    }) ; 

    //coupon_panel.load() ; 
    image_panel.render() ; 

    /*$('#coupon_modal').on('hidden',function(){
        location.href = location.href ; 
    }); */

    $('.facebook_icon').snspost({ 
        type : 'facebook', 
        //content : '추어',
        url : '<?=base_url();?>exhibition/view/<?=$exhb->exhb_id;?>'
    }); 

    $('.twitter_icon').snspost({ 
        type : 'twitter',
        //content : '추어',
        url : '<?=base_url();?>exhibition/view/<?=$exhb->exhb_id;?>'
    }); 

    $('.image_wrapper').on('mouseover',function(){ 
        $('.image_wrapper .caption').fadeIn(1000) ; 
    }); 


    $('.image_wrapper').on('mouseout',function(){ 
        $('.image_wrapper .caption').fadeOut(1000) ; 
    }); 

}); 

(function($){ 
 
    $.fn.snspost = function(opts) {
    var loc = '';

    opts = $.extend({}, {type:'twitter', event:'click', content:''}, opts);
    opts.content = encodeURIComponent(opts.content);

    switch(opts.type) {
    case 'me2day':
        loc = 'http://me2day.net/posts/new?new_post[body]='+opts.content;
        if (opts.tag) loc += '&new_post[tags]='+encodeURIComponent(opts.tag);
        break;
    case 'facebook':
        loc = 'http://www.facebook.com/share.php?t='+opts.content+'&u='+encodeURIComponent(opts.url||location.href);
        break;
    case 'delicious':
        loc = 'http://www.delicious.com/save?v=5&noui&jump=close&url='+encodeURIComponent(opts.url||location.href)+'&title='+opts.content;
        break;
    case 'twitter':
    default:
        loc = 'https://twitter.com/intent/tweet?source=webclient&text='+opts.content+'&url='+opts.url;
        break;
    }

    this.bind(opts.event, function(){
         window.open(loc);
         return false;
         });
    };

    $.snspost = function(selectors, action) {
        $.each(selectors, function(key,val) {
            $(val).snspost( $.extend({}, action, {type:key}) );
        });
    };

})(jQuery);

</script>
