<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css">
		*{
			font-family: "arial";
		}
		div{
			display: inline-table;
			/*border: 1px dotted silver;*/
		}
		.full{
			width: 100%;
		}
		.span1{
			width:10%;
		}
		.span2{
			width:20%;
		}
		.span3{
			width:30%;
		}
		.span4{
			width:40%;
		}
		.span5{
			width:50%;
		}
		.span6{
			width:60%;
		}
		.span7{
			width:70%;
		}
		.span8{
			width:80%;
		}
		.span8{
			width:80%;
		}
		.span9{
			width:90%;
		}
		.span10{
			width:100%;
		}
		.row{
			display: block;
		}
	</style>
</head>
<body>
	<div class="row">
		<b>A. Data Probadi</b>
		<br>
		<br>
		<div class="span2">
			NIK KTP <br>
			<?php echo form_error('nik'); ?>
			<?php echo form_input('nik', set_value('nik', isset($nik) ? $nik : '')); ?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="span2">
			Nama lengkap dan gelar *
			<?php echo form_error('nama').form_hidden('id', $id); ?>
			<?php echo form_input('nama', set_value('nama', isset($nama) ? $nama : '')); ?>
		</div>
		<div class="span2">
			Tempat dan tanggal lahir *
			<?php echo form_error('tempat') ?>
			<?php echo form_input('tempat', set_value('tempat', isset($tempat) ? $tempat : ''),'class="span4"'); ?>
			<?php echo form_error('tgl') ?>
			<?php echo form_input('tgl', set_value('tgl', isset($tgl) ? $tgl : ''),'class="span4"'); ?>
		</div>
		<div class="span2">
			Jenis Kelamin * <br>
			<?php echo form_dropdown('jk', $jk); ?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="span2">
			Golongan darah * <br>
			<?php echo form_dropdown('darah', $darah); ?>
		</div>
		<div class="span2">
			Agama * <br>
			<?php echo form_dropdown('agama', $agama); ?>
		</div>
		<div class="span2">
			Satus pernikahan * <br>
			<label><input checked type="radio" name="status" value="menikah"> Menikah</label>
			<label><input type="radio" name="status" value="belum menikah"> Belum menikah</label>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="span6">
			Alamat rumah * <br>
			<?php echo form_error('alamat') ?>
			<?php echo form_textarea('alamat', set_value('alamat', isset($alamat) ? $alamat : ''), 'class="span10"'); ?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="span3">
			Kota *
			<?php echo form_error('kota'); ?><br>
			<?php echo form_input('kota', set_value('kota', isset($kota) ? $kota : '')); ?>
		</div>
		<div class="span3">
			Kodepos *
			<?php echo form_error('kodepos'); ?><br>
			<?php echo form_input('kodepos', set_value('kodepos', isset($kodepos) ? $kodepos : '')); ?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="span3">
			Telphon/No. Hp *
			<?php echo form_error('telp'); ?><br>
			<?php echo form_input('telp', set_value('telp', isset($telp) ? $telp : '')); ?>
		</div>
		<div class="span3">
			Email (berkas pendaftaran akan dikirim ke email) *
			<?php echo form_error('email'); ?><br>
			<?php echo form_input('email', set_value('email', isset($email) ? $email : '')); ?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="span2">
			Sumber biaya * <br>
			<label><input class="biaya" type="radio" name="biaya" value="sendiri"> Sendiri</label>
			<label><input class="biaya" type="radio" name="biaya" value="instansi"> Instansi</label>
			<?php echo form_input('lainnya', set_value('lainnya',isset($lainnya) ? $lainnya : ''), 'placeholder="Lainnya" class="lain"'); ?>
		</div>
	</div>
	<br>
	<br>
</body>
</html>