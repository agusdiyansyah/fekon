<?php 
class News extends MX_Controller {
	var $title = "Berita";
	function News(){
		parent::__construct();
		$this->load->model('M_news');
		$this->load->library('indo_date');
		$this->load->library('fungsi');
		$this->load->library('clean_url');
		$this->load->helper('share');
		$this->load->helper('html');
		$this->load->helper('text');
	}
	function index($offset = 0){			 	
		$perpage = 5;
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		//load library pagination
		$this->load->library('pagination');
		//untuk konfigurasi pagination
		$config_paging = array(
			'base_url' => base_url()."news/index/",
			'total_rows' => $this->M_news->getAll()->num_rows(),
			'per_page' => $perpage,
			'last_link' => 'terakhir',
			'first_link' => 'awal'
		);
		$this->pagination->initialize($config_paging);
		$data['pagination'] = $this->pagination->create_links();		
		$news = $this->M_news->getAll(array('perpage' => $perpage, 'offset'=>$offset));
		$data['news_list'] = $news->result();
		$data['title'] = "Data Berita";
		$data['page_head'] = "Berita";
		$data['info_akademik'] = Modules::run('infoakademik/widget');
		$this->template->set_layout('template')
		->title($this->title)
		->set_partial('metadata', 'partials/metadata')
		->set_partial('header', 'partials/header')
		->set_partial('footer', 'partials/footer')
		->build('data', $data);

	}
	function detil($clean_url){
		$id = $this->clean_url->getId($clean_url);
		$url = $this->clean_url->getUrl($clean_url);
		$query = $this->M_news->getById($id, $url);
		if ($query->num_rows() > 0) {
			$record = $query->row();
			$data['title'] = $record->title;
			$data['content'] = $record->content;
			$data['image'] = $record->image;
			$data['tanggal'] = $this->indo_date->tgl_indo($record->date).", ".$record->time;
			$data['admin'] = $record->fullname;
			//update news view
			$update['view'] = $record->view+1;

			$data['berita_lainnya'] = Modules::run('news/lainnya', $record->id_news);
			$this->template->set_layout('template')
			->set_partial('metadata', 'partials/metadata')
			->set_partial('header', 'partials/header')
			->set_partial('footer', 'partials/footer')
			->title($record->title)
			->build('detil', $data);
		}
		else {
			redirect('beranda');
		}
	}
	function lastest($limit = 3){
		$news = $this->M_news->getLastest($limit);
		$data['news_list'] = $news->result();
		$data['title'] = "Berita Terbaru";
		$this->load->view('berita_terbaru', $data, FALSE);
	}
	function lainnya(){
		$news = $this->M_news->getLainnya();
		$data['lainnya'] = $news->result();
		$this->load->view('berita_lainnya', $data, FALSE);
	}
	function widget()
	{
		// enam berita terbaru
		$news = $this->M_news->getLastest(5)->result();
		$data['result'] = $news;
		$this->load->view('widget',$data);
	}
}
?>