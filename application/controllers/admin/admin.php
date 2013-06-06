<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('ADMIN_Controller.php'); 

class Admin extends ADMIN_Controller {

    public function __construct(){ 
        parent::__construct() ; 
    } 
    
	public function index()
	{
        $this->load->helper('asset') ; 
		$this->load->view('admin/header');
		$this->load->view('admin/content');
		$this->load->view('admin/footer');
	}
} 
/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */
