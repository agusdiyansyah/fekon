<div class="row">
	<div class="col-md-12 bg">
    	Artikel
    </div>
</div>
<div class="row">
	<div class="col-md-12 border-hijau bxslider">
		<?php 
			foreach ($article_list as $record) { 
			$judul = $record->title;
			$tanggal = $this->indo_date->tgl_indo($record->date);
			$admin = $record->fullname;
			$record->content = strip_tags($record->content, "<strong><b>");
			$isi = word_limiter($record->content, 20);
		?>
			<div class="media a">
				<div class="col-md-3">
					<?php
					if ($record->image) {
						$image_link = base_url()."inventory/gambar/article/thumb/".$record->image;
					}
					else {
						$image_link = "";
					}
					?>
					<div class="bthumb2">
						<a href="#"><img src="<?php echo $image_link;?>" alt="<?php echo $judul;?>" class="media-object thumbnail" width="130px"/></a>
					</div>
				</div>
				<div class="col-md-9">
					<h4 class="media-heading"><?php echo $judul;?></h4>
					<div class="meta">
						<i class="glyphicon glyphicon-calendar"> </i> <?php echo $tanggal;?> 
						<i class="glyphicon glyphicon-user"> </i> <?php echo $admin;?>  
					</div>
					<?php echo $isi;?>
					<div class="button">
						<?php 
						$clean_url = $this->clean_url->generate($record->id_article, $record->clean_url);
						echo anchor('artikel/'.$clean_url, 'Selengkapnya', 'title="Selengkapnya"');
						?>
					</div>
				</div>
			</div>
		<?php 
			} 
		?>
		<?php echo $pagination;?>
	</div>
</div>