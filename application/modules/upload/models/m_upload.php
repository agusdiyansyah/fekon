<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_upload extends CI_Model {
	var $table = 'tb_upload';
	function getAll($limit = array()){
		$this->_filter();
		$this->db->order_by($this->table.".id_upload",'desc');
		if($limit == NULL){
			return $this->db->get($this->table);
		}
		else {
			$this->db->limit($limit['perpage'], $limit['offset']);
			return $this->db->get($this->table);
		}
	}
	function getById($id_upload){
		$this->db->where('id_upload', $id_upload);
		return $this->db->get($this->table);
	}
	function getWidget($id_prodi=""){
		if ($id_prodi) {
			$this->db->where('tb_upload.id_prodi', $id_prodi);
		}
		return $this->db->get($this->table);
	}
	function insert($data){
		$this->db->insert($this->table, $data);
	}
	function update($id_upload, $data){
		$this->db->where('id_upload', $id_upload);
		$this->db->update($this->table, $data);
	}
	function delete($id_upload){
		$this->db->where('id_upload', $id_upload);
		$this->db->delete($this->table);
	}
	function combobox($id_prodi="", $selected=""){
		$options[""] = "::Pilih dosen::";
		if ($id_prodi) {
			$query = $this->db->where('id_prodi', $id_prodi);
		}
		$query = $this->db->order_by('dosen', 'asc');
		$query = $this->db->get('tb_upload');
		foreach ($query->result() as $record) {
			$options[$record->id_upload] = $record->dosen;
		}
		return form_dropdown('id_upload', $options, $selected, 'id="id_upload" class="form-control"');
	}

	function _filter(){
		$foot = $this->session->userdata('foot');
		if ($foot) {
			$this->db->where('foot', $foot);
		}
	}
	

}

/* End of file m_upload.php */
/* Location: ./application/modules/dosen/models/m_upload.php */