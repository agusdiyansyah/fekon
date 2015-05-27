<div class="col-lg-12">
	<div class="info ">
		<div class="row">
			<div class="col-lg-12 judul">
				INFORMASI AKADEMIK
			</div>
		</div>
		<?php
		$no = 1;  
		foreach ($info as $data) {
			$color = '#E3F1E7';
			if ($no%2 == 0) {
				$color = '#EFF7F1';
			}
		?>
		<div class="row content" style="background:<?php echo $color ?>">
			<div class="col-lg-12">
				<b><a href="<?php echo base_url().'infoakademik/detil/'.$data->id_info.'-'.$data->slug ?>"><?php echo word_limiter($data->title, 10, '') ?></a></b><br>
				<p>
					<?php echo word_limiter(strip_tags($data->content), 5, '') ?>
				</p>
			</div>
		</div>
		<?php
		$no++;
		}
		?>
		<div class="row">
			<div class="right">
				<a href="<?php echo base_url().'infoakademik' ?>">More >></a>
			</div>
		</div>
	</div>
</div>