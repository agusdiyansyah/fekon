<?php 
class Category extends MX_Controller {
	var $title = "Data Album";
	function Category(){
		parent::__construct();
		$this->load->library('clean_url');
		$this->load->model('M_cat');
	}
	function index($offset = 0){				
		$perpage = 50;
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		//load library pagination
		$this->load->library('pagination');
		//untuk konfigurasi pagination
		$config_paging = array(
			'base_url' => site_url('gallery/category/index/'),
			'total_rows' => $this->M_cat->getAll()->num_rows(),
			'per_page' => $perpage,
			'last_link' => 'terakhir',
			'first_link' => 'awal',
			'uri_segment' => 4
		);
		$this->pagination->initialize($config_paging);
		$data['pagination'] = $this->pagination->create_links();		
		$category = $this->M_cat->getAll(array('perpage' => $perpage, 'offset'=>$offset));
		$category_list = "";
		$no = 0 + $offset;
		foreach ($category->result() as $record){
			$no++;
			$edit = anchor('gallery/category/edit/'.$record->id_category, '<i class="fa fa-edit"></i>', 'class="btn btn-success btn-xs" title="edit"');
			$hapus = anchor('gallery/category/hapus/'.$record->id_category, '<span class="glyphicon glyphicon-remove"></span>', 'class="hapus btn btn-danger btn-xs" title="hapus"');
			
			$category_list .= '<tr class="barisdata">';
			$category_list .= '<td>'.$no.'</td>';
			$category_list .= '<td>'.$record->name_category.'</td>';
			$category_list .= '<td>'.$edit.' '.$hapus.'</td>';
			$category_list .= '</tr>';
		}
		$data['category_list'] = $category_list;
		$data['title'] = "Data Kategori";
		$this->template->set_layout('template_admin')
		->title($this->title)
		->build('admin/category/data', $data);
	}
	function tambah(){		
		$data['form_action'] = site_url('gallery/category/tambah_proses');
		$data['title'] = 'Tambah Data Album';
		$data['mode'] = 'tambah';
		$data['default']['date'] = date('Y-m-d');
		$data['default']['time'] = date('H:i:s');
		$this->template->set_layout('template_admin')
		->title($this->title)
		->append_metadata('<link href="'.base_url().'inventory/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />')
		->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/bootstrap/js/moment.js"></script>')
		->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/bootstrap/js/bootstrap.datetimepicker.min.js"></script>')
		->build('admin/category/form', $data);
	}
	function tambah_proses(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name_category', 'Judul Album', 'required|xss_clean');
		$this->form_validation->set_rules('date', 'Tanggal', 'required|xss_clean');
		$this->form_validation->set_rules('time', 'Waktu', 'required|xss_clean');
		if ($this->form_validation->run() == FALSE){
			$this->tambah();
		}
		else {
			$data['name_category'] = $this->input->post('name_category');
			$data['date'] = $this->input->post('date');
			$data['time'] = $this->input->post('time');
			$data['clean_url'] = $this->clean_url->create($data['name_category']);
			$insert = $this->M_cat->insert($data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil di Tambah</div>');
			redirect('gallery/category');
		}
	}
	function edit($id_category){
		$query = $this->M_cat->getById($id_category);
		if ($query->num_rows() > 0) {
			$record = $query->row();
			$data['form_action'] = site_url('gallery/category/edit_proses');
			$data['default']['id_category'] = $record->id_category;
			$data['default']['name_category'] = $record->name_category;
			$data['default']['date'] = $record->date;
			$data['default']['time'] = $record->time;
			$data['mode'] = "edit";
			$data['title'] = 'Edit Data Kategori';
			$this->template->set_layout('template_admin')
			->title($this->title)
			->append_metadata('<link href="'.base_url().'inventory/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />')
			->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/bootstrap/js/moment.js"></script>')
			->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/bootstrap/js/bootstrap.datetimepicker.min.js"></script>')
			->build('admin/category/form', $data);
		}
		else {
			redirect('gallery/category');
		}
	}
	function edit_proses(){
		$id_category = $this->input->post('id_category');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name_category', 'Judul Album', 'required|xss_clean');
		$this->form_validation->set_rules('date', 'Tanggal', 'required|xss_clean');
		$this->form_validation->set_rules('time', 'Waktu', 'required|xss_clean');
		if ($this->form_validation->run() == FALSE){
			$this->edit($id_category);
		}
		else {
			$id_category = $this->input->post('id_category');
			$data['name_category'] = $this->input->post('name_category');
			$data['date'] = $this->input->post('date');
			$data['time'] = $this->input->post('time');
			$data['clean_url'] = $this->clean_url->create($data['name_category']);
			$this->M_cat->update($id_category, $data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Proses Edit Berhasil</div>');
			redirect('gallery/category');
		}
	}
	function hapus($id_category){
		$query = $this->M_cat->getById($id_category);
		if ($query->num_rows() > 0) {
			$this->M_cat->delete($id_category);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil di Hapus</div>');
		}
		redirect('gallery/category');
	}
}
