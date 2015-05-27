<link rel="stylesheet" type="text/css" href="<?php echo site_url().'inventory/bootstrap/css/bootstrap.min.css' ?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url().'inventory/style/style.css' ?>">
<div class="row tab">
	<!-- Nav tabs -->
	<div class="col-lg-12 thumbnail">
		<ul class="nav nav-tabs" role="tablist">
			<li class="active"><a href="#home" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-list-alt"></span> Pendaftaran</a></li>
			<li><a href="#profile" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-registration-mark"></span> Registrasi Semester</a></li>
			<li><a href="#messages" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-book"></span> Syarat dan Tata Cara</a></li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
		<div class="tab-pane active" id="home">
			<b>e-Pendaftaran</b>
			<br>
			<ul>
				<li><a><b><u>Master</u></b></a></li>
				<?php foreach ($prodi as $key) {
					if ($key->jenjang == 's2') {
						$url = 'daftar/index/'.$key->id_prodi;
						echo "<li><a href='".site_url($url)."'>$key->prodi</a></li>";
					}
				} ?>
			</ul>
			<ul>
				<li><a><b><u>Doktor</u></b></a></li>
				<?php foreach ($prodi as $key) {
					if ($key->jenjang == 's3') {
						$url = 'daftar/index/'.$key->id_prodi;
						echo "<li><a href='".site_url($url)."'>$key->prodi</a></li>";
					}
				} ?>
			</ul>
			<ul>
				<li><a><b><u>Profesi</u></b></a></li>
				<?php foreach ($prodi as $key) {
					if ($key->jenjang == 'profesi') {
						$url = 'daftar/index/'.$key->id_prodi;
						echo "<li><a href='".site_url($url)."'>$key->prodi</a></li>";
					}
				} ?>
			</ul>
		</div>
		<!-- registrasi -->
		<div class="tab-pane" id="profile">
			<b>Registrasi Semester</b>
			<br>
			
			<ul>
				<li><a><b><u>Master</u></b></a></li>
				<?php foreach ($prodi as $key) {
					if ($key->jenjang == 's2') {
						$url = 'daftar/info_registrasi/'.$key->id_prodi;
						echo "<li><a href='".site_url($url)."'>$key->prodi</a></li>";
					}
				} ?>
			</ul>
			<ul>
				<li><a><b><u>Doktor</u></b></a></li>
				<?php foreach ($prodi as $key) {
					if ($key->jenjang == 's3') {
						$url = 'daftar/info_registrasi/'.$key->id_prodi;
						echo "<li><a href='".site_url($url)."'>$key->prodi</a></li>";
					}
				} ?>
			</ul>
			<ul>
				<li><a><b><u>Profesi</u></b></a></li>
				<?php foreach ($prodi as $key) {
					if ($key->jenjang == 'profesi') {
						$url = 'daftar/info_registrasi/'.$key->id_prodi;
						echo "<li><a href='".site_url($url)."'>$key->prodi</a></li>";
					}
				} ?>
			</ul>
		</div>
		<!-- syarat -->
		<div class="tab-pane" id="messages">
			<b>Syarat dan Tata Cara</b>
			<br>
			
			<ul>
				<li><a><b><u>Master</u></b></a></li>
				<?php foreach ($prodi as $key) {
					if ($key->jenjang == 's2') {
						$url = 'daftar/info_syarat/'.$key->id_prodi;
						echo "<li><a href='".site_url($url)."'>$key->prodi</a></li>";
					}
				} ?>
			</ul>
			<ul>
				<li><a><b><u>Doktor</u></b></a></li>
				<?php foreach ($prodi as $key) {
					if ($key->jenjang == 's3') {
						$url = 'daftar/info_syarat/'.$key->id_prodi;
						echo "<li><a href='".site_url($url)."'>$key->prodi</a></li>";
					}
				} ?>
			</ul>
			<ul>
				<li><a><b><u>Profesi</u></b></a></li>
				<?php foreach ($prodi as $key) {
					if ($key->jenjang == 'profesi') {
						$url = 'daftar/info_syarat/'.$key->id_prodi;
						echo "<li><a href='".site_url($url)."'>$key->prodi</a></li>";
					}
				} ?>
			</ul>
		</div>
		</div>
	</div>
</div>
<!-- JS -->
<script type="text/javascript" src="<?php echo site_url().'inventory/js/jquery.js' ?>"></script>
<script type="text/javascript" src="<?php echo site_url().'inventory/bootstrap/js/bootstrap.min.js' ?>"></script>
<script type="text/javascript">
	$('.dropdown-toggle').dropdown();
</script>