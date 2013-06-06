<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('ADMIN_Controller.php'); 

class Place extends ADMIN_Controller {

    function __construct() {
        parent::__construct() ; 
        $this->load->library('aglayout') ; 
        $this->aglayout->layout('admin/layout'); 
        //$this->output->enable_profiler(TRUE) ; 
    }

    public function placeList($page=1,$list_count=10){
        $this->load->helper('image') ; 
        $data['action'] = 'placeList' ;
        $this->aglayout->moduleViewPath('admin/place/') ; 
        $this->aglayout->add('header') ; 
        $this->aglayout->add('sidebar') ; 
        $this->aglayout->add('placeList') ; 
        $this->aglayout->add('footer') ; 

        $this->load->model('place/place_model','place_model') ; 
        $param = null; 
        $data['search_keyword'] = '' ; 

        if( $search_keyword = $this->input->get('search_keyword')){ 
            $param = array() ; 
            $param['search_keyword'] = $search_keyword ; 
            $data['search_keyword'] = $search_keyword ; 
        }

        $result = $this->place_model->getPlaceList($page,$list_count,$param) ; 
        $data['place_list'] = $result['list'] ;
        $data['pagination'] = $result['pagination'] ;

        $this->aglayout->show($data) ;
    }

    public function getPlace($id){ 
        $this->load->model('place/place_model','place_model') ; 
        $place = $this->place_model->getPlace($id) ; 
    }

    public function delete($place_id=0){ 
        $this->load->model('place/place_model','place_model') ; 
        if($place_id){
            $this->place_model->delete($place_id) ; 
        }
    }

    public function writeform($place_id=0) {
        $data['action'] = 'writeform' ;
        $this->aglayout->moduleViewPath('admin/place/') ; 
        $this->aglayout->add('header') ; 
        $this->aglayout->add('sidebar') ; 
        $this->aglayout->add('writeform') ; 
        $this->aglayout->add('footer') ; 

        if($place_id){
            $this->load->model('place/place_model') ; 
            $place = $this->place_model->getPlace($place_id) ; 
            $place_types = explode(',',$place->place_type ) ; 

            $place->place_type = array() ; 

            if(count($place_types)){
                for($i=0; $i < count($place_types) ; $i++){
                    $place->place_type[$place_types[$i]] = TRUE; 
                }
            }


            $this->load->model('tags/tags_model') ; 

            if($place->tags){
                $tag_map = $this->tags_model->decodeMap($place->tags) ;  
            }

            $tag_types = $this->tags_model->getTagTypes() ;  

            foreach($tag_types as $key => $type){
                if(isset($tag_map[$type])){ 
                    $place->{$type} = implode(',',$tag_map[$type])  ; 
                }else{
                    $place->{$type} = '' ; 
                }
            }

            $data['place'] = $place ; 
        }

        $this->aglayout->show($data) ;
    } 

    function _fields_filter($post_fields){
        $data = new stdClass ; 
        $tags = array() ; 
        $raw_tags = array() ; 

        foreach($post_fields as $key => $field_value){ 
            if(($key=='artist_tags'||$key=='category_tags'||$key=='keyword_tags'||$key=='place_tags')&& $field_value != '' ){ 

                $field_values = explode(',',$field_value) ; 

                for($i = 0 ; $i < count($field_values) ; $i++){
                    $tags[] = '{"'.$key.'":"'.$field_values[$i].'"}' ; 
                    $raw_tags[] = $field_values[$i] ; 
                }

            }else if($key=='place_type'){ 
                if(count($field_value)){
                    $data->place_type = implode(',',$field_value) ; 
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


        return $data ; 
    }


    public function save(){

        $post_fields = $this->input->post() ; 
        $this->load->model('place/place_model','place_model') ; 
        
        $data = $this->_fields_filter($post_fields) ; 
        $this->load->library('tank_auth') ; 

        $place_name = $post_fields['place_name'] ;
        $this->load->model('place/place_model') ; 
        
        $ret = $this->place_model->getPlaceBy('place_name',$place_name) ; 

        if($ret){ //존재하면
            redirect('admin/place/placeList') ; 
        }

        $data->username = $this->tank_auth->get_username() ; 
        $data->email = $this->tank_auth->get_user_email() ; 
        $data->uid = $this->tank_auth->get_user_id() ; 

        $this->load->library('naverapi') ; 
        $geocode = $this->naverapi->getGeocode($post_fields['address']) ; 
    
        if(!$geocode){ 
            $geocode->x  = 0 ; 
            $geocode->y  = 0 ; 
        } 

        $data->lng = $geocode->x ; 
        $data->lat = $geocode->y ; 

        if($post_fields['place_id'] && $this->place_model->getPlace($post_fields['place_id']) != null ){ 
            $ret_data = $this->_update($data) ; 
        }else{ 
            $ret_data = $this->_insert($data) ; 
        }

        $saved_data = $ret_data ; 

        $this->load->library('uploadhandler') ; 


        $file_fields = array('logo',
                            'main_image') ; 
        
        $file_cnt = 0 ; 
	    $obj = new stdClass ; 

        foreach($file_fields as $key => $field){
	        if(($upload_data = $this->uploadhandler->upload($field))){ 
                $file_cnt++ ; 
	            $obj->place_id = $ret_data->place_id ; 
                $file_id = $upload_data->file_id ; 
	
	            !is_dir('files') ? mkdir('files',0777) : null ; 
	            !is_dir('files/place') ? mkdir('files/place',0777) : null ; 
	            !is_dir('files/place/'.$obj->place_id) ? mkdir('files/place/'.$obj->place_id,0777) : null ; 
	
	            copy($upload_data->full_path , './files/place/'.$obj->place_id.'/'.$upload_data->encrypted_file_name) ; 
	
	            $obj->{$field.'_src'} = './files/place/'.$obj->place_id.'/'.$upload_data->encrypted_file_name ; 
	            $obj->{$field.'_id'} = $file_id ;
	        } 
        } 
        
        if($file_cnt){
	        $ret_data = $this->_update($obj) ;
        }

        if($saved_data->tags){

            $resource = new stdClass ; 

            $resource->resource_id = $saved_data->place_id  ;
            $resource->resource_type = 'place'   ;
            $resource->resource_title = $saved_data->place_name  ;

            $this->load->model('tags/tags_model') ; 

            $tag_map = $this->tags_model->decodeMap($saved_data->tags) ; 

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

                    $who->uid = $this->tank_auth->get_user_id() ;
                    $who->username = $this->tank_auth->get_username() ;

                    $this->tags_model->attachTag($resource,$saved_tag) ; 
                    $this->tags_model->saveTaggingLogHistory($who,$resource,$saved_tag) ; 
                }
            } 
        }

        redirect('admin/place/placeList') ; 
    }

    public function _update($data){ 
        return $this->place_model->update($data) ; 
    } 

    public function _insert($data){ 
        return $this->place_model->insert($data) ; 
    }

    public function getGeocode($search_keyword){
        $this->load->library('naverapi') ; 
        $geocode = $this->naverapi->getGeocode($search_keyword) ; 
    }

}
