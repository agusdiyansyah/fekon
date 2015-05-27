<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_slide extends CI_Model {
	public function getAll()
	{
		$this->db->where('publish', 'y');
		return $this->db->get('tb_slider');
	}
}

/* End of file m_slide.php */
/* Location: ./application/models/m_slide.php */