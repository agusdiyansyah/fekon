<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_daftar extends CI_Model {
	var $table = 'tb_daftar';
	public function __construct()
	{
		parent::__construct();
	}
	function getAll($limit = array()){
		$this->db->select('tb_data_pribadi.*,tb_daftar.date');
		$this->db->from($this->table);
		$this->db->join('tb_data_pribadi', 'tb_daftar.nik = tb_data_pribadi.nik','left');
		$this->db->join('tb_pendidikan', 'tb_daftar.nik = tb_pendidikan.nik','left');
		$this->db->join('tb_pekerjaan', 'tb_daftar.nik = tb_pekerjaan.nik','left');
		$this->db->join('tb_publikasi', 'tb_daftar.nik = tb_publikasi.nik','left');
		$this->db->join('tb_prodi', 'tb_daftar.id_prodi = tb_prodi.id_prodi','left');
		$this->db->order_by('tb_daftar.id_daftar', 'desc');
		$this->db->group_by('tb_data_pribadi.nik');
		if ($limit == null) {
			return $this->db->get();
		} else {
			$this->db->limit($limit['perpage'], $limit['offset']);
			return $this->db->get();
		}
	}
	function getProdi()
	{
		$this->db->select('id_prodi, jenjang, prodi');
		return $this->db->get('tb_prodi');
	}
	function getByNik($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('tb_data_pribadi', 'tb_daftar.nik = tb_data_pribadi.nik','left');
		$this->db->join('tb_pendidikan', 'tb_daftar.nik = tb_pendidikan.nik','left');
		$this->db->join('tb_pekerjaan', 'tb_daftar.nik = tb_pekerjaan.nik','left');
		$this->db->join('tb_publikasi', 'tb_daftar.nik = tb_publikasi.nik','left');
		$this->db->join('tb_prodi', 'tb_daftar.id_prodi = tb_prodi.id_prodi','left');
		$this->db->where('tb_data_pribadi.nik', $id);
		return $this->db->get();
	}
	function getPendidikan($id)
	{
		$this->db->where('nik', $id);
		return $this->db->get('tb_pendidikan');
	}
	function getById($id)
	{
		$this->db->where('id_prodi', $id);
		return $this->db->get('tb_prodi');
	}
	function get($table, $nik)
	{
		$this->db->where('nik', $nik);
		return $this->db->get($table);
	}
	function delete($table, $nik)
	{
		$this->db->where('nik', $nik);
		$this->db->delete($table);
	}
	function insert($tbl, $data)
	{
		$in = $this->db->insert($tbl, $data);
		if ($in) {
			return true;
		}
	}

}

/* End of file m_daftar.php */
/* Location: ./application/modules/daftar/models/m_daftar.php */