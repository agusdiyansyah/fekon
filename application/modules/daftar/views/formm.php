<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<br>
		<form action="<?php echo base_url().'daftar/proses' ?>" method="POST" role="form" id="form">
			<legend>Pendaftaran</legend>
			<input type="hidden" name="id" id="inputS[]" class="form-control" value="<?php echo $id ?>">
			<p>
				Pendaftaran Mahasiswa Baru 2014/2015 <br>
				Program Pasca Sarjana Ekonomi - Universitas Tangjungpura
			</p>
			<a class="text-danger" href="<?php echo site_url('daftar/info_syarat/'.$id) ?>">
				<u><span class="glyphicon glyphicon-link"></span> Syarat dan Tata Cara Pendaftaran *</u>
			</a>
			<footer class="text-danger" style="font-size:8pt">
				<b><i>Harap membaca syarat dan tatacara pendaftaran sebelum melakukan pendaftaran</i></b>
			</footer>
			<br>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
					<legend>Data Pribadi</legend>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 form-group">
					<label for="">NIK (KTP)</label>
					<input type="text" name="nik" id="inputNik" class="form-control required" required="required">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 form-group">
					<label>Nama Lengkap dan Gelar</label>
					<input type="text" name="nama_l" id="inputNama" class="form-control" value=""  title="">
				</div>
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 form-group">
					<label>Tempat dan Tanggal Lahir</label>
					<input type="text" name="ttl" id="inputNama" class="form-control" value=""  title="">
				</div>
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 form-group">
					<label>Jenis Kelamin</label>
					<select name="jk" id="inputJk" class="form-control" >
						<option value="laki-laki">laki-laki</option>
						<option value="perempuan">perempuan</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 form-group">
					<label>Golongan Darah</label>
					<select name="darah" id="inputJk" class="form-control" >
						<option value="a">a</option>
						<option value="b">b</option>
						<option value="o">o</option>
						<option value="ab">ab</option>
					</select>
				</div>
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 form-group">
					<label>Agama</label>
					<select name="agama" id="inputJk" class="form-control" >
						<option value="islam">islam</option>
						<option value="kristen">kristen</option>
						<option value="budha">budha</option>
						<option value="hindu">hindu</option>
						<option value="kong hu cu">kong hu cu</option>
						<option value="lainnya">lainnya</option>
					</select>
				</div>
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 form-group">
					<label>Status Pernikahan</label>
					<select name="nikah" id="inputJk" class="form-control" >
						<option value="menikah">menikah</option>
						<option value="belum menikah">belum menikah</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
					<label>Alamat</label>
					<textarea class="form-control" name="alamat_l"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form-group">
					<label>Kota</label>
					<input type="text" name="kota_l" id="inputKota" class="form-control" value="" title="">
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form-group">
					<label>Kode Pos</label>
					<input type="text" name="pos_l" id="inputPos" class="form-control" value="" title="">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form-group">
					<label>Telphone/No. Hp</label>
					<input type="text" name="telp_l" id="inputTelp" class="form-control" value="" title="">
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form-group">
					<label>Email (berkas pendaftaran akan dikirim ke email)</label>
					<input type="text" name="email_l" id="inputEmail" class="form-control" value="" title="">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form-group">
					<label>Sumber Biaya</label>
					<input type="text" name="biaya" id="inputBiaya" class="form-control" value="" title="">
				</div>
			</div>












			<br>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
					<legend>Pendidikan Sarjana (S1)</legend>
					<input type="hidden" name="sjenjang" id="inputS[]" class="form-control" value="s1">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form-group">
					<label>Nama Perguruan Tinggi</label>
					<input type="text" name="snama" id="input" class="form-control" value="" title="">
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<label>Prodi/Fakultas</label>
					<input type="text" name="sprodi" id="input" class="form-control" value="" title="">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
					<label>Alamat Perguruan Tinggi</label>
					<textarea class="form-control" name="salamat"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form-group">
					<label>Tahun Masuk</label>
					<input type="text" name="smasuk" id="input" class="form-control" value="" title="">
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<label>Tahun Lulus</label>
					<input type="text" name="slulus" id="input" class="form-control" value="" title="">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form-group">
					<label>IPK</label>
					<input type="text" name="sipk" id="input" class="form-control" value="" title="">
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<label>IPK Ujian Negara (Jika Ada)</label>
					<input type="text" name="sipkun" id="input" class="form-control" value="" title="">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form-group">
					<label>Status Perguruan Tinggi</label>
					<select name="sstatus" id="input" class="form-control">
						<option value="negeri">negeri</option>
						<option value="swasta">swasta</option>
					</select>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form-group">
					<label>Gelar</label>
					<input type="text" name="sgelar" id="input" class="form-control" value="" title="">
				</div>
			</div>
			



			<br>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
					<legend>Pendidikan Pasca Sarjana (S2)</legend>
					<input type="hidden" name="ssjenjang" id="inputS[]" class="form-control" value="s2">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form-group">
					<label>Nama Perguruan Tinggi</label>
					<input type="text" name="ssnama" id="input" class="form-control" value="" title="">
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<label>Prodi/Fakultas</label>
					<input type="text" name="ssprodi" id="input" class="form-control" value="" title="">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
					<label>Alamat Perguruan Tinggi</label>
					<textarea class="form-control" name="ssalamat"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form-group">
					<label>Tahun Masuk</label>
					<input type="text" name="ssmasuk" id="input" class="form-control" value="" title="">
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<label>Tahun Lulus</label>
					<input type="text" name="sslulus" id="input" class="form-control" value="" title="">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form-group">
					<label>IPK</label>
					<input type="text" name="ssipk" id="input" class="form-control" value="" title="">
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<label>IPK Ujian Negara (Jika Ada)</label>
					<input type="text" name="ssipkun" id="input" class="form-control" value="" title="">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form-group">
					<label>Status Perguruan Tinggi</label>
					<select name="ssstatus" id="input" class="form-control">
						<option value="negeri">negeri</option>
						<option value="swasta">swasta</option>
					</select>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form-group">
					<label>Gelar</label>
					<input type="text" name="ssgelar" id="input" class="form-control" value="" title="">
				</div>
			</div>









			<br>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
					<legend>Pekerjaan</legend>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form-group">
					<label>Jenis Pekerjaan</label>
					<select name="jenis_k" id="input" class="form-control">
						<option value="pns">pns</option>
						<option value="swasta">swasta</option>
						<option value="tni/polri">tni/polri</option>
						<option value="ptn">ptn</option>
						<option value="pts">pts</option>
						<option value="belum bekerja">belum bekerja</option>
					</select>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form-group">
					<label>Instansi</label>
					<input type="text" name="inst_k" id="input" class="form-control" value=""  title="">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form-group">
					<label>NIP/NIS</label>
					<input type="text" name="nip_k" id="input" class="form-control" value=""  title="">
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form-group">
					<label>Pangkat Golongan</label>
					<input type="text" name="pangkat_k" id="input" class="form-control" value=""  title="">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
					<label>Alamat Instansi</label>
					<textarea class="form-control" name="alamat_k"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 form-group">
					<label>Kota</label>
					<input type="text" name="kota_k" id="input" class="form-control" value=""  title="">
				</div>
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 form-group">
					<label>Kode Pos</label>
					<input type="text" name="pos_k" id="input" class="form-control" value=""  title="">
				</div>
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 form-group">
					<label>Telphone Kantor</label>
					<input type="text" name="telp_k" id="input" class="form-control" value=""  title="">
				</div>
			</div>









			<br>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
					<legend>Kegiatan Lain</legend>
					<p>Penelitian dan Publikasi Ilmiah lima tahun terakhir</p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
					<label>Penelitian</label>
					<p>
						Cantumkan: Judul Penelitian, Tahun, Jabatan dalam Penelitian (ketua atau Anggota), Sumber Dana Penelitian
					</p>
					<textarea class="form-control" name="penelitian"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
					<label>Publikasi Ilmiah</label>
					<p>
						Cantumkan: Pengarang, Tahun Penerbitan, Judul, dimana dipublikasikan 
					</p>
					<textarea class="form-control" name="ilmiah"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="checkbox">
						<label>
							<input type="checkbox" value="y" name="ch" class="required checkbox" required> 
							Pastikan anda telah membaca syarat dan tata cara pendaftaran sesuai dengan program studi yang anda pilih
						</label>
					</div>
				</div>
			</div>
			<br>


			<div class="row">
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 form-group">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</form>
	</div>
</div>