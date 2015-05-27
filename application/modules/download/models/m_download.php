<?php 
class M_download extends CI_Model {
	var $table = "tb_download";
	
	function getAll($limit = array()){
		$this->filter();
		$this->db->where('publish', 'y');
		$this->db->order_by("id_download", 'desc');
		if($limit == NULL){
			return $this->db->get($this->table);
		}
		else {
			$this->db->limit($limit['perpage'], $limit['offset']);
			return $this->db->get($this->table);
		}
	}
	function getLastest($jum){
		$this->db->order_by('id_download', 'desc');
		return $this->db->get($this->table, $jum);
	}
	function getFavorit($jum){
		$this->db->order_by('downloaded', 'desc');
		return $this->db->get($this->table, $jum);	
	}
	function getById($id_download, $url){
		$this->db->where('id_download', $id_download);
		$this->db->where('clean_url', $url);
		$this->db->where('publish', 'y');
		return $this->db->get($this->table);
	}
	function update_downloaded($id_download, $data){
		$this->db->where('id_download', $id_download);
		$this->db->update($this->table, $data);
	}
	private function filter(){
		$download_cari = $this->session->userdata('download_cari');
		if ($download_cari) {
			$this->db->like('title', $download_cari, 'both');
		}
	}
}
