<div class="row">
	<div class="col-lg-8">
		<br>
		<div class="row">
			<div class="col-lg-12">
				<h4>A. Staf Pengajar Dari Untan</h4>
				<?php  
				foreach ($dosenDalam as $data) {
					?>
					<div class="col-lg-3 alpha ">
						<a href="<?php echo site_url('dosen/detil/'.$data->id_dosen.'-'.$data->slug) ?>">
							<div class="thumbnail dosen">
								<img src="<?php echo base_url().'inventory/gambar/dosen/thumb/'.$data->img ?>" style="width:100%;height:180px">
								<?php echo $data->nama ?>
							</div>
						</a>
						<br>
					</div>
					<?php
				}
				?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<br>
				<h4>B. Staf Pengajar Dari Luar Untan</h4>
				<?php  
				foreach ($dosenLuar as $luar) {
					?>
					<div class="col-lg-3 alpha ">
						<a href="<?php echo site_url('dosen/detil/'.$luar->id_dosen.'-'.$luar->slug) ?>">
							<div class="thumbnail dosen">
								<img src="<?php echo base_url().'inventory/gambar/dosen/thumb/'.$luar->img ?>" style="width:100%;height:180px">
								<?php echo $luar->nama ?>
							</div>
						</a>
						<br>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<br>
		<div class="col-lg-12">
			<?php echo $prodi ?>
			<br>
		</div>
		<div class="col-lg-12">
			<?php echo $konsen ?>
			<br>
		</div>
		<div class="col-lg-12">
			<?php echo $agenda ?>
		</div>
	</div>
</div>