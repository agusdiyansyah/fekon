<?php 
class M_article extends CI_Model {
	var $table = "tb_article";
	
	function getAll($limit = array()){
		$this->filter();
		$this->db->where('tb_article.publish', 'y');
		$this->db->join('tb_administrator', 'tb_article.id_admin = tb_administrator.id_admin', 'left');
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
		$this->db->where('tb_article.publish', 'y');
		$this->db->join('tb_administrator', 'tb_article.id_admin = tb_administrator.id_admin', 'left');
		$this->db->order_by('tb_article.date', 'desc');
		return $this->db->get($this->table, $limit);
	}
	function getLainnya(){
		$this->db->where('tb_article.publish', 'y');
		$this->db->join('tb_administrator', 'tb_article.id_admin = tb_administrator.id_admin', 'left');
		$this->db->order_by('tb_article.title', 'random');
		return $this->db->get($this->table, 5);
	}
	function getByUrl($clean_url){
		$this->db->join('tb_administrator', 'tb_article.id_admin = tb_administrator.id_admin', 'left');
		$this->db->where('clean_url', $clean_url);
		$this->db->where('publish', 'y');
		return $this->db->get('tb_article',1);
	}
	function getById($id_article, $url){
		$this->db->where('tb_article.publish', 'y');
		$this->db->where('clean_url', $url);
		$this->db->join('tb_administrator', 'tb_article.id_admin = tb_administrator.id_admin', 'left');	
		$this->db->where($this->table.'.id_article', $id_article);
		return $this->db->get($this->table);
	}
	function update_views($id_article){
		$query = $this->getById($id_article);
		if ($query->num_rows>0) {
			$record = $query->row();
			$this->db->where('id_article', $record->id_article);
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
			$this->db->where('tb_article.id_admin', $articleCari_admin);
		}
	}
}
