<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fungsi
{
	function Fungsi()
	{
		$this->CI =& get_instance();
	}
	function create_combobox($name,$dbobj,$key,$value,$extra='',$edit=''){
		$select = '<select name="'.$name.'" '.$extra.'>';
		$select .= '<option value="">:: pilih ::</option>';
		foreach($dbobj->result() as $row)
		{
			$selected = '';
			if($edit!=''){
				//jika mengunakan format dropdown checklis
				$findSaparator = strpos($edit, "|");
				if ($findSaparator !== false){
					$explode = explode("|", $edit);
					$count = count($explode);
					$i = 0;
					for ($i=0; $i<$count; $i++){
						if ($row->$key == $explode[$i]){
							$selected = "selected='selected'";
						}
					}
				}
				//==========================================
				else {
					if($row->$key == $edit){
						$selected = "selected='selected'";
					}
				}
			}
			$select .= '<option value="'.$row->$key.'" '.$selected.'>'.$row->$value.'</option>';
		}
		$select .= '</select>';
		return $select;
	}
	function create_combobox_kecamatan($name,$dbobj,$key,$value,$extra='',$edit=''){
		$select = '<select name="'.$name.'" '.$extra.'>';
		$select .= '<option value="">:: pilih ::</option>';
		foreach($dbobj->result() as $row){
			$selected = '';
			if($edit!=''){
				if($row->$key == $edit){
					$selected = "selected='selected'";
				}
			}
			$select .= '<option value="'.$row->$key.'" '.$selected.'>'.$row->$value.'</option>';
		}
		$select .= '</select>';
		return $select;
	}
	function create_checkbox($dbobj, $name, $edit = ''){
		$checkbox = '';
		$arr_Edit = explode(',', $edit);
		foreach ($dbobj->result() as $row){
			if($edit != ''){
				$checked = (array_search($row->nama, $arr_Edit) === false)? '' : 'checked';
			}
			else{
				$checked = '';
			}
			$checkbox .= "<div class='checkbox_wrapper'><input type=checkbox class='checkbox' name='".$name."[]' value='$row->nama' $checked>$row->nama   </div>";
		}
		return $checkbox;
	}
	function radio_publish($value = ""){
		if($value == ""){
			$publish = "";
			$publish .= form_radio('publish', 'Y'). " Y || ";
			$publish .= form_radio('publish', 'N'). " N ";
		}
		else {
			if($value == "Y"){
				$publish = "";
				$publish .= form_radio('publish', 'Y', 'checked'). " Y || ";
				$publish .= form_radio('publish', 'N'). " N ";
			}
			else if ($value == "N"){
				$publish = "";
				$publish .= form_radio('publish', 'Y'). " Y || ";
				$publish .= form_radio('publish', 'N', 'checked'). " N ";
			}
		}
		return $publish;
	}
	function clean_url($judul){
		$search = array(" ",",", "'", "(", ")", ";", ":", "/", ".");
		$replace = "-";
		return str_replace($search, $replace, $judul);
	}
}
?>