<?php 
class M_cat extends CI_Model {
	var $table = "tb_gallery_category";
	
	function getAll($limit = array()){
		$this->db->order_by("id_category", 'desc');
		if($limit == NULL){
			return $this->db->get($this->table);
		}
		else {
			$this->db->limit($limit['perpage'], $limit['offset']);
			return $this->db->get($this->table);
		}
	}
	function combobox($selected=""){
		$query = $this->getAll();
		$options[""] = "::Kategori Galeri::";
		foreach ($query->result() as $record) {
			$options[$record->id_category] = $record->name_category;
		}
		return form_dropdown('id_category', $options, $selected, 'id="id_category" class="input-xxlarge"');
	}
	function insert($data){
		$this->db->insert($this->table, $data);
	}
	function update($id_category, $data){
		$this->db->where('id_category', $id_category);
		$this->db->update($this->table, $data);
	}
	function delete($id_category){
		$this->db->where('id_category', $id_category);
		$this->db->delete($this->table);
	}
	function getById($id_category){
		$this->db->where('id_category', $id_category);
		return $this->db->get($this->table);
	}
}
