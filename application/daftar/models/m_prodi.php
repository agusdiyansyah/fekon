<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_prodi extends CI_Model {

	function getAll()
	{
		$this->db->order_by('jenjang', 'asc');
		$query = $this->db->get('tb_prodi');
		return $query->result();
	}	
	function getById($id){
		$this->db->where('id_prodi', $id);
		$query = $this->db->get('tb_prodi');
		return $query->row();
	}

}

/* End of file m_prodi.php */
/* Location: ./application/modules/pendaftaran/models/m_prodi.php */