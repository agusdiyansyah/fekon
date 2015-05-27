<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kontak extends MX_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_kontak');
	}
	public function index()
	{
		$query = $this->M_kontak->get();
		if ($query->num_rows()>0) {
			$record = $query->row();
			$data["alamat"] = $record->alamat;
			$data["telepon"] = $record->telepon;
			$data["fax"] = $record->fax;
			$data["kodepos"] = $record->kodepos;
			$data["email"] = $record->email;
			$data["facebook"] = $record->facebook;
			$data["twitter"] = $record->twitter;
			$data["title"] = "Kontak Kami";
			$this->load->view('widget', $data);
			$this->template->set_layout('template')
			->title($data['title'])
			->set_partial('metadata', 'partials/metadata')
			->set_partial('header', 'partials/header')
			->set_partial('footer', 'partials/footer')
			->build('kontak', $data);
		}
	}
	public function widget(){		
		$query = $this->M_kontak->get();
		if ($query->num_rows()>0) {
			$record = $query->row();
			$data["alamat"] = $record->alamat;
			$data["telepon"] = $record->telepon;
			$data["fax"] = $record->fax;
			$data["kodepos"] = $record->kodepos;
			$data["email"] = $record->email;
			$data["facebook"] = $record->facebook;
			$data["twitter"] = $record->twitter;
			$this->load->view('widget', $data);
		}
	}

}

/* End of file kontak.php */
/* Location: ./application/modules/kontak/controllers/kontak.php */