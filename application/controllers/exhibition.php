<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Exhibition extends CI_Controller {
    function __construct(){
        parent::__construct() ; 

    }

    public function getBlogReviews(){ 

    } 

	public function index(){
		$this->welcome() ; 
	}


    public function getItems($page=1){
        $this->load->database() ; 

        $this->load->model('exhibition/exhb_model') ; 
        $this->load->helper('image') ; 

        $list_count = 20 ; 

        $result = $this->exhb_model->get_published_list($page,$list_count,null,'start_date') ; 
        $pagination = $result['pagination'] ; 

        $list = $result['list'] ; 

        foreach($list as $key => $row){
            $thumbnail_url =  thumbImage('exhibition',$row->exhb_id,$row->poster_image_src,330,240) ; 

            if($thumbnail_url){
                $thumbnail_url = base_url().$thumbnail_url ; 
            }else{
                $thumbnail_url = '' ; 
            }

            $list[$key]->thumbnail_url = $thumbnail_url ; 
            $list[$key]->description = mb_strcut($row->description,0,250).'...';

            if(date("Y-m-d") > $row->finish_date){
                $list[$key]->badge = '<span class="exhibition_badge exhibition_badge_expired">전시종료</span>' ;
            }else if(date("Y-m-d") > $row->start_date){
                $list[$key]->badge = '<span class="exhibition_badge exhibition_badge_ing">전시중</span>' ;
            }else{
                $list[$key]->badge = '<span class="exhibition_badge exhibition_badge_ready">준비중</span>' ;
            }

            $list[$key]->badge = ($list[$key]->badge) ; 
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

    public function welcome($exhb_id=0){
        $this->load->library('aglayout') ; 
        $this->aglayout->layout('ag_layout_ver2/layout'); 

        $this->aglayout->moduleViewPath('exhibition/') ; 
        $this->aglayout->add('header') ; 
        $this->aglayout->add('welcome') ; 
        $this->aglayout->add('footer') ; 

        $this->load->database() ; 

        $this->load->model('exhibition/exhb_model') ; 
        $this->load->helper('image') ; 

        $list_count = 20 ; 
        $page = 1 ;  
        $result = $this->exhb_model->getExhbList($page,$list_count,null) ; 

        foreach($result['list'] as $key => $row){
            $exhb=$row ; 
            break;
        }
        $pagination = $result['pagination'] ; 

        $data['page_count'] = $pagination['page_count']; 
        $data['exhb_list'] = $result['list'] ; 
        $data['exhb'] = $exhb ; 

		$main_exhb = null ; 	

		if($exhb_id){
			$main_exhb = $this->exhb_model->getExhb($exhb_id) ;
		} 

		if( !$main_exhb ){
			$arr = $this->exhb_model->get_exhibition_for_slide(); 
			$main_exhb = $arr[0] ; 
		}

		$data['main_exhb'] = $main_exhb ;
		//$data['exhibition_for_slide'] =  $this->exhb_model->get_exhibition_for_slide() ; 


		$this->aglayout->appendHeader('<meta property="os:image" content="'.base_url().thumbImage('exhibition',$main_exhb->exhb_id,$main_exhb->main_image_src,150,150).'"/>') ; 
		$this->aglayout->appendHeader('<meta property="os:title" content="'.$main_exhb->title.'"/>') ; 
			$this->aglayout->appendHeader('<meta property="description" content="'.$exhb->description.'"/>') ; 

		$this->aglayout->show($data) ;
	}

	public function search(){ 
			$keyword = $this->input->get('keyword') ; 
			$this->load->model('exhibition/exhb_model') ; 
			$param = null ; 

			$data = array() ; 

			if($keyword){
					$param = array() ; 
					$param['search_keyword'] = $keyword ; 
					$data['keyword'] = $keyword ; 
			}

			$page = 1; 
			$list_count = 100; 
            $result = $this->exhb_model->search($page,$list_count,$param,'start_date') ; 

			$data['exhb_list'] = $result['list'] ; 

			$this->load->library('aglayout') ; 
			$this->aglayout->layout('ag_layout_ver2/layout'); 
			$this->aglayout->moduleViewPath('exhibition/') ; 
			$this->aglayout->add('search') ; 

			$this->aglayout->show($data) ;
	}

	public function view($exhb_id){
			$this->load->model('exhibition/exhb_model') ; 
			$this->config->load('apikey',false,true) ; 
			$NAVER_MAP_API_KEY = $this->config->item('naver_map_api_key') ; 
			$exhb = $this->exhb_model->getExhb($exhb_id) ; 

			$this->load->helper('image');

			if($exhb == null){
					redirect('artgrafii/error404') ; 
			}

			$view_history = $this->session->userdata('view_history') ; 

			if(!isset($view_history)){ 
					$view_history = array() ; 
			}

			if(!isset($view_history[$exhb->exhb_id])){
					$view_history[$exhb->exhb_id] = TRUE ; 
					$exhb->readed_count = $exhb->readed_count+1; 
					$this->exhb_model->update($exhb) ; 
			}

			$this->session->set_userdata('view_history',$view_history) ;

			$this->load->library('aglayout') ; 
			$this->aglayout->layout('ag_layout_ver2/layout'); 
			$this->aglayout->moduleViewPath('exhibition/') ; 

			$this->aglayout->add('view') ; 

			$this->load->model('tags/tags_model') ; 
			$tag_map = $this->tags_model->decode_map($exhb->tags) ; 
			$exhb->tag_map = $tag_map ; 
			$data = array() ; 
			$data['exhb'] = $exhb ; 
			$data['NAVER_MAP_API_KEY'] = $NAVER_MAP_API_KEY ; 

			$this->aglayout->appendHeader('<meta property="os:image" content="'.base_url().thumbImage('exhibition',$exhb->exhb_id,$exhb->main_image_src,150,150).'"/>') ; 
			$this->aglayout->appendHeader('<meta property="os:title" content="'.$exhb->title.'"/>') ; 
			$this->aglayout->appendHeader('<meta property="description" content="'.$exhb->description.'"/>') ; 

			$this->aglayout->show($data) ; 
	}
}
