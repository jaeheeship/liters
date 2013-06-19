<?php echo css_asset('chosen.css')?>
<?php echo js_asset('chosen.jquery.min.js')?>
<div class="content"> 
    <form class="form-horizontal" action="<?=base_url()?>admin/partner/save"  method="post" enctype="multipart/form-data" >
        <fieldset>
            <input type="hidden" name="partner_id"  value="<?=@$partner->partner_id?>" />
            <div id="legend" class="">
                <legend class="">협력사 정보 입력/수정 <button class="btn btn-primary">저장 </button></legend>
            </div> 
            <div class="control-group"> 
                <label class="control-label" ><span class="badge badge-important">필수</span>&nbsp;협력사 이름</label>
                <div class="controls">
                    <input type="text" placeholder="협력사" name="title"  class="input-xxlarge" filter="required" value="<?=@$partner->title?>" >
                    <p class="help-block"></p>
                </div>
            </div> 
            <div class="">
                <label class="control-label" ><span class="badge badge-important">필수</span>&nbsp;협력사 홈페이지</label>
                <div class="controls">
                    <input type="text" placeholder="협력사 홈페이지" name="link"  class="input-xxlarge" filter="required" value="<?=@$partner->link?>" >
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="">
                <label class="control-label" ><span class="badge badge-important">필수</span>&nbsp;협력사 소개</label>
                <div class="controls">
                    <input type="text" placeholder="협력사 소개" name="description"  class="input-xxlarge" filter="required" value="<?=@$partner->description?>" >
                    <p class="help-block"></p>
                </div>
            </div>

            <div class="alert alert-warning"> 
                <p><strong>File upload</strong> 첨부파일 입력하세요 :)</p>
	            <div class="control-group">
	                <label class="control-label">협력사 이미지 </label>
	                <div class="controls">
	                    <input class="input-file" name="partner_image" type="file">
                        <?php if(@$partner->partner_image_id):?><a href="<?=base_url()?>admin/partner/download/<?=$partner->partner_image_id?>">다운로드 </a><?php endif;?>
	                </div> 
	            </div>
            </div> 
            
            
             
            <div class="form-actions"> 
                <button type="submit" class="btn btn-primary"><i class="icon icon-white icon-ok"></i> 저장</button>
                <button type="button" class="btn"> 목록 바로가기</button>
            </div>
    </fieldset>
    </form> 
</div>

<script>
jQuery(function(){ 
    $('.tags .label').click(function(){
        var $this = $(this) ; 
        var $input = $this.parent().siblings('input') ; 
        var input_value = $input.val() ; 

        if(input_value != ''){
            $input.val(input_value+','+$this.text()) ; 
        }else{
            $input.val($this.text()) ; 
        }

    }); 

    $('.datepicker').datepicker({
        dateFormat:'yy-mm-dd'
    }); 

    $('.form').submit(function(){

    }); 

    $('#place_id').chosen({no_results_text : "No results matched"}) ; 



}); 
</script>
