<br>
<!-- informasi -->
<div class="judul">
	<span>Berita</span>&nbsp
	<h2>Kampus</h2>
</div>

<div class="berita">
	<div class="row">
		<?php
			$no = 0;
			foreach ($result as $record) {
				$no++;
				$image = "nonaktif";
				if ($no == 1) {
					$dynamic_coloumn = "col-sm-12 col-md-6 col-lg-6";
					$image = "aktif";
				}
				else if ($no > 1 && $no < 4) {
					$dynamic_coloumn = "col-sm-6 col-md-6 col-lg-3";
					$image = "aktif";
				}
				else {
					$dynamic_coloumn = "col-sm-6 col-md-6 col-lg-12";
				}
				?>
				<div class="<?php echo $dynamic_coloumn;?>">
					<?php if ($image == "aktif") {
						?>
						<div class="row">
							<div class="col-lg-12">
								<div class="thumbnail">
									<img src="<?php echo site_url().'inventory/gambar/news/thumb/'.$record->image ?>" alt="" style="width:100%">
								</div>
							</div>
						</div>
						<?php
					}
					?>
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<?php 
							$url = base_url().'news/detil/'.$record->id_news.'-'.$record->clean_url;
							?>
							<a href="<?php echo $url; ?>"><h4><?php echo $record->title; ?></h4></a>
							<tgl><?php echo $this->indo_date->tgl_indo($record->date)." ".$record->time; ?></tgl>
							<footer>
								<?php echo word_limiter(strip_tags($record->content), 15, ''); ?>
							</footer>
							<br>
							<a href="<?php echo $url ?>">More >></a>
						</div>
					</div>
				</div>
				<?php
			}
		?>
	</div>
	<br>
</div>
<hr>