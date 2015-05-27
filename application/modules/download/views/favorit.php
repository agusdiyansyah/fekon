<div class="row">
	<div class="col-md-12 bg">
    	Favorit
    </div>
</div>
<div class="row">
	<div class="col-md-12 c border-hijau">
		<ul class="list-group">
			<?php 
			foreach ($result as $record) {
				$clean_url = $this->clean_url->generate($record->id_download, $record->clean_url);
			?>
			<li class="list-group-item">
				<span class="badge"><?php echo $record->downloaded;?></span>
				<?php echo anchor('download-file/'.$clean_url, $record->title);?>
			</li>
			<?php
			}
			?>
		</ul>
	</div>
</div>