<div class="row">
	<div class="col-lg-8">
		<h3 style="color:#428F1E"><?php echo $prodi;?></h3>
		<hr style="margin:10px 0;border: 1px solid #428F1E">
		<div class="content">
			<?php echo $keterangan_prodi;?>
			<br>
			<a href="<?php echo site_url('dosen/staf/'.$id_prodi) ?>">Staf Pengajar Program Studi <?php echo $prodi;?> >></a>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="col-lg-12 alpha">
			<br>
			<?php echo $widget_prodi;?>
			<br>
			<?php echo $widget_konsentrasi;?>
			<br>
			<?php echo $widget_agenda;?>
		</div>
	</div>
</div>