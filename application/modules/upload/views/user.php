<br>
<div class="row">
	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
		<?php
			foreach ($upload as $key) {
				$url = $this->fungsi->clean_url(strtolower($key->nama));
			 	echo anchor(site_url('upload/download/'.$key->id_upload.'-'.$url), $key->nama, 'attributes'); 
			 	echo "<br>";
			} 
		?>
	</div>
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<?php echo $info ?>
	</div>
</div>