<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_pendaftaran extends CI_Model {

	function insert($data, $tb){
		$query = $this->db->insert($tb, $data);
		// return $query;
	}

}

/* End of file m_pendaftaran.php */
/* Location: ./application/modules/pendaftaran/models/m_pendaftaran.php */