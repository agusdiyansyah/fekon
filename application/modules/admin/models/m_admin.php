<?php 
class M_admin extends CI_Model {
	var $tb_admin = "tb_administrator";
	var $tb_level = "tbb_level";
	
	function getAll(){
		$this->db->join('tbb_level', 'tb_administrator.id_level = tbb_level.id_level', 'left');
		$this->db->order_by($this->tb_admin.".id_level", 'asc');
		return $this->db->get($this->tb_admin);
	}
	function combobox($selected=""){
		//$this->db->where('id_level !=', 1);
		$query = $this->db->get($this->tb_level);
		foreach ($query->result_array() as $row) {
			$data[$row['id_level']] = $row['level'];
		}
		return form_dropdown("id_admin", $data, $selected, 'id="id_admin"');
	}
	function insert($data){
		$this->db->insert($this->tb_admin, $data);
	}
	function update($id_admin, $data){
		$this->db->where('id_admin', $id_admin);
		$this->db->update($this->tb_admin, $data);
	}
	function delete($id_admin){
		$this->db->where('id_admin', $id_admin);
		$this->db->delete($this->tb_admin);
	}
	function getById($id_admin){
		$this->db->where('id_admin', $id_admin);
		return $this->db->get($this->tb_admin);
	}
}
