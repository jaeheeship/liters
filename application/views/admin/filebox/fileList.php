<?php $this->load->helper('image') ?>
<div class="content"> 
    <form class="well well-small form-search" action="<?=base_url();?>admin/filebox/fileList">
        <div class="input-append"> 
            <input type="text" name="search_keyword"  value="<?=$search_keyword;?>" class="span3 search-query" >
            <button type="submit" class="btn">Search</button>
        </div> 
    </form>
    <table class="table table-condensed table-striped">
        <thead> 
            <tr> 
                <th><input type="checkbox" /></th>
                <th>filename</th>
                <th>size(KB)</th>
                <th>filetype</th>
                <th>username</th>
                <th><button class="btn btn-small btn-danger deleteall" />All Delete </th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($fileList as $key => $file) :?>
        <?php $thumb = thumbImage('filebox',$file->file_id,$file->full_path,150,100); ?>
        <tr>
            <td><label for="check_id"><?=$file->file_id;?><br/><input type="checkbox" name="check_id" /></label> </td>
            <td>
                <div style="padding-left:160px;">
                    <div style="margin-left:-160px;float:left;width:150px;"><?php if($thumb) :?><img style="width:150px;height:100px;" src="<?=base_url()?><?=$thumb;?>"/><?else:?> NO Image <?endif;?></div> 
                    <p><a href="<?=base_url()?>admin/filebox/download/<?=$file->file_id?>"><?=$file->original_file_name;?></a></p><p><a class=""><i class="icon icon-tag "></i></a>&nbsp;<span class="label" >tag1 </span>&nbsp; <span class="label" >tag1 </span></p>
                </div> 
            </td>
            <td><?=$file->file_size_kb;?> </td>
            <td><?=$file->file_type;?> </td>
            <td><?=$file->username;?> </td>
            <td><a class="btn btn-small btn-warning" href="<?=base_url()?>admin/filebox/delete/<?=$file->file_id;?>">DEL </a> </td>
        </tr>
        <?php endforeach ;?>
        </tbody> 
    </table>
    <div class="pagination pagination-centered"> 
        <?php
            $first_page = $pagination['page'] - 5 <= 0 ? 1 : $pagination['page'] - 5 ;
            $next_limit =  $pagination['page']+5 < $pagination['page_count'] ? $pagination['page']+5 : $pagination['page_count'] ; 
        ?>
        <ul> 
            <?php if($first_page > 1):?>
            <li><a href="<?=base_url()?>admin/filebox/fileList/1/?search_keyword=<?=$search_keyword?>">1</a></li>

            <li><a>...</a> </li> 
            <?php endif;?>
            <?php for($i=$first_page ; $i <$pagination['page'];$i++):?> 
            <li><a href="<?=base_url()?>admin/filebox/fileList/<?=$i;?>/?search_keyword=<?=$search_keyword?>"><?=$i;?></a></li>
            <?php endfor;?>
            <li class="active"><a href="#"><?=$pagination['page'];?></a></li>
            <?php for($i=$pagination['page']+1 ; $i <=$next_limit;$i++):?> 
            <li><a href="<?=base_url()?>admin/filebox/fileList/<?=$i;?>/?search_keyword=<?=$search_keyword?>"><?=$i;?></a></li>
            <?php endfor;?> 

            <?php if($pagination['page_count'] > $next_limit):?>
            <li><a>...</a> </li> 
            <li><a href="<?=base_url()?>admin/filebox/fileList/<?=$pagination['page_count'];?>/?search_keyword=<?=$search_keyword?>"><?=$pagination['page_count'];?></a></li>
            <?php endif;?>
        </ul>
    </div>
</div>

<script> 
$(function(){

$('.del_btn').click(function(){
    if(confirm('파일을 삭제 하시겠습니까?')){ 
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
