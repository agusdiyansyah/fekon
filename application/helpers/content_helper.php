<?php
if( !function_exists('profil_list') ){
	function profil_list()
	{
		$ci = & get_instance();
		$query = $ci->db->select('id_profil, title, clean_url');
		$query = $ci->db->get('tb_profil');
		return $query->result_array();

		/*
		how to use
		$this->load->helper('content_helper');
		$profil_list = profil_list();
		foreach ($profil_list as $key => $value) {
			echo $value['title']."<br>";
		}
		*/
	}
	function prodi_list()
	{
		$ci = & get_instance();
		$query = $ci->db->select('id_prodi, prodi');
		$query = $ci->db->get('tb_prodi');
		return $query->result_array();

		/*
		how to use
		$this->load->helper('content_helper');
		$prodi_list = prodi_list();
		foreach ($prodi_list as $key => $value) {
			echo $value['title']."<br>";
		}
		*/
	}
	
}
?>