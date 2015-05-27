<?php 
class Admin extends MX_Controller {
	var $title = "Manajemen Data Profil";
	function Admin(){
		parent::__construct();
		// Modules::run('login/cek_login');
		echo Modules::run("fekon/cekLogin");
		$this->load->library('indo_date');
		$this->load->library('table');
		$this->load->model('M_profil');
		$this->load->library('clean_url');
	}
	function index($offset = 0){				
		$profil = $this->M_profil->getAll();
		$profil_list = "";
		$no = 0 ;

		$template_table = array("table_open"=>"<table class='table table-hover'>");
		$this->table->set_template($template_table);
		$heading = array('No', 'Judul', 'Aksi');
		$this->table->set_heading($heading);
		foreach ($profil->result() as $record){
			$no++;
			$edit = anchor('profil/admin/edit/'.$record->id_profil, '<i class="fa fa-edit"></i>', 'class="btn btn-success btn-xs" title="edit"');
			$hapus = anchor('profil/admin/hapus/'.$record->id_profil, 'x', 'class="hapus btn btn-danger btn-xs" title="hapus"');
			$this->table->add_row(
				$no,
				$record->title,
				$edit.' '.$hapus
			);
		}
		$data['table'] = $this->table->generate();
		$data['title'] = "Data Profil";
		$data['link_tambah'] = site_url('profil/admin/tambah');
		$this->template->set_layout('template_admin')
		->title($this->title)
		->build('admin/data', $data);
	}
	function tambah(){
		$data['form_action'] = site_url('profil/admin/tambah_proses');
		$data['title'] = 'Tambah Data Profil';
		$data['mode'] = 'tambah';
		$this->template->set_layout('template_admin')
		->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/js/ckeditor/ckeditor.js"></script>')
		->title($this->title)
		->build('admin/form', $data);
	}
	function tambah_proses(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Judul Berita', 'required|xss_clean');
		if ($this->form_validation->run() == FALSE){
			$this->tambah();
		}
		else {
			$dir_images = 'inventory/gambar/profil/';
			$config['upload_path'] = $dir_images ;
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$config['encrypt_name'] = TRUE;		
			$config['max_size'] = '1024';
			$config['max_width'] = '1024';
			$config['max_height'] = '800';		
			$this->load->library('upload', $config);
			$this->load->library('image_lib');

			if(is_uploaded_file($_FILES['userfile']['tmp_name'])){
				if( ! $this->upload->do_upload('userfile')){
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('msg_gambar', "<div class='alert alert-error'>".$error."</div>");
					redirect('profil/admin/tambah');
					break;
				}
				else {
					$upload = $this->upload->data('userfile');
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
			$data['content'] = $this->input->post('content');
			$data['clean_url'] = $this->fungsi->clean_url(strtolower($data['title']));
			$insert = $this->M_profil->insert($data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil di Tambah</div>');
			redirect('profil/admin');
		}
	}
	function edit($id_profil){
		$query = $this->M_profil->getById($id_profil);
		if ($query->num_rows() > 0) {
			$record = $query->row();
			$data['form_action'] = site_url('profil/admin/edit_proses');
			$data['default']['id_profil'] = $record->id_profil;
			$data['default']['title'] = $record->title;
			$data['default']['content'] = $record->content;
			$data['default']['image'] = $record->image;
			$data['mode'] = "edit";
			$data['title'] = 'Edit Data Profil';
			$this->template->set_layout('template_admin')
			->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/js/ckeditor/ckeditor.js"></script>')
			->title($this->title)
			->build('admin/form', $data);
		}
		else {
			redirect('profil');
		}
	}
	function edit_proses(){
		$id_profil = $this->input->post('id_profil');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Profil', 'required|xss_clean');
		if ($this->form_validation->run() == FALSE){
			$this->edit($id_profil);
		}
		else {
			$dir_images = 'inventory/gambar/profil/';
			$config['upload_path'] = $dir_images ;
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$config['encrypt_name'] = TRUE;		
			$config['max_size'] = '1024';
			$config['max_width'] = '1024';
			$config['max_height'] = '800';		
			$this->load->library('upload', $config);
			$this->load->library('image_lib');

			if(is_uploaded_file($_FILES['userfile']['tmp_name'])){
				if( ! $this->upload->do_upload('userfile')){
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('msg_gambar', "<div class='alert alert-error'>".$error."</div>");
					redirect('profil/admin/edit/'.$id_profil);
					break;
				}
				else {
					$upload = $this->upload->data('userfile');
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
			$data['clean_url'] = $this->fungsi->clean_url(strtolower($data['title']));
			$data['content'] = $this->input->post('content');

			$this->M_profil->update($id_profil, $data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Proses Edit Berhasil</div>');
			redirect('profil/admin');
		}
	}
	function hapus($id_profil){
		$query = $this->M_profil->getById($id_profil);
		if ($query->num_rows() > 0) {
			$this->M_profil->delete($id_profil);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil di Hapus</div>');
		}
		redirect('profil/admin');
	}
}
?>