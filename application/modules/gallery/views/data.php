<div class="row">
	<div class="col-lg-8">
		<div class="judul">
			<span>Galeri</span>&nbsp
			<h2>Photo</h2>
		</div>
	</div>
</div>	
<div class="row">
	<div class="col-lg-8">
		<div class="row">
			<?php foreach ($kategori as $data): ?>
			<div class="col-lg-4">
				<a href="<?php echo site_url('gallery/detil/'.$data->id_gallery.'-'.$data->clean_url) ?>">
					<div class="thumbnail" style="height:170px">
						<div class="photo-mini-lainnya">
							<div class="">
								<img src="<?php echo base_url().'inventory/gambar/gallery/thumb/'.$data->cover ?>" style="">
							</div>
						</div>
					</div>
					<p>
						<?php echo $data->name_category ?>
					</p>
				</a>
				<br>
			</div>
			<?php endforeach ?>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="">
			<?php echo $info ?>
		</div>
		<div class="col-lg-12">
			<br>
			<?php echo $agenda ?>
		</div>
	</div>
</div>