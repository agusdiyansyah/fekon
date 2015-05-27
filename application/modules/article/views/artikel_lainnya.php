<div class="row">
	<div class="col-md-12 bg">
    	Artikel Lainnya
    </div>
</div>
<div class="row">
	<div class="col-md-12 c border-hijau">
		<ul>
			<?php 
			foreach ($lainnya as $record) {
				$clean_url = $this->clean_url->generate($record->id_article, $record->clean_url);
				$tanggal = $this->indo_date->tgl_indo($record->date);
			?>
			<li class="sidebar-item">
				<?php echo anchor('artikel/'.$clean_url, $record->title);?>
			</li>
			<?php
			}
			?>
		</ul>
	</div>
</div>