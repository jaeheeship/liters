<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('ADMIN_Controller.php'); 
class Partner extends ADMIN_Controller {
    function __construct(){ 
        parent::__construct() ; 
        $this->load->library('aglayout') ; 
        $this->aglayout->layout('admin/layout'); 
        //$this->output->enable_profiler(TRUE) ; 
    }

    public function partnerList($page=1,$list_count=10){
        $this->load->helper('image') ; 
        $data['action'] = 'partnerList' ;
        $this->aglayout->moduleViewPath('admin/partner/') ; 
        $this->aglayout->add('header') ; 
        $this->aglayout->add('sidebar') ; 
        $this->aglayout->add('partnerList') ; 
        $this->aglayout->add('footer') ; 

        $this->load->model('partner/partner_model','partner_model') ; 
        $param = null; 
        $data['search_keyword'] = '' ; 

        if( $search_keyword = $this->input->get('search_keyword')){ 
            $param = array() ; 
            $param['search_keyword'] = $search_keyword ; 
            $data['search_keyword'] = $search_keyword ; 
        }

        $result = $this->partner_model->getPartnerList($page,$list_count,$param) ; 
        $data['partner_list'] = $result['list'] ;
        $data['pagination'] = $result['pagination'] ;

        $this->aglayout->show($data) ;
    }

    public function delete($partner_id){ 
        $this->load->model('partner/partner_model','partner_model') ; 
        $remove_obj = $this->partner_model->delete($partner_id) ; 
    }

    public function partnerForm($partner_id=0){
        $data['action'] = 'partnerForm' ;
        $this->aglayout->moduleViewPath('admin/partner/') ; 
        $this->aglayout->add('header') ; 
        $this->aglayout->add('sidebar') ; 
        $this->aglayout->add('partnerForm') ; 
        $this->aglayout->add('footer') ; 


        if($partner_id){
            $this->load->model('partner/partner_model','partner_model') ; 
            $partner = $this->partner_model->getPartner($partner_id) ; 

            $data['partner'] = $partner ; 
        }

        $this->aglayout->show($data) ;
    }

    public function save(){ 
        $post_fields = $this->input->post() ; 
        $this->load->model('partner/partner_model','partner_model') ; 

        $data = $this->_fields_filter($post_fields) ; 
        $this->load->library('tank_auth') ; 

        $data->username = $this->tank_auth->get_username() ; 
        $data->email = $this->tank_auth->get_user_email() ; 
        $data->uid = $this->tank_auth->get_user_id() ; 

        if($post_fields['partner_id'] && $this->partner_model->getPartner($post_fields['partner_id']) != null ){ 
            $ret_data = $this->_update($data) ; 
        }else{
            $ret_data = $this->_insert($data) ; 
        }

        $saved_data = $ret_data ; 

        $this->load->library('uploadhandler') ; 

        $file_fields = array('partner_image') ; 

        $file_cnt = 0 ; 
        $obj = new stdClass ; 

        foreach($file_fields as $key => $field){
            if(($upload_data = $this->uploadhandler->upload($field))){ 
                $file_cnt++ ; 
                $obj->partner_id = $ret_data->partner_id ; 
                $file_id = $upload_data->file_id ; 

                !is_dir('files') ? mkdir('files',0777) : null ; 
                !is_dir('files/partner') ? mkdir('files/partner',0777) : null ; 
                !is_dir('files/partner/'.$obj->partner_id) ? mkdir('files/partner/'.$obj->partner_id,0777) : null ; 

                copy($upload_data->full_path , './files/partner/'.$obj->partner_id.'/'.$upload_data->encrypted_file_name) ; 

                $obj->{$field.'_src'} = './files/partner/'.$obj->partner_id.'/'.$upload_data->encrypted_file_name ; 
                $obj->{$field.'_id'} = $file_id ;
            } 
        } 

        if($file_cnt){
            $ret_data = $this->_update($obj) ;
        } 

        redirect('admin/partner/partnerList') ; 
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

        //$data->tags = '['.implode(',',$tags).']' ;
        //$data->raw_tags = implode(',',$raw_tags) ; 
        //$data->artist_tags = '['.implode(',',$artist_tags).']' ;
        //$data->description = htmlspecialchars($data->description) ; 
        //$data->credit = htmlspecialchars($data->credit) ; 


        return $data ; 
    }

    public function _update($data){ 
        return $this->partner_model->update($data) ; 
    } 

    public function _insert($data){ 
        return $this->partner_model->insert($data) ; 
    } 
}
