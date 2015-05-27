<div class="row">
	<div class="col-md-12 bg">
		<?php echo $title;?>
	</div>
</div>
<div class="row">
	<ul class="list-group">
		<?php
			echo "<li class='list-group-item'>";
			echo form_open('download-cari');
				echo "<div class='input-group'>";
					echo form_input('search', $this->session->userdata('download_cari'), 'class="form-control"');
					echo "<span class='input-group-btn'>";
						if ($this->session->userdata('download_cari')) {
							echo anchor('download-reset', 'X', 'class="btn btn-danger"');	
						}
						echo form_submit('submit', 'Cari', 'class="btn btn-danger"');
					echo "</span>";
				echo "</div>";
			echo form_close();
			echo "</li>";
			foreach ($result as $record) {
				$clean_url = $this->clean_url->generate($record->id_download, $record->clean_url);
				echo "<li class='list-group-item'>";
				echo "<h4 class='list-group-item-heading'>".$record->title."</h4>";
				echo anchor('download-file/'.$clean_url, 'Download', 'class="btn btn-danger pull-right"');
				echo "<span class='list-group-item-text'>".$record->info."</span>";
				echo "<div class='clearfix'></div>";
				echo "</li>";
			}
		?>
	</ul>
	<?php echo $pagination;?>
</div>