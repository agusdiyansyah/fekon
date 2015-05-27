<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//librari My_table.php
class Tabel_ku {
	function tabel($heading, $data){
		$CI =& get_instance();
		$CI->load->library('table');
		$table = array(
					'table_open'=>'<table width="100%" cellpading="0" cellspacing="0">',
				    //'table_open'          => '<table class="tablesorter">',
				    'heading_row_start'   => '<thead><tr>',
				    'heading_row_end'     => '</tr></thead><tbody>',
				    'table_close'         => '</body></table>'
    	);
		$CI->table->set_template($table);
		$CI->table->set_heading($heading);
		foreach ($data as $key => $value){
			$CI->table->add_row($value);
		}
		return $CI->table->generate();
	}
}