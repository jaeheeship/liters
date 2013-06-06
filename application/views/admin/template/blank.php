<style> 
a {color:inherit;text-decoration:none;  }
a:hover {color:inherit;;text-decoration:none;  }
a:visited {color:inherit;;text-decoration:none;  }
.row_section {margin-bottom: 20px;position:relative;}
.section_remocon {position:absolute;top:0px;left:-10px;width:40px;}
.box { margin-bottom:20px;}
.box a { word-wrap:break-word ;}

.box .image_left {float:left ;margin : 0px 5px 5px 0px;}
.box .image_right {float:right ;margin : 0px 0px 5px 5px;}
.box .image_center { text-align:center;margin : 0px 0px 5px 0px;}
.box .image_justify {margin : 0px 0px 5px 0px;}

.box .image a {display:block;}
.box .text_area {padding:15px 15px 15px 15px;background:#fafafa; } 
.box h6 { font-size: 1.1em; font-weight:bold;margin-top:0px;margin-bottom:15px;  } 
.box p { font-size: 1.1em; line-height:190%;  } 
.info_page .info_description {font-size:1.4em ; }
.info_page .info_description li { line-height:180%; }
.alert .description { min-height : 70px;}

</style>


<script> 
(function($){

$.printf = function(str,oParam){ 
    $.each(oParam,function(key,val){ 
        str = str.replace('{'+key+'}',val) ;  
    }); 

    return str ; 
}

})(jQuery) ; 
</script>


<?echo js_asset('template.constant.js','template') ?>
<?echo js_asset('template.section.js','template') ?>
<?echo js_asset('template.section_modal.js','template') ?>
<?echo js_asset('template.box.js','template') ?>
<?echo js_asset('template.box_modal.js','template') ?>

<script>
jQuery(function($){ 

$('.add_section_btn').bind('click',function(){
    var $this = $(this) ;
    var $form = $($this.parents('form')) ; 
    var title = $form.find('[name=title]').val() ; 
    var section_type = $this.attr('section_type') ; 

    var section = TMPL.Section({
        target : '#template_body',
        title : title ,
        section_type : section_type
    }).render() ;

}); 
 

});
</script>

<div class="container">
    
</div>

<div>
    <div class="container" id="template_body"> 
    <!--
        # template area
        # 이 영역에 섹션과 template들이 생성됨 
    -->
    </div> 
</div> 

<div class="container">
    <div class="row">
        <div class="span4"> 
            <div class="alert alert-info" style="min-height:150px;"> 
                <h4 class="alert-heading">글상자</h4>
                <p class="description">섹션에 글 상자를 추가해보세요. 내가 수집하고 있는 글들을 편집해서 보여줄수 있어요. </p>
                <a class="btn btn-primary btn-large add_section_btn " section_type="CONTENT_BOX"><i class="icon icon-plus icon-white"></i> ADD </a>
            </div>

        </div>
        <div class="span4"> 
            <div class="alert alert-info" style="min-height:150px;"> 
                <h4 class="alert-heading">HTML</h4>
                <p class="description">HTML이 더 편하세요? 그렇다면 HTML 섹션을 만들어서 나만의 페이지를 만들어 보세요.</p>
                <a class="btn btn-primary btn-large add_section_btn" section_type="HTML" ><i class="icon icon-plus icon-white"></i> ADD </a>
            </div>
        </div>
        <div class="span4"> 
            <div class="alert alert-info" style="min-height:150px;"> 
                <h4 class="alert-heading">위젯</h4>
                <p class="description">아트그라피가 만든 아름다운 위젯을 추가해보세요. 슬라이드 쇼, 포토 갤러리 등을 추가 할수 있어요. </p>
                <a class="btn btn-primary btn-large add_section_btn " section_type="WIDGET"><i class="icon icon-plus icon-white"></i> ADD </a>
            </div>
        </div>
    </div>
</div> 

<div class="modal fade" id="section_modal">
    <div class="modal-header"> 
        <button type="button" class="close" data-dismiss="modal" aria=hidden="true"  >&times; </button>
        <h3>Content Box </h3>
    </div>
    <div class="modal-body">
    <form class="form-horizontal" id="content_box_control_form">
        <fieldset> 
        <div class="control-group">
            <label class="control-label" >Row * Column </label> 
            <div class="controls"> 
                <select name="rows" class="span1">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>                
                </select><span>&nbsp;X</span>
                <select name="cols" class="span1" id="column_changer">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
            </div>
            <label class="control-label" >Class</label> 
            <div class="controls"> 
                <input type="text" name="box_cls" />
            </div>
            <label class="control-label" >Style</label> 
            <div class="controls"> 
                <input type="text" name="box_css" />
            </div>
        </div> 

        <div class="well">
            <h3>이미지 보이기 <input type="checkbox" name="show_image" value="true" /> </h3>
	        <div class="control-group">
		        <label class="control-label"> image 정렬 </label>
		        <div class="controls"> 
	                <label class="radio inline"> 
	                    <input type="radio" value="justify" name="image_align"/>justify
	                </label>
		            <label class="radio inline"> 
	                    <input type="radio" value="left" name="image_align" />Left
	                </label>
	                <label class="radio inline"> 
	                    <input type="radio" value="center" name="image_align" />Center
	                </label>
	                <label class="radio inline"> 
	                    <input type="radio" value="right" name="image_align" />Right
	                </label>
	            </div>
	        </div>
	        <div class="control-group">
		        <label class="control-label">너비*높이 </label>
	            <div class="controls"> 
	                <input type="text" class="span1" name="image_width" /> <span>&nbsp;*</span>
	                <input type="text"  class="span1" name="image_height" />
	            </div>
                <label class="control-label">클래스 </label>
	            <div class="controls"> 
	                <input type="text"  name="image_cls" /> 
	            </div>
                <label class="control-label">스타일 </label>
	            <div class="controls"> 
	                <input type="text"  name="image_css" /> 
	            </div>
	        </div>
        </div> 

        <div class="well">
            <h3>제목 보이기 <input type="checkbox" name="show_title" value="true"/> </h3>
	        
            <div class="control-group">
		        <label class="control-label inline"> 제목 길이 </label>
		        <div class="controls"> 
                    <input type="text" name="title_length"  placeholder="Default:제한없음" />
                </div>
		        <label class="control-label inline">클래스</label>
                <div class="controls"> 
                    <input type="text" name="title_cls" placeholder="Default:없음" />
                </div> 
                <label class="control-label inline">스타일</label>
                <div class="controls"> 
                    <input type="text" name="title_css" placeholder="Default:없음" />
                </div> 
	        </div> 
        </div>
        <div class="well">
            <h3>요약글 보이기 <input type="checkbox" name="show_description" value="true" /> </h3>
	        
            <div class="control-group">
		        <label class="control-label inline"> 글 길이 </label>
		        <div class="controls"> 
                    <input type="text" name="description_length" placeholder="Default:제한없음" />
                </div>
		        <label class="control-label inline">클래스</label>
                <div class="controls"> 
                    <input type="text" name="description_cls" placeholder="Default:없음" />
                </div> 
                <label class="control-label inline">스타일</label>
                <div class="controls"> 
                    <input type="text" name="description_css" placeholder="Default:없음" />
                </div>
	        </div> 
        </div>
        
        </fieldset> 
    </form>
    </div> 
    <div class="modal-footer"> 
        <a data-toggle="modal" id="section_save_btn" class="btn btn-primary" ><i class="icon-plus icon-white"></i>&nbsp;OK</a>
    </div>
</div>

<div class="modal fade" id="box_modal">
    <div class="modal-header"> 
        <button type="button" class="close" data-dismiss="modal" aria=hidden="true"  >&times; </button>
        <h3>Box Configuration </h3>
    </div>
    <div class="modal-body">
    <form class="form-horizontal" id="content_box_control_form">
        <fieldset> 
        <div class="control-group"> 
            <label class="control-label" >Class</label> 
            <div class="controls"> 
                <input type="text" name="box_cls" />
            </div>
            <label class="control-label" >Style</label> 
            <div class="controls"> 
                <input type="text" name="box_css" />
            </div>
        </div> 

        <div class="well">
            <h3>이미지 보이기 <input type="checkbox" name="show_image" value="true" /> </h3>
	        <div class="control-group">
		        <label class="control-label"> image 정렬 </label>
		        <div class="controls"> 
	                <label class="radio inline"> 
	                    <input type="radio" value="justify" name="image_align"/>justify
	                </label>
		            <label class="radio inline"> 
	                    <input type="radio" value="left" name="image_align" />Left
	                </label>
	                <label class="radio inline"> 
	                    <input type="radio" value="center" name="image_align" />Center
	                </label>
	                <label class="radio inline"> 
	                    <input type="radio" value="right" name="image_align" />Right
	                </label>
	            </div>
	        </div>
	        <div class="control-group">
		        <label class="control-label">너비*높이 </label>
	            <div class="controls"> 
	                <input type="text" class="span1" name="image_width" /> <span>&nbsp;*</span>
	                <input type="text"  class="span1" name="image_height" />
	            </div>
                <label class="control-label">클래스 </label>
	            <div class="controls"> 
	                <input type="text"  name="image_cls" /> 
	            </div>
                <label class="control-label">스타일 </label>
	            <div class="controls"> 
	                <input type="text"  name="image_css" /> 
	            </div>
	        </div>
        </div> 

        <div class="well">
            <h3>제목 보이기 <input type="checkbox" name="show_title" value="true"/> </h3>
	        
            <div class="control-group">
		        <label class="control-label inline"> 제목 길이 </label>
		        <div class="controls"> 
                    <input type="text" name="title_length"  placeholder="Default:제한없음" />
                </div>
		        <label class="control-label inline">클래스</label>
                <div class="controls"> 
                    <input type="text" name="title_cls" placeholder="Default:없음" />
                </div> 
                <label class="control-label inline">스타일</label>
                <div class="controls"> 
                    <input type="text" name="title_css" placeholder="Default:없음" />
                </div> 
	        </div> 
        </div>
        <div class="well">
            <h3>요약글 보이기 <input type="checkbox" name="show_description" value="true" /> </h3>
	        
            <div class="control-group">
		        <label class="control-label inline"> 글 길이 </label>
		        <div class="controls"> 
                    <input type="text" name="description_length" placeholder="Default:제한없음" />
                </div>
		        <label class="control-label inline">클래스</label>
                <div class="controls"> 
                    <input type="text" name="description_cls" placeholder="Default:없음" />
                </div> 
                <label class="control-label inline">스타일</label>
                <div class="controls"> 
                    <input type="text" name="description_css" placeholder="Default:없음" />
                </div>
	        </div> 
        </div>
        
        </fieldset> 
    </form>
    </div> 
    <div class="modal-footer"> 
        <a data-toggle="modal" id="box_save_btn" class="btn btn-primary"> <i class="icon-plus icon-white"></i> &nbsp;OK</a>
    </div>
</div>
