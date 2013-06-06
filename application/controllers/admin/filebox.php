<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('ADMIN_Controller.php'); 
class Filebox extends ADMIN_Controller {
    
    function __construct(){
        parent::__construct() ; 
        $this->load->library('aglayout') ; 
        $this->aglayout->layout('admin/layout'); 
        $this->aglayout->moduleViewPath('admin/filebox/') ;
    }

    public function download($file_id){
        $this->load->model('filebox/filebox_model','filebox') ; 

        $file_obj = $this->filebox->getFile($file_id) ; 

        $this->load->helper('download') ; 

        $data = file_get_contents($file_obj->full_path) ; 
        force_download($file_obj->original_file_name , $data) ; 
    }

    public function fileList($page=1,$list_count=10){ 
        $data['action'] = 'fileList' ; 

        $this->load->model('filebox/filebox_model','filebox') ; 

        $param = null; 
        $data['search_keyword'] = '' ; 

        if( $search_keyword = $this->input->get('search_keyword')){ 
            $param = array() ; 
            $param['search_keyword'] = $search_keyword ; 
            $data['search_keyword'] = $search_keyword ; 
        }

        $result = $this->filebox->getFileList($page,$list_count,$param) ; 
        $data['fileList'] = $result['list'] ; 
        $data['pagination'] = $result['pagination'] ; 

        $this->aglayout->add('header') ; 
        $this->aglayout->add('sidebar') ; 
        $this->aglayout->add('fileList') ; 
        $this->aglayout->add('footer') ; 

        $this->aglayout->show($data) ;
    } 

    public function update(){ 
        $file_id = $this->input->post('file_id') ; 

        $param = new stdClass ; 
        $param->tags = $this->input->post('tags') ; 

        $this->load->model('filebox/filebox_model','filebox') ; 
        $data = $this->filebox->update($file_id,$param) ; 
    }

    public function process(){
        error_reporting(E_ALL | E_STRICT);
        
        $config = array() ; 
        $this->load->library('uploadhandler') ; 

        header('Pragma: no-cache');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Content-Disposition: inline; filename="files.json"');
        header('X-Content-Type-Options: nosniff');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');

        !is_dir('files') ? mkdir('files',0777) : null ; 
        !is_dir('files/temp') ? mkdir('files/temp',0777) : null ; 
        !is_dir('files/filebox') ? mkdir('files/filebox',0777) : null ; 
        !is_dir('files/filebox/img') ? mkdir('files/filebox/img',0777) : null ; 
        !is_dir('files/filebox/binary') ? mkdir('files/filebox/binary',0777) : null ;

        $ret = $this->_process($this->input->server('REQUEST_METHOD')) ; 

        echo $ret ; 
    } 

    public function _process($request_method){
        $_method = $this->input->get_post('_method') ; 

        if(($_method && $_method === 'DELETE') || $request_method=='DELETE'){
            $file_id = $this->input->get_post('file_id'); 
            return $this->_delete($file_id) ; 

        } else if( $request_method == 'POST'){
            return $this->_upload() ; 

        } else if($request_method == 'GET'){
            return $this->_today() ; 
        } else {
            header('HTTP/1.1 405 Method Not Allowed');
        } 
    }

    public function _today(){ 
        $this->load->model('filebox/filebox_model','filebox') ; 

        $fileList = $this->filebox->getFileList() ; 
        $arr = array()   ; 
        foreach($fileList as $key => $file){ 
            $arr[] = $this->_param_filter($file) ; 
        }

        return json_encode($arr) ; 
    }

    public function _delete($file_id){
        $this->load->model('filebox/filebox_model','filebox') ; 
        $remove_obj = $this->filebox->delete($file_id) ; 

        if($remove_obj == null){
            return FALSE ; 
        }

        return TRUE ; 
    }

    public function _upload(){

        if(!($upload_data = $this->uploadhandler->upload())){ 
            return null ; 
        } 

        $ret = $this->_param_filter($upload_data) ; 

        return json_encode(array($ret)); 
    }

    function _param_filter($data){
        $ret = new stdClass ; 
        $ret->id = $data->file_id ; 
        $ret->name = $data->original_file_name ; 
        $ret->size = $data->file_size_kb ; 
        $ret->type = $data->file_type ; 
        $ret->url = base_url().$data->full_path ; 
        $ret->thumbnail_url = base_url().$data->full_path ;
        $ret->delete_url = base_url().'admin/filebox/process?file_id='.$ret->id ;
        $ret->delete_type = 'DELETE' ;

        return $ret ; 
    }


    public function uploadForm() {
        $data['action'] = 'uploadForm' ; 

        $this->aglayout->addHeaderData($data) ; 
        $this->aglayout->addFooterData($data) ; 
        $this->aglayout->add('header') ; 
        $this->aglayout->add('sidebar') ; 
        $this->aglayout->add('uploadForm') ; 
        $this->aglayout->add('footer') ; 

        $this->aglayout->show($data) ; 
    } 
}

/* End of filebox.php */
/* Location: ./application/controller/admin/template.php */
