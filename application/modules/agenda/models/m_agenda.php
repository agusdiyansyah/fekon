<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_agenda extends CI_Model {
	var $table = 'tb_agenda';
	function getAll($limit = array()){
		$this->db->order_by($this->table.'.date_start', 'desc');
		if ($limit == null) {
			return $this->db->get($this->table);
		} else {
			$this->db->limit($limit['perpage'], $limit['offset']);
			return $this->db->get($this->table);
		}
	}	
	function widget()
	{
		$this->db->limit(5);
		$this->db->where('publish', 'y');
		return $this->db->get($this->table);
	}
	function getNext(){
		$now = date('Y-m-d');
		$this->db->where('date_start >=', $now);
		$this->db->where('publish', 'y');
		$this->db->order_by('date_start', 'desc');
		$this->db->limit(5);
		return $this->db->get($this->table);
	}
	function getById($id, $url = '')
	{
		if (!empty($url)) {
			$this->db->where('publish', 'y');
			$this->db->where('slug', $url);
		}
		$this->db->where('id_agenda', $id);
		return $this->db->get($this->table);
	}

	function insert($data)
	{
		$this->db->insert($this->table, $data);
	}

	function update($id, $data)
	{
		$this->db->where('id_agenda', $id);
		$this->db->update($this->table, $data);
	}

	function delete($id)
	{
		$this->db->where('id_agenda', $id);
		$this->db->delete($this->table);
	}

}

/* End of file m_agenda.php */
/* Location: ./application/modules/agenda/models/m_agenda.php */