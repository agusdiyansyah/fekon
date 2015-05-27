<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller {
	var $title = "Program Studi";
	public function __construct()
	{
		parent::__construct();
		echo Modules::run("fekon/cekLogin");
		$this->load->model('M_prodi');
		$this->load->library('table');
	}
	// List all your items
	public function index( $offset = 0 )
	{
		$perpage = 50;
		$query = $this->M_prodi->getAll(array('perpage' => $perpage, 'offset' => $offset));
		$template_table = array("table_open"=>"<table class='table table-hover'>");
		$this->table->set_template($template_table);
		$heading = array('No', 'Prodi', 'Aksi');
		$this->table->set_heading($heading);

		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		//load library pagination
		$this->load->library('pagination');
		//untuk konfigurasi pagination
		$config_paging = array(
			'base_url' => site_url('prodi/admin/index/'),
			'total_rows' => $this->M_prodi->getAll()->num_rows(),
			'per_page' => $perpage,
			'uri_segment' => 4
		);

		$no = 0 + $offset;
		$content = null;
		if($query->num_rows() > 0){
			foreach ($query->result() as $record){
				$btn_edit = anchor('prodi/admin/edit/'.$record->id_prodi, '<span class="glyphicon glyphicon-edit"></span>', 'class="btn btn-default btn-xs"');
				$btn_hapus = anchor('prodi/admin/hapus/'.$record->id_prodi, '<span class="glyphicon glyphicon-remove"></span>', 'class="btn btn-default btn-xs hapus"');
				$aksi = $btn_edit.' '.$btn_hapus;
				$no ++;
				$row_table = array(
					$no,
					$record->prodi,
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
		$data['table'] = $this->table->generate();
		$data['link_tambah'] = site_url('prodi/admin/tambah');
		$data['title'] = $this->title;
		$this->template->set_layout('template_admin')
		->title($this->title)
		->build('data', $data);
	}

	public function tambah()
	{
		$data['mode'] = 'tambah';
		$data['form_action'] = site_url('prodi/admin/tambah_proses');
		$data['title'] = $this->title." <small>Tambah Data</small>";
		$this->template->set_layout('template_admin')
		->title($this->title)
		->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/js/ckeditor/ckeditor.js"></script>')
		->build('form', $data);
	}

	public function tambah_proses()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('prodi', 'Program Studi', 'required');
		if ($this->form_validation->run()==FALSE) {
			$this->tambah();
		}
		else {
			$data['prodi'] = $this->input->post('prodi');
			$data['jenjang'] = $this->input->post('jenjang');
			$data['keterangan_prodi'] = $this->input->post('keterangan_prodi');
			$data['kurikulum'] = $this->input->post('kurikulum');
			$this->M_prodi->insert($data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil Disimpan</div>');
			redirect('prodi/admin');
		}
	}

	public function edit($id_prodi){
		$query = $this->M_prodi->getByid($id_prodi);
		if($query->num_rows()>0){
			$record = $query->row();
			$data['mode'] = 'edit';
			$data['default']['id_prodi'] = $record->id_prodi;
			$data['default']['jenjang'] = $record->jenjang;
			$data['default']['prodi'] = $record->prodi;
			$data['default']['keterangan_prodi'] = $record->keterangan_prodi;
			$data['default']['kurikulum'] = $record->kurikulum;
			$data['title'] = $this->title." <small>Edit Data</small>";
			$data['form_action'] = site_url('prodi/admin/edit_proses');
			$this->template->set_layout('template_admin')
			->title($this->title)
			->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/js/ckeditor/ckeditor.js"></script>')
			->build('form', $data);
		}
		else {
			redirect('prodi/admin');
		}
	}
	public function edit_proses()
	{
		$id_prodi = $this->input->post('id_prodi');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('prodi', 'Program Studi', 'required');
		if ($this->form_validation->run()==FALSE) {
			$this->edit($id_prodi);
		}
		else {
			$data['prodi'] = $this->input->post('prodi');
			$data['jenjang'] = $this->input->post('jenjang');
			$data['keterangan_prodi'] = $this->input->post('keterangan_prodi');
			$data['kurikulum'] = $this->input->post('kurikulum');
			$this->M_prodi->update($id_prodi, $data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil Diganti</div>');
			redirect('prodi/admin');
		}
	}
	public function hapus($id)
	{
		$query = $this->M_prodi->getById($id);
		if($query->num_rows()>0){
			$this->M_prodi->delete($id);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil Dihapus</div>');
		}
		redirect('prodi/admin');
	}
}

/* End of file admin.php */
/* Location: ./application/modules/prodi/controllers/admin.php */
