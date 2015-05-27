<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller {
	var $title = "Admin Panel Fekon";
	public function __construct()
	{
		parent::__construct();
		echo Modules::run("fekon/cekLogin");
		$this->load->model('M_admin');
		$this->load->library('table');
	}
	public function index()
	{
		$data['title'] = $this->title;
		$this->template->set_layout('template_admin')
		->title($this->title)
		->build('beranda', $data);
	}
	function data($offset = 0){				
		$perpage = 50;
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		//load library pagination
		$this->load->library('pagination');
		//untuk konfigurasi pagination
		$config_paging = array(
			'base_url' => base_url().'admin/data/',
			'total_rows' => $this->M_admin->getAll()->num_rows(),
			'per_page' => $perpage,
			'last_link' => 'terakhir',
			'first_link' => 'awal'
		);
		$this->pagination->initialize($config_paging);
		$data['pagination'] = $this->pagination->create_links();		
		//Keterangan Pencarian
		if ($this->session->userdata('administratorCari') == "ada") {
			$data['cari']['status'] = 'ada';
			$data['cari']['userid'] = $this->session->userdata('administratorCari_userid');
			$data['cari']['namalengkap'] = $this->session->userdata('administratorCari_namalengkap');
			if ($this->session->userdata('administratorCari_level')) {
				$level = $this->M_admin->getByLevelId($this->session->userdata('administratorCari_level'))->row();
				$data['cari']['level'] = $level->info;
			}
			else {
				$data['cari']['level'] = "";
			}
		}
		else {
			$data['cari']['status'] = 'tidak';
		}

		$admin = $this->M_admin->getAll(array('perpage' => $perpage, 'offset'=>$offset));
		$template_table = array("table_open"=>"<table class='table table-hover'>");
		$this->table->set_template($template_table);
		$heading = array('No', 'Userid', 'Nama Lengkap', 'Level', 'Blok', 'Aksi');
		$this->table->set_heading($heading);
		$no = 0 + $offset;
		foreach ($admin->result() as $record){
			$no++;
			$edit = anchor('admin/edit/'.$record->id_admin, '<i class="fa fa-edit"></i>', 'class="btn btn-success btn-xs" title="edit"');
			$hapus = anchor('admin/hapus/'.$record->id_admin, 'x', 'class="hapus btn btn-danger btn-xs" title="hapus"');
			
			$this->table->add_row(
				$no,
				$record->userid,
				$record->fullname,
				$record->level,
				$record->block,
				$edit.' '.$hapus
			);
		}
		$data['table'] = $this->table->generate();
		$data['title'] = "Data Administrator";
		$data['link_tambah'] = site_url('admin/tambah');
		$this->template->set_layout('template_admin')
		->title($this->title)
		->build('data', $data);
	}
	function tambah(){
		$data['form_action'] = site_url('admin/tambah_proses');
		$data['default']['block'] = null;
		$data['default']['level'] = $this->M_admin->combobox();
		$data['title'] = 'Tambah Data Administrator';
		$data['mode'] = 'tambah';
		$this->template->set_layout('template_admin')
		->title($this->title)
		->build('form', $data);
	}
	function tambah_proses(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('userid', 'User ID', 'required|min_length[6]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|xss_clean|matches[password_ulang]');
		$this->form_validation->set_rules('password_ulang', 'Password Konfirmasi', 'required|xss_clean');
		$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required|xss_clean');
		if ($this->form_validation->run() == FALSE){
			$this->tambah();
		}
		else {
			$data['userid'] = $this->input->post('userid');
			$data['fullname'] = $this->input->post('fullname');
			$data['password'] = md5($this->input->post('password'));
			$data['id_level'] = $this->input->post('level');
			$data['block'] = $this->input->post('block');
			$insert = $this->M_admin->insert($data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil di Tambah</div>');
			redirect('admin/data');
		}
	}
	function edit($id_admin){
		$query = $this->M_admin->getById($id_admin);
		if ($query->num_rows() > 0) {
			$record = $query->row();
			$data['form_action'] = site_url('admin/edit_proses');
			$data['default']['id_admin'] = $record->id_admin;
			$data['default']['userid'] = $record->userid;
			$data['default']['fullname'] = $record->fullname;
			$data['default']['level'] = $record->id_level;
			$data['default']['block'] = $record->block;
			$data['mode'] = "edit";
			$data['title'] = 'Edit Data Administrator';
			$this->template->set_layout('template_admin')
			->title($this->title)
			->build('form', $data);
		}
		else {
			redirect('admin/data');
		}
	}
	function edit_proses(){
		$password = $this->input->post('password');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('userid', 'User ID', 'required|min_length[6]|xss_clean');
		$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required|xss_clean');
		if ($password != "") {
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|xss_clean|matches[password_ulang]');
			$this->form_validation->set_rules('password_ulang', 'Password Konfirmasi', 'required|xss_clean');
		}
		if ($this->form_validation->run() == FALSE){
			$this->edit($id_admin);
		}
		else {
			$id_admin = $this->input->post('id_admin');
			$data['fullname'] = $this->input->post('fullname');
			$data['block'] = $this->input->post('block');
			$data['userid'] = $this->input->post('userid');
			$data['id_level'] = $this->input->post('level');
			if ($password != "") {
				$data['password'] = md5($password);
			}
			$this->M_admin->update($id_admin, $data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Proses Edit Berhasil</div>');
			redirect('admin/data');
		}
	}
	function hapus($id_admin){
		$query = $this->M_admin->getById($id_admin);
		if ($query->num_rows() > 0) {
			$this->M_admin->delete($id_admin);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil di Hapus</div>');
		}
		redirect('admin/data');
	}
}

/* End of file admin.php */
/* Location: ./application/modules/admin/controllers/admin.php */