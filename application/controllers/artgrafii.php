<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Artgrafii extends CI_Controller {
    function __construct(){
        parent::__construct() ; 
    }

    public function take_a_break(){
        $this->load->view('artgrafii/error404')  ; 
    }
}
