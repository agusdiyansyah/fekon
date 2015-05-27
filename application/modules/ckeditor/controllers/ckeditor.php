<?php 
class Ckeditor extends MX_Controller {
	function Ckeditor(){
		parent::__construct();	
		echo Modules::run("fekon/cekLogin");
	}
	function browser(){
		$this->load->helper('directory');
		$dir_images = FCPATH.'inventory/gambar/static_content/';
		$directory = directory_map($dir_images, 1);
		$data["directory"] = $directory;
		$this->load->view('browser', $data);
	}
	function upload_image(){
		$dir_images = 'inventory/gambar/static_content/';
		$config['upload_path'] = $dir_images ;
		$config['allowed_types'] = 'jpg|jpeg|gif|png';
		$config['max_size'] = '5120';
		$config['max_width'] = '4096';
		$config['max_height'] = '4096';		
		$funcNum = $this->input->get('CKEditorFuncNum'); //$_GET['CKEditorFuncNum']
		$this->load->library('upload', $config);
		if( ! $this->upload->do_upload('upload')){
			$error = $this->upload->display_errors();
			$message = "Upload failed on server <br>".$error;
        	$url = '';
		}
		else {
			$upload = $this->upload->data('upload');
			$images = $upload['file_name'];
			$upload_result = base_url() . $dir_images . $upload['file_name'];
	        $upload_name = $upload['file_name'];	 
	        // after finished uploading, it will receive a URL
	        $url = $upload_result;
	        $message = 'Upload success!';
		}
		echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
	}

}
?>