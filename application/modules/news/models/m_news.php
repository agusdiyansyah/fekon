<?php 
class M_news extends CI_Model {
	var $table = "tb_news";
	
	function getAll($limit = array()){
		$this->filter();
		if($this->uri->segment(3) == "admin"){
			$this->db->where('tb_news.publish', 'y');
		}
		$this->db->join('tb_administrator', 'tb_news.id_admin = tb_administrator.id_admin', 'left');
		$this->db->order_by($this->table.".date", 'desc');
		if($limit == NULL){
			return $this->db->get($this->table);
		}
		else {
			$this->db->limit($limit['perpage'], $limit['offset']);
			return $this->db->get($this->table);
		}
	}
	function getLastest($limit){
		$this->db->where('tb_news.publish', 'y');
		$this->db->join('tb_administrator', 'tb_news.id_admin = tb_administrator.id_admin', 'left');
		$this->db->order_by('tb_news.time', 'desc');
		$this->db->order_by('tb_news.date', 'desc');
		$this->db->limit($limit);
		return $this->db->get($this->table);
	}
	function getLainnya(){
		$this->db->where('tb_news.publish', 'y');
		$this->db->join('tb_administrator', 'tb_news.id_admin = tb_administrator.id_admin', 'left');
		$this->db->order_by('tb_news.title', 'random');
		return $this->db->get($this->table, 5);
	}
	function getByUrl($clean_url){
		$this->db->join('tb_administrator', 'tb_news.id_admin = tb_administrator.id_admin', 'left');
		$this->db->where('clean_url', $clean_url);
		$this->db->where('publish', 'y');
		return $this->db->get('tb_news',1);
	}
	function getById($id_news, $url){
		$this->db->where('tb_news.publish', 'y');
		$this->db->where('tb_news.clean_url', $url);
		$this->db->join('tb_administrator', 'tb_news.id_admin = tb_administrator.id_admin', 'left');	
		$this->db->where('tb_news.id_news', $id_news);
		return $this->db->get($this->table);
	}
	function whereId($id_news){
		$this->db->where('id_news', $id_news);
		return $this->db->get($this->table);
	}
	function update_views($id_news){
		$query = $this->getById($id_news);
		if ($query->num_rows>0) {
			$record = $query->row();
			$this->db->where('id_news', $record->id_news);
			$data['view'] = $record->view+1;
			$this->db->update($this->table, $data);			
		}
	}
	private function filter(){
		$articleCari = $this->session->userdata('articleCari');
		$articleCari_title = $this->session->userdata('articleCari_title');
		$articleCari_dateStart = $this->session->userdata('articleCari_dateStart');
		$articleCari_dateEnd = $this->session->userdata('articleCari_dateEnd');
		$articleCari_publish = $this->session->userdata('articleCari_publish');
		$articleCari_admin = $this->session->userdata('articleCari_admin');
		if ($articleCari_title) {
			$this->db->like('title', $articleCari_title, 'both');
		}
		if ($articleCari_dateStart) {
			$this->db->where('date >=', $articleCari_dateStart);
		}
		if ($articleCari_dateEnd) {
			$this->db->where('date <=', $articleCari_dateEnd);
		}
		if ($articleCari_publish) {
			$this->db->where('publish', $articleCari_publish);
		}
		if ($articleCari_admin) {
			$this->db->where('tb_news.id_admin', $articleCari_admin);
		}
	}
	function insert($data){
		$this->db->insert($this->table, $data);
	}
	function update($id_news, $data){
		$this->db->where('id_news', $id_news);
		$this->db->update($this->table, $data);
	}
	function delete($id_news){
		$this->db->where('id_news', $id_news);
		$this->db->delete($this->table);
	}
}
