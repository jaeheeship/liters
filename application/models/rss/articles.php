<?php
class Articles extends CI_Model{
    var $table='articles' ; 
    var $article_x_files='article_x_files' ; 

    function __construct(){ 
        parent::__construct() ; 
    }

    public function insert($data){ 
        $data->article_id = unique_id() ; 

        $article = $this->getArticleByLink($data->link) ;

        if($article){ 
            return $article ; 
        }

        $data->regdate = date("Y-m-d H:i:s") ; 

        if($this->db->insert($this->table,$data)){
            //$id = $this->db->insert_id() ; 
            //$data->article_id = $id ; 

            return $data ; 
        }

        return null ; 
    }

    public function delete($article_id){ 
        $article_obj = null ; 

        if($article_id > 0 ){ 
            $article_obj = $this->getFeed($article_id) ; 
            $this->db->where('article_id',$article_id) ; 
            $this->db->delete($this->table) ; 
        }

        return $article_obj ; 
    }

    public function getFeed($article_id){
        if($article_id > 0){
            $query = $this->db->get_where($this->table , array('article_id'=>$article_id)) ; 
            $arr = $query->result() ; 

            if(count($arr)){ 
                return $arr[0] ; 
            }
        }

        return null ; 
    }

    public function update( $param){
        $this->db->update($this->table , $param ,array('article_id'=>$param->article_id)) ; 
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

    public function getFirstImage($article_id,$file_id){ 
        $param = array() ; 
        if($file_id){
            $param['file_id'] = $file_id ;  
        }

        $param['article_id'] = $article_id ; 

        $query = $this->db->get_where($this->article_x_files , $param); 
        $list = $query->result() ; 

        if(count($list)){ 
            return $list[0] ; 
        }else{ 
            return null ; 
        }
    }


    public function stores($items,$type='obj'){
        $cnt = count($items) ; 

        $ret_arr = array() ; 

        while( ($cnt=$cnt-1) >= 0 ){
            $ret_arr[] = $this->store($items[$cnt]); 
        } 

        return $ret_arr ; 
    }

    public function store($data){ 
        $data->pubdate = date("Y-m-d H:i:s",strtotime($data->pubDate)); 
        //$data->pubdate = date("Y-m-d H:i:s",($data->pubDate)); 
        $data->regdate = date("Y-m-d H:i:s") ; 
        $data->ip_address = $this->input->ip_address() ; 

        unset($data->pubDate) ; 

        if($this->insert($data)){
            //$id = $this->db->insert_id() ;
            //$data->article_id = $id ;

            return $data ; 
        }
         
        return null ; 
    }

    function getArticleByLink($link = ''){ 
        if($link != '' ){
            $query = $this->db->get_where($this->table , array('link'=>$link)) ; 
            $arr = $query->result() ; 

            if(count($arr)){ 
                return $arr[0] ; 
            }
        }

        return null ;
    }

    public function getArticleById($id){
        if($id > 0 ){
            $query = $this->db->get_where($this->table , array('article_id'=>$id)) ; 
            $arr = $query->result() ; 

            if(count($arr)){ 
                return $arr[0] ; 
            }
        }
        return null ; 
    }

    function getArticleList($page=1,$list_count=10,$search_param=null){
        $this->db->limit($list_count , ($page-1)*$list_count ) ; 

        if($search_param == null) { 
            $this->db->order_by('article_id','desc') ; 
            $query = $this->db->get($this->table); 
            $total_rows = $this->db->count_all($this->table); 
        }else{
            $this->db->like('title',$search_param['search_keyword']); 
            $this->db->order_by('article_id','desc') ; 
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

    public function getArticleImageById($article_id, $page=1, $list_count=20){ 
        $this->db->limit($list_count , ($page-1)*$list_count ) ; 
        
        $query = $this->db->get_where($this->article_x_files,array('article_id'=>$article_id)) ; 
        $this->db->where(array('article_id'=>$article_id)) ; 
        $total_rows = $this->db->count_all_results($this->article_x_files); 

        $pagination = array() ; 

        $pagination['page'] = $page ;
        $pagination['list_count'] = $list_count ; 
        $pagination['total_rows'] = $total_rows ; 
        $pagination['page_count'] = ceil($total_rows / $list_count) ; 

        $result['list'] = $query->result() ; 
        $result['pagination'] = $pagination ; 

        return $result ; 
    } 

    public function attachFiles($article_id,$file_data){ 
        $param->article_id = $article_id ; 
        $param->file_id = $file_data->file_id ; 
        $param->full_path = $file_data->full_path ; 
        $param->file_path = $file_data->file_path ; 
        $param->encrypted_file_name = $file_data->encrypted_file_name ; 

        $param->original_file_name = $file_data->original_file_name ; 
        $param->is_image = $file_data->is_image ; 
        $param->image_width = $file_data->image_width ; 
        $param->image_height = $file_data->image_height ; 
        $param->file_type = $file_data->file_type ; 

        if($this->db->insert($this->article_x_files,$param)){
            $id = $this->db->insert_id() ; 
            $param->id = $id ; 

            return $param ; 
        }

        return null ; 
    }
} 

/* end of rss/articles.php */ 
