<?php
require_once(APPPATH . '/controllers/test/Toast.php');

class Article_test extends Toast {
    var $url = 'http://artgrafii.blog.me/rss' ; 

    function Article_test(){
        parent::Toast(__FILE__); 
        $this->load->library('rb') ; 
        $this->load->library('rsslib') ; 

    }
    
	function _pre() {} 

	function _post() {}

    function test_insert_article(){ 
        $this->load->model('rss/feeds') ; 
        $this->load->model('rss/articles'); 
        $feed = $this->feeds->getFeedByUrl($this->url);

        $this->rsslib->init(array(
                'feed_uri'=>$feed->url,
                'life'=>3
            )) ; 

        $this->rsslib->parse($feed->url) ; 
        $items = $this->rsslib->getAllItems() ;

        $cnt = count($items) ; 

        for($i=0 ; $i < $cnt ; $i++){ 
            $data->link = $items[$i]['link'] ; 
            $data->title = $items[$i]['title'] ; 
            $data->description = $items[$i]['description'] ; 
            $data->pubdate = strtotime($items[$i]['pubDate']) ; 
            $this->articles->store($data);
        } 
        
        $_cnt=0 ; 
        for($i=0 ; $i < $cnt ; $i++){ 
            $data->link = $items[$i]['link'] ; 
            $ret = $this->articles->getArticleByLink($data->link ) ; 
            if($ret!=null && $ret->link == $data->link){ 
                $_cnt++ ;
            }
        }

        $this->_assert_equals($cnt,$_cnt) ;
    } 
} 
