<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('ADMIN_Controller.php'); 
class Template extends ADMIN_Controller {

    function __construct(){ 
        parent::__construct() ; 
        $this->load->library('aglayout') ; 
        $this->aglayout->layout('admin/layout'); 
        $this->aglayout->moduleViewPath('admin/template/') ;
    } 

    public function index(){

    }

    public function blank(){ 
        $this->aglayout->add('header') ; 
        $this->aglayout->add('blank') ; 
        $this->aglayout->add('footer') ;

        $this->aglayout->show(null) ; 
    }

    public function showlist(){ 
        $this->aglayout->add('header') ; 
        $this->aglayout->add('templatelist') ; 
        $this->aglayout->add('footer') ;

        $this->aglayout->show(null) ;
    }

    public function show(){

    }

    public function save(){

    } 
} 

/* End of file template.php */
/* Location: ./application/controllers/admin/template.php */
