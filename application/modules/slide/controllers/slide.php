<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slide extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_slide');
	}

	public function index()
	{
		$query = $this->M_slide->getAll();
		$data['result'] = $query->result();
		$this->load->view('slide', $data);
	}

}

/* End of file slide.php */
/* Location: ./application/controllers/slide.php */