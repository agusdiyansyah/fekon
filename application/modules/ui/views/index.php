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
					<?php 
						$this->load->view('page/slider');
						$this->load->view('page/tab');
						$this->load->view('page/berita'); 
						$this->load->view('page/fb');
					?>
				</div>
				<div class="col-lg-4">
					<div class="col-lg-12 alpha">
						<?php  
							$this->load->view('part/promosi');
							$this->load->view('part/info');
							$this->load->view('part/agenda');
							$this->load->view('part/galeri');
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