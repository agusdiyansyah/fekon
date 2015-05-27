<?php 
class Download extends MX_Controller {
	var $title = "Download";
	function Download(){
		parent::__construct();
		$this->load->model('M_download');
		$this->load->library('clean_url');
	}
	function index($offset = 0){
		$data['title'] = $this->title;
		$perpage = 10;
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		$query = $this->M_download->getAll(array('perpage' => $perpage, 'offset' => $offset));
		if ($query->num_rows() > 0) {
			//load library pagination
			$this->load->library('pagination');
			$config_paging = array(
				'base_url' => base_url()."download-data/hal/",
				'total_rows' => $this->M_download->getAll()->num_rows(),
				'per_page' => $perpage,
				'last_link' => 'terakhir',
				'first_link' => 'awal'
			);
			$this->pagination->initialize($config_paging);
			$data['pagination'] = $this->pagination->create_links();
			$data['result'] = $query->result();
		}
		else {
			$data['result'] = NULL;
			$data['pagination'] = NULL;
		}
		$widget = Modules::run('download/favorit');
		$this->template->set_layout('template-profil')
		->set('page_header', $this->title)
		->inject_partial('widget', $widget)
		->title($this->title)
		->build('data', $data);
	}
	function lastest(){
		$query = $this->db->order_by('id_download', 'desc');
		$query = $this->db->get('tb_download', 5);
		$data['title'] = $this->title;
		$data['result'] = $query->result();
		$this->load->view('lastest', $data);
	}
	function favorit(){
		$query = $this->M_download->getFavorit(5);
		$data['result'] = $query->result();
		$this->load->view('favorit', $data);
	}
	function detil($clean_url){
		$this->load->helper('download');
		$id_download = $this->clean_url->getId($clean_url);
		$url = $this->clean_url->getUrl($clean_url);
		$query = $this->M_download->getById($id_download, $url);
		if ($query->num_rows() > 0) {
			$record = $query->row();
			$url = base_url()."inventory/download/".$record->file;
			$ext = pathinfo($record->file, PATHINFO_EXTENSION);
			$data = file_get_contents("inventory/download/".$record->file);

			//update downloaded
			$update['downloaded'] = $record->downloaded+1;
			$this->M_download->update_downloaded($record->id_download, $update);
			force_download($record->title.".".$ext, $data, TRUE);
		}
		else {
			echo "<h1>DATA TIDAK ADA</h1>";
		}
	}
	function cari($reset=""){
		if ($reset) {
			$this->session->set_userdata('download_cari', '');
			redirect("download-data");
		}
		else {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('search', 'Pencarian', 'xss_clean');
			if ($this->form_validation->run() == FALSE){
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('msg', '<div class="alert alert-error">'.$error.'</div>');				
				redirect('download-data');				
			}
			else {
				$title = $this->input->post('search');
				$this->session->set_userdata('download_cari', $title);
				redirect('download-data');
			}				
		}
	}
}
