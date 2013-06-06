<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Openapi extends CI_Controller {

    function __construct(){
        parent::__construct() ; 
    } 

    public function getBlogSearch2(){ 
            /*$this->load->library('simple_html_dom') ; 
            $url="http://cafeblog.search.naver.com/search.naver?where=post&sm=tab_pge&query=%EB%8C%80%EB%A6%BC%EB%AF%B8%EC%88%A0%EA%B4%80&st=sim&date_option=-1&date_from=&date_to=&dup_remove=1&post_blogurl=&ie=utf8&start=21"; 
            $html = file_get_html($url); 

            $t =$html->find('table',0)->find('table',0)->find('tr') ;*/ 
    }

    public function getBlogSearch($search_keyword){ 
        $this->load->library('naverapi') ; 
        $page = $this->input->get('page') ; 

        $page = $page != null ? $page : 1 ; 

        $result = $this->naverapi->getBlogSearch($search_keyword, $page) ; 

        $items = $result['items']  ; 

        $response = array() ; 
        $data = array() ; 
        foreach($items as $key => $item){
            $obj = new stdClass ; 
            $obj->title = strval($item->title) ; 
            $obj->link = strval($item->link) ; 
            $obj->description = mb_strcut(strval($item->description),0,30) ; 
            $obj->bloggername = mb_strcut(strval($item->bloggername),0,24) ; 
            $obj->bloggerlink = strval($item->bloggerlink) ; 
            
            $data[] = $obj ; 
        } 

        $response['items'] = $data ; 
        print_r(json_encode($response)) ;  
    }

    public function getImageSearch($search_keyword){ 
        $this->load->library('naverapi') ; 
        $result = $this->naverapi->getImageSearch($search_keyword) ; 

        $items = $result['items']  ; 

        $response = array() ; 
        $data = array() ; 
        foreach($items as $key => $item){
            $obj = new stdClass ; 
            $obj->title = strval($item->title) ; 
            $obj->link = strval($item->link) ; 
            $obj->thumbnail = strval($item->thumbnail) ; 
            $obj->height = strval($item->sizeheight) ; 
            $obj->width = strval($item->sizewidth) ; 
            
            $data[] = $obj ; 
        }
    

        $response['items'] = $data ; 
        print_r(json_encode($response)) ;  
    }

}
