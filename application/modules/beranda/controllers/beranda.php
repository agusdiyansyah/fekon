<?php 
class Beranda extends MX_Controller {
	var $title = "Fakultas Ekonomi, Universitas Tanjungpura Pontianak";
	function Beranda(){
		parent::__construct();
	}
	function index(){
		$ses = $this->session->flashdata('message');
		if ($ses != null) {
			$data['alert'] = '<div class="row"><div class="alert col-xs-12 col-sm-12 col-md-12 col-lg-12"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-success" role="alert">'.$ses.'</div></div></div>';
		}else{
			$data['alert'] = "<br>";
		}
		$data['widget_agenda'] = Modules::run("agenda/widget");
		$data['widget_berita'] = Modules::run("news/widget");
		$data['widget_info'] = Modules::run("infoakademik/widget");
		$data['widget_gallery'] = Modules::run("gallery/widget");
		$data['promosi'] = Modules::run("promosi/widget");
		$data['prodi'] = Modules::run("prodi/widget");
		$data['slider'] = Modules::run("header/slider");
		$data['daftar'] = Modules::run("daftar/widget");		
		$this->template->set_layout('template')
		->title($this->title)
		->set_partial('metadata', 'partials/metadata')
		->set_partial('header', 'partials/header')
		->set_partial('slider', 'partials/slider')
		->set_partial('footer', 'partials/footer')
		->build('beranda', $data);
	}

	function slide(){
		$query = $this->db->where('publish', 'y');
		$query = $this->db->order_by('id_slider', 'desc');
		$query = $this->db->get('tb_slider');
		if ($query->num_rows()>0) {
			$data['result'] = $query->result();
		}
		else {
			$data['result'] = null;
		}
		$this->load->view('slide', $data);
	}
}
