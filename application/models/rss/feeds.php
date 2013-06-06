<?php
class Feeds extends CI_Model{
    var $table = 'feeds'; 

    function __construct() { 
        parent::__construct() ; 
    }

    public function insert($data){ 
        $data->feed_id = unique_id() ; 
        $data->regdate = date("Y-m-d H:i:s") ; 
        $data->last_update = date("Y-m-d H:i:s") ; 

        if($this->db->insert($this->table,$data)){ 
            return $data ; 
        }

        return null ; 
    }

    public function delete($feed_id){ 
        $feed_obj = null ; 

        if($feed_id > 0 ){ 
            $feed_obj = $this->getFeed($feed_id) ; 
            $this->db->where('feed_id',$feed_id) ; 
            $this->db->delete($this->table) ; 
        }

        return $feed_obj ; 
    }

    public function getFeed($feed_id){
        if($feed_id > 0){
            $query = $this->db->get_where($this->table , array('feed_id'=>$feed_id)) ; 
            $arr = $query->result() ; 

            if(count($arr)){ 
                return $arr[0] ; 
            }
        }

        return null ; 
    }

    public function update( $param){
        $this->db->update($this->table , $param ,array('feed_id'=>$param->feed_id)) ; 
        return $param ; 
    }

    public function getFeedList($page=1,$list_count=10,$search_param=null){
        $this->db->limit($list_count , ($page-1)*$list_count ) ; 

        if($search_param == null) { 
            $query = $this->db->get($this->table); 
            $total_rows = $this->db->count_all($this->table); 
        }else{
            $this->db->like('title',$search_param['search_keyword']); 
            $query = $this->db->get($this->table) ; 
            $this->db->like('title',$search_param['search_keyword']); 
            $total_rows = $this->db->count_all_results($this->table); 
        }

        $pagination['page'] = $page ;
        $pagination['list_count'] = $list_count ; 
        $pagination['total_rows'] = $total_rows ; 
        $pagination['page_count'] = ceil($total_rows / $list_count) ; 

        $result['list'] = $query->result() ; 
        $result['pagination'] = $pagination ; 

        return $result ; 
    } 

    function store($data){
        $this->load->helper('date') ; 
        $feeds = R::dispense('feeds') ; 

        $feeds->url = $data->url ; 
        $feeds->title = $data->title ; 
        $feeds->last_update = now();
        $feeds->regdate = now(); 

        $id = R::store($feeds) ; 

        return $id ; 
    }

    function getFeedByUrl($url=null){
        if($url != null ){
            $query = $this->db->get_where($this->table , array('url'=>$url)) ; 
            $arr = $query->result() ; 

            if(count($arr)){ 
                return $arr[0] ; 
            }
        }

        return null ;
    }

    function getFeedById($feed_id=0){
        if($feed_id > 0){
            $query = $this->db->get_where($this->table , array('feed_id'=>$feed_id)) ; 
            $arr = $query->result() ; 

            if(count($arr)){ 
                return $arr[0] ; 
            }
        }

        return null ;
    } 
}

/* end of rss/feeds.php */ 
