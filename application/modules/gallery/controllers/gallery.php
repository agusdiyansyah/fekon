<?php 
class Gallery extends MX_Controller {
	var $title = "Galeri";
	function Gallery(){
		parent::__construct();
		$this->load->model('M_gallery');
		$this->load->library('clean_url');
		$this->load->library('indo_date');
	}
	function index(){
		$data['kategori'] = $this->M_gallery->getAllKategori()->result();
		$data['info'] = Modules::run("infoakademik/widget");
		$data['agenda'] = Modules::run("agenda/widget");
		$this->template->set_layout('template')
		->title($this->title)
		->set_partial('metadata', 'partials/metadata')
		->set_partial('header', 'partials/header')
		->set_partial('footer', 'partials/footer')
		->build('data', $data);		
	}
	function kategori($id_category){
		$query = $this->M_gallery->getByKategori($id_category);
		$query_kat = $this->M_gallery->getKategoriById($id_category);		
		$kat = $query_kat->row();
		$data['id_category'] = $id_category;
		$data['name_category'] = $kat->name_category;
		$data['result'] = $query->result();
		$this->template->set_layout('template')
		->title($this->title)
		->set_partial('metadata', 'partials/metadata')
		->set_partial('header', 'partials/header')
		->set_partial('footer', 'partials/footer')
		->build('data_by_category', $data);		
	}
	function detil($clean_url){
		$id_gallery = $this->clean_url->getId($clean_url);
		$query = $this->M_gallery->getById($id_gallery);
		if ($query->num_rows>0) {
			$record = $query->row();
			$data['title'] = $record->title;
			$data['id_category'] = $record->id_category;
			$data['name_category'] = $record->name_category;
			$data['date'] = $this->indo_date->tgl_indo($record->date).' | '.$record->time;
			$data['content'] = $record->content;
			$data['image'] = $record->image;
			$data['detil_lainnya'] = $this->M_gallery->detil_lainnya($record->id_gallery, $record->id_category)->result();
			$this->template->set_layout('template')
			->title($this->title)
			->set_partial('metadata', 'partials/metadata')
			->set_partial('header', 'partials/header')
			->set_partial('footer', 'partials/footer')
			->build('detil', $data);
		}
		else{
			redirect('gallery');
		}
	}
	function widget()
	{
		$data['kategori'] = $this->M_gallery->getAllKategori()->result();
		// print_r($data['kategori'])
		$this->load->view('widget', $data);
	}
}
