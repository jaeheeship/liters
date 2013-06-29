<?php
class Css_model extends CI_Model{
    var $table = 'css'; 

    function __construct(){ 
        parent::__construct() ; 
        $this->load->database() ; 
    }

    public function insert($data){ 
        $data->css_id = unique_id() ; 
        if($this->db->insert($this->table,$data)){ 
            return $data ; 
        }

        return null ; 
    }

    public function delete($css_id){ 
        $css_obj = null ; 
        if($css_id > 0 ){ 
            $css_obj = $this->getItem($css_id) ; 
            $this->db->where('css_id',$css_id) ; 
            $this->db->delete($this->table) ; 
        }

        return $css_obj ; 
    }

    public function getItem($exhb_id){
        if($exhb_id > 0){
            $query = $this->db->get_where($this->table , array('exhb_id'=>$exhb_id)) ; 
            $arr = $query->result() ; 

            if(count($arr)){ 
                return $arr[0] ; 
            }
        } 
        return null ; 
    }

    public function getItems(){
        return $this->db->get($this->table)->result(); 
    }
}
