<?php echo css_asset('chosen.css')?>
<?php echo js_asset('chosen.jquery.min.js')?>
<div class="content"> 
    <form class="form-horizontal" action="<?=base_url()?>admin/exhibition/save"  method="post" enctype="multipart/form-data" >
        <fieldset>
            <input type="hidden" name="exhb_id"  value="<?=@$exhb->exhb_id?>" />
            <div id="legend" class="">
                <legend class="">전시 정보 입력/수정 <button class="btn btn-primary">저장 </button></legend>
            </div> 
            <div class="control-group"> 
                <label class="control-label" ><span class="badge badge-important">필수</span>&nbsp;전시 타이틀</label>
                <div class="controls">
                    <input type="text" placeholder="전시명" name="title"  class="input-xxlarge" filter="required" value="<?=@$exhb->title?>" >
                    <p class="help-block"></p>
                </div>
            </div>

            <div class="control-group"> 
                <label class="control-label" ><span class="badge badge-important">필수</span>&nbsp;블로그 검색어</label>
                <div class="controls">
                    <input type="text" placeholder="블로그 검색어를 입력하세요." name="search_keyword"  class="input-xxlarge" filter="required" value="<?=@$exhb->search_keyword?>" >
                    <p class="help-block"></p>
                </div>
            </div>

            <div class="control-group"> 
                <label class="control-label" ><span class="badge badge-important">필수</span>&nbsp;전시 발행여부</label>
                <div class="controls">
                    <span>편집중<input type="radio" value="editing" name="status" <?php if(@$exhb->status =='editing'):?> checked="checked" <?php endif; ?> /></span>
                    <span>발행완료<input type="radio" value="publish" name="status" <?php if(@$exhb->status =='publish'):?> checked="checked" <?php endif; ?>/></span>
                </div>
            </div>
            <div class="control-group"> 
                <label class="control-label" >전시 소주제</label>
                <div class="controls">
                    <input type="text" name="sub_title" placeholder="소주제가 있다면 입력하세요." class="input-xxlarge" value="<?=@$exhb->sub_title?>" >
                    <p class="help-block"></p>
                </div>
            </div> 

            <div class="control-group"> 
                <label class="control-label"><span class="badge badge-important">필수</span>&nbsp;전시기간</label>
                <div class="controls">
                    <div class="input-append span3">
                        <input class="span2 datepicker" name="start_date"  placeholder="시작일" type="text" value="<?=@$exhb->start_date?>" >
                        <span class="add-on"><i class="icon icon-calendar"> </i></span>
                    </div>
                    <div class="input-append span3">
                        <input class="span2 datepicker" name="finish_date"  placeholder="종료일" type="text" value="<?=@$exhb->finish_date?>">
                        <span class="add-on"><i class="icon icon-calendar"> </i></span>
                    </div>
                </div> 
            </div>

            <div class="control-group"> 
                <label class="control-label" ><span class="badge badge-important">필수</span>&nbsp;전시 장소</label>
                <div class="controls">
                    <select name="place_id" id="place_id" > 
                        <?php foreach($place_list as $key => $place):?> 
                        <option value="<?=$place->place_id?>" <?php if(@$exhb->place_id==$place->place_id):?>selected="selected" <?endif;?>><?=$place->place_name?> </option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div> 

            <div class="control-group"> 
                <label class="control-label">전시 요약</label>
                <div class="controls">
                    <div class="textarea">
                        <textarea type="" name="description"  class="input-xxlarge"><?=@$exhb->description?></textarea>
                    </div>
                </div>
            </div> 

            <div class="control-group"> 
                <label class="control-label">credit</label>
                <div class="controls">
                    <div class="textarea">
                        <textarea type="" name="credit"  class="input-xxlarge"><?=@$exhb->credit?></textarea>
                    </div>
                </div>
            </div>

            <div class="alert alert-warning"> 
                <p><strong>File upload</strong> 첨부파일 입력하세요 :)</p>
	            <div class="control-group">
	                <label class="control-label">포스터 이미지 </label>
	                <div class="controls">
	                    <input class="input-file" name="poster_image" type="file">
                        <?php if(@$exhb->poster_image_id):?><a href="<?=base_url()?>admin/filebox/download/<?=$exhb->poster_image_id?>">포스터 다운로드 </a><?php endif;?>
	                </div>
	
	                <label class="control-label">보도자료 </label>
	                <div class="controls">
	                    <input class="input-file" name="press_data" type="file">
                        <?php if(@$exhb->press_data_id):?><a href="<?=base_url()?>admin/filebox/download/<?=$exhb->press_data_id?>">보도자료 다운로드 </a><?php endif;?>
	                </div>
	
	                <label class="control-label">전시 메인 이미지 </label>
	                <div class="controls">
	                    <input class="input-file" name="main_image" type="file">
                        <?php if(@$exhb->main_image_id):?><a href="<?=base_url()?>admin/filebox/download/<?=$exhb->main_image_id?>">전시 메인 이미지 다운로드</a><?php endif;?>
	                </div>

                    <label class="control-label">슬라이드용 이미지 465 X 300px </label>
	                <div class="controls">
	                    <input class="input-file" name="slide_image" type="file">
                        <?php if(@$exhb->slide_image_id):?><a href="<?=base_url()?>admin/filebox/download/<?=$exhb->slide_image_id?>">슬라이드 이미지 다운로드</a><?php endif;?>
	                </div>
	            </div>
            </div>

            <div class="alert alert-warning"> 
                <p><strong>TAG!!!</strong> 태그 정보들을 입력하세요 :)</p>
	            <div class="control-group"> 
	                <label class="control-label" >공간 태그</label>
	                <div class="controls">
	                    <input type="text" name="place_tags" placeholder="공간관련 태그를 입력하세요.ex)서울미술관,신사동,코엑스" class="input-xxlarge" value="<?=@$exhb->place_tags?>">
	                    <p class="help-block place_tags tags">
                        <?php foreach($tags['place_tags'] as $key => $tag):?> 
                            <span class="label"><?=$tag->tag_name?> </span>&nbsp;
                        <?php endforeach;?>
                        </p>
	                </div>
	            </div>
	
	            <div class="control-group"> 
	                <label class="control-label" >전시 키워드</label>
	                <div class="controls">
	                    <input type="text" name="keyword_tags" placeholder="전시 관련 키워드를 입력하세요.키워드1,키워드2,키워드3" class="input-xxlarge" value="<?=@$exhb->keyword_tags?>">
	                    <p class="help-block keyword_tags tags"> 
                        <?php foreach($tags['keyword_tags'] as $key => $tag):?> 
                            <span class="label"><?=$tag->tag_name?> </span>&nbsp;
                        <?php endforeach;?>
                        </p>
	                </div>
	            </div>
	
	            <div class="control-group"> 
	                <label class="control-label" >전시 카테고리</label>
	                <div class="controls">
	                    <input type="text" name="category_tags" placeholder="전시 관련 카테고리를 입력하세요. ex)팝아트,르네상스" class="input-xxlarge" value="<?=@$exhb->category_tags?>">
	                    <p class="help-block category_tags tags"> 
                        <?php foreach($tags['category_tags'] as $key => $tag):?> 
                            <span class="label"><?=$tag->tag_name?> </span>&nbsp;
                        <?php endforeach;?>
                        </p>
	                </div>
	            </div> 

                <div class="control-group"> 
	                <label class="control-label" >아티스트</label>
	                <div class="controls">
	                    <input type="text" name="artist_tags" placeholder="전시와 관련된 아티스트를 입력하세요.  ex)이우환,존맥커리" class="input-xxlarge" value="<?=@$exhb->artist_tags?>">
	                    <p class="help-block artist_tags tags"> 
                        <?php foreach($tags['artist_tags'] as $key => $tag):?> 
                            <span class="label"><?=$tag->tag_name?> </span>&nbsp;
                        <?php endforeach;?>
                        </p>
	                </div>
	            </div>
            </div> 
            
            <hr/>
            <div class="alert alert-info "><p><strong>info</strong> 추가로 필요한 정보들을 입력하세요.</p>
	            
	            <div class="control-group"> 
	                <label class="control-label" >휴관일 </label>
	                <div class="controls">
	                    <input type="text" name="closed"  placeholder="미술관 휴관일을 입력하세요." class="input-xxlarge" value="<?=@$exhb->closed?>">
	                    <p class="help-block"></p>
	                </div>
	            </div>
	            <div class="control-group"> 
	                <label class="control-label" >관람요금 </label>
	                <div class="controls">
	                    <input type="text" name="fee" placeholder="관람 요금을 입력하세요." class="input-xxlarge" value="<?=@$exhb->fee?>">
	                    <p class="help-block"></p>
	                </div>
	            </div>
	            <div class="control-group"> 
	                <label class="control-label" >관람 가능 시간 </label>
	                <div class="controls">
	                    <input type="text" name="visiting_hours"  placeholder="관람 가능 시간을 알려주세요." class="input-xxlarge" value="<?=@$exhb->visiting_hours?>">
	                    <p class="help-block"></p>
	                </div>
	            </div>
	            <div class="control-group"> 
	                <label class="control-label" >문의 전화 </label>
	                <div class="controls">
	                    <input type="text" name="callcenter"  placeholder="예시) 02-1234-1234" class="input-xxlarge" value="<?=@$exhb->callcenter?>">
	                    <p class="help-block"></p>
	                </div>
	            </div>
                <div class="control-group"> 
	                <label class="control-label" >추가사항 </label>
	                <div class="controls">
                        <textarea name="information" style="width:100%;"><?=@$exhb->information?> </textarea>
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
