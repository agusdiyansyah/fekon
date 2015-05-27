<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matakuliah extends MX_Controller {
	var $title = "Mata Kuliah";
	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->library('table');
	}

	// List all your items
	public function index( $offset = 0 )
	{
		$perpage = 50;
		$query = $this->Model->getAll(array('perpage' => $perpage, 'offset' => $offset));
		$template_table = array("table_open"=>"<table class='table table-hover'>");
		$this->table->set_template($template_table);
		$heading = array('kolom1', 'kolom2');
		$this->table->set_heading($heading);

		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		//load library pagination
		$this->load->library('pagination');
		//untuk konfigurasi pagination
		$config_paging = array(
			'base_url' => site_url('controller/index/'),
			'total_rows' => $this->Model->getAll()->num_rows(),
			'per_page' => $perpage,
		);

		$no = 0 + $offset;
		$content = null;
		if($program->num_rows() > 0){
			foreach ($program->result() as $record){
				$no ++;
				$row_table = array(
					'kolom1',
					'kolom2'
				);
				$this->table->add_row($row_table);
			}
			$this->pagination->initialize($config_paging);
			$data['pagination'] = $this->pagination->create_links();
		}
		else {
			$data['pagination'] = "";
		}
		$data['table'] = ->table->generate();
		$this->template->set_layout('template')
		->title($this->title)
		->build('data', $data);
	}

	public function tambah()
	{
		$data['mode'] = 'tambah';
		$data['form_action'] = site_url('controller/tambah_proses');
		$this->template->set_layout('template')
		->title($this->title)
		->build('form', $data);
	}

	public function tambah_proses()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fieldname', 'fieldlabel', 'required');
		if ($this->form_validation->run()==FALSE) {
			$this->tambah();
		}
		else {
			$data['kolom1'] = $this->input->post('kolom1');
			$data['kolom2'] = $this->input->post('kolom2');
			$this->Model->add($data);
			$this->session->set_flashdata('msg', '<div class="alert">Data Berhasil Disimpan</div>');
			redirect('controller');
		}
	}

	public function edit($id){
		$query = $this->Model->getById($id);
		if($query->num_rows()>0){
			$record = $query->row();
			$data['mode'] = 'edit';
			$data['default']['id'] = $record->id;
			$data['default']['kolom1'] = $record->kolom1;
			$data['default']['kolom2'] = $record->kolom2;
			$this->template->set_layout('template')
			->title($this->title)
			->build('form', $data);
		}
		else {
			redirect('controller');
		}
	}
	public function edit_proses()
	{
		$id = $this->input->post('id');
		$this->form_validation->set_rules('fieldname', 'fieldlabel', 'required');
		if ($this->form_validation->run()==FALSE) {
			$this->edit($id);
		}
		else {
			$data['kolom1'] = $this->input->post('kolom1');
			$data['kolom2'] = $this->input->post('kolom2');
			$this->Model->update($data, $id);
			$this->session->set_flashdata('msg', '<div class="alert">Data Berhasil Diganti</div>');
			redirect('controller');
		}
	}
	public function hapus($id)
	{
		$query = $this->Model->getById($id);
		if($query->num_rows()>0){
			$this->Model->delete($id);
			$this->session->set_flashdata('msg', '<div class="alert">Data Berhasil Dihapus</div>');
		}
		redirect('controller');
	}
}

/* End of file matakuliah.php */
/* Location: ./application/modules/matakuliah/controllers/matakuliah.php */
