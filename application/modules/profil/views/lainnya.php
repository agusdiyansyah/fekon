<div class="col-md-12">
	<div class="judul">Profil Lainnya</div>
	<div class="agenda">
		<?php
			if (count($result)>0) {
				foreach ($result as $record) {
					echo anchor('profil/detil/'.$record->id_profil, $record->title);
					echo '<div class="garis"></div>';
				}
			}
		?>
	</div>
</div>