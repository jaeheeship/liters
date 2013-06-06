<?php
class Place_tags_model extends CI_Model{
    var $table = 'place_tags'; 

    function __construct(){ 
        parent::__construct() ; 
        $this->load->database() ; 
    }

    public function insert($data){ 
        if($this->db->insert($this->table,$data)){
            $id = $this->db->insert_id() ; 
            $data->place_tag_id = $id ; 


            return $data ; 
        }

        return null ; 
    }

    public function deleteByTag($tag_name){

    }

    public function delete($place_tag){ 
        $exhb_obj = null ; 
        if($exhb_id > 0 ){ 
            $exhb_obj = $this->getExhb($exhb_id) ; 
            $this->db->where('exhb_id',$exhb_id) ; 
            $this->db->delete($this->table) ; 
        }

        return $exhb_obj ; 
    }

    public function getExhb($exhb_id){
        if($exhb_id > 0){
            $query = $this->db->get_where($this->table , array('exhb_id'=>$exhb_id)) ; 
            $arr = $query->result() ; 

            if(count($arr)){ 
                return $arr[0] ; 
            }
        }

        return null ; 
    }

    public function update( $param){
        $this->db->update($this->table , $param ,array('exhb_id'=>$param->exhb_id)) ; 
        return $param ; 
    }

    public function getExhbList($page=1,$list_count=10,$search_param=null){
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

}

