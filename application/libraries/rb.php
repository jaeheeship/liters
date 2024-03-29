<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rb {
    function __construct(){
        include(APPPATH.'/config/database.php'); 
        include(APPPATH.'/third_party/rb/rb.php'); 

        $host = $db[$active_group]['hostname'] ; 
        $user = $db[$active_group]['username'] ; 
        $pass = $db[$active_group]['password'] ; 
        $db = $db[$active_group]['database'] ; 

        R::setup("mysql:host=$host;dbname=$db",$user,$pass) ;
    }
}

/* End of file rb.php */
/* Location: ./application/libraries */
