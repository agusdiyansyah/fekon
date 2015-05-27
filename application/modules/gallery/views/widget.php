<style type="text/css">
	.gallery img{
		margin-bottom: 5px;
	}
	.gallery-lainnya .row{
		border-top: 1px solid #ecf0f1;
		padding-top: 10px;
		margin-top: 5px;
		padding-bottom: 5px;
	}
</style>
<?php  
	$c = 1;
	foreach ($kategori as $key) {
		if (!empty($key->cover)) {
			if ($c == 4) {
				break;
			}
			if ($c == 1) {
				?>
				<div class="gallery">
					<div class="row thumbnail">
						<a href="<?php echo base_url().'gallery/detil/'.$key->id_category.'-'.$key->clean_url ?>">
							<div class="col-lg-12">
								<div class="row">
									<img style="width:100%" src="<?php echo base_url().'inventory/gambar/gallery/thumb/'.$key->cover ?>" alt="">
								</div>
								<div class="row">
									<?php echo $key->name_category ?>
								</div>
							</div>
						</a>
					</div>
				</div>
				<?php
			}else{
				?>
				<div class="gallery-lainnya">
					<div class="row">
						<a href="<?php echo base_url().'gallery/detil/'.$key->id_category.'-'.$key->clean_url ?>">
							<div class="col-lg-5 alpha">
								<img class="thumbnail" style="width:100%" src="<?php echo base_url().'inventory/gambar/gallery/thumb/'.$key->cover ?>" alt="">
							</div>
							<div class="col-lg-7 alpha">
								<?php echo $key->name_category ?>
							</div>
						</a>
					</div>
				</div>
				<?php
			}
			$c++;
		}
	}
?>