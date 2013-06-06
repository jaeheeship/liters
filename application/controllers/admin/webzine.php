<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Webzine extends CI_Controller{
    public function index(){

    }

    public function layout_manager(){ 
        $this->load->view('admin/header');
        $this->load->view('admin/layout/layout_manager');
		$this->load->view('admin/footer');
    } 
}

/* End of file webzine.php */
/* Location: ./application/controllers/admin/webzine.php */
