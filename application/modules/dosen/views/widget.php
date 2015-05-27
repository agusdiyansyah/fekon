<div class="row thumbnail">
	<div class="judul">
		<span>Data</span>&nbsp
		<h2>Konsentrasi</h2>
	</div>
	<?php
		foreach ($result as $key => $konsentrasi) {
			echo anchor('konsentrasi/detil/'.$konsentrasi->id_konsentrasi, $konsentrasi->konsentrasi);
			echo '<hr style="margin:10px 0;">';
		}
	?>
	<br style="margin-bottom:10px;">
</div>