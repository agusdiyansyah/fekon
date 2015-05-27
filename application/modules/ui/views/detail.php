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
					<h2 style="color:#428F1E">Lorem ipsum dolor sit amet.</h2>
					<tgl>22 Januari 2015</tgl>
					<hr style="margin:10px 0;border: 1px solid #428F1E">
					<img src="<?php echo site_url().'inventory/gambar/static_content/863700800px-Kantorbupatilandak.jpg' ?>" alt="" style="width:100%" class="thumbnail">
					<br>
					<p>
						One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What's happened to me? " he thought.
						<br>
						<br>
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa.
						<br>
						<br>
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa. 
						Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh. Duis tincidunt lectus quis dui viverra vestibulum. 
						Suspendisse vulputate aliquam dui. Nulla elementum dui ut augue. Aliquam vehicula mi at mauris. Maecenas placerat, nisl at consequat rhoncus, sem nunc 
						gravida justo, quis eleifend arcu velit quis lacus. Morbi magna magna, tincidunt a, mattis non, imperdiet vitae, tellus. Sed odio est, auctor ac, 
						sollicitudin in, consequat vitae, orci. Fusce id felis. Vivamus sollicitudin metus eget eros.
						<br>
						<br>
						
					</p>
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