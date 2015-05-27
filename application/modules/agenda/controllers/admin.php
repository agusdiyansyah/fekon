<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller {
	var $title = 'Agenda';
	public function __construct()
	{
		parent::__construct();
		echo Modules::run("fekon/cekLogin");
		$this->load->model('m_agenda');
		$this->load->library('table');
	}

	public function index($offset = 0)
	{
		$perpage = 50;
		$query = $this->m_agenda->getAll(array('perpage' => $perpage, 'offset' => $offset));
		$table = array('table_open' => '<table class="table table-hover">', );
		$this->table->set_template($table);
		$head = array('No', 'Agenda', 'Mulai', 'Berakhir','Waktu', 'Publish', 'Aksi');
		$this->table->set_heading($head);

		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		$this->load->library('pagination');
		$config_paging = array(
			'base_url' => 'agenda/admin/index',
			'total_row' => $this->m_agenda->getAll()->num_rows(),
			'per_page' => $perpage,
			'uri_segment' => 4
		);
		$no = 0 + $offset;;
		$content = null;
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $key) {
				$edit = anchor('agenda/admin/edit/'.$key->id_agenda, '<span class="glyphicon glyphicon-edit">', 'class="btn btn-default btn-xs"');
				$hapus = anchor('agenda/admin/hapus/'.$key->id_agenda, '<span class="glyphicon glyphicon-remove">', 'class="btn btn-default btn-xs hapus"');
				$aksi = $edit.' '.$hapus;
				$no++;
				$row_table = array(
					$no,
					$key->title,
					$key->date_start,
					$key->date_end,
					$key->time,
					$key->publish,
					$aksi
				);
				$this->table->add_row($row_table);
			}
			$this->pagination->initialize($config_paging);
			$data['pagination'] = $this->pagination->create_links();
		} else {
			$data['pagination'] = '';
		}
		$data['table'] = $this->table->generate();
		$data['link_tambah'] = site_url('agenda/admin/tambah');
		$data['title'] = $this->title;
		$this->template->set_layout('template_admin')
		->title($this->title)
		->build('admin/data', $data);
	}

	public function tambah()
	{
		date_default_timezone_set("Asia/Jakarta");
		$data['mode'] = 'tambah';
		$data['form_action'] = site_url('agenda/admin/tambah_proses');
		$data['title'] = $this->title." <small>Tambah Data</small>";
		$data['default'] = array(
			'date_start' => date('Y-m-d'),
			'date_end' => date('Y-m-d'),
			'time' => date('H:i:s'),
			'publish' => null,
		);

		$this->template->set_layout('template_admin')
		->title($this->title)
		->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/js/ckeditor/ckeditor.js"></script>')
		->append_metadata('<link rel="stylesheet" type="text/css" href="'.base_url().'inventory/bootstrap/css/bootstrap-datetimepicker.min.css">')
		->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/bootstrap/js/moment.js"></script>')
		->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/bootstrap/js/bootstrap.datetimepicker.min.js"></script>')
		->build('admin/form', $data);
	}

	public function tambah_proses()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Judul Agenda', 'required|xss_clean');
		$this->form_validation->set_rules('content', 'Keterangan', 'required|xss_clean');
		$this->form_validation->set_rules('place', 'Tempat Agenda', 'required|xss_clean');
		if ($this->form_validation->run() == false) {
			$this->tambah();
		} else {
			$data = array(
				'title' => $this->input->post('title'), 
				'content' => $this->input->post('content'), 
				'date_start' => $this->input->post('date_start'), 
				'date_end' => $this->input->post('date_end'), 
				'time' => $this->input->post('time'), 
				'place' => $this->input->post('place'), 
				'publish' => $this->input->post('publish'),
				'slug' =>$this->fungsi->clean_url(strtolower($this->input->post('title')))
			);
			$this->m_agenda->insert($data);
			redirect('agenda/admin');
		}
	}

	public function edit($id)
	{
		$query = $this->m_agenda->getById($id);
		if ($query->num_rows() > 0) {
			$key = $query->row();
			$data['mode'] = 'edit';
			$data['form_action'] = 'agenda/admin/edit_proses';
			$data['default'] = array(
				'id_agenda' => $key->id_agenda,
				'title' => $key->title, 
				'content' => $key->content, 
				'date_start' => $key->date_start, 
				'date_end' => $key->date_end, 
				'place' => $key->place, 
				'publish' => $key->publish, 
			);
			$data['title'] = 'Edit Data Agenda';
			$this->template->set_layout('template_admin')
			->title($this->title)
			->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/js/ckeditor/ckeditor.js"></script>')
		->append_metadata('<link rel="stylesheet" type="text/css" href="'.base_url().'inventory/bootstrap/css/bootstrap-datetimepicker.min.css">')
		->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/bootstrap/js/moment.js"></script>')
		->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/bootstrap/js/bootstrap.datetimepicker.min.js"></script>')
			->build('admin/form', $data);
		} else {
			redirect('agenda/admin');
		}
		
	}

	public function edit_proses()
	{
		$id = $this->input->post('id_agenda');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Judul Agenda', 'required|xss_clean');
		$this->form_validation->set_rules('content', 'Keterangan', 'required|xss_clean');
		$this->form_validation->set_rules('place', 'Tempat Agenda', 'required|xss_clean');
		if ($this->form_validation->run() == false) {
			$this->edit($id);
		} else {
			$data = array(
				'title' => $this->input->post('title'), 
				'content' => $this->input->post('content'), 
				'date_start' => $this->input->post('date_start'), 
				'date_end' => $this->input->post('date_end'), 
				'time' => $this->input->post('time'), 
				'place' => $this->input->post('place'), 
				'publish' => $this->input->post('publish'),
				'slug' =>$this->fungsi->clean_url(strtolower($this->input->post('title')))
			);
			$this->m_agenda->update($id, $data);
			redirect('agenda/admin');
		}
		
	}

	function hapus($id)
	{
		$query = $this->m_agenda->getById($id);
		if ($query->num_rows() > 0) {
			$this->m_agenda->delete($id);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil di Hapus</div>');
		}
		redirect('agenda/admin');
		
	}

}

/* End of file admin.php */
/* Location: ./application/modules/agenda/controllers/admin.php */