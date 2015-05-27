<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="<?php echo site_url().'inventory/bootstrap/css/bootstrap.min.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url().'inventory/style/style.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url().'inventory/slider/responsiveslides.css' ?>">
</head>
<body>
	<div class="page-border">
		<div class="container">
			<?php 
				$this->load->view('part/head'); 
				$this->load->view('part/menu');
			?>
			<div class="row">
				<div class="col-lg-8">
					<h3 style="color:#428F1E">Nama Prodi</h3>
					<br>
					<div class="row">
						<div class="col-lg-12"></div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-3">
							<img src="" style="width:100%;height:180px">
						</div>
						<div class="col-lg-9">
							<h4 style="color:#428F1E;margin-top:0">Nama Staf Pengajar</h4>
							<hr>
							<p>
								<b>Fokus keahlian </b>
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa.
							</p>
							<p>
								<b>Telp : </b> 0896 0927 5330
							</p>
							<p>
								<b>Email : </b> agusdiyansyah@gmail.com
							</p>
							<p>
								<b>Alamat : </b>
								<p>
									Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa.
								</p>
							</p>
							<hr>
							<p>
								<b>Riwayat Pendidikan</b>
								<br>
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa.
							</p>
							<hr>
							<p>
								<b>Jurnal dan Publikasi Ilmiah</b>
								<br>
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa.
							</p>
							<hr>
							<p>
								<b>Pelatihan dna Seminar</b>
								<br>
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa.
							</p>
							<hr>
							<p>
								<b>Organisasi</b>
								<br>
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa.
							</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="col-lg-12 alpha">
						<?php  
							$this->load->view('part/info');
							$this->load->view('part/agenda');
						?>
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-12">
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-12" style="background:#0B6E45">
								<?php $this->load->view('page/footer'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
	<!-- JS -->
	<script type="text/javascript" src="<?php echo site_url().'inventory/js/jquery.js' ?>"></script>
	<script type="text/javascript" src="<?php echo site_url().'inventory/bootstrap/js/bootstrap.min.js' ?>"></script>
	<script type="text/javascript" src="<?php echo site_url().'inventory/slider/responsiveslides.min.js' ?>"></script>
	<script type="text/javascript">
		$('.dropdown-toggle').dropdown();
		$(".rslides").responsiveSlides({
			pager: true,
		});
	</script>
</html>