<?php foreach ($result as $record) {
	$judul = $record->title;
	$clean_url = strtolower(str_replace(" ", "-", $judul));
	echo "<li role='presentation'>";
	echo anchor('pengumuman/'.$clean_url, $judul);
	echo "</li>";				
}
?>