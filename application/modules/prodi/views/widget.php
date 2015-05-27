<div class="row thumbnail">
	<div class="judul">
		<span>Program</span>&nbsp
		<h2>Studi</h2>
	</div>
	<?php
		if (count($result>0)) {
			foreach ($result as $key => $prodi) {
				echo anchor('prodi/detil/'.$prodi->id_prodi, $prodi->prodi);
				echo '<hr style="margin:10px 0;">';
			}
		}
	?>
	<br style="margin-bottom:10px;">
</div>