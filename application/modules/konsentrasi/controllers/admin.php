<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller {
	var $title = "Konsentrasi";
	public function __construct()
	{
		parent::__construct();
		echo Modules::run("fekon/cekLogin");
		$this->load->model('M_konsentrasi');
		$this->load->model('prodi/M_prodi');
		$this->load->library('table');
		// Modules::run('login/cek_login');
	}

	public function index( $offset = 0 )
	{
		$perpage = 50;
		$query = $this->M_konsentrasi->getAll(array('perpage' => $perpage, 'offset' => $offset));
		$template_table = array("table_open"=>"<table class='table table-hover'>");
		$this->table->set_template($template_table);
		$heading = array('No', 'Program Studi', 'Konsentrasi', 'Aksi');
		$this->table->set_heading($heading);

		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		//load library pagination
		$this->load->library('pagination');
		//untuk konfigurasi pagination
		$config_paging = array(
			'base_url' => base_url().'konsentrasi/admin/index',
			'total_rows' => $this->M_konsentrasi->getAll()->num_rows(),
			'per_page' => $perpage,
			'uri_segment' => 4
		);

		$no = 0 + $offset;
		$content = null;
		if($query->num_rows() > 0){
			foreach ($query->result() as $record){
				$no++;
				$btn_edit = anchor('konsentrasi/admin/edit/'.$record->id_konsentrasi, '<span class="glyphicon glyphicon-edit"></span>', 'class="btn btn-default btn-xs"');
				$btn_hapus = anchor('konsentrasi/admin/hapus/'.$record->id_konsentrasi, '<span class="glyphicon glyphicon-remove"></span>', 'class="btn btn-default btn-xs hapus"');
				$aksi = $btn_edit.' '.$btn_hapus;
				$row_table = array(
					$no,
					$record->prodi,
					$record->konsentrasi,
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
		$data['combobox_prodi'] = $this->M_prodi->combobox($this->session->userdata('konsentrasi_id_prodi'));
		$data['table'] = $this->table->generate();
		$data['link_tambah'] = site_url('konsentrasi/admin/tambah');
		$data['title'] = $this->title;
		$this->template->set_layout('template_admin')
		->title($this->title)
		->build('data', $data);
	}

	public function tambah()
	{
		$data['mode'] = 'tambah';
		$data['form_action'] = site_url('konsentrasi/admin/tambah_proses');
		$data['combobox_prodi'] = $this->M_prodi->combobox();
		$data['title'] = $this->title." <small>Tambah Data</small>";
		$this->template->set_layout('template_admin')
		->title($this->title)
		->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/js/ckeditor/ckeditor.js"></script>')
		->build('form', $data);
	}

	public function tambah_proses()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_prodi', 'Program Studi', 'required');
		$this->form_validation->set_rules('konsentrasi', 'Konsentrasi', 'required');
		if ($this->form_validation->run()==FALSE) {
			$this->tambah();
		}
		else {
			$data['id_prodi'] = $this->input->post('id_prodi');
			$data['konsentrasi'] = $this->input->post('konsentrasi');
			$data['keterangan_konsentrasi'] = $this->input->post('keterangan_konsentrasi');
			$this->M_konsentrasi->insert($data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Data Berhasil di Proses
			</div>');
			redirect('konsentrasi/admin');
		}
	}

	public function edit($id){
		$query = $this->M_konsentrasi->getById($id);
		if($query->num_rows()>0){
			$record = $query->row();
			$data['mode'] = 'edit';
			$data['form_action'] = site_url('konsentrasi/admin/edit_proses');
			$data['default']['id_konsentrasi'] = $record->id_konsentrasi;
			$data['combobox_prodi'] = $this->M_prodi->combobox($record->id_prodi);
			$data['default']['konsentrasi'] = $record->konsentrasi;
			$data['default']['keterangan_konsentrasi'] = $record->keterangan_konsentrasi;
			$data['title'] = $this->title." <small>Edit Data</small>";
			$this->template->set_layout('template_admin')
			->title($this->title)
			->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/js/ckeditor/ckeditor.js"></script>')
			->build('form', $data);
		}
		else {
			redirect('controller');
		}
	}
	public function edit_proses()
	{
		$id_konsentrasi = $this->input->post('id_konsentrasi');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_prodi', 'Program Studi', 'required');
		$this->form_validation->set_rules('konsentrasi', 'Konsentrasi', 'required');
		if ($this->form_validation->run()==FALSE) {
			$this->edit($id_konsentrasi);
		}
		else {
			$data['id_prodi'] = $this->input->post('id_prodi');
			$data['konsentrasi'] = $this->input->post('konsentrasi');
			$data['keterangan_konsentrasi'] = $this->input->post('keterangan_konsentrasi');
			$this->M_konsentrasi->update($id_konsentrasi, $data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Data Berhasil di Proses
			</div>');
			redirect('konsentrasi/admin');
		}
	}
	public function cari_berdasarkan_prodi()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_prodi', 'Prodi', 'required');
		if ($this->form_validation->run()==TRUE) {
			$array = array(
				'konsentrasi_id_prodi' => $this->input->post('id_prodi')
			);
			$this->session->set_userdata($array);
		}
		else {
			$this->session->unset_userdata('konsentrasi_id_prodi');
		}
	}
	public function hapus($id)
	{
		$query = $this->M_konsentrasi->getById($id);
		if($query->num_rows()>0){
			$this->M_konsentrasi->delete($id);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Data Berhasil di Hapus
			</div>');
		}
		redirect('konsentrasi/admin');
	}
	public function combobox_konsentrasi($id_prodi)
	{
		echo $this->M_konsentrasi->combobox($id_prodi);
	}
}

/* End of file konsentrasi.php */
/* Location: ./application/modules/konsentrasi/controllers/konsentrasi.php */
