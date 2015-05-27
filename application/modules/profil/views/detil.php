<h3><?php echo $title;?></h3>
<hr>
<?php
	if ($image) {
		echo '<img class="img-thumbnail" src="'.base_url().'inventory/gambar/profil/'.$image.'"/>';
		echo '<br>';
		echo '<br>';
	}
?>
<?php echo $content;?>