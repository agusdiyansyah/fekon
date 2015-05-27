<?php  
	foreach ($file as $key) {
		$url = $this->fungsi->clean_url(strtolower($key->nama));
		echo anchor(site_url('upload/download/'.$key->id_upload.'-'.$url), $key->nama);
		echo "<br>";
	}
?>