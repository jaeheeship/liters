<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('ADMIN_Controller.php'); 
class Control_panel extends ADMIN_Controller {
    function __construct(){ 
        parent::__construct() ; 
        $this->load->library('aglayout') ; 
    }

    public function sample(){
        $this->load->database() ; 
        useq() ; 
    }

    public function setColumn(){
        $column = $this->input->post('column') ;
        $this->load->model('config_model') ; 
        $result = $this->config_model->getConfigBy('config_key','column') ; 

        $data = array() ; 
        $data['config_key'] = 'column' ; 
        $data['config_val'] = $column ; 

        if($result){
            $data['config_id'] = $result->config_id ; 
            $this->config_model->update($data) ; 
        }else{ 
            $this->config_model->insert($data) ; 
        }
    }

    public function save_css(){
        $this->load->library('uploadhandler') ; 

        $file_fields = array('css') ; 

        $file_cnt = 0 ; 
        $obj = new stdClass ; 

        foreach($file_fields as $key => $field){
            if(($upload_data = $this->uploadhandler->upload($field))){ 
                $file_cnt++ ; 
                $file_id = $upload_data->file_id ; 

                !is_dir('files') ? mkdir('files',0777) : null ; 
                !is_dir('files/css') ? mkdir('files/css',0777) : null ; 

                copy($upload_data->full_path , './files/css/'.$upload_data->encrypted_file_name) ; 
            }
        }

        redirect('admin/control_panel/css') ; 
    }

    public function select_css(){
        $css_id = $this->input->post('file_id') ;
        $this->load->model('config_model') ; 
        $result = $this->config_model->getConfigBy('config_key','css_id') ; 

        $data = array() ; 
        $data['config_key'] = 'css_id' ; 
        $data['config_val'] = $css_id ; 

        if($result){
            $data['config_id'] = $result->config_id ; 
            $this->config_model->update($data) ; 
        }else{ 
            $this->config_model->insert($data) ; 
        }
    }

    public function css(){
        $data = array() ;  
        
        $this->load->model('filebox/filebox_model') ; 

        $this->load->model('config_model') ; 
        $result = $this->config_model->getConfigBy('config_key','css_id') ; 

        if($result){ 
            $data['css_id'] = $result->config_val ; 
        }

        $data['cssList'] = $this->filebox_model->getCssList() ;
        $this->aglayout->layout('admin/layout'); 
        $this->aglayout->moduleViewPath('admin/control_panel/') ; 
        $this->aglayout->add('header') ; 
        $this->aglayout->add('sidebar') ; 
        $this->aglayout->add('css') ; 
        $this->aglayout->add('footer') ; 

        $this->aglayout->show($data) ; 
    } 

    public function layout(){
        $this->aglayout->layout('admin/layout'); 
        $this->aglayout->moduleViewPath('admin/control_panel/') ; 
        $this->aglayout->add('header') ; 
        $this->aglayout->add('sidebar') ; 
        $this->aglayout->add('layout') ; 
        $this->aglayout->add('footer') ; 

        $this->aglayout->show() ; 
    }

    public function refreshTable(){
        $table_name = $this->input->post('table_name') ;
        $table_path = $this->input->post('table_path') ;

        $this->load->database(); 
        $this->load->dbforge() ; 

        if($this->db->table_exists($table_name)){ 
            $this->dbforge->drop_table($table_name) ; 
        } 

        $this->load->helper('file') ; 
        $this->load->library('ag_dbutil') ; 

        $f = read_file($table_path) ; 
        $result = $this->ag_dbutil->schema_parse($f) ; 
        $this->ag_dbutil->create_table($table_name,$result['columns']) ; 
    }

    public function deleteTable(){
        $table_name = $this->input->post('table_name') ;

        $this->load->database(); 
        $this->load->dbforge() ; 

        if($this->db->table_exists($table_name)){ 
            $this->dbforge->drop_table($table_name) ; 
        }
    }

    public function schemaList(){

        $this->load->helper('directory') ; 
        $this->load->helper('file') ; 
        $map = directory_map(APPPATH.'schemas/',3); 
 
        $schema_list = array() ; 
        $file_list = array() ; 

        foreach($map as $key => $row){ //modules list 
           $schema_list_cnt = count($row) ;  
           $path = APPPATH.'schemas/'.$key ; 

           for($i=0 ; $i < $schema_list_cnt ;$i++){ 
               if(strpos($row[$i],'xml')){
                   $result = explode('.',$row[$i]); 
                   $file_list[$result[0]] = array('path' => $path.'/'.$row[$i] , 
                           'table' => $result[0], 
                           'is_exists' => false 
                           ); 
               }

           } 
        }

        $this->load->library('ag_dbutil') ; 

        $data = array() ; 

        foreach($file_list as $key => $row){ 
            $file_list[$key]['is_exists'] =  $this->ag_dbutil->is_exists($row['table']) ;
        } 

        $data['schema_list']= $file_list ;

        $this->aglayout->layout('admin/layout'); 
        $this->aglayout->moduleViewPath('admin/control_panel/') ; 
        $this->aglayout->add('header') ; 
        $this->aglayout->add('sidebar') ; 
        $this->aglayout->add('schemaList') ; 
        $this->aglayout->add('footer') ; 

        $this->aglayout->show($data) ; 
    } 
} 
/* End of control_panel.php */
/* Location: ./application/controller/admin/control_panel.php */
