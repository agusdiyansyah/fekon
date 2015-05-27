<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Saran extends MX_Controller {
	var $title = "Saran";
	var $model;
	function Saran(){
		parent::__construct();
		$this->load->model('M_saran');
		$this->load->library('form_validation');
		$this->load->library('recaptcha');
		$this->lang->load('recaptcha');
	}
	function index(){
		$saran = $this->M_saran->getBanner()->row();
		$data['saran_msg'] = $saran->content_static;
		$data['form_action'] = site_url('saran/tambah_proses');
		$data['html_captcha'] = $this->recaptcha->get_html();
		$this->template->set_layout('template_single')
		->title($this->title)
		->build('form', $data);
	}
	function tambah_proses(){
		//set validation
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required|htmlspecialchars|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|email|required|htmlspecialchars|xss_clean');
		$this->form_validation->set_rules('telepon', 'No Telepon/HP', 'trim|numeric|required|htmlspecialchars|xss_clean');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|htmlspecialchars|xss_clean');
		$this->form_validation->set_rules('saran', 'Saran', 'trim|required|htmlspecialchars|xss_clean');
		$this->form_validation->set_rules('recaptcha_response_field', 'lang:recaptcha_field_name', 'required|callback_check_captcha');
		if ($this->form_validation->run($this) == FALSE){
			$this->index();
		}
		else {
			$data['nama_lengkap'] = $this->input->post('nama_lengkap');
			$data['no_identitas'] = $this->input->post('no_identitas');
			$data['email'] = $this->input->post('email');
			$data['telepon'] = $this->input->post('telepon');
			$data['alamat'] = $this->input->post('alamat');
			$data['saran'] = $this->input->post('saran');
			date_default_timezone_set('Asia/Jakarta');
			$data['tanggal'] = date('Y-m-d');
			$data['jam'] = date('H:i:s');
			$sendMail = $this->M_saran->sendMail($data);
			if ($sendMail) {
				$this->M_saran->insert($data);
				$this->session->set_flashdata('msg', '<div class="alert alert-success">Saran Anda Kami Terima, Terima Kasih</div>');
			}
			else {
				$this->session->set_flashdata('msg', '<div class="alert alert-error">Saran Gagal Terkirim, Silahkan Hubungi Administrator Web</div>');
			}
			redirect('saran');
		}
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

/* End of file saran.php */
/* Location: ./application/modules/saran/controllers/saran.php */
