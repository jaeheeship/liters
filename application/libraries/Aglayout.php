<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Aglayout{
    var $layout ;
    var $moduleViewPath ; 
    var $header_data = '' ;
    var $footer_data = '' ; 
    var $body = array() ; 

    function __construct() { 
		$this->ci =& get_instance();
    }

    public function layout($layout){ 
        $this->layout ='layout/'.$layout ; 
    }

    public function moduleViewPath($path){
        $this->moduleViewPath = $path ; 

        return $this->moduleViewPath ; 
    } 

    public function add($view_file){ 
        $this->body[] = $view_file ; 

        return $this->body ; 
    } 

    public function appendHeader($str){
        $this->header_data = $this->header_data.$str ; 
    }

    public function appendFooter($str){
        $this->footer_data = $this->footer_data.$str ; 
    }

    

    public function addHeaderData($data){
        $this->header_data = $this->ci->load->view($this->moduleViewPath.'_header_data',$data,TRUE) ; 
    }

    public function addFooterData($data){
        $this->footer_data = $this->ci->load->view($this->moduleViewPath.'_footer_data',$data,TRUE) ;

    }

    public function compile($data){ 
        if($this->header_data){
            $data['header_data'] = $this->header_data ; 
        }

        if($this->footer_data){
            $data['footer_data'] = $this->footer_data ; 
        }

        $body_html = '' ; 

        foreach($this->body as $key => $row){
            $body_html .= $this->ci->load->view($this->moduleViewPath.$row,$data,TRUE) ;
        }
        
        $data['contents'] = $body_html ; 

        return $this->ci->load->view($this->layout,$data,TRUE) ; 

    }

    public function show($data=null){ 
        $str = $this->compile($data)  ; 
        echo @$this->ci->load->view($this->layout,$data,TRUE); 
    }
} 

/* End of file Aglayout.php */
/* Location: ./application/libraries/Aglayout.php */
