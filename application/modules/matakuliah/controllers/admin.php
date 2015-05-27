<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller {
	var $title = "Data Mata Kuliah";
	public function __construct()
	{
		parent::__construct();
		echo Modules::run("fekon/cekLogin");
		$this->load->model('M_matakuliah');
		$this->load->model('prodi/M_prodi');
		$this->load->model('konsentrasi/M_konsentrasi');
		$this->load->library('table');
		// Modules::run('login/cek_login');
	}

	public function index( $offset = 0 )
	{
		$perpage = 50;
		$query = $this->M_matakuliah->getAll(array('perpage' => $perpage, 'offset' => $offset));
		$template_table = array("table_open"=>"<table class='table table-hover'>");
		$this->table->set_template($template_table);
		$heading = array('No', 'Program Studi', 'Konsentrasi', 'Mata Kuliah', 'Aksi');
		$this->table->set_heading($heading);

		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		//load library pagination
		$this->load->library('pagination');
		//untuk konfigurasi pagination
		$config_paging = array(
			'base_url' => base_url().'konsentrasi/admin/index',
			'total_rows' => $this->M_matakuliah->getAll()->num_rows(),
			'per_page' => $perpage,
			'uri_segment' => 4
		);

		$no = 0 + $offset;
		$content = null;
		if($query->num_rows() > 0){
			foreach ($query->result() as $record){
				$no++;
				$btn_edit = anchor('matakuliah/admin/edit/'.$record->id_matakuliah, '<span class="glyphicon glyphicon-edit"></span>', 'class="btn btn-default btn-xs"');
				$btn_hapus = anchor('matakuliah/admin/hapus/'.$record->id_matakuliah, '<span class="glyphicon glyphicon-remove"></span>', 'class="btn btn-default btn-xs hapus"');
				$aksi = $btn_edit.' '.$btn_hapus;
				$row_table = array(
					$no,
					$record->prodi,
					$record->konsentrasi,
					$record->matakuliah,
					$aksi
				);
				$this->table->add_row($row_table);
			}
			$this->pagination->initialize($config_paging);
			$data['pagination'] = $this->pagination->create_links();
		}
		else {
			$data['pagination'] = "";
		}
		$data['combobox_prodi'] = $this->M_prodi->combobox($this->session->userdata('matakuliah_id_prodi'));
		if ($this->session->userdata('matakuliah_id_prodi')) {
			$data['combobox_konsentrasi'] = $this->M_konsentrasi->combobox($this->session->userdata('matakuliah_id_prodi'), $this->session->userdata('matakuliah_id_konsentrasi'));
		}
		else {
			$data['combobox_konsentrasi'] = NULL;
		}

		$data['table'] = $this->table->generate();
		$data['link_tambah'] = site_url('matakuliah/admin/tambah');
		$data['title'] = $this->title;
		$this->template->set_layout('template_admin')
		->title($this->title)
		->build('admin/data', $data);
	}

	public function tambah()
	{
		$data['mode'] = 'tambah';
		$data['form_action'] = site_url('matakuliah/admin/tambah_proses');
		$data['combobox_prodi'] = $this->M_prodi->combobox();
		$data['combobox_konsentrasi'] = "Pilih Program Studi Terlebih Dahulu";
		$data['title'] = $this->title." <small>Tambah Data</small>";
		$this->template->set_layout('template_admin')
		->title($this->title)
		->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/js/ckeditor/ckeditor.js"></script>')
		->build('admin/form', $data);
	}

	public function tambah_proses()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_prodi', 'Program Studi', 'required');
		$this->form_validation->set_rules('id_konsentrasi', 'Konsentrasi', 'required');
		$this->form_validation->set_rules('matakuliah', 'Mata Kuliah', 'required');
		if ($this->form_validation->run()==FALSE) {
			$this->tambah();
		}
		else {
			$data['id_konsentrasi'] = $this->input->post('id_konsentrasi');
			$data['matakuliah'] = $this->input->post('matakuliah');
			$data['keterangan_matakuliah'] = $this->input->post('keterangan_matakuliah');
			$this->M_matakuliah->insert($data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Data Berhasil di Proses
			</div>');
			redirect('matakuliah/admin');
		}
	}

	public function edit($id){
		$query = $this->M_matakuliah->getById($id);
		if($query->num_rows()>0){
			$record = $query->row();
			$data['mode'] = 'edit';
			$data['form_action'] = site_url('matakuliah/admin/edit_proses');
			$data['default']['id_matakuliah'] = $record->id_matakuliah;
			$data['combobox_prodi'] = $this->M_prodi->combobox($record->id_prodi);
			$data['combobox_konsentrasi'] = $this->M_konsentrasi->combobox($record->id_prodi, $record->id_konsentrasi);
			$data['default']['matakuliah'] = $record->matakuliah;
			$data['default']['keterangan_matakuliah'] = $record->keterangan_matakuliah;
			$data['title'] = $this->title." <small>Edit Data</small>";
			$this->template->set_layout('template_admin')
			->title($this->title)
			->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/js/ckeditor/ckeditor.js"></script>')
			->build('admin/form', $data);
		}
		else {
			redirect('matakuliah/admin');
		}
	}
	public function edit_proses()
	{
		$id_matakuliah = $this->input->post('id_matakuliah');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_prodi', 'Program Studi', 'required');
		$this->form_validation->set_rules('id_konsentrasi', 'Konsentrasi', 'required');
		$this->form_validation->set_rules('matakuliah', 'Mata Kuliah', 'required');
		if ($this->form_validation->run()==FALSE) {
			$this->edit($id_matakuliah);
		}
		else {
			$data['id_konsentrasi'] = $this->input->post('id_konsentrasi');
			$data['matakuliah'] = $this->input->post('matakuliah');
			$data['keterangan_matakuliah'] = $this->input->post('keterangan_matakuliah');
			$this->M_matakuliah->update($id_matakuliah, $data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Data Berhasil di Proses
			</div>');
			redirect('matakuliah/admin');
		}
	}
	public function cari_berdasarkan_konsentrasi()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_prodi', 'Prodi', 'required');
		$this->form_validation->set_rules('id_konsentrasi', 'Konsentrasi', 'required');
		if ($this->form_validation->run()==TRUE) {
			$array = array(
				'matakuliah_id_prodi' => $this->input->post('id_prodi'),
				'matakuliah_id_konsentrasi' => $this->input->post('id_konsentrasi')
			);
			$this->session->set_userdata($array);
		}
		else {
			$this->session->unset_userdata('matakuliah_id_prodi');
			$this->session->unset_userdata('matakuliah_id_konsentrasi');
		}
	}
	public function hapus($id)
	{
		$query = $this->M_matakuliah->getById($id);
		if($query->num_rows()>0){
			$this->M_matakuliah->delete($id);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Data Berhasil di Hapus
			</div>');
		}
		redirect('matakuliah/admin');
	}
}