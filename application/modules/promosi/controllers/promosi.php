<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promosi extends MX_Controller {
	var $title = "Promosi";
	function Promosi(){
		parent::__construct();	
		$this->load->helper('html');
		$this->load->model('m_promosi');	
		$this->load->library('clean_url');
	}
	public function index()
	{
		$query = $this->m_promosi->get()->row();
		$data = array(
			'title' => $query->title, 
			'image' => $query->image, 
			'content' => $query->content, 
			'info' => Modules::run("infoakademik/widget"),
			'gallery' => Modules::run("gallery/widget"),
		);
		$this->template->set_layout('template')
		->title($this->title)
		->set_partial('metadata', 'partials/metadata')
		->set_partial('header', 'partials/header')
		->set_partial('footer', 'partials/footer')
		->build('detil', $data);
	}
	function widget()
	{
		$query = $this->m_promosi->get()->row();
		$data = array(
			'image' => $query->image, 
			'id_promosi' => $query->id_promosi, 
			'content' => $query->content, 
			'title' => $query->title, 
			'slug' => $query->slug, 
		);
		$this->load->view('widget', $data);
	}

}

/* End of file promosi.php */
/* Location: ./application/modules/promosi/controllers/promosi.php */