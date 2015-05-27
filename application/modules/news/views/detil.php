<div class="panel-body">
  	<div class="padtop"></div>
  	<div class="row">
		<div class="col-xs-8">
				<div class="row pad-detailberita">
					<h3 class="media-heading">
						<strong><?php echo $title;?></strong>
					</h3>
			
	  				<div class="admin">
		  				<span><strong class="glyphicon glyphicon-user"></strong> <?php echo $admin;?></span> &nbsp
		  				<span><strong class="glyphicon glyphicon-calendar"></strong> <?php echo $tanggal;?></span>  &nbsp
	  				</div>
						<hr style="margin:10px 0;border:none;border-bottom:1px dashed silver">
	  				<?php
		  				if ($image) {
		  					echo '<div class="img-wrapper">';
								echo '<div class="img-news"><img src="'.base_url().'inventory/gambar/news/'.$image.'" width="100%"/></div>';
							echo '</div>';
						}
					?>
					<br>
					<div><?php echo $content;?></div>
				</div>
		</div>
		<div class="col-xs-4 omega">
			<?php echo $berita_lainnya;?>
		</div>
		<div class="clearfix"></div>
	</div>
</div>