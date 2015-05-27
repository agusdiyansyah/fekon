<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_prodi extends CI_Model {
	var $table = 'tb_prodi';
	function getAll($limit = array()){
		$this->db->order_by($this->table.".prodi");
		if($limit == NULL){
			return $this->db->get($this->table);
		}
		else {
			$this->db->limit($limit['perpage'], $limit['offset']);
			return $this->db->get($this->table);
		}
	}
	function updateR($id, $mode, $data)
	{
		$this->db->query("update tb_prodi set ".$mode." = '".$data."' where id_prodi = '".$id."'");
	}
	function getById($id_prodi){
		$this->db->where('id_prodi', $id_prodi);
		return $this->db->get($this->table);
	}
	function getWidget(){
		$this->db->select('id_prodi, prodi');
		return $this->db->get($this->table);
	}
	function insert($data){
		$this->db->insert($this->table, $data);
	}
	function update($id_prodi, $data){
		$this->db->where('id_prodi', $id_prodi);
		$this->db->update($this->table, $data);
	}
	function delete($id_prodi){
		$this->db->where('id_prodi', $id_prodi);
		$this->db->delete($this->table);
	}
	function combobox($selected=""){
		$options[""] = "::Pilih Program Studi::";
		$query = $this->getAll();
		foreach ($query->result() as $record) {
			$options[$record->id_prodi] = $record->prodi;
		}
		return form_dropdown('id_prodi', $options, $selected, 'id="id_prodi" class="form-control"');
	}
}

/* End of file m_prodi.php */
/* Location: ./application/modules/prodi/models/m_prodi.php */