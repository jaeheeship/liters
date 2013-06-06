<?php
class Tags_model extends CI_Model{
    var $table = 'tags'; 
    var $resource_tags = 'resource_tags' ; 
    var $user_tags = 'user_tags' ; 

    function __construct(){
        parent::__construct() ; 
        $this->load->database() ; 
         
    }

    public function get_tags($type=null){
        $this->load->database() ; 

        if($type){ 
            $this->db->where('tag_type',$type) ;
        }

        $query = $this->db->get($this->table) ;

        return $query->result() ;
    }

    public function tag_map(){ 
        $result = $this->get_tags() ; 

        $tagMap = array() ; 

        foreach($result as $key => $row){
            $tag_type = $row->tag_type ; 

            if(!isset($tagMap[$tag_type])){ 
                $tagMap[$tag_type] = array() ; 
            } 

            $tagMap[$tag_type][] = $row ; 
        } 

        return $tagMap ; 
    }

    public function decode_map($tags){
        $tags = json_decode($tags) ; 
        $place_tags = array() ; 
        $artist_tags = array() ; 
        $category_tags = array() ; 
        $keyword_tags = array() ; 

        $map = array() ;

        if(count($tags)==0){
            return $map ; 
        }
        
        foreach($tags as $key => $el){ 
            if(isset($el->place_tags)){
                $place_tags[] = $el->place_tags ;
            }else if(isset($el->keyword_tags)){
                $keyword_tags[] = $el->keyword_tags ; 
            }else if(isset($el->category_tags)){
                $category_tags[] = $el->category_tags ; 
            }else if(isset($el->artist_tags)){
                $artist_tags[] = $el->artist_tags ; 
            }
        } 
        $tag_types = $this->get_tag_types() ; 

        foreach($tag_types as $key => $el){
            $tmp = ${$el} ; 

            if(count($tmp) > 0){
                $map[$el] = $tmp ; 
            }
        }
        return $map ; 
    }

    public function is_attached_tag($resource,$tag_data){

    }

    public function save_tagging_log_history($who,$resource,$tag){
        $obj = new stdClass ; 
        
        $obj->resource_type = $resource->resource_type ; 
        $obj->resource_id = $resource->resource_id ; 
        $obj->resource_title = $resource->resource_title ; 

        $obj->tag_id = $tag->tag_id ; 
        $obj->tag_name = $tag->tag_name ; 
        $obj->tag_type = $tag->tag_type ; 

        $obj->uid = $who->uid ;
        $obj->username = $who->username ;
        $obj->regdate = date("YmdHis") ; 

        $this->db->insert( $this->user_tags , $obj ) ; 
    }

    public function attach_tag($resource,$tag_data){ 
        $insert_data = new stdClass ; 

        $insert_data->resource_id = $resource->resource_id ; 
        $insert_data->resource_type = $resource->resource_type ; 
        $insert_data->resource_title = $resource->resource_title ; 
        $insert_data->tag_id = $tag_data->tag_id ; 
        $insert_data->tag_type = $tag_data->tag_type ; 
        $insert_data->tag_name = $tag_data->tag_name ; 

        $insert_data->regdate = date("YmdHis") ; 

        $this->db->insert($this->resource_tags , $insert_data) ; 
        $insert_data->resource_tags_id = $this->db->insert_id() ; 

        return $insert_data ; 
    }

    public function detach_tag($resouce,$tag_data){

    }

    public function save($tag_data){
        $tag_key = $this->get_tagkey($tag_data) ;  

        $tag = $this->get_tag_by_tagkey($tag_key) ; 

        if($tag){ 
            return $tag ; 
        }else{
            $tag_data->tag_key = $tag_key ; 
            $tag_data->tag_count = 1 ; 
            $ret = $this->insert($tag_data) ; 
        }

        return $ret ; 
    }

    public function get_tag_types(){
        $o = array('artist_tags','category_tags','keyword_tags','place_tags') ; 
        return $o ; 
    }

    public function get_tagkey($data){
        return $data->tag_type.':'.$data->tag_name ; 
    }

    public function insert($data){
        $data->tag_id = unique_id() ; 
        $data->regdate = date("YmdHis") ; 

        if($this->db->insert($this->table,$data)){ 
            return $data ; 
        }

        return null ;
    }

    public function update($data){
        $this->db->update($this->table , $param ,array('tag_id'=>$data->tag_id)) ; 
        return $param ; 
    }

    public function get_tag_by_id($id){
        if($id > 0){
            $query = $this->db->get_where($this->table , array('tag_id'=>$id)) ; 
            $arr = $query->result() ; 

            if(count($arr)){ 
                return $arr[0] ; 
            }
        }

        return null ;
    } 

    public function get_tag_by_tagkey($tag_key){
        if($tag_key != ''){
            $query = $this->db->get_where($this->table , array('tag_key'=>$tag_key)) ; 
            $arr = $query->result() ; 

            if(count($arr)){ 
                return $arr[0] ; 
            }
        }

        return null ;
    } 
}

/* end of tags_model.php */
