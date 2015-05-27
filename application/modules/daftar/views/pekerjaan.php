<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div class="row">
		<b>Pekerjaan</b>
		<br>
		<br>
		<div class="span3">
			Jenis pekerjaan * <br>
			<?php echo form_dropdown('kerja', $kerja); ?>
		</div>
		<div class="span3">
			Instansi <br>
			<?php echo form_input('instansi', set_value('instansi', isset($instansi) ? $instansi : '')); ?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="span3">
			nip/nis <br>
			<?php echo form_input('nip', set_value('nip', isset($nip) ? $nip : '')); ?>
		</div>
		<div class="span3">
			pangkat golongan <br>
			<?php echo form_input('pangkat', set_value('pangkat', isset($pangkat) ? $pangkat : '')); ?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="span6">
			alamat instansi
			<?php echo form_textarea('alamat_kantor', set_value('alamat_kantor', isset($alamat_kantor) ? $alamat_kantor : ''), 'class="span10"'); ?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="span2">
			kota <br>
			<?php echo form_input('kota_kantor', set_value('kota_kantor', isset($kota_kantor) ? $kota_kantor : '')); ?>
		</div>
		<div class="span2">
			kodepos <br>
			<?php echo form_input('kodepos_kantor', set_value('kodepos_kantor', isset($kodepos_kantor) ? $kodepos_kantor : '')); ?>
		</div>
		<div class="span2">
			telpon kantor <br>
			<?php echo form_input('telp_kantor', set_value('telp_kantor', isset($telp_kantor) ? $telp_kantor : '')); ?>
		</div>
	</div>
	<br>
	<br>
	<div class="row">
		<b>kegiatan lain</b>
		<br>
		penelitian dan publikasi 5 tahun terakhir
		<br>
		<br>
		<b>penelitian</b>
		<br>
		Cantumkan: Judul Penelitian, Tahun, Jabatan dalam Penelitian (ketua atau Anggota), Sumber Dana Penelitian
		<div class="span6">
			<?php echo form_textarea('penelitian', set_value('penelitian', isset($penelitian) ? $penelitian : ''), 'class="span10"'); ?>
		</div>
	</div>
	<div class="row">
		<br>
		<br>
		<b>publikasi ilmiah</b>
		<br>
		Cantumkan: Pengarang, Tahun Penerbitan, Judul, dimana dipublikasikan
		<br>
		<div class="span6">
			<?php echo form_textarea('publikasi', set_value('publikasi', isset($publikasi) ? $publikasi : ''), 'class="span10"'); ?>
		</div>
	</div>
	<br>
	<div class="row">
		<label>
			<?php echo form_error('sub') ?>
			<input type="checkbox" name="sub" value="sub">
			Dengan ini saya menyatakan bahwa data diatas telah diisi dengan sebenar-benarnya.
		</label>
	</div>
	<br>
	captcha
	<br>
	<br>
	<?php echo form_submit('daftar', 'Daftar'); ?>
</body>
</html>