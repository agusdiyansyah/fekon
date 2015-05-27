<div class="col-md-12">
	<div class="judul">Prodi Fakultas Lainnya</div>
	<div class="agenda">
		<?php
			if (count($result)>0) {
				foreach ($result as $record) {
					echo anchor('prodi/detil/'.$record->id_prodi, $record->prodi);
					echo '<div class="garis"></div>';
				}
			}
		?>
	</div>
</div>