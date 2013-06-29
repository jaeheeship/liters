<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function __construct(){ 
        parent::__construct() ; 
    } 

    public function thanks(){
        $this->load->library('aglayout') ; 
        $this->aglayout->layout('ag_layout_ver2/layout'); 

        $this->aglayout->moduleViewPath('welcome/ver1/') ; 
        $this->aglayout->add('header') ; 
        $this->aglayout->add('thanks') ; 
        $this->aglayout->add('footer') ; 

        $this->aglayout->show() ;
    }

    public function view($article_id){
        $this->load->library('aglayout'); 
        $this->aglayout->layout('ag_layout_ver2/iframe_layout'); 

        $this->aglayout->moduleViewPath('welcome/ver1/') ; 
        $this->aglayout->add('view') ; 

        $this->load->database() ; 

        $this->load->model('rss/articles') ; 
        $this->load->model('exhibition/exhb_model') ; 
        $this->load->helper('image') ; 


        $item = $this->articles->getArticleById($article_id) ; 
        $data = array() ; 
        $data['article'] = $item ; 
        $this->aglayout->show($data) ; 
    }

    public function getData($page=1){
        $this->load->database() ; 

        $this->load->model('rss/articles') ; 
        $this->load->model('config_model') ; 
        $result = $this->config_model->getConfigBy('config_key','column') ; 

        if($result){
            $column = $result->config_val  ; 
        }

        $this->load->model('exhibition/exhb_model') ; 
        $this->load->helper('image') ; 

        $list_count = 30 ; 

        $result = $this->articles->getArticleList($page,$list_count) ; 
        $pagination = $result['pagination'] ; 

        $list = $result['list'] ; 

        foreach($list as $key => $row){
            $thumbnail_url =  thumbImage('rss',$row->article_id,$row->main_image_src,830,240) ; 

            if($thumbnail_url){
                $thumbnail_url = base_url().$thumbnail_url ; 
            }else{
                $thumbnail_url = '' ; 
            }

            $list[$key]->thumbnail_url = $thumbnail_url ; 
            $list[$key]->iframe_link = base_url().'welcome/view/'.$list[$key]->article_id ; 
            $list[$key]->description = mb_strcut($row->description,0,250).'...';
        }

        $data['page'] = $page ; 
        $data['page_count'] = $pagination['page_count'] ; 
        $data['items'] = $list; 
        


        echo json_encode($data) ; 

    }

    public function page($page=1){ 
        $this->load->library('aglayout') ; 
        $this->aglayout->layout('ag_layout_ver2/layout'); 

        $this->aglayout->moduleViewPath('welcome/ver1/') ; 
        $this->aglayout->add('header') ; 
        $this->aglayout->add('welcome') ; 
        $this->aglayout->add('footer') ; 

        $this->load->database() ; 

        $this->load->model('rss/articles') ; 
        $this->load->model('exhibition/exhb_model') ; 
        $this->load->helper('image') ; 

        $list_count = 20 ; 

        $result = $this->articles->getArticleList($page,$list_count) ; 
        //$exhb_result = $this->exhb_model->getExhbList(1,3) ; 
        $pagination = $result['pagination'] ; 

        $data['page_count'] = $pagination['page_count']; 
        $data['recent_post'] = $result['list'] ; 
        //$data['exhibition_list'] = $exhb_result['list'] ; 
        //
        $this->load->model('config_model') ; 
        $result = $this->config_model->getConfigBy('config_key','column') ; 

        if($result){
            $column = $result->config_val  ; 
        }

        $data['column'] = $column ; 
        if($column == 1){
            $data['width'] = '800px' ; 
        }else if($column == 2){
            $data['width'] = '450px' ; 
        }else if($column == 3 ){
            $data['width'] = '300px' ; 
        }else if($column == 4 ){
            $data['width'] = '220px' ; 
        }

        $result = $this->config_model->getConfigBy('config_key','css_id') ; 
        if($result){
            $file_id = $result->config_val  ; 
            $this->load->model('filebox/filebox_model') ; 
            $css_file = $this->filebox_model->getFile($file_id) ; 

            if($css_file){
                $data['css_file'] = $css_file->full_path ; 
            }
        }

        $this->aglayout->show($data) ; 

    }

    public function exhibition(){ 
        $this->load->library('aglayout') ; 
        $this->aglayout->layout('ag_layout_ver2/layout'); 

        $this->aglayout->moduleViewPath('exhibition/') ; 
        $this->aglayout->add('header') ; 
        $this->aglayout->add('welcome') ; 
        $this->aglayout->add('footer') ; 

        $this->load->database() ; 

        //$this->load->model('rss/articles') ; 
        $this->load->model('exhibition/exhb_model') ; 
        $this->load->helper('image') ; 

        $list_count = 20 ; 
        $page = 1 ;  
        $result = $this->exhb_model->getExhbList($page,$list_count,null) ; 
        $pagination = $result['pagination'] ; 

        $data['page_count'] = $pagination['page_count']; 
        $data['exhb_list'] = $result['list'] ; 

        $this->aglayout->show($data) ;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome/welcome.php */
