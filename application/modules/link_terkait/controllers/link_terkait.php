<?php 
class Link_terkait extends MX_Controller {
	function Link_terkait(){
		parent::__construct();
		$this->load->model('M_link');		
	}
	function link(){
		$query = $this->M_link->getAll();
		$data['result'] = $query->result();
		$this->load->view('link', $data);
	}
}
?>