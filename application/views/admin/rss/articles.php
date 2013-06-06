<?php $this->load->helper('date') ;?>
<?php $this->load->helper('image') ;?>

<div class="content">
    <form class="well well-small form-search" action="" method="get" >
        <div class="input-append"> 
            <input type="text" class="span3 search-query" name="search_keyword" value="<?=$search_keyword?>" >
            <button type="submit" class="btn">Search</button>
        </div> 
    </form>

	<table class="table table-striped">
	    <thead>
	        <tr>
	            <th># </th>
	            <th>제목 </th>
	            <th>발행일</th>
	            <th></th>
	            <th></th>
	        </tr>
	    </thead> 
	    <tbody>
	        <?php foreach($list as $key => $article): ?>
	        <tr data_id="<?=$article->article_id?>">
	            <td><?=$article->article_id?></td>
	            <td> 
                    <div style="padding-left:150px;">
                        <div style="margin-left:-150px;margin-right:10px;float:left"> 
                            <img style="width:150px;height:100px;" src="<?=base_url()?><?=thumbImage('rss',$article->article_id,$article->main_image_src,150,100);?>" class="main_image"/>
                        </div>
                        <div><?=$article->title?><br/><a href="<?=$article->link?>" target="_blank" ><?=$article->link?></a></div>
                    </div>
                </td>
	            <td><?=$article->pubdate?></td>
	            <td><button class="btn btn-info" >수정</button></td>
	            <td><button class="btn btn-danger del_btn">삭제 </button> </td>
	        </tr>
	        <?php endforeach;?> 
	    </tbody>
	</table> 
    <div class="pagination pagination-centered"> 
        <?php
            $first_page = $pagination['page'] - 5 <= 0 ? 1 : $pagination['page'] - 5 ;
            $next_limit =  $pagination['page']+5 < $pagination['page_count'] ? $pagination['page']+5 : $pagination['page_count'] ; 
        ?>

        <ul> 
            <?php if($first_page > 1):?>
            <li><a href="<?=base_url()?>admin/rss/articleList/1/?search_keyword=<?=$search_keyword?>">1</a></li>

            <li><a>...</a> </li> 
            <?php endif;?>

            <?php for($i=$first_page ; $i <$pagination['page'];$i++):?> 
            <li><a href="<?=base_url()?>admin/rss/articleList/<?=$i;?>/?search_keyword=<?=$search_keyword?>"><?=$i;?></a></li>
            <?php endfor;?>
            <li class="active"><a href="#"><?=$pagination['page'];?></a></li>
            <?php for($i=$pagination['page']+1 ; $i <=$next_limit;$i++):?> 
            <li><a href="<?=base_url()?>admin/rss/articleList/<?=$i;?>/?search_keyword=<?=$search_keyword?>"><?=$i;?></a></li>
            <?php endfor;?> 
            <?php if($pagination['page_count'] > $next_limit):?>
            <li><a>...</a> </li> 
            <li><a href="<?=base_url()?>admin/rss/articleList/<?=$pagination['page_count'];?>/?search_keyword=<?=$search_keyword?>"><?=$pagination['page_count'];?></a></li>
            <?php endif;?>
        </ul>
    </div>
</div>

<div> 
    <div id="myModal" class="modal hide fade">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3>대표이미지 설정</h3>
        </div>
        <div class="modal-body">
            <div id="myCarousel" class="carousel slide">
                <div class="carousel-inner"> 
                <!-- area that added item --> 
                </div>
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
            </div>
        </div>
        <div class="modal-header">
            <button type="button" class="btn btn-primary" id="main_image_set_btn"  data-dismiss="modal">대표 이미지로 설정..</button>
        </div>
    </div>
</div>

<script> 
$(function(){

$('.main_image').click(function(){
    var $this = $(this) ; 
    var article_id = $this.parents('tr').attr('data_id') ;  
    var base_url = '<?=base_url()?>' ; 
    var url = '<?=base_url()?>'+'admin/rss/getArticleImage/'+article_id ; 
    var data = {} ; 

    $.getJSON(url,data,function(response){
        var list = response.list ; 
        var ima_src ; 
        var cls ; 

        $('#myModal .carousel-inner').html('') ; 
        var length = list.length ;

        for(var i = 0 ; i < length  ; i++ ){ 
            img_src = base_url+list[i].full_path  ; 
            cls = (i == 0 ? 'item active' : 'item ') ;
            $('#myModal .carousel-inner').append('<div class="'+cls+'" file_id="'+list[i].file_id +'">'+'<div style="text-align:center;"><img src="'+img_src+'" style="height:250px;"/></div></div>') ;
        } 

        if(length == 0){
            $('#myModal .carousel-inner').append('<div class="active item"><div class="hero-unit "><h1>NO Image</h1> </div></div>') ; 
        }

        $('#myCarousel').carousel({ interval:0}) ; 
        $('#myModal').modal() ; 
    }) ; 

    $('#myModal #main_image_set_btn').click(function(){
        var $active_item = $('#myModal .carousel-inner .active') ; 
        var file_id = $active_item.attr('file_id') ; 

        $.getJSON( base_url+'admin/rss/setMainImage/'+article_id+'/'+file_id ,{}, 
            function(response){

            }
        ); 
    }); 
}); 

}); 
</script>

