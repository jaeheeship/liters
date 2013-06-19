<style>
.row-fluid .well { height : 200px; }
</style>
<div class="content"> 
    <div class="row-fluid">
        <div class="span12"> 
            <div class="carousel slide" id="myCarousel">
                <div class="carousel-inner">
                    <div class="active item"> 
                        <div class="row-fluid"> 
                            <div class="span12">
                                <div class="well"></div>
                            </div>
                        </div> 
                        <div class="carousel-caption"> 
                            <p style="text-align:center;font-size:1.3em;color:#fff;" >1 column</p>
                        </div>
                    </div>
                    <div class="item"> 
                        <div class="row-fluid"> 
                            <div class="span6">
                                <div class="well"></div>
                            </div>
                            <div class="span6">
                                <div class="well"></div>
                            </div>
                        </div> 
                        <div class="carousel-caption"> 
                            <p style="text-align:center;font-size:1.3em;color:#fff;" >2 column</p>
                        </div>

                    </div>
                    <div class="item"> 
                        <div class="row-fluid"> 
                            <div class="span4">
                                <div class="well"></div>
                            </div>
                            <div class="span4">
                                <div class="well"></div>
                            </div>
                            <div class="span4">
                                <div class="well"></div>
                            </div>
                        </div> 

                        <div class="carousel-caption"> 
                            <p style="text-align:center;font-size:1.3em;color:#fff;" >3 column</p>
                        </div>
                    </div>
                    <div class="item"> 
                        <div class="row-fluid"> 
                            <div class="span3">
                                <div class="well"></div>
                            </div>
                            <div class="span3">
                                <div class="well"></div>
                            </div>
                            <div class="span3">
                                <div class="well"></div>
                            </div>
                            <div class="span3">
                                <div class="well"></div>
                            </div>
                        </div> 

                        <div class="carousel-caption"> 
                            <p style="text-align:center;font-size:1.3em;color:#fff;" >4 column</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control left" data-slide="prev" href="#myCarousel">&lsaquo; </a>
                <a class="carousel-control right" data-slide="next" href="#myCarousel">&rsaquo; </a>
            </div> 
            <div>
                <a class="select_column btn btn-primary">컬럼 선택 하기 </a>
            </div>
        </div>
    </div>
</div>
<hr/>
<script>
var base_url = '<?=base_url();?>' ; 
jQuery(function($){
    var index;
    $('.carousel').carousel() ; 
    $('.select_column').click(function(){
        $('.item').each(function(i,o){
            if($(o).hasClass('active')){ 
                index = i; 
            } 
        }); 

        $.post(base_url+'admin/control_panel/setColumn',{column : index+1},function(response){

        }); 
    }); 
}); 
</script>
