<?php 
class Admin extends MX_Controller {
	var $title = "Manajemen Data Berita";
	function Admin(){
		parent::__construct();
		// Modules::run('login/cek_login');
		echo Modules::run("fekon/cekLogin");
		$this->load->library('indo_date');
		$this->load->library('table');
		$this->load->model('M_news');
		$this->load->library('clean_url');
	}
	function index($offset = 0){				
		$perpage = 50;
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		//load library pagination
		$this->load->library('pagination');
		//untuk konfigurasi pagination
		$config_paging = array(
			'base_url' => base_url().'news/admin/index/',
			'total_rows' => $this->M_news->getAll()->num_rows(),
			'per_page' => $perpage,
			'last_link' => 'terakhir',
			'first_link' => 'awal',
			'uri_segment' => $uri_segment
		);
		$this->pagination->initialize($config_paging);
		$data['pagination'] = $this->pagination->create_links();		
		//Keterangan Pencarian
		if ($this->session->userdata('newsCari') == "ada") {
			$data['cari']['status'] = 'ada';
		}
		else {
			$data['cari']['status'] = 'tidak';
		}
		$data['cari']['title'] = $this->session->userdata('newsCari_title');
		$data['cari']['dateStart'] = $this->session->userdata('newsCari_dateStart');
		$data['cari']['dateEnd'] = $this->session->userdata('newsCari_dateEnd');
		$data['cari']['publish'] = $this->session->userdata('newsCari_publish');
		if ($this->session->userdata('newsCari_admin')) {
			$data['cari']['admin'] = $this->M_news->getAdmin($this->session->userdata('newsCari_admin'));
		}
		else {
			$data['cari']['admin'] = null;
		}

		$news = $this->M_news->getAll(array('perpage' => $perpage, 'offset'=>$offset));
		$news_list = "";
		$no = 0 + $offset;

		$template_table = array("table_open"=>"<table class='table table-hover'>");
		$this->table->set_template($template_table);
		$heading = array('No', 'Judul', 'Tanggal', 'Admin', 'Publish', 'Aksi');
		$this->table->set_heading($heading);
		foreach ($news->result() as $record){
			$no++;
			$edit = anchor('news/admin/edit/'.$record->id_news, '<i class="fa fa-edit"></i>', 'class="btn btn-success btn-xs" title="edit"');
			$hapus = anchor('news/admin/hapus/'.$record->id_news, 'x', 'class="hapus btn btn-danger btn-xs" title="hapus"');
			$this->table->add_row(
				$no,
				$record->title,
				$this->indo_date->tgl_indo($record->date).'<br><small>'.$record->time.'</small>',
				$record->fullname,
				$record->publish,
				$edit.' '.$hapus
			);
		}
		$data['table'] = $this->table->generate();
		$data['title'] = "Data Berita";
		$data['link_tambah'] = site_url('news/admin/tambah');
		$this->template->set_layout('template_admin')
		->title($this->title)
		->build('admin/data', $data);
	}
	function tambah(){
		date_default_timezone_set("Asia/Jakarta");     	
		$data['form_action'] = site_url('news/admin/tambah_proses');
		$level = $this->session->userdata('level');		
		if ($level == 1) {
			$data['administrator'] = $this->M_news->dropdownAdmin('id_admin');
		}
		else {
			$data['administrator'] = $this->session->userdata('fullname');
		}
		$data['default']['publish'] = null;
		$data['default']['date'] = date('Y-m-d');
		$data['default']['time'] = date('H:i:s');
		$data['title'] = 'Tambah Data Berita';
		$data['mode'] = 'tambah';
		$this->template->set_layout('template_admin')
		->append_metadata('<link href="'.base_url().'inventory/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />')
		->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/bootstrap/js/moment.js"></script>')
		->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/bootstrap/js/bootstrap.datetimepicker.min.js"></script>')
		->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/js/ckeditor/ckeditor.js"></script>')
		->title($this->title)
		->build('admin/form', $data);
	}
	function tambah_proses(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Judul Berita', 'required|xss_clean');
		$this->form_validation->set_rules('content', 'Isi Berita', 'required');
		$this->form_validation->set_rules('date', 'Tanggal Berita', 'required|xss_clean');
		if ($this->form_validation->run() == FALSE){
			$this->tambah();
		}
		else {
			$dir_images = 'inventory/gambar/news/';
			$config['upload_path'] = $dir_images ;
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$config['encrypt_name'] = TRUE;		
			$config['max_size'] = '1024';
			$config['max_width'] = '1366';
			$config['max_height'] = '800';		
			$this->load->library('upload', $config);
			$this->load->library('image_lib');

			if(is_uploaded_file($_FILES['userfile']['tmp_name'])){
				if( ! $this->upload->do_upload('userfile')){
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('msg_gambar', "<div class='alert alert-error'>".$error."</div>");
					redirect('news/admin/tambah');
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
			$data['clean_url'] = $this->clean_url->create($data['title']);
			$data['content'] = $this->input->post('content');
			$level = $this->session->userdata('level');		
			if ($level == 1) {
				$data['id_admin'] = $this->input->post('id_admin');
			}
			else {
				$data['id_admin'] = $this->session->userdata('id_admin');
			}
			$data['publish'] = $this->input->post('publish');
			$data['date'] = $this->input->post('date');
			$data['time'] = $this->input->post('time');
			$data['clean_url'] = $this->fungsi->clean_url(strtolower($data['title']));
			$insert = $this->M_news->insert($data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil di Tambah</div>');
			redirect('news/admin');
		}
	}
	function edit($id_news){
		$query = $this->M_news->whereId($id_news);
		if ($query->num_rows() > 0) {
			$record = $query->row();
			$data['form_action'] = site_url('news/admin/edit_proses');
			$data['default']['id_news'] = $record->id_news;
			$data['default']['title'] = $record->title;
			$data['default']['content'] = $record->content;
			$level = $this->session->userdata('level');	

			// if ($level == 1) {
			// 	$data['administrator'] = $this->M_news->dropdownAdmin('id_admin', $record->id_admin);
			// }
			// else {
			// 	$data['administrator'] = $this->session->userdata('fullname');
			// }
			$data['administrator'] = $this->session->userdata('fullname');
			$data['default']['publish'] = $record->publish;
			$data['default']['date'] = $record->date;
			$data['default']['time'] = $record->time;
			$data['default']['image'] = $record->image;
			$data['mode'] = "edit";
			$data['title'] = 'Edit Data Berita';
			$this->template->set_layout('template_admin')
			->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/js/ckeditor/ckeditor.js"></script>')
			->title($this->title)
			->build('admin/form', $data);
		}
		else {
			redirect('news');
		}
	}
	function edit_proses(){
		$id_news = $this->input->post('id_news');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Judul Berita', 'required|xss_clean');
		$this->form_validation->set_rules('content', 'Isi Berita', 'required');
		$this->form_validation->set_rules('date', 'Tanggal Berita', 'required|xss_clean');
		if ($this->form_validation->run() == FALSE){
			$this->edit($id_news);
		}
		else {
			$dir_images = 'inventory/gambar/news/';
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
					redirect('news/admin/edit/'.$id_news);
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
			$data['clean_url'] = $this->clean_url->create($data['title']);
			$data['content'] = $this->input->post('content');
			$level = $this->session->userdata('level');
			if ($level == 1) {
				$data['id_admin'] = $this->input->post('id_admin');
			}
			else {
				$data['id_admin'] = $this->session->userdata('id_admin');
			}
			$data['publish'] = $this->input->post('publish');
			$data['date'] = $this->input->post('date');
			$data['time'] = $this->input->post('time');

			$this->M_news->update($id_news, $data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Proses Edit Berhasil</div>');
			redirect('news/admin');
		}
	}
	function hapus($id_news){
		$query = $this->M_news->whereId($id_news);
		if ($query->num_rows() > 0) {
			$this->M_news->delete($id_news);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil di Hapus</div>');
		}
		redirect('news/admin');
	}
	function cari(){
		$data['form_action'] = site_url('news/admin/cari_proses');
		$data['default']['title'] = $this->session->userdata('newsCari_title');
		$data['default']['dateStart'] = $this->session->userdata('newsCari_dateStart');
		$data['default']['dateEnd'] = $this->session->userdata('newsCari_dateEnd');
		$data['administrator'] = $this->M_news->dropdownAdmin('id_admin', $this->session->userdata('newsCari_admin'));
		$opt_pub = array(''=>'::Pilih Publish::', 'y'=>'Y','n'=>'N');
		$data['publish'] = form_dropdown('publish', $opt_pub, $this->session->userdata('newsCari_publish'));
		$this->load->view('admin/form_cari', $data);
	}
	function cari_proses($reset=""){
		if ($reset=="reset") {
			$data['newsCari'] = "";
			$data['newsCari_title'] = "";
			$data['newsCari_dateStart'] = "";
			$data['newsCari_dateEnd'] = "";
			$data['newsCari_publish'] = "";
			$data['newsCari_admin'] = "";
			$this->session->set_userdata($data);
		}
		else {
			$data['newsCari'] = "ada";
			$data['newsCari_title'] = $this->input->post('title');
			$data['newsCari_dateStart'] = $this->input->post('dateStart');
			$data['newsCari_dateEnd'] = $this->input->post('dateEnd');
			$data['newsCari_admin'] = $this->input->post('id_admin');
			$data['newsCari_publish'] = $this->input->post('publish');
			$this->session->set_userdata($data);			
		}		
	}
	function clean_url(){
		$this->load->library('fungsi');
		$query = $this->M_news->getAll();
		foreach ($query->result() as $r) {
			$clean_url = strtolower($this->fungsi->clean_url($r->title));
			$data['clean_url'] = $clean_url;
			$this->M_news->update($r->id_news, $data);
		}
	}
}
?>