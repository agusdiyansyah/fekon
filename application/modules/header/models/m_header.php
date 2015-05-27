<?php 
class M_header extends CI_Model {
	var $table = 'tb_header';
	function getAll($limit = array()){
		$this->db->order_by($this->table.".id_header");		
		if($limit == NULL){
			return $this->db->get($this->table);
		}
		else {
			$this->db->limit($limit['perpage'], $limit['offset']);
			return $this->db->get($this->table);
		}
	}
	function delete($id_header){
		$this->db->where('id_header', $id_header);
		$this->db->delete($this->table);
	}
	function insert($data)
	{
		$this->db->insert($this->table, $data);
	}
	function update($id, $data)
	{
		$this->db->where('id_header', $id);
		$this->db->update($this->table, $data);
	}
	function getById($id)
	{
		$this->db->where('id_header', $id);
		return $this->db->get($this->table);
	}
	function getData($id, $slug)
	{
		$this->db->where('id_header', $id);
		$this->db->where('slug', $slug);
		return $this->db->get($this->table);
	}
}