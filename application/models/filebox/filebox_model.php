<?php
class Filebox_model extends CI_Model {
    var $table = 'filebox'; 

    public function __construct(){ 
        parent::__construct() ; 
        $this->load->database() ; 
    }

    public function insert($data){ 
        $ci = &get_instance() ; 

        $ci->load->library('tank_auth') ; 

        $data->username = $ci->tank_auth->get_username() ; 
        $data->email = $ci->tank_auth->get_user_email() ; 
        $data->uid = $ci->tank_auth->get_user_id() ; 

        $data->file_id = unique_id() ; 

        if($this->db->insert($this->table,$data)){
            //$id = $this->db->insert_id() ; 
            //$data->file_id = $id ; 

            return $data ; 
        }

        return null ; 
    }

    public function delete($file_id){ 
        $file_obj = null ; 
        if($file_id > 0 ){ 
            $file_obj = $this->getFile($file_id) ; 
            $this->db->where('file_id',$file_id) ; 
            $this->db->delete($this->table) ; 
        }

        return $file_obj ; 
    }

    public function getFile($file_id){
        if($file_id > 0){
            $query = $this->db->get_where($this->table , array('file_id'=>$file_id)) ; 
            $arr = $query->result() ; 

            if(count($arr)){ 
                return $arr[0] ; 
            }
        }

        return null ; 
    }

    public function update($file_id , $param){
        $this->db->update($this->table , $param ,array('file_id'=>$file_id)) ; 
    }

    public function getFileList($page=1,$list_count=10,$search_param=null){
        $this->db->limit($list_count , ($page-1)*$list_count ) ; 
        $this->db->order_by('file_id','desc') ; 

        if($search_param == null) { 
            $query = $this->db->get($this->table); 
            $total_rows = $this->db->count_all($this->table); 
        }else{
            $this->db->like('original_file_name',$search_param['search_keyword']); 
            $query = $this->db->get($this->table) ; 

            $this->db->like('original_file_name',$search_param['search_keyword']); 
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

/* end of filebox/filebox_model.php */ 
