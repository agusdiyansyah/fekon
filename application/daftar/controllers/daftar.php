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
		$data = $this->input->post('data');
		$s = $this->input->post('s');
		$kerja = $this->input->post('kerja');
		$publikasi = $this->input->post('publikasi');
		if (!empty($this->input->post('data'))) {
			$data = array(
				'nik' => $data['0'],
				'nama' => $data['1'],
				'ttl' => $data['2'],
				'jk' => $data['3'],
				'darah' => $data['4'],
				'agama' => $data['5'],
				'nikah' => $data['6'],
				'alamat' => $data['7'],
				'kota' => $data['8'],
				'pos' => $data['9'],
				'telp' => $data['10'],
				'email' => $data['11'],
				'biaya' => $data['12'],
			);
			$this->daftar->insert('tb_data_pribadi', $data);
		}
		
		if (!empty($this->input->post('ss'))) {
			$ss = $this->input->post('ss');
			$ss = array(
				'nik' => $data['nik'],
				'jenjang' => $ss['0'],
				'nama_pt' => $ss['1'],
				'program' => $ss['2'],
				'alamat_pt' => $ss['3'],
				'masuk' => $ss['4'],
				'lulus' => $ss['5'],
				'ipk' => $ss['6'],
				'ipkun' => $ss['7'],
				'status' => $ss['8'],
				'gelar' => $ss['9'],
			);
			$this->daftar->insert('tb_pendidikan', $ss);
			// echo "<b>Pendidikan s2</b><hr>";
			// var_dump($ss);
		}
		if (!empty($this->input->post('kerja'))) {
			$kerja = array(
				'nik' => $data['nik'],
				'jenis' => $kerja['0'],
				'instansi' => $kerja['1'],
				'nip' => $kerja['2'],
				'pangkat' => $kerja['3'],
				'alamat_k' => $kerja['4'],
				'kota_k' => $kerja['5'],
				'pos_k' => $kerja['6'],
				'telp_k' => $kerja['7'],
			);
			$this->daftar->insert('tb_pekerjaan', $kerja);
			// echo "<b>Pekerjaan</b><hr>";
			// var_dump($kerja);
		}
		if (!empty($this->input->post('publikasi'))) {
			$publikasi = array(
				'nik' => $data['nik'],
				'penelitian' => $publikasi['0'],
				'ilmiah' => $publikasi['1'],
			);
			$this->daftar->insert('tb_publikasi', $publikasi);
			// echo "<b>Publikasi</b><hr>";
			// var_dump($publikasi);
		}
		$daftar = array(
			'nik' => $data['nik'],
			'id_prodi' => $this->input->post('id')
		);
		$this->daftar->insert('tb_daftar', $daftar);
		redirect('beranda');
	}

}

/* End of file daftar.php */
/* Location: ./application/modules/daftar/controllers/daftar.php */