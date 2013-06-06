<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('ADMIN_Controller.php'); 
class Exhibition extends ADMIN_Controller {
    function __construct(){ 
        parent::__construct() ; 
        $this->load->library('aglayout') ; 
        $this->aglayout->layout('admin/layout'); 
        //$this->output->enable_profiler(TRUE) ; 
    }

    public function register_slide($exhb_id,$on='on'){ 
        $this->load->model('exhibition/exhb_model') ; 

        if($exhb_id > 0){
            $data = new stdClass ; 
            if($on == 'on'){ 
                $data->is_slide = 'Y' ; 
            }else{
                $data->is_slide = 'N' ; 
            }
            $data->exhb_id = $exhb_id ; 

            $this->exhb_model->update($data) ; 
        }
    }

    public function generateThumbnail($exhb_id){ 
        $this->load->model('exhibition/exhb_model','exhb_model') ; 
        $exhb = $this->exhb_model->getExhb($exhb_id) ; 

        $this->load->helper('image') ; 
        $thumbnail_url =  thumbImage('exhibition',$exhb->exhb_id,$exhb->poster_image_src,330,240) ; 
    }

    public function share($exhb_id){
        $this->load->model('exhibition/exhb_model','exhb_model') ; 
        $exhb = $this->exhb_model->getExhb($exhb_id) ; 
        $data = array() ; 
        $data['exhb'] = $exhb ; 

        $this->load->view('share',$data) ; 
    }

    public function tagCloud(){
        $data['action'] = 'tagCloud' ;
        $this->aglayout->moduleViewPath('admin/exhibition/') ; 
        $this->aglayout->add('header') ; 
        $this->aglayout->add('sidebar') ; 
        $this->aglayout->add('tagCloud') ; 
        $this->aglayout->add('footer') ; 

        $this->load->model('exhibition/exhb_model','exhb_model') ; 
        $this->load->model('tags/tags_model') ; 

        $tagMap = $this->tags_model->tag_map() ; 

        $data['tagMap'] = $tagMap ; 

        $this->aglayout->show($data) ;
    }

    public function exhbList($page=1,$list_count=10){
        $this->load->helper('image') ; 
        $data['action'] = 'exhbList' ;
        $this->aglayout->moduleViewPath('admin/exhibition/') ; 
        $this->aglayout->add('header') ; 
        $this->aglayout->add('sidebar') ; 
        $this->aglayout->add('exhbList') ; 
        $this->aglayout->add('footer') ; 

        $this->load->model('exhibition/exhb_model','exhb_model') ; 
        $param = null; 
        $data['search_keyword'] = '' ; 

        if( $search_keyword = $this->input->get('search_keyword')){ 
            $param = array() ; 
            $param['search_keyword'] = $search_keyword ; 
            $data['search_keyword'] = $search_keyword ; 
        }

        $result = $this->exhb_model->getExhbList($page,$list_count,$param) ; 
        $data['exhb_list'] = $result['list'] ;
        $data['pagination'] = $result['pagination'] ;

        $this->aglayout->show($data) ;
    }

    public function delete($exhb_id){ 
        $this->load->model('exhibition/exhb_model','exhb_model') ; 
        $remove_obj = $this->exhb_model->delete($exhb_id) ; 
    }

    public function exhbForm($exhb_id=0){
        $data['action'] = 'exhbForm' ;
        $this->aglayout->moduleViewPath('admin/exhibition/') ; 
        $this->aglayout->add('header') ; 
        $this->aglayout->add('sidebar') ; 
        $this->aglayout->add('exhbForm') ; 
        $this->aglayout->add('footer') ; 

        $this->load->model('place/place_model') ; 
        $this->load->model('tags/place_model') ; 
        $place_list = $this->place_model->getPlaceListAll() ; 


        $this->load->model('tags/tags_model') ; 

        $data['place_list'] = $place_list ; 
        $data['tags'] = array() ; 
        $data['tags']['artist_tags'] = $this->tags_model->get_tags('artist_tags') ; 
        $data['tags']['category_tags'] =  $this->tags_model->get_tags('category_tags') ; 
        $data['tags']['place_tags'] = $this->tags_model->get_tags('place_tags')  ; 
        $data['tags']['keyword_tags'] = $this->tags_model->get_tags('keyword_tags')  ; 

        if($exhb_id){
            $this->load->model('exhibition/exhb_model','exhb_model') ; 
            $exhb = $this->exhb_model->getExhb($exhb_id) ; 


            if($exhb->tags){
                $tag_map = $this->tags_model->decode_map($exhb->tags) ;  
            }

            $tag_types = $this->tags_model->get_tag_types() ;  

            foreach($tag_types as $key => $type){
                if(isset($tag_map[$type])){ 
                    $exhb->{$type} = implode(',',$tag_map[$type])  ; 
                }else{
                    $exhb->{$type} = '' ; 
                }
            }


            $data['exhb'] = $exhb ; 
        }

        $this->aglayout->show($data) ;
    }

    public function save(){ 
        $post_fields = $this->input->post() ; 
        $this->load->model('exhibition/exhb_model','exhb_model') ; 

        $data = $this->_fields_filter($post_fields) ; 
        $this->load->library('tank_auth') ; 

        $data->username = $this->tank_auth->get_username() ; 
        $data->email = $this->tank_auth->get_user_email() ; 
        $data->uid = $this->tank_auth->get_user_id() ; 

        $this->load->model('place/place_model') ; 
        $place = $this->place_model->getPlace($data->place_id) ;  


        if($place){
            $data->address = $place->address ; 
            $data->place_name = $place->place_name ; 
        }

        if($post_fields['exhb_id'] && $this->exhb_model->getExhb($post_fields['exhb_id']) != null ){ 
            $ret_data = $this->_update($data) ; 
        }else{
            $ret_data = $this->_insert($data) ; 
        }

        $saved_data = $ret_data ; 


        $this->load->library('uploadhandler') ; 

        $file_fields = array('poster_image',
                'press_data',
                'main_image',
                'slide_image') ; 

        $file_cnt = 0 ; 
        $obj = new stdClass ; 

        foreach($file_fields as $key => $field){
            if(($upload_data = $this->uploadhandler->upload($field))){ 
                $file_cnt++ ; 
                $obj->exhb_id = $ret_data->exhb_id ; 
                $file_id = $upload_data->file_id ; 

                !is_dir('files') ? mkdir('files',0777) : null ; 
                !is_dir('files/exhibition') ? mkdir('files/exhibition',0777) : null ; 
                !is_dir('files/exhibition/'.$obj->exhb_id) ? mkdir('files/exhibition/'.$obj->exhb_id,0777) : null ; 

                copy($upload_data->full_path , './files/exhibition/'.$obj->exhb_id.'/'.$upload_data->encrypted_file_name) ; 

                $obj->{$field.'_src'} = './files/exhibition/'.$obj->exhb_id.'/'.$upload_data->encrypted_file_name ; 
                $obj->{$field.'_id'} = $file_id ;
            } 
        } 

        if($file_cnt){
            $ret_data = $this->_update($obj) ;
        }

        if($saved_data->tags){ 
            $resource = new stdClass ; 

            $resource->resource_id = $saved_data->exhb_id  ;
            $resource->resource_type = 'exhibition'   ;
            $resource->resource_title = $saved_data->title  ;

            $this->load->model('tags/tags_model') ; 

            $tag_map = $this->tags_model->decode_map($saved_data->tags) ; 

            foreach($tag_map as $key => $tag_list){
                $tag_type = $key ; 
                for($i = 0 ; $i < count($tag_list) ; $i++){
                    $tag_name = $tag_list[$i] ; 
                    $tag_data = new stdClass ; 
                    $tag_data->tag_type = $tag_type ; 
                    $tag_data->tag_name = $tag_name ; 
                    $tag_data->uid = $this->tank_auth->get_user_id() ;
                    $tag_data->username = $this->tank_auth->get_username();
                    $saved_tag = $this->tags_model->save($tag_data) ; 

                    $who = new stdClass ; 
                    $who->uid = $this->tank_auth->get_user_id() ;
                    $who->username = $this->tank_auth->get_username() ;

                    $this->tags_model->attach_tag($resource,$saved_tag) ; 
                    $this->tags_model->save_tagging_log_history($who,$resource,$saved_tag) ; 
                }
            } 
        }

        redirect('admin/exhibition/exhbList') ; 
    }

    public function _imgUpload(){
        $this->load->library('upload') ; 
        if(!$this->upload->do_upload()){
            return null ; 
        }

        $data = $this->upload->data(); 

        if(!$data['is_image']){
            return null ;  
        }

        return $data ;  
    }

    public function _fields_filter($post_fields){
        $data = new stdClass ; 
        $tags = array() ; 
        $artist_tags = array() ; 
        $raw_tags = array() ; 

        foreach($post_fields as $key => $field_value){ 
            if(($key=='artist_tags'||$key=='category_tags'||$key=='keyword_tags'||$key=='place_tags')&& $field_value != '' ){ 

                $field_values = explode(',',$field_value) ; 

                for($i = 0 ; $i < count($field_values) ; $i++){
                    $tags[] = '{"'.$key.'":"'.$field_values[$i].'"}' ; 
                    if($key!='artist_tags'){
                        $raw_tags[] = $field_values[$i] ; 
                    }else if($key == 'artsit_tags'){
                        $artist_tags[] = $field_values[$i] ; 
                    }
                }

            }else{
                $data->{$key}  = $field_value ; 
            } 
        }

        unset($data->keyword_tags) ; 
        unset($data->artist_tags) ; 
        unset($data->category_tags) ; 
        unset($data->place_tags) ; 

        $data->tags = '['.implode(',',$tags).']' ;
        $data->raw_tags = implode(',',$raw_tags) ; 
        $data->artist_tags = '['.implode(',',$artist_tags).']' ;
        $data->description = htmlspecialchars($data->description) ; 
        $data->credit = htmlspecialchars($data->credit) ; 


        return $data ; 
    }

    public function _update($data){ 
        return $this->exhb_model->update($data) ; 
    } 

    public function _insert($data){ 
        return $this->exhb_model->insert($data) ; 
    }
}


/* End of exhibition.php */
/* Location: ./application/controller/admin/exhibition.php */
