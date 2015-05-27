<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller {

	var $title = "Management User";
	public function __construct()
	{
		parent::__construct();
		echo Modules::run("fekon/cekLogin");
		$this->load->model('M_user');
		$this->load->library('table');
	}

	public function index($offset = 0)
	{
		$perpage = 10;
		$query = $this->M_user->getAll(array('perpage' => $perpage, 'offset' => $offset));
		$template_table = array("table_open" => "<table class='table table_hover'>");
		$this->table->set_template($template_table);
		$heading = array('No','Fullname','Block','Aksi');
		$this->table->set_heading($heading);

		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		$this->load->library('pagination');
		$config_paging = array(
			'base_url' => base_url().'user/admin/index',
			'total_rows' => $this->M_user->getAll()->num_rows(),
			'per_page' => $perpage,
			'uri_segment' => 4
		);
		$no = 0 + $offset;
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $key) {
				$no++;
				$edit = anchor('user/admin/edit/'.$key->id_admin, '<span class="glyphicon glyphicon-edit"></span>', 'class="btn btn-default btn-xs"');
				$hapus = anchor('user/admin/hapus/'.$key->id_admin, '<span class="glyphicon glyphicon-remove"></span>', 'class="btn btn-default btn-xs"');
				$aksi = $edit.' '.$hapus;
				$row = array(
					$no,
					$key->fullname,
					$key->block,
					$aksi
				);
				$this->table->add_row($row);
			}
			$this->pagination->initialize($config_paging);
			$data['pagination'] = $this->pagination->create_links();
		}else{
			$data['pagination'] = "";
		}
		$data['table'] = $this->table->generate();
		$data['link_tambah'] = site_url('user/admin/tambah');
		$data['title'] = $this->title;
		$this->template->set_layout('template_admin')
		->title($this->title)
		->build('data', $data);
	}

	public function tambah()
	{
		$data['mode'] = 'tambah';
		$data['form_action'] = site_url('user/admin/tambah_proses');
		$data['title'] = $this->title." <small>Tambah Data</small>";
		$this->template->set_layout('template_admin')
		->title($this->title)
		->build('form', $data);
	}

	public function tambah_proses()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fullname', 'Fullname', 'required|xss_clean');
		$this->form_validation->set_rules('userid', 'Username', 'required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
		if ($this->form_validation->run() == false) {
			$this->tambah();
		} else {
			$data = array(
				'fullname' => $this->input->post('fullname'), 
				'userid' => $this->input->post('userid'), 
				'password' => md5($this->input->post('password')), 
				'block' => $this->input->post('block'), 
				'id_level' => 1,
			);
			$this->M_user->insert($data);
			redirect('user/admin');
		}
	}

	public function edit($id)
	{
		$query = $this->M_user->getById($id);
		if ($query->num_rows() > 0) {
			$key = $query->row();
			$data['mode'] = 'edit';
			$data['form_action'] = 'user/admin/edit_proses';
			$data['default'] = array(
				'id_admin' => $id,
				'fullname' => $key->fullname,
				'userid' => $key->userid, 
				'block' => $key->block, 
			);
			$data['title'] = 'Edit Data user';
			$this->template->set_layout('template_admin')
			->title($this->title)
			->build('form', $data);
		} else {
			redirect('user/admin');
		}
		
	}

	public function edit_proses()
	{
		$id = $this->input->post('id_admin');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fullname', 'Fullname', 'required|xss_clean');
		$this->form_validation->set_rules('userid', 'Username', 'required|xss_clean');
		if ($this->form_validation->run() == false) {
			$this->edit($id);
		} else {
			$data = array(
				'fullname' => $this->input->post('fullname'), 
				'userid' => $this->input->post('userid'), 
				'block' => $this->input->post('block'), 
				'id_level' => 1,
			);
			if (!empty($this->input->post('password'))) {
				$data['password'] = md5($this->input->post('password'));
			}
			$this->M_user->update($id, $data);
			redirect('user/admin');
		}
		
	}

	function hapus($id)
	{
		$query = $this->M_user->getById($id);
		if ($query->num_rows() > 0) {
			$this->M_user->delete($id);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil di Hapus</div>');
		}
		redirect('user/admin');
		
	}

}

/* End of file admin.php */
/* Location: ./application/modules/user/controllers/admin.php */