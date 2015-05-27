<style type="text/css">
	.berita-lainnya ul{
		list-style: none;
		padding-left: 0
	}
	.berita-lainnya li{
		margin-bottom: 10px;
		border-bottom: 1px dashed silver;
		padding-bottom: 10px;
	}
</style>
<div class="panel panel-nobg panel-default mar-kan">
	<div class="panel-heading panel-heading3">Berita Lainnya</div>
	<div class="panel-body berita-lainnya">
		<ul >
			<?php
				foreach ($lainnya as $record) {
					echo '<li role="presentation">';
						$clean_url = $record->id_news.'-'.$record->clean_url;
						echo anchor('berita/'.$clean_url, $record->title);
					echo '</li>';
				}
			?>
		</ul>
	</div>
</div>