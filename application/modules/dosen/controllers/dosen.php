<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dosen extends MX_Controller {
	var $title = "Staf Pengajar Fakultas Ekonomi, Universitas Tanjungpura Pontianak";
	function Dosen(){
		parent::__construct();
		$this->load->model('m_dosen');
		$this->load->library('clean_url');
	}
	public function index()
	{
		$data['dosenDalam'] = $this->m_dosen->getByStaf(1)->result();
		$data['dosenLuar'] = $this->m_dosen->getByStaf(2)->result();
		$data['agenda'] = modules::run("agenda/widget");
		$data['prodi'] = modules::run("prodi/widget");
		$data['konsen'] = '';
		$this->template->set_layout('template')
		->title($this->title)
		->set_partial('metadata', 'partials/metadata')
		->set_partial('header', 'partials/header')
		->set_partial('footer', 'partials/footer')
		->build('dosen', $data);
	}
	function staf($id)
	{
		$data['dosenDalam'] = $this->m_dosen->getByProdi($id,1)->result();
		$data['dosenLuar'] = $this->m_dosen->getByProdi($id,2)->result();
		$data['agenda'] = modules::run("agenda/widget");
		$data['prodi'] = modules::run("prodi/widget");
		$data['konsen'] = modules::run("konsentrasi/widget", $id);
		$this->template->set_layout('template')
		->title($this->title)
		->set_partial('metadata', 'partials/metadata')
		->set_partial('header', 'partials/header')
		->set_partial('footer', 'partials/footer')
		->build('dosen', $data);
	}
	public function detil($id_dosen)
	{
		$id = $this->clean_url->getId($id_dosen);
		$query = $this->m_dosen->getById($id);
		if ($query->num_rows()>0) {
			$record = $query->row();
			$data = array(
				'nama' => $record->nama, 
				'img' => $record->img, 
				'fokus' => $record->fokus, 
				'telp' => $record->telp, 
				'email' => $record->email, 
				'alamat' => $record->alamat, 
				'sekolah' => $record->sekolah, 
				'jurnal' => $record->jurnal, 
				'pelatihan' => $record->pelatihan, 
				'organisasi' => $record->organisasi, 
				'prodi' => $record->prodi, 
			);
			$data['widget_agenda'] = modules::run("agenda/widget");
			$data['widget_prodi'] = modules::run("prodi/widget");
			$data['widget_konsentrasi'] = modules::run("konsentrasi/widget", $record->id_prodi);
			$this->template->set_layout('template')
			->title($record->nama)
			->build('detil', $data);
		}
		else {
			redirect('beranda');
		}
	}
	public function widget($id_prodi="")
	{
		$query = $this->M_konsentrasi->getWidget($id_prodi);
		$data['result'] = $query->result();
		$this->load->view('widget', $data);
	}
}

/* End of file konsentrasi.php */
/* Location: ./application/modules/konsentrasi/controllers/konsentrasi.php */