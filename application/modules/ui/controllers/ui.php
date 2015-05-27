<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ui extends MX_Controller {

	public function index()
	{
		$this->load->view('index');
	}
	function berita()
	{
		$this->load->view('berita');
	}
	function detail()
	{
		$this->load->view('detail');
	}
	function profil()
	{
		$this->load->view('profil');
	}
	function galeri($d)
	{
		$this->load->view($d);
	}
	function staf($staf)
	{
		$this->load->view($staf);
	}

}

/* End of file ui.php */
/* Location: ./application/modules/ui/controllers/ui.php */