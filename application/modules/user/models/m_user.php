<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model {

	var $table = 'tb_administrator';
	function getAll($limit = array()){
		// $this->_filter();
		$this->db->order_by($this->table.".id_admin",'desc');
		if($limit == NULL){
			return $this->db->get($this->table);
		}
		else {
			$this->db->limit($limit['perpage'], $limit['offset']);
			return $this->db->get($this->table);
		}
	}

	function insert($data)
	{
		$this->db->insert($this->table, $data);
	}

	function getById($id)
	{
		$this->db->where('id_admin', $id);
		return $this->db->get($this->table);
	}

	function update($id, $data)
	{
		$this->db->where('id_admin', $id);
		$this->db->update($this->table, $data);
	}

	function delete($id)
	{
		$this->db->where('id_admin', $id);
		$this->db->delete($this->table);
	}

}

/* End of file m_user.php */
/* Location: ./application/modules/user/models/m_user.php */