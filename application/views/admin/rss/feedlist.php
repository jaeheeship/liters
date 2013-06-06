<?php $this->load->helper('date') ;?>
<script>
$(function(){
    $('#form').submit(function(){
        var url_obj = $(this).find('[name=url]'); 
        if(url_obj.val() == ''){
           alert("url 값을 입력하세요.") ;  
           return false ; 
        }

        $.ajax({
            url: $('#form').attr('action'), 
            type:'POST',
            data :{ 
                url : url_obj.val() 
            } 
        }).done(function(data){
            location.href=location.href ;  
        }); 

        return false; 
    });

    $('.refresh_btn').click(function(){
        var feed_id =$(this).parents('tr').attr('feed_id')  ; 

        $.ajax({
	        url: 'refresh/'+feed_id , 
	        type:'GET', 
            cache:false ,
            context: $(this) 
	    }).done(function(data){
//            location.href = location.href ; 
	    }); 

        return false ; 
    }); 

    $('.del_btn').click(function(){
        if(confirm('삭제하시겠습니까?')){
	        $.ajax({
	            url: 'deleteFeed', 
	            type:'POST',
	            data :{ 
	                id : $(this).parents('tr').attr('feed_id') 
	            } ,
                context: $(this) 
	        }).done(function(data){
	           //$(this).parents('tr').fade() ; 
	           $(this).parents('tr').remove() ; 
	        }); 
        }
    }); 
});
</script>
<div class="content">
	<form id="form" class="well form-inline" method="post" action="<?=base_url()?>index.php/admin/rss/insertFeed">
	    <input type="text" class="input-large" name="url"  placeholder="rss url을 입력하세요." />
	    <button type="submit"  class="btn btn-primary">Add </button> 
	</form>
	<table class="table table-striped">
	    <thead>
	        <tr>
	            <th># </th>
	            <th>이름/url </th>
	            <th>등록일</th>
	            <th>수정일</th>
	            <th></th>
	            <th></th>
	        </tr>
	    </thead> 
	    <tbody>
	        <?php foreach($list as $key => $feed): ?>
	        <tr feed_id="<?=$feed->feed_id?>">
	            <td><?=$feed->feed_id?></td>
	            <td><?=$feed->title?><br/><?=$feed->url?></td>
	            <td><?=$feed->regdate?></td>
	            <td><?=$feed->last_update?></td>
	            <td><a class="btn refresh_btn"  href="#"><i class="icon-refresh"></i> REfresh</a> </td>
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
