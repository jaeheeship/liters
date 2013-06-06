<?php
class Place_model extends CI_Model{
    var $table = 'place'; 

    function __construct(){
        parent::__construct() ; 
        $this->load->database() ; 
    } 

    public function insert($data){
        $data->place_id = unique_id() ; 
        $data->regdate = date("Y-m-d H:i:s") ; 

        if($this->db->insert($this->table,$data)){
            return $data ; 
        }

        return null ; 
    }

    public function update( $param){
        $this->db->update($this->table , $param ,array('place_id'=>$param->place_id)) ; 
        return $param ; 
    }

    public function delete($place_id){
        $place_obj = null; 
        if($place_id > 0 ){
            $place_obj = $this->getPlace($place_id) ; 
            $this->db->where('place_id',$place_id) ; 
            $this->db->delete($this->table) ; 
        }

        return $place_obj ; 
    }

    public function getPlaceBy($column,$value,$operation = 'equal'){ 
        if($operation == 'equal'){

            $query = $this->db->get_where($this->table , array($column=>$value)) ; 
            $arr = $query->result() ; 

            if(count($arr)){ 
                return $arr[0] ; 
            }
        }

        return null ; 
    }


    public function getPlace($place_id){
        if($place_id > 0){
            $query = $this->db->get_where($this->table , array('place_id'=>$place_id)) ; 
            $arr = $query->result() ; 

            if(count($arr)){ 
                return $arr[0] ; 
            }
        }

        return null ; 
    } 

    public function getPlaceListAll(){ 
        $query = $this->db->get($this->table); 
        
        return $query->result() ; 
    }

    public function getPlaceList($page=1,$list_count=10,$search_param=null){

        $this->db->order_by('place_id','desc') ; 
        $this->db->limit($list_count , ($page-1)*$list_count ) ; 
        if($search_param == null) { 
            $query = $this->db->get($this->table); 
            $total_rows = $this->db->count_all($this->table); 
        }else{
            $this->db->like('place_name',$search_param['search_keyword']); 
            $query = $this->db->get($this->table) ; 
            $this->db->like('place_name',$search_param['search_keyword']); 
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
