<div class="panel-body">
  	<div class="padtop"></div>
  	<div class="row">
		<div class="col-xs-8 alpha">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<?php 
							foreach ($news_list as $record) { 
								$image_link = base_url()."inventory/gambar/news/thumb/".$record->image;
								$judul = $record->title;
								$tanggal = $this->indo_date->tgl_indo($record->date).", ".$record->time;
								$admin = $record->fullname;
								$record->content = strip_tags($record->content, "<strong><b>");
								$isi = word_limiter($record->content, 30);
								echo '<div class="media garis-bawah">';
									if ($record->image) {
										echo '<a href="#" class="pull-left">';
											echo '<img src="'.$image_link.'" width="150px" class="img-thumbnail">';
										echo '</a>';
									}
									echo '<div class="media-body">';
										echo '<h3 class="media-heading">';
											echo '<strong>'.$judul.'</strong>';
										echo '</h3>';
										echo '<div class="admin">';
											echo '<span><strong class="glyphicon glyphicon-calendar"></strong> '.$tanggal.'</span>';
											echo '&nbsp <span><strong class="glyphicon glyphicon-user"></strong> &nbsp '.$admin.'</span> ';
										echo '</div>';
										echo '<div>'.$isi.'</div>';
										echo "<div style='height:10px'></div>";
										echo anchor('news/detil/'.$record->id_news.'-'.$record->clean_url, 'Selengkapnya', 'class="btn btn-sm btn-success" title="Selengkapnya"');
									echo '</div>';
									echo "<hr>";
									echo '<div class="clearfix"></div>';
								echo '</div>';
							}
						?>						
						<?php echo $pagination;?>
					</div>
				</div>
		</div>
		<div class="col-xs-4">
			<div class="row">
				<!-- <div class="col-xs-12"> -->
  					<?php echo $info_akademik;?>
				<!-- </div> -->
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>