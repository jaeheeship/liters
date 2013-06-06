<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct(){
        parent::__construct() ; 

        $this->load->library('aglayout') ; 
        $this->aglayout->layout('teaser/layout') ; 
    }

    public function getItems($page=1,$list_count=20){
        $this->load->database() ; 

        $this->load->model('filebox/filebox_model') ; 
        $this->load->helper('image') ; 

        $list_count = 20 ; 

        $result = $this->filebox_model->getFileList($page,$list_count) ; 
        $pagination = $result['pagination'] ; 

        $list = $result['list'] ; 

        foreach($list as $key => $row){
            $thumbnail_url =  thumbImage('artist',$row->file_id,$row->full_path,330,240) ; 

            if($thumbnail_url){
                $thumbnail_url = base_url().$thumbnail_url ; 
            }else{
                $thumbnail_url = '' ; 
            }

            $list[$key]->thumbnail_url = $thumbnail_url ; 
            //$list[$key]->description = mb_strcut($row->description,0,250).'...'; 
        }

        $arr = array() ; 
        
        for($i=0; $i < 20 ; $i++){
            foreach($list as $key => $item){ 
                $arr[] = $item ; 
            }
        }

        $data['page'] = $page ; 
        $data['page_count'] = $pagination['page_count'] ; 
        $data['items'] = $list; 

        echo json_encode($data) ; 
    }

    public function index(){
        $this->aglayout->moduleViewPath('teaser/') ; 
        $this->aglayout->add('welcome') ; 
        $this->aglayout->show() ; 
    } 


}

/* end of welcome.php */
