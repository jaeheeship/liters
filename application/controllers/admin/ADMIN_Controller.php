<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ADMIN_Controller extends CI_Controller {
    function __construct(){
        parent::__construct() ; 
        $this->load->library('tank_auth');  
        $this->load->helper('url') ; 

		if (!$this->tank_auth->is_logged_in()) {
            redirect('admin/member/login');
        } else if($this->tank_auth->is_logged_in(FALSE)) { 
            redirect('admin/member/activation'); 
        }
    }
} 

/* End of file ADMIN_Controller.php */
/* Location: ./application/controllers/admin/ADMIN_Controller.php */
