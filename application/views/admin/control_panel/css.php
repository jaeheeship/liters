<style>
.row-fluid .well { height : 200px; }
</style>
<div class="content"> 
    <div class="row-fluid">
        <div class="span12"> 
            <form  action="<?=base_url()?>admin/control_panel/save_css"  method="post" enctype="multipart/form-data" >
                <input class="input-file" name="css" type="file">
                <button class="btn btn-primary" type="submit" >파일업로드 </button>
                
            </form>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <table class="table table-striped table-hover"> 
                <thead>
                    <tr>
                        <th>CSS파일 </th>
                        <th>선택 </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cssList as $key => $row):?>
                    <tr>
                        <td><?=$row->original_file_name;?> </td>
                        <td><a class="btn css_select <?if(@$row->file_id==$css_id):?> btn-primary <?php endif;?>" file_id="<?=$row->file_id;?>">선택</a></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<hr/>
<script>
var base_url = '<?=base_url();?>' ; 
jQuery(function($){
    var index;
    $('.css_select').click(function(){
        if(confirm('css로 선택하시겠습니까')){ 
            var $this = $(this) ; 
            var file_id = $this.attr('file_id') ; 

            $.post(base_url+'admin/control_panel/select_css',{ file_id : file_id },function(){ 
                location.href = location.href ; 
            }); 
        }
    }); 

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
