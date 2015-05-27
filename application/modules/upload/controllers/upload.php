<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends MX_Controller {
	function Upload(){
		parent::__construct();
		$this->load->model('m_upload');
		$this->load->library('clean_url');
		$this->load->library('fungsi');
	}
	public function index($offset = 0)
	{
		$perpage = 50;
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		//load library pagination
		$this->load->library('pagination');
		//untuk konfigurasi pagination
		$config_paging = array(
			'base_url' => base_url()."news/index/",
			'total_rows' => $this->m_upload->getAll()->num_rows(),
			'per_page' => $perpage,
			'last_link' => 'terakhir',
			'first_link' => 'awal'
		);
		$this->pagination->initialize($config_paging);
		$data['pagination'] = $this->pagination->create_links();		
		$news = $this->m_upload->getAll(array('perpage' => $perpage, 'offset'=>$offset));
		$data['upload'] = $news->result();
		$data['info'] = Modules::run('infoakademik/widget');
		$this->template->set_layout('template')
		->title('Download File')
		->set_partial('metadata', 'partials/metadata')
		->set_partial('header', 'partials/header')
		->set_partial('footer', 'partials/footer')
		->build('user', $data);
	}
	function file()
	{
		$array = array(
			'foot' => 'y'
		);
		
		$this->session->set_userdata( $array );
		$query = $this->m_upload->getAll();
		if ($query->num_rows() > 0) {
			$data['file'] = $query->result();
			$this->load->view('file', $data);
		}else{
			echo "~~ Tidak ada file yang terupload ~~";
		}
		$this->session->unset_userdata('foot');
	}
	function download($url)
	{
		$id = $this->clean_url->getId($url);
		$this->load->helper('download');
		$query = $this->m_upload->getById($id);
		if ($query->num_rows() > 0) {
			$record = $query->row();
			$url = base_url()."inventory/file/doc/".$record->file;
			$ext = pathinfo($record->file, PATHINFO_EXTENSION);
			$data = file_get_contents("inventory/file/doc/".$record->file);
			force_download($record->nama.".".$ext, $data, TRUE);
		}
		else {
			echo "<h1>DATA TIDAK ADA</h1>";
		}
	}
	function staf($id)
	{
		$data['dosenDalam'] = $this->m_upload->getByProdi($id,1)->result();
		$data['dosenLuar'] = $this->m_upload->getByProdi($id,2)->result();
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
	public function detil($id_upload)
	{
		$id = $this->clean_url->getId($id_upload);
		$query = $this->m_upload->getById($id);
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