<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pendaftaran</title>
	<link rel="stylesheet" type="text/css" href="">
</head>
<body>
	<form action="<?php echo site_url($akses) ?>" method="post">
		<h3>Form Pendaftaran</h3>
		<p>Pendaftaran Mahasiswa Tahun Ajaran 2014 - 2015 Telah Ditutup</p>
		<p>Pendaftaran mahasiswa baru 2014/2015 <br>
		Program Doktor Fakultas Ekonomi - Universitas Tanjungpura </p>
		<?php $this->load->view($page); ?>
	</form>
</body>
</html>