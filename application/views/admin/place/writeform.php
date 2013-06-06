<div class="content"> 
    <form class="form-horizontal" action="<?=base_url()?>admin/place/save"  method="post" enctype="multipart/form-data" >
        <fieldset>
            <input type="hidden" name="place_id"  value="<?=@$place->place_id?>" />
            <div id="legend" class="">
                <legend class="">정보 입력/수정 <button class="btn btn-primary">저장 </button></legend>
            </div> 
            <div class="control-group"> 
                <label class="control-label" ><span class="badge badge-important">필수</span>&nbsp;장소 이름</label>
                <div class="controls">
                    <input type="text" placeholder="장소(한글명)" name="place_name"  class="input-xxlarge" filter="required" value="<?=@$place->place_name?>" >
                    <p class="help-block"></p>
                </div>
                <div class="controls">
                    <input type="text" placeholder="장소(영문명)" name="place_eng_name"  class="input-xxlarge"  value="<?=@$place->place_eng_name?>" >
                    <p class="help-block"></p>
                </div>
            </div>

            <div class="control-group"> 
                <label class="control-label" ><span class="badge badge-important">필수</span>&nbsp;장소 타입</label>
                <div class="controls"> 
                    <div> 
                        <label class="checkbox"><input type="checkbox" name="place_type[]" value="museum" class="checkbox" <?php if(@$place->place_type['museum'] == TRUE):?> checked="checked" <?php endif; ?> />미술관 </label>
                    </div>
                    <div> 
                        <label class="checkbox"><input type="checkbox" name="place_type[]"  value="gallery" class="checkbox" <?php if(@$place->place_type['gallery'] == TRUE):?> checked="checked" <?php endif; ?> />갤러리 </label>
                    </div>
                    <div> 
                        <label class="checkbox"><input type="checkbox" name="place_type[]"  value="alt_space" class="checkbox" <?php if(@$place->place_type['alt_space'] == TRUE):?> checked="checked" <?php endif; ?> />대안공간 </label>
                    </div>
                </div>
            </div>

            <div class="control-group"> 
                <label class="control-label" ><span class="badge badge-important">필수</span>&nbsp;공개여부</label>
                <div class="controls">
                    <span>공개<input type="radio" value="public" name="status" <?php if(@$place->status =='public'):?> checked="checked" <?php endif; ?> /></span>
                    <span>비공개<input type="radio" value="private" name="status" <?php if(@$place->status =='private'):?> checked="checked" <?php endif; ?>/></span>
                </div>
            </div>
            
            <div class="control-group"> 
                <label class="control-label" >주소</label>
                <div class="controls">
                    <input type="text" name="address" placeholder="주소를 입력하세요." class="input-xxlarge" value="<?=@$place->address?>">
                    <p class="help-block"></p>
                </div>
            </div> 

            <div class="control-group"> 
                <label class="control-label" >홈페이지 주소</label>
                <div class="controls">
                    <input type="text" name="homepage" placeholder="주소를 입력하세요." class="input-xxlarge" value="<?=@$place->homepage?>">
                    <p class="help-block"></p>
                </div>
            </div> 

            <div class="control-group"> 
                <label class="control-label" ><span class="badge badge-important">필수</span>&nbsp;SNS link</label>
                <div class="controls">
                    <input type="text" placeholder="페이스북 주소" name="facebook"  class="input-xxlarge" filter="required" value="<?=@$place->facebook?>" >
                    <p class="help-block"></p>
                </div>
                <div class="controls">
                    <input type="text" placeholder="트위터 주소" name="twitter"  class="input-xxlarge" filter="required" value="<?=@$place->twitter?>" >
                    <p class="help-block"></p>
                </div>
                <div class="controls">
                    <input type="text" placeholder="blog주소" name="blog"  class="input-xxlarge" filter="required" value="<?=@$place->twitter?>" >
                    <p class="help-block"></p>
                </div>
            </div>

            <div class="alert alert-warning"> 
                <p><strong>File upload</strong> 첨부파일 입력하세요 :)</p>
	            <div class="control-group">
	                <label class="control-label">로고 이미지 </label>
	                <div class="controls">
	                    <input class="input-file" name="logo" type="file">
                        <?php if(@$place->logo_id):?><a href="<?=base_url()?>admin/filebox/download/<?=$place->logo_id?>">로고 다운로드 </a><?php endif;?>
	                </div>
	
	                <label class="control-label">미술관 메인 이미지 </label>
	                <div class="controls">
	                    <input class="input-file" name="main_image" type="file">
                        <?php if(@$place->main_image_id):?><a href="<?=base_url()?>admin/filebox/download/<?=$place->main_image_id?>">공간 이미지</a><?php endif;?>
	                </div> 
	            </div>
            </div>

            <div class="alert alert-warning"> 
                <p><strong>TAG!!!</strong> 태그 정보들을 입력하세요 :)</p>
	            <div class="control-group"> 
	                <label class="control-label" >공간 태그</label>
	                <div class="controls">
	                    <input type="text" name="place_tags" placeholder="공간관련 태그를 입력하세요.ex)서울미술관,신사동,코엑스" class="input-xxlarge" value="<?=@$place->place_tags?>">
	                    <p class="help-block"></p>
	                </div>
	            </div> 
            </div> 
            
            <hr/>
            <div class="alert alert-info "><p><strong>info</strong> 추가로 필요한 정보들을 입력하세요.</p>
	            
	            <div class="control-group"> 
	                <label class="control-label" >휴관일 </label>
	                <div class="controls">
	                    <input type="text" name="closed"  placeholder="미술관 휴관일을 입력하세요." class="input-xxlarge" value="<?=@$place->closed?>">
	                    <p class="help-block"></p>
	                </div>
	            </div> 

	            <div class="control-group"> 
	                <label class="control-label" >문의 전화 </label>
	                <div class="controls">
	                    <input type="text" name="tel"  placeholder="예시) 02-1234-1234" class="input-xxlarge" value="<?=@$place->tel?>">
	                    <p class="help-block"></p>
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

$('.datepicker').datepicker({
    dateFormat:'yy-mm-dd'
}); 

$('.form').submit(function(){

}); 

}); 
</script>
