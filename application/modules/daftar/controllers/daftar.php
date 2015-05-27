<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Daftar extends MX_Controller {
	var $title = "Pendaftaran";
	function Daftar()
	{
		parent::__construct();
		$this->load->model('m_daftar', 'daftar');
		$this->load->model('prodi/M_prodi');
	}

	function index($id)
	{
		$data = $this->daftar->getById($id)->row();
		$form = 'form';
		if ($data->jenjang == 's3') {
			$form = 'formm';
		}
		$this->template->set_layout('template')
		->title($this->title)
		->set_partial('metadata', 'partials/metadata')
		->set_partial('header', 'partials/header')
		->set_partial('footer', 'partials/footer')
		->build($form, array('id' => $data->id_prodi));
	}

	function proses()
	{
		$data = array(
			'nik' => $this->input->post('nik'),
			'nama' => $this->input->post('nama_l'),
			'ttl' => $this->input->post('ttl'),
			'jk' => $this->input->post('jk'),
			'darah' => $this->input->post('darah'),
			'agama' => $this->input->post('agama'),
			'nikah' => $this->input->post('nikah'),
			'alamat' => $this->input->post('alamat_l'),
			'kota' => $this->input->post('kota_l'),
			'pos' => $this->input->post('pos_l'),
			'telp' => $this->input->post('telp_l'),
			'email' => $this->input->post('email_l'),
			'biaya' => $this->input->post('biaya'),
		);
		
		$s = array(
			'nik' => $data['nik'],
			'jenjang' => $this->input->post('sjenjang'),
			'nama_pt' => $this->input->post('snama'),
			'program' => $this->input->post('sprodi'),
			'alamat_pt' => $this->input->post('salamat'),
			'masuk' => $this->input->post('smasuk'),
			'lulus' => $this->input->post('slulus'),
			'ipk' => $this->input->post('sipk'),
			'ipkun' => $this->input->post('sipkun'),
			'status' => $this->input->post('sstatus'),
			'gelar' => $this->input->post('sgelar'),
		);
		
		$ss = array(
			'nik' => $data['nik'],
			'jenjang' => $this->input->post('ssjenjang'),
			'nama_pt' => $this->input->post('ssnama'),
			'program' => $this->input->post('ssprodi'),
			'alamat_pt' => $this->input->post('ssalamat'),
			'masuk' => $this->input->post('ssmasuk'),
			'lulus' => $this->input->post('sslulus'),
			'ipk' => $this->input->post('ssipk'),
			'ipkun' => $this->input->post('ssipkun'),
			'status' => $this->input->post('ssstatus'),
			'gelar' => $this->input->post('ssgelar'),
		);			

		$kerja = array(
			'nik' => $data['nik'],
			'jenis' => $this->input->post('jenis_k'),
			'instansi' => $this->input->post('inst_k'),
			'nip' => $this->input->post('nip_k'),
			'pangkat' => $this->input->post('pangkat_k'),
			'alamat_k' => $this->input->post('alamat_k'),
			'kota_k' => $this->input->post('kota_k'),
			'pos_k' => $this->input->post('pos_k'),
			'telp_k' => $this->input->post('telp_k'),
		);
	
		$publikasi = array(
			'nik' => $data['nik'],
			'penelitian' => $this->input->post('penelitian'),
			'ilmiah' => $this->input->post('ilmiah'),
		);
		
			
		$daftar = array(
			'nik' => $data['nik'],
			'id_prodi' => $this->input->post('id'),
			'date' => date('Y-m-d'),
			'time' => date('H:i:s'),
		);
		$in_data = $this->daftar->insert('tb_data_pribadi', $data);
		$this->daftar->insert('tb_pendidikan', $s);
		if (!empty($ss['nama_pt'])) {
			$this->daftar->insert('tb_pendidikan', $ss);
		}
		$this->daftar->insert('tb_pekerjaan', $kerja);
		$this->daftar->insert('tb_publikasi', $publikasi);
		$in_daftar = $this->daftar->insert('tb_daftar', $daftar);
		if (!empty($in_data) && !empty($in_daftar)) {			
			$this->session->set_flashdata('message','Anda berhasil melakukan pendaftaran');
			redirect('beranda');
		}
	}

	function info_registrasi($id)
	{
		$query = $this->M_prodi->getById($id);
		if ($query->num_rows() > 0) {
			$key = $query->row();
			$data = array(
				'id_prodi' => $key->id_prodi,
				'prodi' => $key->prodi,
				'reg' => $key->reg, 
				'mode' => 'Registrasi'
			);
			$data['info'] = Modules::run("infoakademik/widget");
			$this->template->set_layout('template')
			->title($this->title)
			->set_partial('metadata', 'partials/metadata')
			->set_partial('header', 'partials/header')
			->set_partial('footer', 'partials/footer')
			->build('page',$data);
		}
	}

	function info_syarat($id)
	{
		$query = $this->M_prodi->getById($id);
		if ($query->num_rows() > 0) {
			$key = $query->row();
			$data = array(
				'id_prodi' => $key->id_prodi,
				'prodi' => $key->prodi,
				'reg' => $key->syarat, 
				'mode' => 'Syarat dan Tata Cara'
			);
			$data['info'] = Modules::run("infoakademik/widget");
			$this->template->set_layout('template')
			->title($this->title)
			->set_partial('metadata', 'partials/metadata')
			->set_partial('header', 'partials/header')
			->set_partial('footer', 'partials/footer')
			->build('page',$data);
		}
	}

	public function form()
	{
		$data['prodi'] = $this->m_prodi->getAll();
		$this->load->view('daftar',$data);
	}

	function widget()
	{
		$data['prodi'] = $this->daftar->getProdi()->result();
		$this->load->view('widget',$data);
	}

}

/* End of file daftar.php */
/* Location: ./application/modules/daftar/controllers/daftar.php */