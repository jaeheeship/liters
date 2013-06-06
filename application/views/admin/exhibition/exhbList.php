<div class="content"> 
    <form class="well well-small form-search" action="" method="get" >
        <div class="input-append"> 
            <input type="text" class="span3 search-query" name="search_keyword" value="<?=$search_keyword?>" >
            <button type="submit" class="btn">Search</button>
        </div> 
    </form>

    <table class="table table-condensed table-striped">
        <thead> 
            <tr> 
                <th></th>
                <th>전시명</th>
                <th>전시장소</th>
                <th>등록자</th>
                <th>슬라이드</th>
                <th colspan="2"> </th>
            </tr>
        </thead> 
        <tbody>
        <?php foreach($exhb_list as $key => $exhb) :?>
        <tr>
            <td><label for="check_id"><?=$exhb->exhb_id;?></label> </td>
            <td>
                <div style="padding-left:160px;">
                    <div style="margin-left:-160px;float:left;width:150px;"><img style="width:150px;height:100px;" src="<?=base_url()?><?=thumbImage('exhibition',$exhb->exhb_id,$exhb->main_image_src,150,100);?>"/></div> 
                    <p><a href="<?=base_url();?>admin/exhibition/exhbForm/<?=$exhb->exhb_id?>" ><?=$exhb->title;?> <span class="badge <?php if($exhb->status=='publish'):?>badge-success <?php endif;?>" ><?=$exhb->status?> </span></a><a href="<?=base_url();?>exhibition/view/<?=$exhb->exhb_id?>" target="_blank">detail</a></p>
                    <p> 
                       <i class="icon icon-calendar"></i><?=$exhb->start_date;?> ~ <?=$exhb->finish_date;?>
                    </p>
                    <p><a class=""><i class="icon icon-tag "></i></a>&nbsp;
                        <? if($exhb->raw_tags) :?>
                            <? $tags = explode(',',$exhb->raw_tags) ;?>
                            <? foreach($tags as $t => $tag):?>
                                <span class="label" ><?=$tag?> </span>&nbsp; 
                            <? endforeach ;?> 
                        <? endif ;?> 
                    </p>
                </div> 
            </td>
            <td><?=$exhb->place_name;?> </td>
            <td><?=$exhb->username;?> </td>
            <td><input type="checkbox" class="check_slide" url="<?=base_url();?>admin/exhibition/register_slide/<?=$exhb->exhb_id;?>" <?php if($exhb->is_slide=='Y'):?> checked="checked"<?php endif;?> /></td>
            <td><a class="btn btn-small btn-info thumbnail_btn"  href="<?=base_url()?>admin/exhibition/generateThumbnail/<?=$exhb->exhb_id;?>">썸네일 </a> </td>
            <td><a class="btn btn-small btn-info share_btn"  href="<?=base_url()?>admin/exhibition/share/<?=$exhb->exhb_id;?>">SHARE </a> </td>
            <td><a class="btn btn-small btn-warning del_btn" href="<?=base_url()?>admin/exhibition/delete/<?=$exhb->exhb_id;?>">DEL </a> </td>
        </tr>
        <?php endforeach ;?> 
        </tbody>
    </table>
    <div class="pagination pagination-centered"> 
        <?php
            $first_page = $pagination['page'] - 5 <= 0 ? 1 : $pagination['page'] - 5 ;
            $next_limit =  $pagination['page']+5 < $pagination['page_count'] ? $pagination['page']+5 : $pagination['page_count'] ; 
        ?>

        <form class="well well-small form-search">
        <ul> 
            <?php for($i=$first_page ; $i <$pagination['page'];$i++):?> 
            <li><a href="<?=base_url()?>admin/exhibition/exhbList/<?=$i;?>/?search_keyword=<?=$search_keyword?>"><?=$i;?></a></li>
            <?php endfor;?>
            <li class="active"><a href="#"><?=$pagination['page'];?></a></li>
            <?php for($i=$pagination['page']+1 ; $i <=$next_limit;$i++):?> 
            <li><a href="<?=base_url()?>admin/exhibition/exhbList/<?=$i;?>/?search_keyword=<?=$search_keyword?>"><?=$i;?></a></li>
            <?php endfor;?> 
        </ul>
        </form>
    </div>
</div>

<div class="modal hide fade" id="share_modal">
    <div class="modal-header"> 
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>전시정보를 블로그에 공유해보세요.</h3>
    </div>

    <div class="modal-body"> 
        <textarea style="width:99%;height:300px;padding:0px;margin:0px;" class="textarea">

        </textarea>
    </div>
</div>


<script> 
$(function(){

$('.del_btn').click(function(){
    if(confirm('전시 정보를 삭제 하시겠습니까?')){ 
        var href = $(this).attr('href') ; 
        $.ajax({
            url : href,
            type: 'get',
            success: function(){ 
                location.href = location.href ; 
            }
        }); 

    }
    return false ; 
}); 

$('.thumbnail_btn').click(function(){

    var href = $(this).attr('href') ; 

    $.ajax({
        url : href,
        type: 'get',
        success: function(response){ 
            //$('#share_modal .textarea').val(response) ; 
            //$('#share_modal').modal('show') ; 
        }
    }); 


    return false ; 
});

$('.share_btn').click(function(){

    var href = $(this).attr('href') ; 

    $.ajax({
        url : href,
        type: 'get',
        success: function(response){ 
            $('#share_modal .textarea').val(response) ; 
            $('#share_modal').modal('show') ; 
            
        }
    }); 


    return false ; 
}); 

$('.check_slide').click(function(){
    var checked = $(this).attr('checked') ; 
    var url = $(this).attr('url') ;  

    if(checked == 'checked'){ 
        url = url + '/on' ;
    }else { 
        url = url + '/off' ; 
    } 

    $.ajax({
        url : url ,
        type : 'get', 
        success : function(response){

        }
    }); 

}); 

}); 
</script>
