<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Artgrafii extends CI_Controller {
    function __construct(){
        parent::__construct() ; 
    } 

    public function intro(){
        $this->load->library('aglayout') ; 
        $this->aglayout->layout('ag_layout_ver2/layout'); 

        $this->aglayout->moduleViewPath('artgrafii/') ; 
        $this->aglayout->add('intro') ; 

        $data = array() ; 
        $this->aglayout->show($data) ; 
    }

    public function contact(){

    }
}
