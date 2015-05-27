<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Infoakademik extends MX_Controller {
	var $title = "Informasi Akademik";
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_info');
		$this->load->library('clean_url');
		$this->load->library('indo_date');
	}

	function index($offset = 0){			
		$perpage = 5;
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		//load library pagination
		$this->load->library('pagination');
		//untuk konfigurasi pagination
		$config_paging = array(
			'base_url' => base_url()."infoakademik/index/",
			'total_rows' => $this->m_info->getAll()->num_rows(),
			'per_page' => $perpage,
			'last_link' => 'terakhir',
			'first_link' => 'awal'
		);
		$this->pagination->initialize($config_paging);
		$data['pagination'] = $this->pagination->create_links();		
		$news = $this->m_info->getAll(array('perpage' => $perpage, 'offset'=>$offset));
		$data['news_list'] = $news->result();
		$data['title'] = "Informasi Akademik";
		$data['agenda'] = Modules::run('agenda/widget');
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
		$query = $this->m_info->getById($id, $url);
		if ($query->num_rows() > 0) {
			$record = $query->row();
			$data = array(
				'title' => $record->title, 
				'content' => $record->content,
				'date' => $this->indo_date->tgl_indo($record->date),
			);
			//update news view
			$update['view'] = $record->view+1;

			$data['widget_agenda'] = Modules::run('agenda/widget');
			$this->template->set_layout('template')
			->title($record->title)
			->set_partial('metadata', 'partials/metadata')
			->set_partial('header', 'partials/header')
			->set_partial('footer', 'partials/footer')
			->build('detil', $data);
		}
		else {
			redirect('beranda');
		}
	}

	function widget()
	{
		$data['info'] = $this->m_info->widget()->result();
		$this->load->view('widget', $data);
	}

}

/* End of file infoakademik.php */
/* Location: ./application/modules/infoakademik/controllers/infoakademik.php */