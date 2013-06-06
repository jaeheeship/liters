<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rss extends CI_Controller {

    function  __construct(){
        $this->load->library('rss') ; 
    }

	public function index()
	{

	}

    public function insertArticle(){

    }

    public function deleteArticle(){

    }

    public function addFeed(){
        $args->feed_url = $this->input->post('url');
        $args->link = $this->input->post('link');
        $args->title = $this->input->post('title');
        $args->description = $this->input->post('description');

        $this->load->model('rss/feed_model') ;

        $ret = $this->feed_model->store($args) ;
    }

    public function deleteFeed(){

    }

    public function getFeed($args){
        /* todo number or url */ 
    }

    public function getFeedList(){

    }
} 
/* End of file rss.php */
/* Location: ./application/controllers/rss/rss.php */
