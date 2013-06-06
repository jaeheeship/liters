<?php 
    $this->load->helper('image') ; 
?>
<h1 style="font-size:18px;border-left:10px solid #00afec;padding-left:10px"><?=$exhb->title;?></h1>
<div style="font-family:NanumGothic,MalgunGothic,Dotum;border:1px solid #ccc; padding:20px;background:#fafafa;">
    <div>
        <img src="<?=base_url();?><?=thumbImage('exhibition',$exhb->exhb_id,$exhb->main_image_src,700,300,'width')?>" alt="<?=$exhb->title;?>"/>
    </div>
    <div>
        <br/>
        <h1 style="font-size:18px;border-left:10px solid #00afec;padding-left:10px"><?=$exhb->title;?></h1>
        <hr/>
        <br/>
        <div>
            <table style="border:0px;"> 
                <tr> 
			        <th style="font-size:15px;"><i class="icon icon-th"></i>&nbsp;<span class="letter2">기간</span> </th>
			        <td style="font-size:15px;padding-left:20px;"><?=$exhb->start_date?>&nbsp;부터 <?=$exhb->finish_date;?>&nbsp;까지 전시합니다. </td>
			    </tr>
			    <tr> 
			        <th style="font-size:15px;"><i class="icon icon-time"></i>&nbsp;<span class="letter4">개관시간</span> </th>
			        <td style="font-size:15px;padding-left:20px;"><?=$exhb->visiting_hours?> </td>
			    </tr>
			    <tr> 
			        <th style="font-size:15px;"><i class="icon icon-question-sign"></i>&nbsp;<span class="letter3">휴관일</span> </th>
			        <td style="font-size:15px;padding-left:20px;"><?=$exhb->closed?>  </td>
			    </tr>
		        <tr> 
			        <th style="font-size:15px;"><i class="icon-h"></i>&nbsp;<span class="letter2">가격</span> </th>
			        <td style="font-size:15px;padding-left:20px;"><?=$exhb->fee?> </td>
			    </tr>
            </table>
        </div>
        <p style="background:#fefefe;border:1px dotted #cfcfcf;margin-top:20px;padding:10px;font-size:15px;line-height:170%;font-family:NanumGothic,MalgunGothic;">
            <?=$exhb->description;?>
        </p>
    </div>
    <div style="background:#00afec;padding:5px;border : 1px solid #ccc;"> 
        <p style="font-family:NanumGothic,MalgunGothic,Dotum;font-size:12px;color:#fff;">SNS로 전시 정보를 공유하세요.~~ </p>
    </div>
</div>
<br/>
<br/>
<br/>
<div>
    <p>
        하고싶은 말.
    </p>
</div>
