<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller {
	var $title = "Informasi Akademik";
	public function __construct()
	{
		parent::__construct();
		echo Modules::run("fekon/cekLogin");
		$this->load->model('m_info');
		$this->load->library('table');
	}
	public function index($offset = 0)
	{
		$perpage = 50;
		$query = $this->m_info->getAll(array('perpage' => $perpage, 'offset' => $offset));
		$template_table = array('table_open' => '<table class="table table-hover">', );
		$this->table->set_template($template_table);
		$heading = array('No','Judul','Tanggal','Publish','Aksi');
		$this->table->set_heading($heading);

		$uri = 3;
		$offset = $this->uri->segment($uri);
		$this->load->library('pagination');
		$no = 0+$offset;
		$content = null;
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $rec) {
				$edit = anchor('infoakademik/admin/edit/'.$rec->id_info, '<span class="btn btn-default btn-xs glyphicon glyphicon-edit"></span>');
				$hapus = anchor('infoakademik/admin/hapus/'.$rec->id_info, '<span class="btn btn-default btn-xs glyphicon glyphicon-remove"></span>');
				$aksi = $edit.' '.$hapus;
				$no++;
				$row_table = array($no, $rec->title, $rec->date, $rec->publish, $aksi);
				$this->table->add_row($row_table);
			}
			//$this->pagination->initialize($conf);
		}
		else{
			//$data['pagination'] = "";
		}
		$data = array(
			'table' => $this->table->generate(), 
			'link_tambah' => site_url('infoakademik/admin/tambah'),
			'title' => $this->title
			);
		$this->template->set_layout('template_admin')
		->title($this->title)
		->build('admin/data', $data);
	}

	function tambah()
	{
		$data = array(
			'mode' => 'tambah', 
			'form_action' => site_url('infoakademik/admin/tambah_proses'),
			'title' => $this->title." <small>Tambah Data</small>",
		);
		$data['default'] = array(
			'date' => date('Y-m-d'),
			'publish' => null,
		);
		$this->template->set_layout('template_admin')
		->title($this->title)
		->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/js/ckeditor/ckeditor.js"></script>')
		->append_metadata('<link rel="stylesheet" type="text/css" href="'.base_url().'inventory/bootstrap/css/bootstrap-datetimepicker.min.css">')
		->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/bootstrap/js/moment.js"></script>')
		->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/bootstrap/js/bootstrap.datetimepicker.min.js"></script>')
		->build('admin/form', $data);
	}

	function tambah_proses()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Judul Informasi', 'required');
		$this->form_validation->set_rules('content', 'Konten', 'required');
		if ($this->form_validation->run() == false) {
			$this->tambah();
		}
		else{
			
			$data = array(
				'title' => $this->input->post('title'), 
				'content' => $this->input->post('content'),
				'publish' => $this->input->post('publish'),
				'date' => $this->input->post('date'),
				'slug' =>$this->fungsi->clean_url(strtolower($this->input->post('title')))
			);
			$this->m_info->insert($data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil Disimpan</div>');
			redirect('infoakademik/admin');
		}
	}

	function edit($id)
	{
		$query = $this->m_info->getById($id);
		if ($query->num_rows() > 0) {
			$rec = $query->row();
			$data = array(
				'mode' => 'edit',
				'title' => $this->title.' <small>Edit Data</small>',
				'form_action' => site_url('infoakademik/admin/edit_proses'),
			);
			$data['default'] = array(
				'id_info' => $rec->id_info,
				'title' => $rec->title,
				'content' => $rec->content,
				'publish' => $rec->publish,
				'date' => $rec->date,
			);
			$this->template->set_layout('template_admin')
			->title($this->title)
			->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/js/ckeditor/ckeditor.js"></script>')
			->append_metadata('<link rel="stylesheet" type="text/css" href="'.base_url().'inventory/bootstrap/css/bootstrap-datetimepicker.min.css">')
			->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/bootstrap/js/moment.js"></script>')
			->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/bootstrap/js/bootstrap.datetimepicker.min.js"></script>')
			->build('admin/form', $data);;
		}
		else {
			redirect('infoakademik/admin');
		}
	}

	function edit_proses()
	{
		$id = $this->input->post('id_info');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Judul Informasi', 'required');
		$this->form_validation->set_rules('content', 'Konten', 'required');
		if ($this->form_validation->run() == false) {
			$this->edit($id);
		}
		else{
			$data = array(
				'title' => $this->input->post('title'), 
				'content' => $this->input->post('content'),
				'publish' => $this->input->post('publish'),
				'date' => $this->input->post('date'),
				'slug' =>$this->fungsi->clean_url(strtolower($this->input->post('title')))
			);
			$this->m_info->update($id, $data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil Diupdate</div>');
			redirect('infoakademik/admin');
		}
	}

	function hapus($id)
	{
		$query = $this->m_info->getById($id);
		if ($query->num_rows() > 0) {
			$this->m_info->delete($id);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil Dihapus</div>');
		}
		redirect('infoakademik/admin');
	}

}

/* End of file admin.php */
/* Location: ./application/modules/infoakademik/controllers/admin.php */