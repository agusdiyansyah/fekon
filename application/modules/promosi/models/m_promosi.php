<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_promosi extends CI_Model {
	var $table = 'tb_promosi';
	function get()
	{
		return $this->db->get($this->table);
	}
	function update($data)
	{
		$this->db->where('id_promosi', '1');
		$this->db->update($this->table, $data);
	}
	

}

/* End of file m_promosi.php */
/* Location: ./application/modules/promosi/models/m_promosi.php */