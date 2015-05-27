<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div class="row">
		<b>Pendidikan sarjana (s1)</b>
		<br>
		<br>
		<div class="span3">
			Nama perguruan tinggi * <br>
			<?php echo form_error('s1_nama_pt') ?>
			<?php echo form_input('s1_nama_pt', set_value('s1_nama_pt', isset($s1_nama_pt) ? $s1_nama_pt : '')); ?>
		</div>
		<div class="span3">
			Prodi/ Fakultas * <br>
			<?php echo form_error('s1_prodi') ?>
			<?php echo form_input('s1_prodi', set_value('s1_prodi', isset($s1_prodi) ? $s1_prodi : '')); ?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="span6">
			Alamat Perguruan tinggi * <br>
			<?php echo form_error('s1_alamat_pt') ?>
			<?php echo form_textarea('s1_alamat_pt', set_value('s1_alamat_pt', isset($s1_alamat_pt) ? $s1_alamat_pt : ''), 'class="span10"'); ?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="span3">
			Tahun masuk * <br>
			<?php echo form_error('s1_masuk') ?>
			<?php echo form_input('s1_masuk', set_value('s1_masuk', isset($s1_masuk) ? $s1_masuk : '')); ?>
		</div>
		<div class="span3">
			tahun lulus * <br>
			<?php echo form_error('s1_lulus') ?>
			<?php echo form_input('s1_lulus', set_value('s1_lulus', isset($s1_lulus) ? $s1_lulus : '')); ?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="span3">
			IPK * <br>
			<?php echo form_error('s1_ipk') ?>
			<?php echo form_input('s1_ipk', set_value('s1_ipk', isset($s1_ipk) ? $s1_ipk : '')); ?>
		</div>
		<div class="span3">
			IPK Ujian Negara (jika ada) <br>
			<?php echo form_input('s1_ipkun', set_value('s1_ipkun', isset($s1_ipkun) ? $s1_ipkun : '')); ?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="span3">
			Status perguruan tinggi * <br>
			<?php echo form_dropdown('s1_status_pt', $status_pt); ?>
		</div>
		<div class="span3">
			Gelar <br>
			<?php echo form_input('s1_gelar', set_value('s1_gelar', isset($s1_gelar) ? $s1_gelar : '')); ?>
		</div>
	</div>
	<br>
	<br>
</body>
</html>