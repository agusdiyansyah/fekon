<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Konsentrasi extends MX_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_konsentrasi');
	}
	public function index()
	{
		echo "tex";
		//redirect("beranda");
	}
	public function detil($id_konsentrasi)
	{
		$query = $this->M_konsentrasi->getById($id_konsentrasi);
		if ($query->num_rows()>0) {
			$record = $query->row();
			$data['konsentrasi'] = $record->konsentrasi;
			$data['keterangan_konsentrasi'] = $record->keterangan_konsentrasi;
			$data['widget_agenda'] = modules::run("agenda/widget");
			$data['widget_prodi'] = modules::run("prodi/widget");
			$data['widget_konsentrasi'] = modules::run("konsentrasi/widget", $record->id_prodi);
			$this->template->set_layout('template')
			->title($record->konsentrasi)
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