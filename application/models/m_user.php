<?php
class M_user extends CI_Model {
	function getAll(){
		$this->db->order_by('id_user', 'desc');
		return $this->db->get('tb_user');
	}
	function tambah($data){
		$this->db->insert('tb_user', $data);
	}
}