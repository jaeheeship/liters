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
                <th><input type="checkbox" /></th>
                <th>장소명</th>
                <th>전시주소</th>
                <th>등록자</th>
                <th><button class="btn btn-small btn-danger deleteall" />All Delete </th>
            </tr>
        </thead> 
        <tbody>
        <?php foreach($place_list as $key => $place) :?>
        <tr>
            <td><label for="check_id"><?=$place->place_id;?><br/><input type="checkbox" name="place_id" /></label> </td>
            <td> 
                <a href="<?=base_url()?>admin/place/writeform/<?=$place->place_id?>"><?=$place->place_name?></a> 
            </td>
            <td><?=$place->address;?><a href="https://maps.google.com/maps?q=<?=$place->lat?>,+<?=$place->lng?>+(<?=$place->place_name?>)&iwloc=A&hl=ko" target="_blank"><i class="icon icon-map-marker"></i></a> 
                <p> 
                    <?php if($place->homepage):?>
                    <a href="<?=$place->homepage?>" target="_blank">homepage </a>
                    <?php endif;?>

                    <?php if($place->twitter):?>
                    <a href="<?=$place->twitter?>" target="_blank">twitter </a>
                    <?php endif;?>

                    <?php if($place->facebook):?>
                    <a href="<?=$place->facebook?>" target="_blank">facebook </a>
                    <?php endif;?>
                </p>
            </td>
            <td><?=$place->username;?> </td>
            <td><a class="btn btn-small btn-warning del_btn" href="<?=base_url()?>admin/place/delete/<?=$place->place_id;?>">DEL </a> </td>
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
            <li><a href="<?=base_url()?>admin/place/placeList/<?=$i;?>/?search_keyword=<?=$search_keyword?>"><?=$i;?></a></li>
            <?php endfor;?>
            <li class="active"><a href="#"><?=$pagination['page'];?></a></li>
            <?php for($i=$pagination['page']+1 ; $i <=$next_limit;$i++):?> 
            <li><a href="<?=base_url()?>admin/place/placeList/<?=$i;?>/?search_keyword=<?=$search_keyword?>"><?=$i;?></a></li>
            <?php endfor;?> 
        </ul>
        </form>
    </div>
</div>

<script> 
$(function(){

$('.del_btn').click(function(){
    if(confirm('장소 정보를 삭제 하시겠습니까?')){ 
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

}); 
</script>
