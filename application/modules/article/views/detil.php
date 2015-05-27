<div class="row spancer2">
	<div class="col-md-12 bg">
    	<?php echo $title;?>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
			
			<?php 
			if ($image) {
			?>
			<div class="row">
				<div class="col-md-12">
					<a href="<?php echo base_url()."inventory/gambar/article/".$image;?>" class="fancybox"><img alt="<?php echo $title;?>" src="<?php echo base_url()."inventory/gambar/article/".$image;?>" width="600px"/></a>
				</div>
			</div>
			<?php
			}
			?>

			<div class="row">
				<div class="col-md-12">
					<br>
					<span><i class="glyphicon glyphicon-calendar"> </i> <?php echo $tanggal;?> <span>
					<span><i class="glyphicon glyphicon-user"> </i> <?php echo $admin;?></span>
					<?php
					if ($file) {
						$dir_file = "inventory/download/".$file;
						if (is_file($dir_file)) {
							echo anchor('article/download_lampiran/'.$id_article.'-'.$clean_url, '<span class="glyphicon glyphicon-file"></span> File Lampiran');
						}
					}
					?>
					<br>
					<br>
					<span><?=share_button('facebook', array('url'=>current_url(), 'text'=>$title))?></span>
					<span><?=share_button('twitter', array('url'=>current_url(), 'text'=>$title, 'type'=>'iframe'))?></span>
					<br>
					<br>
					<?php echo $content;?>
				</div>
			</div>
			
	</div>
</div>