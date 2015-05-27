<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller {
	var $title = "Upload File";
	public function __construct()
	{
		parent::__construct();
		echo Modules::run("fekon/cekLogin");
		$this->load->model('M_upload');
		$this->load->library('table');
		// Modules::run('login/cek_login');
	}

	public function index( $offset = 0 )
	{
		$perpage = 50;
		$query = $this->M_upload->getAll(array('perpage' => $perpage, 'offset' => $offset));
		$template_table = array("table_open"=>"<table class='table table-hover'>");
		$this->table->set_template($template_table);
		$heading = array('No', 'Nama File','Show on Foother', 'Aksi');
		$this->table->set_heading($heading);

		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		//load library pagination
		$this->load->library('pagination');
		//untuk konfigurasi pagination
		$config_paging = array(
			'base_url' => base_url().'upload/admin/index',
			'total_rows' => $this->M_upload->getAll()->num_rows(),
			'per_page' => $perpage,
			'uri_segment' => 4
		);

		$no = 0 + $offset;
		$content = null;
		if($query->num_rows() > 0){
			foreach ($query->result() as $record){
				$no++;
				$btn_down = anchor('upload/admin/down/'.$record->id_upload, '<span class="glyphicon glyphicon-download-alt"></span>', 'class="btn btn-default btn-xs"');
				$btn_edit = anchor('upload/admin/edit/'.$record->id_upload, '<span class="glyphicon glyphicon-edit"></span>', 'class="btn btn-default btn-xs"');
				$btn_hapus = anchor('upload/admin/hapus/'.$record->id_upload, '<span class="glyphicon glyphicon-remove"></span>', 'class="btn btn-default btn-xs hapus"');
				$aksi = $btn_down.' '.$btn_edit.' '.$btn_hapus;
				$row_table = array(
					$no,
					$record->nama,
					$record->foot,
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
		$data['link_tambah'] = site_url('upload/admin/tambah');
		$data['title'] = $this->title;
		$this->template->set_layout('template_admin')
		->title($this->title)
		->build('data', $data);
	}

	public function tambah()
	{
		$data['mode'] = 'tambah';
		$data['form_action'] = site_url('upload/admin/tambah_proses');
		$data['title'] = $this->title." <small>Tambah Data</small>";
		$this->template->set_layout('template_admin')
		->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/js/ckeditor/ckeditor.js"></script>')
		->title($this->title)
		->build('form', $data);
	}

	function tambah_proses(){
		$name = $_FILES['doc']['name'];
		$dir_file = 'inventory/file/doc/';
		$config['upload_path'] = $dir_file ;
		$config['allowed_types'] = 'pdf|doc|docx';
		$config['encrypt_name'] = TRUE;		
		$config['max_size'] = '5120';
		$this->load->library('upload', $config);

		if(is_uploaded_file($_FILES['doc']['tmp_name'])){
			if( ! $this->upload->do_upload('doc')){
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('msg_gambar', "<div class='alert alert-error'>".$error."</div>");
				redirect('upload/admin/tambah');
				break;
			}
			else {
				$upload = $this->upload->data('doc');
				$file = $upload['file_name'];

				$this->session->set_flashdata('msg_gambar', '<div class="alert alert-success">File Berhasil di Upload</div>');
				$data['file'] = $file;
			}
		}
		$data['nama'] = $name;
		$data['foot'] = $this->input->post('foot');
		$insert = $this->M_upload->insert($data);
		$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil di Tambah</div>');
		redirect('upload/admin');
	}

	public function edit($id){	
		$query = $this->M_upload->getById($id);
		if($query->num_rows()>0){
			$record = $query->row();
			$data['mode'] = 'edit';
			$data['form_action'] = site_url('upload/admin/edit_proses');
			$data['default'] = array(
				'id_upload' =>$record->id_upload, 
				'nama' =>$record->nama, 
				'foot' =>$record->foot, 
			);
			$data['title'] = $this->title." <small>Edit Data</small>";
			$this->template->set_layout('template_admin')
			->title($this->title)
			->build('form', $data);
		}
		else {
			redirect('uploads/admin');
		}
	}
	function edit_proses(){
		$id_upload = $this->input->post('id_upload');
		$query = $this->M_upload->getById($id_upload);
		$rec = $query->row();
		$dir_file = 'inventory/file/doc/';
		if (file_exists($dir_file.$rec->file)) {
			unlink($dir_file.$rec->file);
		}
		$name = $_FILES['doc']['name'];
		if (empty($name)) {
			$name = $this->input->post('nama');
		}
		$dir_file = 'inventory/file/doc/';
		$config['upload_path'] = $dir_file ;
		$config['allowed_types'] = 'pdf|doc|docx';
		$config['encrypt_name'] = TRUE;		
		$config['max_size'] = '5120';
		$this->load->library('upload', $config);

		if(is_uploaded_file($_FILES['doc']['tmp_name'])){
			if( !$this->upload->do_upload('doc')){
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('msg_gambar', "<div class='alert alert-error'>".$error."</div>");
				redirect('upload/admin/edit/'.$this->input->post('id_upload'));
				break;
			}
			else {
				$upload = $this->upload->data('doc');
				$file = $upload['file_name'];

				$this->session->set_flashdata('msg_gambar', '<div class="alert alert-success">File Berhasil di Upload</div>');
				$data['file'] = $file;
			}
		}
		$data['nama'] = $name;
		$data['foot'] = $this->input->post('foot');
		$this->M_upload->update($id_upload,$data);
		$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil di Update</div>');
		redirect('upload/admin');
	}

	function down($id)
	{
		$this->load->helper('download');
		$query = $this->M_upload->getById($id);
		if ($query->num_rows() > 0) {
			$record = $query->row();
			$url = base_url()."inventory/file/doc/".$record->file;
			$ext = pathinfo($record->file, PATHINFO_EXTENSION);
			$data = file_get_contents("inventory/file/doc/".$record->file);
			force_download($record->nama.".".$ext, $data, TRUE);
		}
		else {
			echo "<h1>DATA TIDAK ADA</h1>";
		}
	}

	public function hapus($id)
	{
		$query = $this->M_upload->getById($id);
		$rec = $query->row();
		$dir_file = 'inventory/file/doc/';
		if (file_exists($dir_file.$rec->file)) {
			unlink($dir_file.$rec->file);
		}
		if($query->num_rows()>0){
			$this->M_upload->delete($id);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Data Berhasil di Hapus
			</div>');
		}
		redirect('upload/admin');
	}
	public function combobox_upload($id_prodi)
	{
		echo $this->M_upload->combobox($id_prodi);
	}
}

/* End of file upload.php */
/* Location: ./application/modules/upload/controllers/upload.php */
