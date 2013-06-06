<?php
require_once(APPPATH . '/controllers/test/Toast.php');

class Rss_test extends Toast {
    var $url = 'http://artgrafii.blog.me/rss' ; 

    function Rss_test(){
        parent::Toast(__FILE__); 
        $this->load->library('rb') ; 
        $this->load->library('rsslib') ; 
    }
    
	function _pre() {} 

	function _post() {}


    function test_article_delete(){
        
    }

    function test_rss_parse(){
        $url = 'http://artgrafii.blog.me/rss' ; 
        //$url = 'http://rdmosley.wordpress.com/feed' ; 
        $this->load->library('rsslib') ; 
        $this->rsslib->init(array('life'=>3,'feed_uri'=>$url)) ;
        $this->rsslib->parse() ; 
        $data = $this->rsslib->getItems(10) ; 
        

    }

    function test_feed_parse(){
        $this->load->library('rb') ; 
        $this->load->library('rsslib') ; 
        $this->load->model('rss/feeds') ; 

        $url = 'http://artgrafii.blog.me/rss' ; 

        $this->rsslib->init(array('life'=>3,'feed_uri'=>$url)); 
        $ret = $this->rsslib->parse() ; 

		$this->_assert_true($ret);

    }

    function test_feed_add()
	{
        $this->load->library('rb') ; 
        $this->load->library('rsslib') ; 
        $this->load->model('rss/feeds') ; 

        $url = 'http://artgrafii.blog.me/rss' ; 

        $this->rsslib->init(array('life'=>3,'feed_uri'=>$url)); 
        $this->rsslib->parse() ; 
        $channel_data = $this->rsslib->getChannelData() ;

        $data->url = $url ; 
        $data->title = $channel_data['title'] ; 
        $data->description = $channel_data['description'] ; 

        $result = $this->feeds->getFeedByUrl($data->url) ; 

        if($result!=null){
            $this->_assert_not_empty(count($result));
        }else{ 
            $id = $this->feeds->store($data); 
		    $this->_assert_not_empty($id);
        } 
	} 

    function test_feed_findall(){
        $this->load->library('rb') ; 
        $this->load->library('rsslib') ; 
        $this->load->model('rss/feeds') ; 

        $result = $this->feeds->getFeedList(); 

        if($result==null){ 
            $this->_assert_equals(true,false) ;
        }else{ 
            //$this->_assert_equals($url,$result->url) ; 
        }
    }

    function test_feed_find(){
        $this->load->library('rb') ; 
        $this->load->library('rsslib') ; 
        $this->load->model('rss/feeds') ; 

        $url = 'http://artgrafii.blog.me/rss' ; 

        $result = $this->feeds->getFeedByUrl($url); 

        if($result==null){ 
            $this->_assert_equals(true,false) ;
        }else{ 
            $this->_assert_equals($url,$result->url) ; 
        }
    } 
    
} 
