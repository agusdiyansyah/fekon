<?php 
class Article extends MX_Controller {
	var $title = "Artikel";
	function Article(){
		parent::__construct();
		$this->load->model('M_article');
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
			'base_url' => base_url()."artikel/hal/",
			'total_rows' => $this->M_article->getAll()->num_rows(),
			'per_page' => $perpage,
			'last_link' => 'terakhir',
			'first_link' => 'awal'
		);
		$this->pagination->initialize($config_paging);
		$data['pagination'] = $this->pagination->create_links();		
		$article = $this->M_article->getAll(array('perpage' => $perpage, 'offset'=>$offset));
		$data['article_list'] = $article->result();
		$data['title'] = "Data Artikel";
		$data['page_head'] = "Artikel";
		$widget = Modules::run('article/lainnya')."<br>".Modules::run('link_terkait/link');
		$this->template->set_layout('template-news')
		->title($this->title)
		->inject_partial('widget', $widget)
		->build('data', $data);
	}
	function detil($clean_url){
		$id = $this->clean_url->getId($clean_url);
		$url = $this->clean_url->getUrl($clean_url);
		$query = $this->M_article->getById($id, $url);
		if ($query->num_rows() > 0) {
			$record = $query->row();
			$data['id_article'] = $record->id_article;
			$data['title'] = $record->title;
			$data['clean_url'] = $record->clean_url;
			$data['content'] = $record->content;
			$data['image'] = $record->image;
			$data['file'] = $record->file;
			$data['tanggal'] = $this->indo_date->tgl_indo($record->date);
			$data['admin'] = $record->fullname;
			//update news view
			$update['view'] = $record->view+1;

			$widget = Modules::run('article/lainnya')."<br>".Modules::run('link_terkait/link');
			$this->template->set_layout('template-news')
			->set('page_head', $record->title)
			->inject_partial('widget', $widget)
			->title($record->title)
			->build('detil', $data);
		}
		else {
			redirect('beranda');
		}
	}
	function download_lampiran($clean_url){
		$id = $this->clean_url->getId($clean_url);
		$url = $this->clean_url->getUrl($clean_url);
		$query = $this->M_article->getById($id, $url);
		if ($query->num_rows() > 0) {
			$record = $query->row();
			$upload_path_lampiran = "inventory/download/";
			if (is_file($upload_path_lampiran.$record->file)) {
				$this->load->helper('download');
				$file = file_get_contents($upload_path_lampiran.$record->file);
				$file_ext = pathinfo($record->file, PATHINFO_EXTENSION );
				force_download("Lampiran Artikel.".$file_ext, $file);
			}
			else{
				redirect("beranda");
			}
		}
		else {
			redirect("beranda");
		}
	}
	function lastest(){
		$article = $this->M_article->getLastest(4);
		$data['article_list'] = $article->result();
		$data['title'] = "Artikel Terbaru";
		$this->load->view('artikel_terbaru', $data, FALSE);
	}
	function lainnya(){
		$article = $this->M_article->getLainnya();
		$data['lainnya'] = $article->result();
		$this->load->view('artikel_lainnya', $data, FALSE);
	}
}
?>