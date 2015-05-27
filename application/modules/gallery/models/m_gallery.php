<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_gallery extends CI_Model {
	var $table = "tb_gallery";
	
	public function getAllKategori()
	{
		$string = "
		SELECT kategori.*,  
		(SELECT image FROM tb_gallery WHERE id_category = kategori.id_category AND tb_gallery.image != '' LIMIT 0, 1) AS cover,
		(SELECT id_gallery FROM tb_gallery WHERE id_category = kategori.id_category AND tb_gallery.image != '' LIMIT 0, 1) AS id_gallery  
		FROM tb_gallery_category kategori  
		ORDER BY date desc, time desc
		";
		return $this->db->query($string);
	}
	function getKategoriById($id_category){
		$this->db->where('id_category', $id_category);
		return $this->db->get('tb_gallery_category',1);
	}
	function getByKategori($id_category){
		$this->db->select('
			tb_gallery.*, 
			tb_gallery_category.name_category , tb_gallery_category.date
			');
		$this->db->join('tb_gallery_category', 'tb_gallery.id_category = tb_gallery_category.id_category');
		$this->db->where('tb_gallery.id_category', $id_category);
		return $this->db->get('tb_gallery');
	}
	function detil_lainnya($id_gallery, $id_category){
		$this->db->where('tb_gallery.id_gallery !=', $id_gallery);
		$this->db->where('tb_gallery.id_category', $id_category);
		return $this->db->get('tb_gallery');
	}
	function getById($id_gallery){		
		$this->db->select('tb_gallery.*');
		$this->db->select('tb_gallery_category.name_category, tb_gallery_category.date, tb_gallery_category.time');
		$this->db->join('tb_gallery_category', 'tb_gallery.id_category = tb_gallery_category.id_category');
		$this->db->where('tb_gallery.id_gallery', $id_gallery);
		return $this->db->get('tb_gallery');
	}
	function list_thumb(){
		$this->db->order_by('id_gallery', 'desc');
		return $this->db->get('tb_gallery', 10);
	}

	function getAll($limit = array()){
		$this->filter();
		$level = $this->session->userdata('level');
		$this->db->join('tb_gallery_category', 'tb_gallery.id_category = tb_gallery_category.id_category');
		$this->db->order_by("date", 'desc');
		$this->db->order_by("time", 'desc');
		if($limit == NULL){
			return $this->db->get($this->table);
		}
		else {
			$this->db->limit($limit['perpage'], $limit['offset']);
			return $this->db->get($this->table);
		}
	}
	function insert($data){
		$this->db->insert($this->table, $data);
	}
	function update($id_gallery, $data){
		$this->db->where('id_gallery', $id_gallery);
		$this->db->update($this->table, $data);
	}
	function delete($id_gallery){
		$this->db->where('id_gallery', $id_gallery);
		$this->db->delete($this->table);
	}
	function getCat($id_category){
		$this->db->where('id_category', $id_category);
		$query = $this->db->get('tb_gallery_category',1);
		$record = $query->row();
		return $record->name_category;
	}	
	private function filter(){
		$galleryCari = $this->session->userdata('galleryCari');
		$galleryCari_title = $this->session->userdata('galleryCari_title');
		$galleryCari_category = $this->session->userdata('galleryCari_category');
		if ($galleryCari_title) {
			$this->db->like('title', $galleryCari_title, 'both');
		}
		if ($galleryCari_category) {
			$this->db->where('tb_gallery.id_category', $galleryCari_category);
		}
	}
}

/* End of file M_gallery.php */
/* Location: ./application/modules/gallery/models/M_gallery.php */