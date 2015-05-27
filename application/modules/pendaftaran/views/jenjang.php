<!-- <input type="submit" name="jenjang" value="Pasca Sarjana (S2)">&nbsp 
<input type="submit" name="jenjang" value="Program Doktor (S3)"> -->
<b>E-Pendaftaran</b>
<br>
<!-- <a href="<?php echo site_url('pendaftaran/tambah/mm') ?>">Magister Management</a><br>
<a href="<?php echo site_url('pendaftaran/tambah/me') ?>">Magister Ekonomi</a><br>
<a href="<?php echo site_url('pendaftaran/tambah/ma') ?>">Magister Akuntansi</a><br>
<a href="<?php echo site_url('pendaftaran/tambah/ppak') ?>">Pendidikan Profesi Akuntansi (PPAk)</a><br>
<hr>	
<a href="<?php echo site_url('pendaftaran/tambah/de') ?>">Program Doktor Ilmu Ekonomi</a><br>
<a href="<?php echo site_url('pendaftaran/tambah/da') ?>">Program Doktor Ilmu Akuntansi</a><br> -->
<?php  
	foreach ($prodi as $key) {
		echo anchor('pendaftaran/tambah/'.$key->id_prodi, $key->prodi);
		echo "<br>";
	}
?>