<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller {
	var $title = 'Promosi';
	public function __construct()
	{
		parent::__construct();
		echo Modules::run("fekon/cekLogin");
		$this->load->model('M_promosi');
		$this->load->library('clean_url');
	}
	public function index()
	{
		$perpage = 50;
		$query = $this->M_promosi->get();
		$content = null;
		if($query->num_rows() > 0){
			foreach ($query->result() as $promosi){
				$data['default'] = array(
					'id_promosi' => $promosi->id_promosi, 
					'content' => $promosi->content, 
					'title' => $promosi->title, 
					'image' => $promosi->image, 
				);
			}
		}
		$data['form_action'] = site_url('promosi/admin/edit_proses');
		$data['title'] = $this->title;
		$this->template->set_layout('template_admin')
		->title($this->title)
		->build('form', $data);
	}

	function edit_proses(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Judul Header', 'required|xss_clean');
		if ($this->form_validation->run() == FALSE){
			$this->index();
		}
		else {
			$query = $this->M_promosi->get();
			$rec = $query->row();
			$dir_images = 'inventory/gambar/promosi/';
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
					redirect('promosi/admin');
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
						'height' => 300
					);

					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();

					$this->session->set_flashdata('msg_gambar', '<div class="alert alert-success">Gambar Berhasil di Proses</div>');
					$data['image'] = $images;
				}
			}
			$data['title'] = $this->input->post('title');
			$data['slug'] = $this->clean_url->create($data['title']);
			$data['content'] = $this->input->post('content');
			$insert = $this->M_promosi->update($data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil di Update</div>');
			redirect('promosi/admin');
		}
	}
}

/* End of file admin.php */
/* Location: ./application/modules/promosi/controllers/admin.php */