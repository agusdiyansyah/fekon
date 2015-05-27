<div class="col-xs-12">
	<div class="">
		<div class="row">
			<small>
				<!--- breadcrumb -->
					<ol class="breadcrumb"> 
						<li><?php echo anchor('gallery', 'Galeri');?></li>
						<li><?php echo anchor('gallery/kategori/'.$id_category, $name_category);?></li>
				  	<li class="active"><?php echo $title;?></li>
				</ol> 
				<!--- breadcrumb -->
			</small>
		</div>
			<div class="row">
  			<div class="col-xs-8">
  				<div class="row">
	  				<h4 class="media-heading">
  						<strong><?php echo $name_category;?></strong>
  					</h4>
  					<br>
  					<?php echo '<img class="img-thumbnail" src="'.base_url().'inventory/gambar/gallery/'.$image.'" >';?>
  					<tgl style="font-size:8pt;margin-top:10px;text-align:right"><?php echo $date ?></tgl>
  					<hr style="margin:10px 0;">
  					<h4><b><?php echo $title ?></b></h4>
	  				<?php echo $content;?>
	  			</div>
	  			<br>
  			</div>
  				
  			<div class="col-xs-4">			  				
				<div class="col-xs-12">
					<h4 class="media-heading"><strong>Foto lainnya </strong></h4>
					<br>	  	
				</div>
<?php
	foreach ($detil_lainnya as $lainnya) {
		echo '<div class="col-xs-6 pad2">';
				echo '
				<a href="'.site_url('gallery/detil/'.$lainnya->id_gallery.'-'.$lainnya->clean_url).'">
				<img src="'.base_url().'inventory/gambar/gallery/thumb/'.$lainnya->image.'" class="img-thumbnail" width="155px" height="155px"></a>';
			echo '</div> ';
	}
?>
  			</div>
			</div>
		
			
	  		
		
	</div>
</div>