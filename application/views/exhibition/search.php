<?php 
    $this->load->helper('image') ; 
?>

<?php if(count($exhb_list) ==0):?> 
    <div class="alert alert-info">
        <p>
            <strong>"<?=$keyword;?>" </strong>에 대한 전시 정보가 없습니다.  
        </p>
    </div>
<?php endif;?>

<?php foreach($exhb_list as $key => $exhb):?>
<div style="border:1px solid #ccc;margin-bottom:30px;" class="box_shadow">
    <div style="padding-left:470px;" class="clearfix">
        <div style="margin-left:-470px;width:470px;float:left;">
            <img src="<?=base_url()?><?=thumbImage('exhibition',$exhb->exhb_id,$exhb->main_image_src,470,470,'width');?>" style="width:100%;" />
        </div>
        <div style="padding:20px;">
            <h3 style="color:#000;font-family:NanumGothic;font-weight:lighter;font-size:1.3em;margin-bottom:10px;margin-top:00px;"><a href="<?=base_url();?>exhibition/view/<?=$exhb->exhb_id;?>"><?=$exhb->title?></a> </h3>
            <table  class="table">
                <tbody> 
                <tr> 
                    <th><i class="icon icon-th"></i>&nbsp;<span class="letter2">기간</span> </th>
                    <td><?=$exhb->start_date?>&nbsp;부터 <?=$exhb->finish_date;?>&nbsp;까지 전시합니다. </td>
                </tr>
                <tr> 
                    <th><i class="icon icon-time"></i>&nbsp;<span class="letter4">개관시간</span> </th>
                    <td><?=$exhb->visiting_hours?> </td>
                </tr>
                <tr> 
                    <th><i class="icon icon-question-sign"></i>&nbsp;<span class="letter3">휴관일</span> </th>
                    <td><?=$exhb->closed?>  </td>
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
<?php endforeach;?>
