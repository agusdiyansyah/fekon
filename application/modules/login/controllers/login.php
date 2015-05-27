<?php
class Login extends MX_Controller {
	var $title = "Login Administrator";
	function Login(){
		parent::__construct();
		$this->load->model('M_login');
		$this->load->library('form_validation');
		$this->load->library('recaptcha');
		$this->lang->load('recaptcha');
	    $this->load->helper('form');
	}
	function index(){
		$data['title'] = $this->title;
		$data['form_action'] = site_url('login/login_proses');
		$data['html_captcha'] = $this->recaptcha->get_html();
		$this->load->view('form', $data);
	}
	function login_proses(){
		//validasi form
		$this->form_validation->set_rules('userid', 'Nama', 'required|trim|xss_clean');
		$this->form_validation->set_rules('password', 'Sandi', 'required|trim|xss_clean');
		//$this->form_validation->set_rules('recaptcha_response_field', 'lang:recaptcha_field_name', 'required|callback_check_captcha');
		//jika validasi sukses
		if($this->form_validation->run($this) == TRUE){
			$userid = $this->input->post('userid');
			$password = md5($this->input->post('password'));
			//cek user dan sandi di database
			if($this->M_login->cek($userid, $password) == TRUE){
				$admin = $this->M_login->getAdmin($userid, $password);
				$data['userid'] = $userid;
				$data['password'] = $password;
				$data['id_admin'] = $admin->id_admin;
				$data['level'] = $admin->id_level;
				$data['fullname'] = $admin->fullname;
				$data['block'] = $admin->block;
				$data['login'] = TRUE;
				$this->session->set_userdata($data);
				redirect('beranda');
			}
			else {
				$this->session->set_flashdata('message', 'Maaf, nama dan atau sandi Anda salah');
				redirect('login');
			}
		}
		else {
			$this->index();
		}
	}
	function cek_login($level = ""){		
		$status_login = $this->session->userdata('login');
		if (!isset($status_login) || $status_login != TRUE){
			redirect('login');
		}
		else {			
			if ($level) {				
				if (is_array($level)) { //cek apakah $level merupakan jenis array
					if (!in_array($this->session->userdata('level'), $level)) {//cek apakah level yg login masuk dalam array $level
						redirect('beranda');
					}
				}
				else {
					if ($this->session->userdata('level') != $level){
						redirect('login');
					}
				}
			}
		}
	}
	function logout(){
		// $this->session->unset_userdata('userid');
		// $this->session->unset_userdata('password');
		// $this->session->unset_userdata('login');
		// $this->session->unset_userdata('id_admin');
		// $this->session->unset_userdata('level');
		// $this->session->unset_userdata('fullname');
		// $this->session->unset_userdata('block');
		$this->session->sess_destroy();
		redirect('fekon');
	}
	function check_captcha($val){
	  	if ($this->recaptcha->check_answer($this->input->ip_address(), $this->input->post('recaptcha_challenge_field'), $val))
		{
	    	return TRUE;
	  	}
		
	    $this->form_validation->set_message('check_captcha', $this->lang->line('recaptcha_incorrect_response'));
	    return FALSE;
	} 
}