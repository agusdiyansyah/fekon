<?php 
class Admin extends MX_Controller {
	var $title = "Data Galeri Foto";
	function Admin(){
		parent::__construct();
		echo Modules::run("fekon/cekLogin");
		$this->load->model('M_gallery');
		$this->load->model('M_cat');
		$this->load->library('clean_url');
		$this->load->library('table');
	}
	function index($offset = 0){				
		$perpage = 50;
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		//load library pagination
		$this->load->library('pagination');
		//untuk konfigurasi pagination
		$config_paging = array(
			'base_url' => site_url('gallery/index/'),
			'total_rows' => $this->M_gallery->getAll()->num_rows(),
			'per_page' => $perpage,
			'last_link' => 'terakhir',
			'first_link' => 'awal'
		);
		$this->pagination->initialize($config_paging);
		$data['pagination'] = $this->pagination->create_links();		
		//Keterangan Pencarian
		if ($this->session->userdata('galleryCari') == "ada") {
			$data['cari']['status'] = 'ada';
		}
		else {
			$data['cari']['status'] = 'tidak';
		}
		$data['cari']['title'] = $this->session->userdata('galleryCari_title');
		 
		if ($this->session->userdata('galleryCari_category')){
			$data['cari']['category'] = $this->M_gallery->getCat($this->session->userdata('galleryCari_category'));
		}
		else {
			$data['cari']['category'] = null;
		}

		$gallery = $this->M_gallery->getAll(array('perpage' => $perpage, 'offset'=>$offset));
		$gallery_list = "";
		$no = 0 + $offset;
		foreach ($gallery->result() as $record){
			$no++;
			$edit = anchor('gallery/admin/edit/'.$record->id_gallery, '<i class="fa fa-edit"></i>', 'class="btn btn-success btn-xs" title="edit"');
			$hapus = anchor('gallery/admin/hapus/'.$record->id_gallery, '<span class="glyphicon glyphicon-remove"></span>', 'class="hapus btn btn-danger btn-xs" title="hapus"');
			
			$gallery_list .= '<tr class="barisdata">';
			$gallery_list .= '<td>'.$no.'</td>';
			$gallery_list .= '<td>'.$record->title.'</td>';
			$gallery_list .= '<td>'.$record->name_category.'</td>';
			$gallery_list .= '<td>'.$edit.' '.$hapus.'</td>';
			$gallery_list .= '</tr>';
		}
		$data['gallery_list'] = $gallery_list;
		$data['title'] = "Data Galeri";
		$this->template->set_layout('template_admin')
		->title($this->title)
		->build('admin/data', $data);
	}
	function tambah(){
		$data['form_action'] = site_url('gallery/admin/tambah_proses');
		$data['category'] = $this->M_cat->combobox();
		$data['default']['image'] = null;
		$data['title'] = 'Tambah Data Galeri';
		$data['mode'] = 'tambah';
		$this->template->set_layout('template_admin')
		->title($this->title)
		->build('admin/form', $data);
	}
	function tambah_proses(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Judul Galeri', 'required|xss_clean');
		$this->form_validation->set_rules('id_category', 'Kategori Galeri', 'required|xss_clean');
		if ($this->form_validation->run() == FALSE){
			$this->tambah();
		}
		else {
			$dir_images = 'inventory/gambar/gallery/';
			$config['upload_path'] = $dir_images ;
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$config['encrypt_name'] = TRUE;		
			$config['max_size'] = '3072';
			$config['max_width'] = '3072';
			$config['max_height'] = '3072';		
			$this->load->library('upload', $config);
			$this->load->library('image_lib');

			if(is_uploaded_file($_FILES['userfile']['tmp_name'])){
				if( ! $this->upload->do_upload('userfile')){
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('msg_gambar', "<div class='alert alert-error'>".$error."</div>");
					redirect('gallery/admin/tambah');
					break;
				}
				else {
					$upload = $this->upload->data('userfile');
					$images = $upload['file_name'];

					$config_resize = array(
					'source_image' => $upload['full_path'],
					'new_image' => $dir_images.'thumb/',
					'maintain_ration' => false,
					'width' => 270,
					'height' => 272
					);

					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();

					$this->session->set_flashdata('msg_gambar', '<div class="alert alert-success">Gambar Berhasil di Proses</div>');
					$data['image'] = $images;
				}
			}
			$data['title'] = $this->input->post('title');
			$data['content'] = $this->input->post('content');
			$data['clean_url'] = $this->clean_url->create($data['title']);
			$data['id_category'] = $this->input->post('id_category');
			$insert = $this->M_gallery->insert($data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil di Tambah</div>');
			redirect('gallery/admin');
		}
	}
	function edit($id_gallery){
		$query = $this->M_gallery->getById($id_gallery);
		if ($query->num_rows() > 0) {
			$record = $query->row();
			$data['form_action'] = site_url('gallery/admin/edit_proses');
			$data['default']['id_gallery'] = $record->id_gallery;
			$data['category'] = $this->M_cat->combobox($record->id_category);
			$data['default']['title'] = $record->title;
			$data['default']['content'] = $record->content;
			
			$data['default']['image'] = $record->image;
			$data['mode'] = "edit";
			$data['title'] = 'Edit Data Galeri';
			$this->template->set_layout('template_admin')
			->title($this->title)
			->build('admin/form', $data);
		}
		else {
			redirect('gallery/admin');
		}
	}
	function edit_proses(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Judul Galeri', 'required|xss_clean');
		if ($this->form_validation->run() == FALSE){
			$id_gallery = $this->input->post('id_gallery');
			$this->edit($id_gallery);
		}
		else {
			$query = $this->M_gallery->getById($id_gallery);
			$rec = $query->row();
			$dir_images = 'inventory/gambar/dosen/';
			if (file_exists($dir_images.$rec->image)) {
				unlink($dir_images.$rec->image);
				if (file_exists($dir_images.'thumb/'.$rec->image)) {
					unlink($dir_images.'thumb/'.$rec->image);
				}
			}
			$dir_images = 'inventory/gambar/gallery/';
			$config['upload_path'] = $dir_images ;
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$config['encrypt_name'] = TRUE;		
			$config['max_size'] = '2048';
			$config['max_width'] = '2048';
			$config['max_height'] = '800';		
			$this->load->library('upload', $config);
			$this->load->library('image_lib');

			if(is_uploaded_file($_FILES['userfile']['tmp_name'])){
				if( !$this->upload->do_upload('userfile')){
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('msg_gambar', "<div class='alert alert-error'>".$error."</div>");
					redirect('gallery/admin/edit/'.$this->input->post('id_gallery'));
					break;
				}
				else {
					$upload = $this->upload->data('userfile');
					$images = $upload['file_name'];

					$config_resize = array(
					'source_image' => $upload['full_path'],
					'new_image' => $dir_images.'thumb/',
					'maintain_ration' => true,
					'width' => 270,
					'height' => 272
					);

					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();

					$this->session->set_flashdata('msg_gambar', '<div class="alert alert-success">Gambar Berhasil di Proses</div>');
					$data['image'] = $images;
				}
			}
			$id_gallery = $this->input->post('id_gallery');
			$data['title'] = $this->input->post('title');
			$data['content'] = $this->input->post('content');
			$data['clean_url'] = $this->clean_url->create($data['title']);
			$data['id_category'] = $this->input->post('id_category');

			$this->M_gallery->update($id_gallery, $data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Proses Edit Berhasil</div>');
			redirect('gallery/admin');
		}
	}
	function hapus($id_gallery){
		$query = $this->M_gallery->getById($id_gallery);
		$rec = $query->row();
		$dir_images = 'inventory/gambar/dosen/';
		if (file_exists($dir_images.$rec->image)) {
			unlink($dir_images.$rec->image);
			if (file_exists($dir_images.'thumb/'.$rec->image)) {
				unlink($dir_images.'thumb/'.$rec->image);
			}
		}
		if ($query->num_rows() > 0) {
			$this->M_gallery->delete($id_gallery);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil di Hapus</div>');
		}
		redirect('gallery/admin');
	}
	function cari(){
		$data['form_action'] = site_url('gallery/admin/cari_proses');
		$data['default']['title'] = $this->session->userdata('galleryCari_title');
		$data['category'] = $this->M_cat->combobox($this->session->userdata('galleryCari_category'));
		$this->load->view('admin/form_cari', $data);
	}
	function cari_proses($reset=""){
		if ($reset=="reset") {
			$data['galleryCari'] = "";
			$data['galleryCari_title'] = "";
			$data['galleryCari_category'] = "";
			$this->session->set_userdata($data);
		}
		else {
			$data['galleryCari'] = "ada";
			$data['galleryCari_title'] = $this->input->post('title');
			$data['galleryCari_category'] = $this->input->post('id_category');
			$this->session->set_userdata($data);			
		}		
	}

}