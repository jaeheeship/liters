<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Loader extends CI_Loader {
    function __construct(){
        parent::__construct() ; 
    }

    function things($arr){ 
        foreach($arr as $key => $el){ 
            $cnt = count($el)  ; 
            for($i=0 ; $i <$cnt ; $i++){
                $this->load->{$key}($el); 
            }
        }
    } 
}
