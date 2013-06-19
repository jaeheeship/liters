<?php
class Config_model extends CI_Model{
    var $table = 'config'; 

    function __construct(){ 
        parent::__construct() ; 
        $this->load->database() ; 
    }

    public function insert($data){ 
        if($this->db->insert($this->table,$data)){ 
            return $data ; 
        }

        return null ; 
    }

    public function update( $param){
        $this->db->update($this->table , $param ,array('config_id'=>$param['config_id'])) ; 
        return $param ; 
    }

    public function getConfigBy($column,$value,$operation = 'equal'){ 
        if($operation == 'equal'){

            $query = $this->db->get_where($this->table , array($column=>$value)) ; 
            $arr = $query->result() ; 

            if(count($arr)){ 
                return $arr[0] ; 
            }
        }

        return null ; 
    } 

    public function getConfig($config_id){
        if($config_id > 0){
            $query = $this->db->get_where($this->table , array('config_id'=>$config_id)) ; 
            $arr = $query->result() ; 

            if(count($arr)){ 
                return $arr[0] ; 
            }
        }

        return null ; 
    }


}
