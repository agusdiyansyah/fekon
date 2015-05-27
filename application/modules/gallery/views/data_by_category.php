<div class="col-xs-12">
	<div class="panel panel2 panel-default">
  			<div class="panel-body">					
  				<div class="col-xs-12">						
		  			<div class="row">
		  				<ol class="breadcrumb">
		  					<li>
		  						<?php echo anchor('gallery', 'Galeri');?>
		  					</li>
		  					<li class="active"><?php echo $name_category;?></li>
		  				</ol>

		  				<?php
		  					if (count($result) > 0) {
			  					foreach ($result as $record) {
			  						echo '<div class="col-xs-3 album">';
						  				echo '<a href="'.site_url('gallery/detil/'.$record->id_gallery).'">';
						  				echo '<img src="'.base_url().'inventory/gambar/gallery/thumb/'.$record->image.'" width="238px" height="163px" class="img-thumbnail">';
						  				echo '<div class="blok"><p>'.$record->title.'</p></div>';
						  				echo '</a>';
						  			echo '</div> ';
			  					}
		  					}
		  					else {
		  						echo '<div><h2>Data Foto Tidak Ada</h2></div>';
		  					}
		  				?>
		  			</div>
  				</div>
  				
  			</div>
  		</div>
</div>