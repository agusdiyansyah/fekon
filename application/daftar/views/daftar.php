<?php  
	foreach ($prodi as $key) {
		echo 
			anchor('daftar/tambah/'.$key->id_prodi, $key->prodi)
			.'<br>'
		;
	}
?>