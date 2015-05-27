<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_link extends CI_Model {
	var $table = "tb_link";
	function getAll(){
		return $this->db->get($this->table);
	}
	

}

/* End of file m_link.php */
/* Location: ./application/modules/link_terkait/models/m_link.php */