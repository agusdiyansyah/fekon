<p>Prodi Pilihan : <b><?php echo $prodi->prodi ?></b></p>
<input type="hidden" name="id_prodi" value="<?php echo $id ?>">
<b>Data Pribadi</b>
<hr>
<!-- form eror -->
<?php 
	echo 
		form_error('nik').
		form_error('nama').
		form_error('tempat').
		form_error('tgl').
		form_error('alamat').
		form_error('kota').
		form_error('kodepos').
		form_error('telp').
		form_error('email').
		form_error('s1-nama-pt').
		form_error('s1-prodi').
		form_error('s1-alamat-pt').
		form_error('s1-masuk').
		form_error('s1-lulus').
		form_error('s1-ipk').
		form_error('s2-nama-pt').
		form_error('s2-prodi').
		form_error('s2-alamat-pt').
		form_error('s2-masuk').
		form_error('s2-lulus').
		form_error('s2-ipk')
		; 
?>
<p>NIK KTP</p>
<input type="text" name="nik">
<p>Nama Lengkap dan Gelar *</p>
<input type="text" name="nama">
<p>Tempat Tanggal Lahir *</p>
<input type="text" name="tempat" placeholder="Tempat"> - <input type="text" name="tgl" placeholder="Tanggal Lahr">
<p>Jenis Kelamin *</p>
<select name="jk">
	<option value="Laki-laki">Laki-laki</option>
	<option value="Perempuan">Perempuan</option>
</select>
<p>Agama *</p>
<select name="agama">
	<option value="Islam">Islam</option>
	<option value="Kristen">Kristen</option>
	<option value="Budha">Budha</option>
	<option value="Hindu">Hindu</option>
	<option value="Kong Ho Cu">Kong Ho Cu</option>
</select>
<p>Alamat Rumah *</p>
<textarea name="alamat"></textarea>
<p>Kota *</p>
<input type="text" name="kota">
<p>Kode Pos *</p>
<input type="text" name="kodepos">
<p>Telphone/No. Hp</p>
<input type="text" name="telp">
<p>Email (Berkas pendaftaran akan dikirim ke email tersebut)</p>
<input type="text" name="email">
<p>Sumber biaya *</p>
<label><input checked id="rd" type="radio" name="biaya" value="sendri"> &nbsp Sendiri</label> &nbsp
<label><input id="rd" type="radio" name="biaya" value="instansi"> &nbsp Instansi</label> &nbsp
<input type="text" name="lainnya" id="lain" placeholder="Lainnya">
<div>
	<?php  
		foreach ($form as $key) {
			$this->load->view($key);
			echo "<br>";
		}
	?>	
</div>
<br>
<p><b>Pekerjaan</b></p>
<hr>
<p>Jenis pekerjaan *</p>
<select name='jenis-pekerjaan'>
	<option value="pns">pns</option>
	<option value="swasta">swasta</option>
	<option value="tni/polri">tni/polri</option>
	<option value="ptn">ptn</option>
	<option value="pts">pts</option>
	<option value="belum bekerja">belum bekerja</option>
</select>
<p>instansi</p>
<input type="text" name="instansi">
<p>nip/nis</p>
<input type="text" name="nip">
<p>pangkat/golongan</p>
<input type="text" name="pangkat">
<p>alamat</p>
<textarea name="alamat-instansi"></textarea>
<p>kota</p>
<input type="text" name="kota">
<p>kodepos</p>
<input type="text" name="kodepos">
<p>telpon kantor</p>
<input type="text" name="tlp-kantor">
<br>
<br>
<p><b>Kegiatan lain</b></p>
<p>Penelitian dan publikasi 5 tahun terakhir</p>
<hr>
<b>penelitian</b>
<p>cantumkan : judul penelitian, tahun, jabatan dalam penelitian (ketua atau anggota), dan sumber dana penelitian</p>
<textarea name="penelitian"></textarea>
<p><b>Publikasi Ilmiah</b></p>
<p>Cantumkan: Pengarang, Tahun Penerbitan, Judul, dimana dipublikasikan</p>
<textarea name="ilmiah"></textarea>
<p><label><input type="checkbox"> &nbsp Dengan ini saya menyatakan bahwa data diatas telah diisi dengan sebenar-benarnya.</label></p>
<input type="submit" value="Daftar">