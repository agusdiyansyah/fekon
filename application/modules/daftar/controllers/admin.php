<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller {
	var $title = 'Pendaftaran';
	public function __construct()
	{
		parent::__construct();
		echo Modules::run("fekon/cekLogin");
		$this->load->model('m_daftar');
		$this->load->library('table');
		$this->load->model('prodi/M_prodi');
	}

	public function index($offset = 0)
	{
		$perpage = 50;
		$query = $this->m_daftar->getAll(array('perpage' => $perpage, 'offset' => $offset));
		$table = array('table_open' => '<table class="table table-hover">', );
		$this->table->set_template($table);
		$head = array('No', 'NIK', 'Nama Pendaftar', 'Tanggal Daftar', 'Aksi');
		$this->table->set_heading($head);

		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		$this->load->library('pagination');
		$config_paging = array(
			'base_url' => 'agenda/admin/index',
			'total_row' => $this->m_daftar->getAll()->num_rows(),
			'per_page' => $perpage,
			'uri_segment' => 4
		);
		$no = 0 + $offset;;
		$content = null;
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $key) {
				$edit = anchor('daftar/admin/edit/'.$key->nik, '<span class="glyphicon glyphicon-edit">', 'class="btn btn-default btn-xs"');
				$hapus = anchor('daftar/admin/hapus/'.$key->nik, '<span class="glyphicon glyphicon-remove">', 'class="btn btn-default btn-xs hapus"');
				$aksi = $edit.' '.$hapus;
				$no++;
				$row_table = array(
					$no,
					$key->nik,
					$key->nama,
					$key->date,
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

	function registrasi()
	{
		$query = $this->M_prodi->getAll();
		$table = array('table_open' => '<table class="table table-hover">', );
		$this->table->set_template($table);
		$head = array('No', 'Prodi', 'Informasi');
		$no = 0;
		$this->table->set_heading($head);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $key) {
				$edit = anchor('daftar/admin/redit/'.$key->id_prodi, 'Registrasi', 'class="btn btn-default btn-xs"');
				$hapus = anchor('daftar/admin/sedit/'.$key->id_prodi, 'Syarat', 'class="btn btn-default btn-xs"');
				$aksi = $edit.' '.$hapus;
				$no++;
				$row_table = array(
					$no,
					$key->prodi,
					$aksi					
				);
				$this->table->add_row($row_table);
			}
		}
		$data['pagination'] = '';
		$data['table'] = $this->table->generate();
		$data['link_tambah'] = site_url('agenda/admin/tambah');
		$data['title'] = $this->title;
		$this->template->set_layout('template_admin')
		->title($this->title)
		->build('admin/data', $data);
	}

	function redit($id)
	{
		$query = $this->M_prodi->getById($id);
		if ($query->num_rows() > 0) {
			$key = $query->row();
			$data['default'] = array(
				'id_prodi' => $key->id_prodi,
				'content' => $key->reg,
				'mode' => 'reg',
			);
			$data['title'] = $this->title;
			$data['form_action'] = 'daftar/admin/ureg';
			$this->template->set_layout('template_admin')
			->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/js/ckeditor/ckeditor.js"></script>')
			->title($this->title)
			->build('admin/reg', $data);
		}
	}
	function sedit($id)
	{
		$query = $this->M_prodi->getById($id);
		if ($query->num_rows() > 0) {
			$key = $query->row();
			$data['default'] = array(
				'id_prodi' => $key->id_prodi,
				'content' => $key->syarat,
				'mode' => 'syarat',
			);
			$data['title'] = $this->title;
			$data['form_action'] = 'daftar/admin/ureg';
			$this->template->set_layout('template_admin')
			->append_metadata('<script type="text/javascript" src="'.base_url().'inventory/js/ckeditor/ckeditor.js"></script>')
			->title($this->title)
			->build('admin/reg', $data);
		}
	}
	function ureg()
	{
		$id = $this->input->post('id_prodi');
		$mode = $this->input->post('mode');
		$data = $this->input->post('content');
		$this->M_prodi->updateR($id, $mode, $data);
		redirect('daftar/admin/registrasi');
	}

	public function edit($id)
	{
		$query = $this->m_daftar->getByNik($id);
		if ($query->num_rows() > 0) {
			$key = $query->row();
			$data['default'] = array(
				'nik' => $key->nik,
				'id_prodi' => $key->id_prodi,
				'date' => $key->date,
				'time' => $key->time,
				'nama' => $key->nama,
				'ttl' => $key->ttl,
				'jk' => $key->jk,
				'darah' => $key->darah,
				'agama' => $key->agama,
				'nikah' => $key->nikah,
				'alamat' => $key->alamat,
				'kota' => $key->kota,
				'pos' => $key->pos,
				'telp' => $key->telp,
				'email' => $key->email,
				'biaya' => $key->biaya,
				'id_pekerjaan' => $key->id_pekerjaan,
				'jenis' => $key->jenis,
				'instansi' => $key->instansi,
				'nip' => $key->nip,
				'pangkat' => $key->pangkat,
				'alamat_k' => $key->alamat_k,
				'kota_k' => $key->kota_k,
				'pos_k' => $key->pos_k,
				'telp_k' => $key->telp_k,
				'id_publikasi' => $key->id_publikasi,
				'penelitian' => $key->penelitian,
				'ilmiah' => $key->ilmiah,
				'jenjang' => $key->jenjang,
				'prodi' => $key->prodi,
			);
			$data['pendidikan'] = $this->m_daftar->getPendidikan($id)->result();
			// $data['title'] = $this->title;
			$this->template->set_layout('template_admin')
			->title($this->title)
			->build('admin/form', $data);
		} else {
			redirect('daftar/admin');
		}
		
	}

	function hapus($id)
	{
		$data = $this->m_daftar->get('tb_data_pribadi',$id);
		$pendidikan = $this->m_daftar->get('tb_pendidikan',$id);
		$pekerjaan = $this->m_daftar->get('tb_pekerjaan',$id);
		$publikasi = $this->m_daftar->get('tb_publikasi',$id);
		$daftar = $this->m_daftar->get('tb_daftar',$id);
		if ($data->num_rows() > 0 || $pendidikan->num_rows() > 0 || $pekerjaan->num_rows() > 0 || $publikasi->num_rows() > 0 || $daftar->num_rows() > 0) {
			$this->m_daftar->delete('tb_data_pribadi',$id);
			$this->m_daftar->delete('tb_pendidikan',$id);
			$this->m_daftar->delete('tb_pekerjaan',$id);
			$this->m_daftar->delete('tb_publikasi',$id);
			$this->m_daftar->delete('tb_daftar',$id);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil di Hapus</div>');
		}
		redirect('daftar/admin');
		
	}

}

/* End of file admin.php */
/* Location: ./application/modules/agenda/controllers/admin.php */