<div class="page-header">
	<h3>
		<?php 
		$titles = explode(" ", $title);
		echo "<span>".$titles[0]." </span>";
		echo $titles[1];
		?>
		<div class="pull-right">
    		<div class="btn-group">
		    	<button class="article-ticker-up btn btn-xs btn-default"><span class="glyphicon glyphicon-chevron-up"></span></button>
				<button class="article-ticker-down btn btn-xs btn-default"><span class="glyphicon glyphicon-chevron-down"></span></button>
    		</div>
    	</div>
	</h3>
</div>

	<div class="col-md-12 bxslider"> 
		<div class="vticker vticker_article">
			<ul class="media-list">
			<?php 
				foreach ($article_list as $record) { 
				$dir_image = "inventory/gambar/article/thumb/";
				$image_link = base_url().$dir_image.$record->image;
				$judul = word_limiter($record->title, 8);
				$clean_url = $this->clean_url->generate($record->id_article,$record->clean_url);
				$tanggal = $this->indo_date->tgl_indo($record->date);
				$admin = $record->fullname;
				$isi = word_limiter($record->content, 20);
			?>
			  <li class="media">
			  	<div class="media-body">
			  		<h4 class="media-heading"><?php echo anchor('berita/'.$clean_url, $judul);?></h4>
				  	<p class="info">
				  	<?php
				  		if ($record->image) {
					  		if (is_file($dir_image.$record->image)) {
					  			echo "<img class='media-object' src='".$image_link."' alt='".$record->title."'/>";
					  		}
				  		}
				  	?>			  	
				  		<span class="glyphicon glyphicon-user"></span> <?php echo $admin;?>
				  		<span class="glyphicon glyphicon-calendar"></span> <?php echo $tanggal;?>
				  	</p>
			  		<p><?php echo $isi;?></p>
			  	</div>
			  </li>
			<?php 
			} 
			?>
			</ul>
		</div>
	<!-- 
	<?php 
		foreach ($article_list as $record) { 
			$image_link = base_url()."inventory/gambar/article/thumb/".$record->image;
			$judul = $record->title;
			$clean_url = $this->clean_url->generate($record->id_article,$record->clean_url);
			$tanggal = $this->indo_date->tgl_indo($record->date);
			$tanggal_publish = $this->indo_date->tgl_indo($record->date_publish);
			$admin = $record->fullname;
			$isi = substr($record->content,0,200); // ambil sebanyak 220 karakter
			$isi = substr($record->content,0,strrpos($isi," ")); // potong per spasi kalimat
			$isi = str_replace("&nbsp;", "", $isi);
	    
		    echo '<div class="media a">';
			    if ($record->image) {
			    	echo '<a class="pull-left" href="#">';
			        echo '<img class="media-object" src="'.$image_link.'" width="80">';
			      	echo '</a>';
			    }
			    echo '<div class="media-body">';
			    	echo '<h4 class="media-heading"><strong>'.$judul.'</strong></h4>';
					echo $isi;
					echo '<h4>'.anchor($clean_url, 'Detail <span class="glyphicon glyphicon-chevron-right"></span>', 'class="label label-success"').'</h4>';
			    echo '</div>';
		    	echo '<hr>';
		    echo '</div>';
		} 
	?>
	-->
  </div>
