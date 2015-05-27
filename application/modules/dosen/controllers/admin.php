<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller {
	var $title = "Staf Pengajar";
	public function __construct()
	{
		parent::__construct();
		echo Modules::run("fekon/cekLogin");
		$this->load->model('M_dosen');
		$this->load->model('prodi/M_prodi');
		$this->load->library('table');
		// Modules::run('login/cek_login');
	}

	public function index( $offset = 0 )
	{
		$perpage = 50;
		$query = $this->M_dosen->getAll(array('perpage' => $perpage, 'offset' => $offset));
		$template_table = array("table_open"=>"<table class='table table-hover'>");
		$this->table->set_template($template_table);
		$heading = array('No', 'Nama', 'Program', 'Staf', 'Aksi');
		$this->table->set_heading($heading);

		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		//load library pagination
		$this->load->library('pagination');
		//untuk konfigurasi pagination
		$config_paging = array(
			'base_url' => base_url().'dosen/admin/index',
			'total_rows' => $this->M_dosen->getAll()->num_rows(),
			'per_page' => $perpage,
			'uri_segment' => 4
		);

		$no = 0 + $offset;
		$content = null;
		if($query->num_rows() > 0){
			foreach ($query->result() as $record){
				$no++;
				$btn_edit = anchor('dosen/admin/edit/'.$record->id_dosen, '<span class="glyphicon glyphicon-edit"></span>', 'class="btn btn-default btn-xs"');
				$btn_hapus = anchor('dosen/admin/hapus/'.$record->id_dosen, '<span class="glyphicon glyphicon-remove"></span>', 'class="btn btn-default btn-xs hapus"');
				$aksi = $btn_edit.' '.$btn_hapus;
				$staf = 'Dosen Untan';
				if ($record->staf == 2) {
					$staf = 'Dosen Luar';
				}
				$row_table = array(
					$no,
					$record->nama,
					$record->prodi,
					$staf,
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
		$data['combobox_prodi'] = $this->M_prodi->combobox($this->session->userdata('dosen_id_prodi'));
		$data['table'] = $this->table->generate();
		$data['link_tambah'] = site_url('dosen/admin/tambah');
		$data['title'] = $this->title;
		$this->template->set_layout('template_admin')
		->title($this->title)
		->build('data', $data);
	}

	public function tambah()
	{
		$data['mode'] = 'tambah';
		$data['form_action'] = site_url('dosen/admin/tambah_proses');
		$data['combobox_prodi'] = $this->M_prodi->combobox();
		$data['title'] = $this->title." <small>Tambah Data</small>";
		$this->template->set_layout('template_admin')
		->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/js/ckeditor/ckeditor.js"></script>')
		->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/bootstrap/js/moment.js"></script>')
		->title($this->title)
		->build('form', $data);
	}

	function tambah_proses(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama Dosen', 'required|xss_clean');
		if ($this->form_validation->run() == FALSE){
			$this->tambah();
		}
		else {
			$dir_images = 'inventory/gambar/dosen/';
			$config['upload_path'] = $dir_images ;
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$config['encrypt_name'] = TRUE;		
			$config['max_size'] = '4096';
			$config['max_width'] = '2048';
			$config['max_height'] = '2048';		
			$this->load->library('upload', $config);
			$this->load->library('image_lib');

			if(is_uploaded_file($_FILES['img']['tmp_name'])){
				if( ! $this->upload->do_upload('img')){
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('msg_gambar', "<div class='alert alert-error'>".$error."</div>");
					redirect('dosen/admin/tambah');
					break;
				}
				else {
					$upload = $this->upload->data('img');
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
					$data['img'] = $images;
				}
			}
			$data['id_prodi'] = $this->input->post('id_prodi');
			$data['nama'] = $this->input->post('nama');
			$data['slug'] = $this->fungsi->clean_url(strtolower($this->input->post('nama')));
			$data['alamat'] = $this->input->post('alamat');
			$data['telp'] = $this->input->post('telp');
			$data['email'] = $this->input->post('email');
			$data['staf'] = $this->input->post('staf');
			$insert = $this->M_dosen->insert($data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil di Tambah</div>');
			redirect('dosen/admin');
		}
	}

	public function edit($id){	
		$query = $this->M_dosen->getById($id);
		if($query->num_rows()>0){
			$record = $query->row();
			$data['mode'] = 'edit';
			$data['form_action'] = site_url('dosen/admin/edit_proses');
			$data['default']['id_dosen'] = $record->id_dosen;
			$data['combobox_prodi'] = $this->M_prodi->combobox($record->id_prodi);
			$data['default'] = array(
				'id_dosen' =>$record->id_dosen, 
				'staf' => $record->staf, 
				'img' => $record->img, 
				'nama' => $record->nama, 
				'telp' => $record->telp, 
				'email' => $record->email, 
				'alamat' => $record->alamat,  
			);
			$data['title'] = $this->title." <small>Edit Data</small>";
			$this->template->set_layout('template_admin')
			->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/js/ckeditor/ckeditor.js"></script>')
			->title($this->title)
			->build('form', $data);
		}
		else {
			redirect('dosen/admin');
		}
	}
	function edit_proses(){
		$id_dosen = $this->input->post('id_dosen');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama Dosen', 'required|xss_clean');
		if ($this->form_validation->run() == FALSE){
			$this->edit($id_dosen);
		}
		else {
			$query = $this->M_dosen->getById($id_dosen);
			$rec = $query->row();
			$dir_images = 'inventory/gambar/dosen/';
			if (!empty($_FILES['img']['tmp_name'])) {
				if (file_exists($dir_images.$rec->img)) {
					unlink($dir_images.$rec->img);
					if (file_exists($dir_images.'thumb/'.$rec->img)) {
						unlink($dir_images.'thumb/'.$rec->img);
					}
				}
			}
				
			$config['upload_path'] = $dir_images ;
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$config['encrypt_name'] = TRUE;		
			$config['max_size'] = '4096';
			$config['max_width'] = '2048';
			$config['max_height'] = '2048';		
			$this->load->library('upload', $config);
			$this->load->library('image_lib');

			if(is_uploaded_file($_FILES['img']['tmp_name'])){
				if( !$this->upload->do_upload('img')){
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('msg_gambar', "<div class='alert alert-error'>".$error."</div>");
					redirect('dosen/admin/edit/'.$this->input->post('id_dosen'));
					break;
				}
				else {
					$upload = $this->upload->data('img');
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
					$data['img'] = $images;
				}
			}
			$data['id_prodi'] = $this->input->post('id_prodi');
			$data['nama'] = $this->input->post('nama');
			$data['slug'] = $this->fungsi->clean_url(strtolower($this->input->post('nama')));
			$data['alamat'] = $this->input->post('alamat');
			$data['telp'] = $this->input->post('telp');
			$data['email'] = $this->input->post('email');
			$data['staf'] = $this->input->post('staf');
			$this->M_dosen->update($id_dosen,$data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil di Update</div>');
			redirect('dosen/admin');
		}
	}

	public function cari_berdasarkan_prodi()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_prodi', 'Prodi', 'required');
		if ($this->form_validation->run()==TRUE) {
			$array = array(
				'dosen_id_prodi' => $this->input->post('id_prodi')
			);
			$this->session->set_userdata($array);
		}
		else {
			$this->session->unset_userdata('dosen_id_prodi');
		}
	}
	public function hapus($id)
	{
		$query = $this->M_dosen->getById($id);
		$rec = $query->row();
		$dir_images = 'inventory/gambar/dosen/';
		if (file_exists($dir_images.$rec->img)) {
			unlink($dir_images.$rec->img);
			if (file_exists($dir_images.'thumb/'.$rec->img)) {
				unlink($dir_images.'thumb/'.$rec->img);
			}
		}
		if($query->num_rows()>0){
			$this->M_dosen->delete($id);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Data Berhasil di Hapus
			</div>');
		}
		redirect('dosen/admin');
	}
	public function combobox_dosen($id_prodi)
	{
		echo $this->M_dosen->combobox($id_prodi);
	}
}

/* End of file dosen.php */
/* Location: ./application/modules/dosen/controllers/dosen.php */
