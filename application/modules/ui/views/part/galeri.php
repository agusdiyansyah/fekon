<div class="row galeri">
	<div class="judul">
		<span>Photo</span>&nbsp
		<h2>Gallery</h2>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<img src="<?php echo site_url().'inventory/gambar/static_content/863700800px-Kantorbupatilandak.jpg' ?>" alt="" style="width:100%">
		</div>
	</div>
	<hr>
	<?php  
	for ($i=0; $i < 3; $i++) { 
	?>
	<div class="row">
		<div class="col-lg-4">
			<img src="<?php echo site_url().'inventory/gambar/static_content/863700800px-Kantorbupatilandak.jpg' ?>" alt="" style="width:100%">
		</div>
		<div class="col-lg-8 alpha">
			<a href="">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</a>
		</div>
	</div>
	<hr>
	<?php
	}
	?>
	<div class="right">
		<a href="">More >></a>
	</div>
</div>