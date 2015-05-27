<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clean_url{
	protected 	$CI;
	function Clean_url(){
        $this->CI =& get_instance();
        $this->CI->load->helper('url');
	}
	function getId($url){
		$explode = explode("-", $url);
		return $explode[0];
	}
	function getUrl($url){
		$explode = explode("-", $url);
		array_shift($explode);
		return implode("-", $explode);
	}
	function generate($id, $title){
		$title = strtolower($title);
		return url_title($id."-".$title);
	}
	function create($title){		
		return url_title(strtolower($title));
	}
	

}

/* End of file Clean_url.php */
/* Location: ./application/libraries/Clean_url.php */
