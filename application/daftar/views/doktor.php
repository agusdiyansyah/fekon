<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div class="row">
		<b>Pendidikan pascasarjana (s2)</b>
		<br>
		<br>
		<div class="span3">
			Nama perguruan tinggi * <br>
			<?php echo form_error('s2_nama_pt') ?>
			<?php echo form_input('s2_nama_pt', set_value('s2_nama_pt', isset($s2_nama_pt) ? $s2_nama_pt : '')); ?>
		</div>
		<div class="span3">
			Prodi/ Fakultas * <br>
			<?php echo form_error('s2_prodi') ?>
			<?php echo form_input('s2_prodi', set_value('s2_prodi', isset($s2_prodi) ? $s2_prodi : '')); ?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="span6">
			Alamat Perguruan tinggi * <br>
			<?php echo form_error('s2_alamat_pt') ?>
			<?php echo form_textarea('s2_alamat_pt', set_value('s2_alamat_pt', isset($s2_alamat_pt) ? $s2_alamat_pt : ''), 'class="span10"'); ?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="span3">
			Tahun masuk * <br>
			<?php echo form_error('s2_masuk') ?>
			<?php echo form_input('s2_masuk', set_value('s2_masuk', isset($s2_masuk) ? $s2_masuk : '')); ?>
		</div>
		<div class="span3">
			tahun lulus * <br>
			<?php echo form_error('s2_lulus') ?>
			<?php echo form_input('s2_lulus', set_value('s2_lulus', isset($s2_lulus) ? $s2_lulus : '')); ?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="span3">
			IPK * <br>
			<?php echo form_error('s2_ipk') ?>
			<?php echo form_input('s2_ipk', set_value('s2_ipk', isset($s2_ipk) ? $s2_ipk : '')); ?>
		</div>
		<div class="span3">
			IPK Ujian Negara (jika ada) <br>
			<?php echo form_error('s2_ipkun') ?>
			<?php echo form_input('s2_ipkun', set_value('s2_ipkun', isset($s2_ipkun) ? $s2_ipkun : '')); ?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="span3">
			Status perguruan tinggi * <br>
			<?php echo form_dropdown('s2_status_pt', $status_pt); ?>
		</div>
		<div class="span3">
			Gelar <br>
			<?php echo form_input('s2_gelar', set_value('s2_gelar', isset($s2_gelar) ? $s2_gelar : '')); ?>
		</div>
	</div>
	<br>
	<br>
</body>
</html>