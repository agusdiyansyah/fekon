<?php 
class Header extends MX_Controller {
	var $title = "Berita Pilihan";
	function Header(){
		parent::__construct();	
		$this->load->helper('html');
		$this->load->model('m_header');	
		$this->load->library('clean_url');
	}
	function slider(){
		$data['data'] = $this->m_header->getAll()->result();
		$this->load->view('slider', $data);
	}

	function detil($clean_url)
	{
		$id = $this->clean_url->getId($clean_url);
		$slug = $this->clean_url->getUrl($clean_url);
		$query = $this->m_header->getData($id, $slug);
		if ($query->num_rows() > 0) {
			$result = $query->row();
			$data = array(
				'id_header' => $result->id_header, 
				'title' => $result->title, 
				'image' => $result->image, 
				'keterangan' => $result->keterangan, 
				'info' => Modules::run("infoakademik/widget"),
				'gallery' => Modules::run("gallery/widget"),
			);
			$this->template->set_layout('template')
			->title($this->title)
			->build('detil', $data);
		}
	}

}
?>