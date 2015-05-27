<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_konsentrasi extends CI_Model {
	var $table = 'tb_konsentrasi';
	function getAll($limit = array()){
		$this->_filter();
		$this->db->join('tb_prodi', 'tb_prodi.id_prodi = tb_konsentrasi.id_prodi');
		$this->db->order_by($this->table.".konsentrasi");
		if($limit == NULL){
			return $this->db->get($this->table);
		}
		else {
			$this->db->limit($limit['perpage'], $limit['offset']);
			return $this->db->get($this->table);
		}
	}
	function getById($id_konsentrasi){
		$this->db->join('tb_prodi', 'tb_prodi.id_prodi = tb_konsentrasi.id_prodi');
		$this->db->where('tb_konsentrasi.id_konsentrasi', $id_konsentrasi);
		return $this->db->get($this->table);
	}
	function getWidget($id_prodi=""){
		if ($id_prodi) {
			$this->db->where('tb_konsentrasi.id_prodi', $id_prodi);
		}
		return $this->db->get($this->table);
	}
	function insert($data){
		$this->db->insert($this->table, $data);
	}
	function update($id_konsentrasi, $data){
		$this->db->where('id_konsentrasi', $id_konsentrasi);
		$this->db->update($this->table, $data);
	}
	function delete($id_konsentrasi){
		$this->db->where('id_konsentrasi', $id_konsentrasi);
		$this->db->delete($this->table);
	}
	function combobox($id_prodi="", $selected=""){
		$options[""] = "::Pilih Konsentrasi::";
		if ($id_prodi) {
			$query = $this->db->where('id_prodi', $id_prodi);
		}
		$query = $this->db->order_by('konsentrasi', 'asc');
		$query = $this->db->get('tb_konsentrasi');
		foreach ($query->result() as $record) {
			$options[$record->id_konsentrasi] = $record->konsentrasi;
		}
		return form_dropdown('id_konsentrasi', $options, $selected, 'id="id_konsentrasi" class="form-control"');
	}

	function _filter(){
		$id_prodi = $this->session->userdata('konsentrasi_id_prodi');
		$konsentrasi = $this->session->userdata('konsentrasi_konsentrasi');
		if ($id_prodi) {
			$this->db->where('tb_konsentrasi.id_prodi', $id_prodi);
		}
		if ($konsentrasi) {
			$this->db->like('tb_konsentrasi.konsentrasi', $konsentrasi, 'both');
		}
	}
	

}

/* End of file m_konsentrasi.php */
/* Location: ./application/modules/konsentrasi/models/m_konsentrasi.php */