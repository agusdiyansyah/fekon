<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_profil extends CI_Model {
	var $table = 'tb_profil';
	function getAll(){
		return $this->db->get('tb_profil');
	}
	function getByUrl($url){
		$this->db->where('url', $url);
		return $this->db->get($this->table,1);
	}
	function getById($id_profil){
		$this->db->where('id_profil', $id_profil);
		return $this->db->get($this->table,1);
	}
	function insert($data){
		$this->db->insert($this->table, $data);
	}
	function update($id_profil, $data){
		$this->db->where('id_profil', $id_profil);
		$this->db->update($this->table, $data);
	}
	function delete($id_profil){
		$this->db->where('id_profil', $id_profil);
		$this->db->delete($this->table);
	}
}