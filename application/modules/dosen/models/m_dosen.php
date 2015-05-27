<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_dosen extends CI_Model {
	var $table = 'tb_dosen';
	function getAll($limit = array()){
		$this->_filter();
		$this->db->join('tb_prodi', 'tb_prodi.id_prodi = tb_dosen.id_prodi');
		$this->db->order_by($this->table.".id_dosen");
		if($limit == NULL){
			return $this->db->get($this->table);
		}
		else {
			$this->db->limit($limit['perpage'], $limit['offset']);
			return $this->db->get($this->table);
		}
	}
	function getByStaf($staf)
	{
		$this->db->where('tb_dosen.staf', $staf);
		return $this->db->get($this->table);
	}
	function getByProdi($id,$staf)
	{
		$this->db->where('tb_dosen.id_prodi', $id);
		$this->db->where('tb_dosen.staf', $staf);
		return $this->db->get($this->table);
	}
	function getById($id_dosen){
		$this->db->join('tb_prodi', 'tb_prodi.id_prodi = tb_dosen.id_prodi');
		$this->db->where('tb_dosen.id_dosen', $id_dosen);
		return $this->db->get($this->table);
	}
	function getWidget($id_prodi=""){
		if ($id_prodi) {
			$this->db->where('tb_dosen.id_prodi', $id_prodi);
		}
		return $this->db->get($this->table);
	}
	function insert($data){
		$this->db->insert($this->table, $data);
	}
	function update($id_dosen, $data){
		$this->db->where('id_dosen', $id_dosen);
		$this->db->update($this->table, $data);
	}
	function delete($id_dosen){
		$this->db->where('id_dosen', $id_dosen);
		$this->db->delete($this->table);
	}
	function combobox($id_prodi="", $selected=""){
		$options[""] = "::Pilih dosen::";
		if ($id_prodi) {
			$query = $this->db->where('id_prodi', $id_prodi);
		}
		$query = $this->db->order_by('dosen', 'asc');
		$query = $this->db->get('tb_dosen');
		foreach ($query->result() as $record) {
			$options[$record->id_dosen] = $record->dosen;
		}
		return form_dropdown('id_dosen', $options, $selected, 'id="id_dosen" class="form-control"');
	}

	function _filter(){
		$id_prodi = $this->session->userdata('dosen_id_prodi');
		$dosen = $this->session->userdata('dosen_dosen');
		if ($id_prodi) {
			$this->db->where('tb_dosen.id_prodi', $id_prodi);
		}
		if ($dosen) {
			$this->db->like('tb_dosen.dosen', $dosen, 'both');
		}
	}
	

}

/* End of file m_dosen.php */
/* Location: ./application/modules/dosen/models/m_dosen.php */