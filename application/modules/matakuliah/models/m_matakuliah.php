<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_matakuliah extends CI_Model {
	var $table = "tb_matakuliah";
	function getAll($limit = array()){
		$this->_filter();
		$this->db->join('tb_konsentrasi', 'tb_konsentrasi.id_konsentrasi = tb_matakuliah.id_konsentrasi');
		$this->db->join('tb_prodi', 'tb_prodi.id_prodi = tb_konsentrasi.id_prodi');
		$this->db->order_by($this->table.".matakuliah");
		if($limit == NULL){
			return $this->db->get($this->table);
		}
		else {
			$this->db->limit($limit['perpage'], $limit['offset']);
			return $this->db->get($this->table);
		}
	}
	function getById($id_matakuliah){
		$this->db->select('tb_konsentrasi.konsentrasi');
		$this->db->select('tb_prodi.prodi, tb_prodi.id_prodi');
		$this->db->select('tb_matakuliah.*');
		$this->db->join('tb_konsentrasi', 'tb_matakuliah.id_konsentrasi = tb_konsentrasi.id_konsentrasi');
		$this->db->join('tb_prodi', 'tb_prodi.id_prodi = tb_konsentrasi.id_prodi');
		$this->db->where('tb_matakuliah.id_matakuliah', $id_matakuliah);
		return $this->db->get($this->table);
	}
	function insert($data){
		$this->db->insert($this->table, $data);
	}
	function update($id_matakuliah, $data){
		$this->db->where('id_matakuliah', $id_matakuliah);
		$this->db->update($this->table, $data);
	}
	function delete($id_matakuliah){
		$this->db->where('id_matakuliah', $id_matakuliah);
		$this->db->delete($this->table);
	}
	function combobox($id_konsentrasi="", $selected=""){
		$options[""] = "::Pilih Mata Kuliah::";
		if ($id_konsentrasi) {
			$query = $this->db->where('id_konsentrasi', $id_konsentrasi);
		}
		$query = $this->db->order_by('matakuliah', 'asc');
		$query = $this->db->get('tb_matakuliah');
		foreach ($query->result() as $record) {
			$options[$record->id_matakuliah] = $record->matakuliah;
		}
		return form_dropdown('id_matakuliah', $options, $selected, 'id="id_matakuliah"');
	}

	function _filter(){
		$id_prodi = $this->session->userdata('matakuliah_id_prodi');
		$id_konsentrasi = $this->session->userdata('matakuliah_id_konsentrasi');
		$matakuliah = $this->session->userdata('matakuliah_matakuliah');
		if ($id_prodi) {
			$this->db->where('tb_konsentrasi.id_prodi', $id_prodi);
		}
		if ($id_konsentrasi) {
			$this->db->where('tb_matakuliah.id_konsentrasi', $id_konsentrasi);
		}
		if ($matakuliah) {
			$this->db->like('tb_matakuliah.matakuliah', $matakuliah, 'both');
		}
	}
	

}

/* End of file m_matakuliah.php */
/* Location: ./application/modules/matakuliah/models/m_matakuliah.php */