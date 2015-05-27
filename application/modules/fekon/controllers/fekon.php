<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fekon extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_login');
	}

	public function index()
	{
		$this->load->view('login');
	}

	function logout()
	{	
		$this->session->unset_userdata('userid');
		$this->session->unset_userdata('password');
		redirect('fekon');
	}

	function login()
	{
		$array = array(
			'userid' => $this->input->post('userid'),
			'password' => $this->input->post('password'),
		);
		
		$this->session->set_userdata( $array );
		redirect('admin');
	}

	function cekLogin()
	{
		$userid = $this->session->userdata('userid');
		$password = $this->session->userdata('password');
		$query = $this->M_login->getData($userid, md5($password));
		if ($query->num_rows() == 0) {
			$this->load->view('');
		}
	}

}

/* End of file fekon.php */
/* Location: ./application/modules/fekon/controllers/fekon.php */