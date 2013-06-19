<?php
class Partner_model extends CI_Model{
    var $table = 'partners'; 

    function __construct(){ 
        parent::__construct() ; 
        $this->load->database() ; 
    }

    public function get_partner_for_slide(){ 
        $query = $this->db->get_where($this->table , array('is_slide'=>'Y')) ; 

        $arr = $query->result() ; 

        return $arr ; 
    }

    public function insert($data){ 
        $data->partner_id = unique_id() ; 
        if($this->db->insert($this->table,$data)){ 
            return $data ; 
        }

        return null ; 
    }

    public function delete($partner_id){ 
        $partner_obj = null ; 
        if($partner_id > 0 ){ 
            $partner_obj = $this->getPartner($partner_id) ; 
            $this->db->where('partner_id',$partner_id) ; 
            $this->db->delete($this->table) ; 
        }

        return $partner_obj ; 
    }

    public function getPartnerBy($column,$value,$operation = 'equal'){ 
        if($operation == 'equal'){

            $query = $this->db->get_where($this->table , array($column=>$value)) ; 
            $arr = $query->result() ; 

            if(count($arr)){ 
                return $arr[0] ; 
            }
        }

        return null ; 
    } 

    public function getPartner($partner_id){
        if($partner_id > 0){
            $query = $this->db->get_where($this->table , array('partner_id'=>$partner_id)) ; 
            $arr = $query->result() ; 

            if(count($arr)){ 
                return $arr[0] ; 
            }
        }

        return null ; 
    }

    public function update( $param){
        $this->db->update($this->table , $param ,array('partner_id'=>$param->partner_id)) ; 
        return $param ; 
    }

    public function get_published_list($page =1 , $list_count = 10 , $search_param = null, $order_index = 'partner_id', $order_type = 'desc'){
        if($order_index){ 
            $this->db->order_by($order_index,$order_type) ; 
        }else{ 
            $this->db->order_by('partner_id','desc') ; 
        }
        $this->db->limit($list_count , ($page-1)*$list_count ) ; 

        if($search_param == null) { 
            $this->db->where('status','publish'); 
            $query = $this->db->get($this->table); 

            $this->db->where('status','publish'); 
            $total_rows = $this->db->count_all($this->table); 
        }else{
            $this->db->where('status','publish'); 
            $this->db->like('title',$search_param['search_keyword']); 
            $query = $this->db->get($this->table) ; 

            $this->db->where('status','publish'); 
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

    public function search($page=1,$list_count=10,$search_param=null,$order_index='partner_id',$order_type='desc'){ 
        if($order_index){ 
            $this->db->order_by($order_index,$order_type) ; 
        }else{ 
            $this->db->order_by('partner_id','desc') ; 
        }
        $this->db->limit($list_count , ($page-1)*$list_count ) ; 

        if($search_param == null) { 
            $query = $this->db->get($this->table); 
            $total_rows = $this->db->count_all($this->table); 
        }else{
            $this->db->like('title',$search_param['search_keyword']); 
            $this->db->or_like('place_name',$search_param['search_keyword']); 
            $query = $this->db->get($this->table) ; 
            $this->db->like('title',$search_param['search_keyword']); 
            $this->db->or_like('place_name',$search_param['search_keyword']); 
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

    public function getPartnerList($page=1,$list_count=10,$search_param=null,$order_index='partner_id',$order_type='desc'){

        if($order_index){ 
            $this->db->order_by($order_index,$order_type) ; 
        }else{ 
            $this->db->order_by('partner_id','desc') ; 
        }
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




    /* partner_model.php */

}
