<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('ADMIN_Controller.php'); 

class Rss extends ADMIN_Controller {

    function __construct(){ 
        parent::__construct() ; 
        $this->load->library('aglayout') ; 
        $this->aglayout->layout('admin/layout'); 
        $this->aglayout->moduleViewPath('admin/rss/') ;
    }

	public function index()
	{
       $this->feedlist() ;  
	}

    public function getArticleImage($article_id){ 
        $this->load->model('rss/articles') ; 

        $page = 1 ; 
        $list_count = 40 ; 
    
        $result = $this->articles->getArticleImageById($article_id,$page,$list_count) ; 

        echo json_encode($result) ; 
    }

    public function import(){
        /*$this->load->database() ; 
        $query = $this->db->get('articles_bak') ; 

        $this->load->library('tank_auth') ; 
        $this->load->model('rss/articles') ; 

        $username = $this->tank_auth->get_username() ; 
        $email = $this->tank_auth->get_user_email() ; 
        $uid = $this->tank_auth->get_user_id() ; 

        foreach($query->result() as $key => $row){
            unset($row->id) ; 
            $row->username = $username ;
            $row->email = $email ;
            $row->uid = $email ;
            $this->articles->store($row) ; 
        }*/
    }


    public function refresh($id){
        $this->load->model(array('rss/feeds','rss/articles')) ; 
        $this->load->library('rsslib') ; 
        $feed = $this->feeds->getFeedById($id) ; 

        $this->rsslib->init(array(
            'feed_uri'=>$feed->url,
            'life'=>3
        )); 

        $this->load->library('tank_auth') ; 

        $username = $this->tank_auth->get_username() ; 
        $email = $this->tank_auth->get_user_email() ; 
        $uid = $this->tank_auth->get_user_id() ;

        $this->rsslib->parse($feed->url) ; 
        $items = $this->rsslib->getAllItems() ; 

        $cnt = count($items) ; 

        while( ($cnt=$cnt-1) >= 0 ){
            $items[$cnt]->username = $username ;
            $items[$cnt]->email = $email ;
            $items[$cnt]->uid = $uid ; 
        }


        $arr = $this->articles->stores($items) ; 

        foreach($arr as $key => $row){ 
            print_r($row) ; 
            $row->article_id ; 
            //$this->extractImageFromNaverBlog($row->article_id) ; 
            print_r($row->article_id) ; 
            $this->attachImageToArticle($row->article_id) ; 
        }
    }

    public function crawler(){
        $this->load->things(array(
            'model'=> array('rss/feeds','rss/articles') ,
            'library'=> array('rsslib') 
        ));

        $feed_list = $this->feeds->getFeedList() ; 
        
        foreach($feed_list as $key => $feed){
            $this->rsslib->init(array(
                'feed_uri'=>$feed->url,
                'life'=>3
            )) ; 
            $this->rsslib->parse($feed->url) ; 
            $items = $this->rsslib->getAllItems() ; 

            $cnt = count($items) ; 

            while(($cnt=$cnt-1) >= 0){
                $this->articles->store($items[$cnt],'array'); 
            } 
        } 
    }

    public function unique_id(){
        /*for($i = 0 ; $i < 111 ; $i++){
            unique_id() ; 
        }*/
    }

    public function extractAllImage(){
        $this->load->model('/rss/articles') ; 

        $data['action'] = 'articleList' ; 
        $data['search_keyword'] = '' ; 

        $param = array() ; 
        if( $search_keyword = $this->input->get('search_keyword')){ 
            $param['search_keyword'] = $search_keyword ; 
            $data['search_keyword'] = $search_keyword ; 
        }

        $result = $this->articles->getArticleList(1,200,$param); 

        $data['list'] = $result['list']  ; 

        foreach($data['list'] as $key => $row){ 
            $this->attachImageToArticle($row->article_id) ; 
            //$this->extractImageFromNaverBlog($row->article_id) ; 
        } 
    } 

    public function attachImageToArticle($article_id){
        $this->load->model('rss/articles','articles') ; 

        $param = array() ; 
        $article = $this->articles->getArticleById($article_id) ; 

        $this->extractImageFromNaverBlog($article->article_id) ; 
        $this->setMainImage($article->article_id)  ; 
    }

    public function attachImage(){
        $this->load->model('/rss/articles') ; 

        $data['action'] = 'articleList' ; 
        $data['search_keyword'] = '' ; 

        $param = array() ; 
        if( $search_keyword = $this->input->get('search_keyword')){ 
            $param['search_keyword'] = $search_keyword ; 
            $data['search_keyword'] = $search_keyword ; 
        }

        $result = $this->articles->getArticleList(1,200,$param); 

        $data['list'] = $result['list']  ; 

        foreach($data['list'] as $key => $row){ 
            $this->extractImageFromNaverBlog($row->article_id) ; 
            $this->setMainImage($row->article_id)  ; 
        } 
    }

    public function setMainImage($article_id,$file_id = 0 ){ 
        $param->article_id = $article_id ; 

        $this->load->model('rss/articles') ;

        $obj = $this->articles->getFirstImage($article_id,$file_id) ; 

        if($obj){
            $param->main_image_src = $obj->full_path ; 
            $obj = $this->articles->update($param) ; 
        }

        //$this->output->enable_profiler(true) ; 
    }

    public function articleList($page=1,$list_count=20){
        $this->load->model('/rss/articles') ; 

        $data['action'] = 'articleList' ; 
        $data['search_keyword'] = '' ; 

        $param = array() ; 
        if( $search_keyword = $this->input->get('search_keyword')){ 
            $param['search_keyword'] = $search_keyword ; 
            $data['search_keyword'] = $search_keyword ; 
        }

        $result = $this->articles->getArticleList($page,$list_count,$param); 

        $data['list'] = $result['list']  ; 
        $data['pagination'] = $result['pagination'] ;

        $this->aglayout->add('header') ; 
        $this->aglayout->add('sidebar') ; 
        $this->aglayout->add('articles') ; 
        $this->aglayout->add('footer') ;

        $this->aglayout->show($data) ; 
    }

    public function feedlist($page=1,$list_count=10){
        $this->load->model('/rss/feeds') ; 
        $result = $this->feeds->getFeedList($page,$list_count); 
        $data['action'] = 'feedlist' ; 
        $data['pagination'] = $result['pagination'] ; 
        $data['list'] = $result['list'] ; 
		
        $this->aglayout->add('header') ; 
        $this->aglayout->add('sidebar') ; 
        $this->aglayout->add('feedlist') ; 
        $this->aglayout->add('footer') ;

        $this->aglayout->show($data) ; 
    }

    public function deleteFeed(){ 
        $id = $this->input->post('id') ; 
        $this->load->model('rss/feeds') ; 

        $ret = $this->feeds->delete($id) ; 
    }

    public function moveToArticle(){
        $id = $this->input->post('temp_id') ; 
        $this->load->model('rss/temp_articles') ; 
        $article = $this->temp_articles->getArticleById($id) ; 

        if($article != null){ 
            $this->load->model('rss/articles'); 
            $this->articles->store($item) ; 
            $this->temp_article->remove($id) ; 
        } 
    }

    public function extractImageFromNaverBlog($article_id){ 
        $this->output->enable_profiler(TRUE) ; 
        $this->load->model('rss/articles') ; 

        $article = $this->articles->getArticleById($article_id) ; 
        $this->load->library('uploadhandler') ; 

        $fullpath_arr = array() ; 

        if($article){ 
            $arr = explode('/',$article->link) ; 
            $post_no = end($arr) ; 
            $link ='http://blog.naver.com/PostView.nhn?blogId=3liters&logNo='.$post_no ;  
            $html = file_get_contents($link) ; 

            $this->load->library('simple_html_dom') ; 

            $this->simple_html_dom->load($html) ;
            $imgs = $this->simple_html_dom->find('img');

            $this->load->model('rss/articles') ; 

            foreach($imgs as $key => $img){ 
                if(strpos($img->src,'postfile')){
                    $name = urldecode(basename($img->src)) ; 
                    $names = explode('?',$name) ; 
                    $name = mb_convert_encoding($names[0],"UTF-8",'EUC-KR') ;
                    $fullpath = $this->save_image($img->src,'./files/temp/'.$name) ; 
                    $ret = $this->uploadhandler->uploadFileFromServer($fullpath) ; 
                    $this->articles->attachFiles($article_id,$ret) ;
                } 
            } 
        }
    } 


    public function save_image($img_src,$fullpath){
        $ch = curl_init ($img_src);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $rawdata=curl_exec($ch);

        curl_close ($ch);
        if(file_exists($fullpath)){
            unlink($fullpath);
        }

        $fp = fopen($fullpath,'x');
        fwrite($fp, $rawdata);
        fclose($fp);

        return $fullpath ; 
    }

    public function insertFeed(){ 
        $this->load->library('rsslib') ; 
        $this->load->model('rss/feeds') ; 

        $url = $this->input->post('url'); 

        $this->rsslib->init(array('life'=>3,'feed_uri'=>$url)); 
        $this->rsslib->parse() ; 
        $channel_data = $this->rsslib->getChannelData() ;

        $username = $this->tank_auth->get_username() ; 
        $email = $this->tank_auth->get_user_email() ; 
        $uid = $this->tank_auth->get_user_id() ; 

        $data->url = $url ; 
        $data->title = $channel_data['title'] ; 
        $data->description = $channel_data['description'] ; 
        $data->username = $username ;
        $data->email = $email ; 
        $data->uid = $uid ; 

        $result = $this->feeds->getFeedByUrl($data->url) ; 

        if($result==null){ 

            $feed = $this->feeds->insert($data); 

            if($feed){
                $this->refresh($feed->feed_id) ; 
            }
        } 

        redirect('admin/rss/feedlist') ; 
    }
} 

/* End of file rss.php */
/* Location: ./application/controllers/admin/rss.php */
