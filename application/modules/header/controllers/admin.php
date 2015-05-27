<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller {
	var $title = "Header";
	public function __construct()
	{
		parent::__construct();
		if (Modules::run("fekon/cekLogin") == false) {
			$this->session->sess_destroy();
			redirect('404');
		}
		$this->load->model('M_header');
		$this->load->library('table');
		$this->load->library('fungsi');
		$this->load->library('clean_url');
	}
	public function index( $offset = 0 )
	{
		$perpage = 50;
		$query = $this->M_header->getAll(array('perpage' => $perpage, 'offset' => $offset));
		$template_table = array("table_open"=>"<table class='table table-hover'>");
		$this->table->set_template($template_table);
		$heading = array('No', 'Title','Publish', 'Aksi');
		$this->table->set_heading($heading);

		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		//load library pagination
		$this->load->library('pagination');
		//untuk konfigurasi pagination
		$config_paging = array(
			'base_url' => base_url().'header/admin/index',
			'total_rows' => $this->M_header->getAll()->num_rows(),
			'per_page' => $perpage,
			'uri_segment' => 4
		);

		$no = 0 + $offset;
		$content = null;
		if($query->num_rows() > 0){
			foreach ($query->result() as $record){
				$no++;
				$btn_edit = anchor('header/admin/edit/'.$record->id_header, '<span class="glyphicon glyphicon-edit"></span>', 'class="btn btn-default btn-xs"');
				$btn_hapus = anchor('header/admin/hapus/'.$record->id_header, '<span class="glyphicon glyphicon-remove"></span>', 'class="btn btn-default btn-xs hapus"');
				$aksi = $btn_edit.' '.$btn_hapus;
				$row_table = array(
					$no,
					$record->title,
					$record->publish,
					$aksi,
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
		$data['link_tambah'] = site_url('header/admin/tambah');
		$data['title'] = $this->title;
		$this->template->set_layout('template_admin')
		->title($this->title)
		->build('data_header', $data);
	}

	public function tambah()
	{
		$data['mode'] = 'tambah';
		$data['form_action'] = site_url('header/admin/tambah_proses');
		$data['title'] = $this->title." <small>Tambah Data</small>";
		$this->template->set_layout('template_admin')
		->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/js/ckeditor/ckeditor.js"></script>')
		->title($this->title)
		->build('form', $data);
	}
	function edit($id_header){
		$query = $this->M_header->getById($id_header);
		if ($query->num_rows() > 0) {
			$record = $query->row();
			$data['form_action'] = site_url('header/admin/edit_proses');
			$data['default']['id_header'] = $record->id_header;
			$data['default']['title'] = $record->title;
			$data['default']['image'] = $record->image;
			$data['default']['keterangan'] = $record->keterangan;
			$data['default']['publish'] = $record->publish;
			$data['mode'] = "edit";
			$data['title'] = 'Edit Data Header';
			$this->template->set_layout('template_admin')
			->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/js/ckeditor/ckeditor.js"></script>')
			->title($this->title)
			->build('form', $data);
		}
		else {
			redirect('news');
		}
	}
	function tambah_proses(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Judul Header', 'required|xss_clean');
		if ($this->form_validation->run() == FALSE){
			$this->tambah();
		}
		else {
			$dir_images = 'inventory/gambar/header/';
			$config['upload_path'] = $dir_images ;
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$config['encrypt_name'] = TRUE;		
			$config['max_size'] = '3000';
			$config['max_width'] = '3000';
			$config['max_height'] = '3000';		
			$this->load->library('upload', $config);
			$this->load->library('image_lib');

			if(is_uploaded_file($_FILES['image']['tmp_name'])){
				if( ! $this->upload->do_upload('image')){
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('msg_gambar', "<div class='alert alert-error'>".$error."</div>");
					redirect('header/admin/tambah');
					break;
				}
				else {
					$upload = $this->upload->data('image');
					$images = $upload['file_name'];

					$config_resize = array(
						'source_image' => $upload['full_path'],
						'new_image' => $dir_images.'thumb/',
						'maintain_ration' => true,
						'width' => 560,
						'height' => 251
					);

					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();

					$this->session->set_flashdata('msg_gambar', '<div class="alert alert-success">Gambar Berhasil di Proses</div>');
					$data['image'] = $images;
				}
			}
			$data['title'] = $this->input->post('title');
			$data['slug'] = $this->clean_url->create($data['title']);
			$data['keterangan'] = $this->input->post('keterangan');
			$data['publish'] = $this->input->post('publish');
			$insert = $this->M_header->insert($data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil di Tambah</div>');
			redirect('header/admin');
		}
	}
	function edit_proses(){
		$id = $this->input->post('id_header');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Judul Header', 'required|xss_clean');
		if ($this->form_validation->run() == FALSE){
			$this->edit($id);
		}
		else {
			$query = $this->M_header->getById($id);
			$rec = $query->row();
			$dir_images = 'inventory/gambar/header/';
			$config['upload_path'] = $dir_images ;
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$config['encrypt_name'] = TRUE;		
			$config['max_size'] = '3000';
			$config['max_width'] = '3000';
			$config['max_height'] = '3000';		
			$this->load->library('upload', $config);
			$this->load->library('image_lib');

			if(is_uploaded_file($_FILES['image']['tmp_name'])){
				if (file_exists($dir_images.$rec->image)) {
					unlink($dir_images.$rec->image);
					if (file_exists($dir_images.'thumb/'.$rec->image)) {
						unlink($dir_images.'thumb/'.$rec->image);
					}
				}
				if( ! $this->upload->do_upload('image')){
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('msg_gambar', "<div class='alert alert-error'>".$error."</div>");
					redirect('header/admin/tambah');
					break;
				}
				else {
					$upload = $this->upload->data('image');
					$images = $upload['file_name'];

					$config_resize = array(
						'source_image' => $upload['full_path'],
						'new_image' => $dir_images.'thumb/',
						'maintain_ration' => true,
						'width' => 560,
						'height' => 251
					);

					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();

					$this->session->set_flashdata('msg_gambar', '<div class="alert alert-success">Gambar Berhasil di Proses</div>');
					$data['image'] = $images;
				}
			}
			$data['title'] = $this->input->post('title');
			$data['slug'] = $this->clean_url->create($data['title']);
			$data['keterangan'] = $this->input->post('keterangan');
			$data['publish'] = $this->input->post('publish');
			$insert = $this->M_header->update($id,$data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil di Update</div>');
			redirect('header/admin');
		}
	}

	function hapus($id){
		$query = $this->M_header->getById($id);
		$rec = $query->row();
		$dir_images = 'inventory/gambar/header/';
		if (file_exists($dir_images.$rec->image)) {
			unlink($dir_images.$rec->image);
			if (file_exists($dir_images.'thumb/'.$rec->image)) {
				unlink($dir_images.'thumb/'.$rec->image);
			}
		}
		if ($query->num_rows() > 0) {
			$this->M_header->delete($id);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil di Hapus</div>');
		}
		redirect('header/admin');
	}

}

/* End of file admin.php */
/* Location: ./application/modules/header/controllers/admin.php */