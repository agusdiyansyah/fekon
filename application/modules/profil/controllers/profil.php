<?php 
class Profil extends MX_Controller {
	function Profil(){
		parent::__construct();
		$this->load->model('M_profil');		
	}
	function detil($id_profil){
		$query = $this->M_profil->getById($id_profil);
		if ($query->num_rows()>0) {
			$record = $query->row();
			$data['title'] = $record->title;
			$data['content'] = $record->content;
			$data['image'] = $record->image;
			$data['clean_url'] = $record->clean_url;
			$data['id_profil'] = $record->id_profil;
			$profil_lainnya = Modules::run('profil/lainnya', $id_profil);
			$this->template->set_layout('template')
			->title($record->title)
			->set_partial('metadata', 'partials/metadata')
			->set_partial('header', 'partials/header')
			->inject_partial('right_side', $profil_lainnya)
			->set_partial('footer', 'partials/footer')
			->build('detil', $data);
		}
		else {
			redirect('beranda');
		}
	}
	public function lainnya($id_current)
	{
		$query = $this->db->where('id_profil !=', $id_current);
		$query = $this->db->get('tb_profil');
		$data['result'] = $query->result();
		$this->load->view('lainnya', $data);
	}
}
?>