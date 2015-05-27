<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_kontak extends CI_Model {

	var $table = "tb_kontak";
	function get(){
		return $this->db->get($this->table,1);
	}

}

/* End of file m_kontak.php */
/* Location: ./application/modules/kontak/models/m_kontak.php */