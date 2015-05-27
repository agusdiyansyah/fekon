<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendaftaran extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_prodi');
		$this->load->model('m_pendaftaran');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data = array(
			'akses' => 'pendaftaran/tambah', 
			'page' => 'jenjang', 
		);
		$data['prodi'] = $this->m_prodi->getAll();
		$this->load->view('pendaftaran',$data);
	}
	function tambah(){
		$data = array(
			'akses' => 'pendaftaran/tambah_proses', 
			'page' => 'form_pendaftaran',
		);
		if ($this->uri->segment(3)!=null) {
			$data['id'] = $this->uri->segment(3);
		}else{
			$data['id'] = $this->input->post('id_prodi');
		}
		$data['form'] = array(
			'form_s1',
		);
		$data['prodi'] = $this->m_prodi->getById($data['id']);
		
		if ($data['prodi']->jenjang == 's3') {
			$data['form'] = array(
				'form_s1','form_s2'
			);
		}
		$this->load->view('pendaftaran', $data);
	}
	function tambah_proses(){
		$data = $this->m_prodi->getById($this->input->post('id_prodi'));
		$this->form_validation->set_rules('nik', 'NIK', 'required');
		$this->form_validation->set_rules('nama', 'Nama Pendaftar', 'required');
		$this->form_validation->set_rules('tempat', 'Tempat Lahir', 'required');
		$this->form_validation->set_rules('tgl', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('kota', 'Kota', 'required');
		$this->form_validation->set_rules('kodepos', 'Kode Pos', 'required');
		$this->form_validation->set_rules('telp', 'Telephone', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');

		$this->form_validation->set_rules('s1-nama-pt', 'Nama Perguruan Tinggi S1', 'required');
		$this->form_validation->set_rules('s1-prodi', 'Program Studi S1', 'required');
		$this->form_validation->set_rules('s1-alamat-pt', 'Alamat Perguruan Tinggi S1', 'required');
		$this->form_validation->set_rules('s1-masuk', 'Tanggal Masuk Dari Perguruan Tinggi S1', 'required');
		$this->form_validation->set_rules('s1-lulus', 'Tanggal Lulus Dari Perguruan Tinggi S1', 'required');
		$this->form_validation->set_rules('s1-ipk', 'IPK S1', 'required');
		if ($data->jenjang == 's3') {
			$this->form_validation->set_rules('s2-nama-pt', 'Nama Perguruan Tinggi S2', 'required');
			$this->form_validation->set_rules('s2-prodi', 'Program Studi S2', 'required');
			$this->form_validation->set_rules('s2-alamat-pt', 'Alamat Perguruan Tinggi S2', 'required');
			$this->form_validation->set_rules('s2-masuk', 'Tanggal Masuk Dari Perguruan Tinggi S2', 'required');
			$this->form_validation->set_rules('s2-lulus', 'Tanggal Lulus Dari Perguruan Tinggi S2', 'required');
			$this->form_validation->set_rules('s2-ipk', 'IPK S2', 'required');
		}
		$this->form_validation->set_message('required','Kolom %s tidak boleh kosong');

		if ($this->form_validation->run() == FALSE)
		{
			$this->tambah();
		}
		else
		{
			
		}
	}
}

/* End of file pendaftaran.php */
/* Location: ./application/modules/pendaftaran/controllers/pendaftaran.php */