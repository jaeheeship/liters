<script type="text/javascript">
$(function(){
    $('#section_component').carousel(); 
    $('#add_section').click(function(){
        $('.content_body').append('<div class="row show-grid"><div class="span3 "><a class="thumbnail"><img src="http://placehold.it/240x180"/></a> </div><div class="span3 "><a class="thumbnail"><img src="http://placehold.it/240x180"/></a>  </div><div class="span3 "><a class="thumbnail"><img src="http://placehold.it/240x180"/></a>  </div><div class="span3 "><a class="thumbnail"><img src="http://placehold.it/240x180"/></a>  </div></div>'); 
    }); 
}); 
</script>
<div class="container">
    <div class="row">
        <a id="add_section" class="btn btn-primary"><i class="icon-plus icon-white"></i>&nbsp;섹션 추가</a>
    </div>
    <div class="row"> 
        <div id="section_component" class="carousel slide">
            <!-- carousel inner -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="span3">
                        <a class="thumbnail"><img src="http://placehold.it/240x180"/></a> 
                    </div>
                    <div class="span3">
                        <a class="thumbnail"><img src="http://placehold.it/240x180"/></a> 
                    </div>
                    <div class="span3">
                        <a class="thumbnail"><img src="http://placehold.it/240x180"/></a> 
                    </div>
                    <div class="span3">
                        <a class="thumbnail"><img src="http://placehold.it/240x180"/></a> 
                    </div>
                </div>
                <div class="item">
                    <div class="span3">
                        <div class="thumbnail">
                            <img src="http://placehold.it/240x180"/>
                            <div class="caption">
                                <h5>title</h5>
                                <p>description</p>
                            </div>
                        </div>
                    </div>
                    <div class="span3">
                        <div class="thumbnail">
                            <img src="http://placehold.it/240x180"/>
                            <div class="caption">
                                <h5>title</h5>
                                <p>description</p>
                            </div>
                        </div>
                    </div>
                    <div class="span3">
                        <div class="thumbnail">
                            <img src="http://placehold.it/240x180"/>
                            <div class="caption">
                                <h5>title</h5>
                                <p>description</p>
                            </div>
                        </div>
                    </div>
                    <div class="span3">
                        <div class="thumbnail">
                            <img src="http://placehold.it/240x180"/>
                            <div class="caption">
                                <h5>title</h5>
                                <p>description</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="span4">
                        <a class="thumbnail"><img src="http://placehold.it/360x268"/></a> 
                    </div>
                    <div class="span4">
                        <a class="thumbnail"><img src="http://placehold.it/360x268"/></a> 
                    </div>
                    <div class="span4">
                        <a class="thumbnail"><img src="http://placehold.it/360x268"/></a> 
                    </div>
                </div>
                <div class="item">
                    <div class="span6"> 
                    df
                    </div>
                    <div class="span6"> 
                        <ul class="thumbnails"> 
                            <li class="span4">
                                <a href="#" class="thumbnail" ><img src="http://placehold.it/360x268" alt=""/> </a>
                            </li>
                            <li class="span2"> 
                                <a href="#" class="thumbnail" ><img src="http://placehold.it/160x120" alt=""/> </a>
                            </li>
                            <li class="span2"> 
                                <a href="#" class="thumbnail" ><img src="http://placehold.it/160x120" alt=""/> </a>
                            </li>
                            <li class="span2"> 
                                <a href="#" class="thumbnail" ><img src="http://placehold.it/160x120" alt=""/> </a>
                            </li>
                            <li class="span2"> 
                                <a href="#" class="thumbnail" ><img src="http://placehold.it/160x120" alt=""/> </a>
                            </li>
                            <li class="span2"> 
                                <a href="#" class="thumbnail" ><img src="http://placehold.it/160x120" alt=""/> </a>
                            </li> 
                        </ul>
                    </div>
                </div>
            </div>
            <!--carousel nav-->
            <a class="carousel-control left" href="#section_component" data-slide="prev">&lsaquo;</a>
            <a class="carousel-control right" href="#section_component" data-slide="next">&rsaquo;</a>
        </div>
    </div>
</div>
<div class="container content_body">
</div>

<div class="modal fade hide" id="section_modal">
    <div class="modal-header">
        <button type="button" data-dismiss="modal" class="close">x</button>
        <h3>섹션 추가 박스</h3>
    </div>
    <div class="modal-body">
        test
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">close</a>
        <a href="#" class="btn btn-primary" data-dismiss="modal">add</a>
    </div>
</div>
