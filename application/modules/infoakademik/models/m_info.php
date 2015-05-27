<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_info extends CI_Model {
	var $tbl = "tb_info_akademik";
	function getAll($limit = array())
	{
		$this->db->order_by('date', 'desc');
		if ($limit = null) {
			return $this->db->get($this->tbl);
		}else{
			return $this->db->get($this->tbl, $limit['perpage'], $limit['offset']);
		}
	}
	function widget()
	{
		$this->db->order_by('date', 'desc');
		return $this->db->get($this->tbl, 5, 0);
	}
	function getById($id, $url = '')
	{
		if (!empty($url)) {
			$this->db->where('publish', 'y');
			$this->db->where('slug', $url);
		}
		$this->db->where('id_info', $id);
		return $this->db->get($this->tbl);
	}	

	function insert($data)
	{
		$this->db->insert($this->tbl, $data);
	}

	function update($id, $data)
	{
		$this->db->where('id_info', $id);
		$this->db->update($this->tbl, $data);
	}

	function delete($id)
	{
		$this->db->where('id_info', $id);
		$this->db->delete($this->tbl);
	}

}

/* End of file m_info.php */
/* Location: ./application/modules/infoakademik/models/m_info.php */