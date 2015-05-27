<?php 
	foreach ($news_list as $record) { 
	$dir_image = "inventory/gambar/news/thumb/";
	$image_link = base_url().$dir_image.$record->image;
	$judul = word_limiter($record->title, 8);
	$clean_url = $this->clean_url->generate($record->id_news,$record->clean_url);
	$tanggal = $this->indo_date->tgl_indo($record->date);
	$admin = $record->fullname;
	$isi = word_limiter($record->content, 20);
?>
  <div class="media">
  	<?php
  		echo '<div class="media-left">';
  		if ($record->image) {
	  		if (is_file($dir_image.$record->image)) {
	  				echo "<img class='img-rounded' src='".$image_link."' alt='".$record->title."' width='98px'/>";
	  		}
  		}
  		echo '</div>';
  	?>			  	
  	<div class="media-body">
  		<h4 class="media-heading2"><?php echo anchor('berita/'.$clean_url, $judul);?></h4>
	  	<small class="info">
	  		<?php echo $tanggal;?>
	  	</small>
  		<p><?php echo $isi;?></p>
  	</div>
  </div>
<?php 
} 
?>