<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prodi extends MX_Controller {
	var $title = "Prodi";
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_prodi');
	}

	public function index()
	{
		
	}
	public function detil($id_prodi)
	{
		$query = $this->M_prodi->getById($id_prodi);
		if ($query->num_rows()>0) {
			$record = $query->row();
			$data['id_prodi'] = $record->id_prodi;
			$data['prodi'] = $record->prodi;
			$data['keterangan_prodi'] = $record->keterangan_prodi;
			$data['widget_konsentrasi'] = Modules::run("konsentrasi/widget", $record->id_prodi);
			$data['widget_prodi'] = Modules::run("prodi/widget");
			$data['widget_agenda'] = Modules::run("agenda/widget");
			$this->template->set_layout('template')
			->title($record->prodi)
			->set_partial('metadata', 'partials/metadata')
			->build('detil', $data);
		}
		else {
			redirect('beranda');
		}
	}
	public function lainnya($id_current)
	{
		$query = $this->db->where('id_prodi !=', $id_current);
		$query = $this->db->get('tb_prodi');
		$data['result'] = $query->result();
		$this->load->view('lainnya', $data);
	}
	public function widget()
	{
		$query = $this->M_prodi->getWidget();
		$data['result'] = $query->result();
		$this->load->view('widget', $data);
	}
	public function footer()
	{
		$query = $this->M_prodi->getAll();
		echo "<judul>Profil fakultas</judul>";
		foreach ($query->result() as $record) {
			echo anchor('prodi/detil/'.$record->id_prodi, $record->prodi);
		}
	}

	function kurikulum($id_prodi)
	{
		$query = $this->M_prodi->getById($id_prodi);
		if ($query->num_rows()>0) {
			$record = $query->row();
			$data['id_prodi'] = $record->id_prodi;
			$data['prodi'] = $record->prodi;
			$data['keterangan_prodi'] = $record->kurikulum;
			$data['widget_konsentrasi'] = Modules::run("konsentrasi/widget", $record->id_prodi);
			$data['widget_prodi'] = Modules::run("prodi/widget");
			$data['widget_agenda'] = Modules::run("agenda/widget");
			$this->template->set_layout('template')
			->title($record->prodi)
			->set_partial('metadata', 'partials/metadata')
			->build('detil', $data);
		}
		else {
			redirect('beranda');
		}
	}

}

/* End of file prodi.php */
/* Location: ./application/modules/prodi/controllers/prodi.php */