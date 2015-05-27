<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agenda extends MX_Controller {
	var $title = "Agenda";
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_agenda');
		$this->load->library('indo_date');
		$this->load->library('clean_url');
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
			'total_rows' => $this->m_agenda->getAll()->num_rows(),
			'per_page' => $perpage,
			'last_link' => 'terakhir',
			'first_link' => 'awal'
		);
		$this->pagination->initialize($config_paging);
		$data['pagination'] = $this->pagination->create_links();		
		$news = $this->m_agenda->getAll(array('perpage' => $perpage, 'offset'=>$offset));
		$data['news_list'] = $news->result();
		$data['title'] = "Data Agenda";
		$data['infoakademik'] = Modules::run('infoakademik/widget');
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
		$query = $this->m_agenda->getById($id, $url);
		if ($query->num_rows() > 0) {
			$record = $query->row();
			$data = array(
				'title' => $record->title, 
				'content' => $record->content,
				'start' => $this->indo_date->tgl_indo($record->date_start),
				'end' => $this->indo_date->tgl_indo($record->date_end),
				'time' => $record->time,
			);
			//update news view
			// $update['view'] = $record->view+1;

			$data['widget_agenda'] = Modules::run('infoakademik/widget');
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

	public function widget()
	{
		$query = $this->m_agenda->widget();
		$data['result'] = $query->result();
		if ($query->num_rows() > 0) {
			$this->load->view('widget', $data);
		}
	}
}

/* End of file agenda.php */
/* Location: ./application/modules/agenda/controllers/agenda.php */