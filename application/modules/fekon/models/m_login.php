<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model {

	var $table = "tb_administrator";

	function getData($userid, $password)
	{
		$this->db->where('userid', $userid);
		$this->db->where('password', $password);
		return $this->db->get($this->table);
	}

}

/* End of file m_login.php */
/* Location: ./application/modules/fekon/models/m_login.php */