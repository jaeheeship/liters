<div class="content">
    <table class="table table-condensed table-striped">
        <thead>
            <tr> 
                <th></th>
                <th>파트너사</th>
                <th>링크</th>
                <th>삭제</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($partner_list as $key => $partner) :?>
        <tr>
            <td><label for="check_id"> <?=$partner->partner_id;?> </label></td>
            <td>
                <div style="padding-left:160px;">
                    <div style="margin-left:-160px;float:left;width:150px;"><img style="width:150px;height:100px;" src="<?=base_url()?><?=thumbImage('partner',$partner->partner_id,$partner->partner_image_src,150,100);?>"/></div> 
                    <p><a href="<?=base_url();?>admin/partner/partnerForm/<?=$partner->partner_id?>"><?=$partner->title;?></a></p> 
                    <p> </p>
                    
                </div> 
            </td>
            <td>
                <a href="<?=$partner->link?>"  class="btn">바로가기 </a>
            </td>
            <td>
                <a href="<?=base_url()?>admin/partner/delete/<?=$partner->partner_id;?>"  class="del_btn btn btn-danger">삭제 </a>
            </td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>

<script> 
$(function(){

$('.del_btn').click(function(){
    if(confirm('파트너 정보를 삭제 하시겠습니까?')){ 
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
