<?php
echo '<div class="link_terkait">';
	foreach ($result as $record) {
		if ($record->image != "") {
			$img_properties = array(
				'src'=>base_url().'inventory/gambar/link_terkait/thumb/'.$record->image,
				'width'=>'211',
				'height'=>'61'
				);
			$image = img($img_properties);
			echo '<div class="link_terkait_list">';
				echo anchor($record->url, $image, 'target="blank"');
			echo '</div>';
		}
		else {
			echo '<div class="link_terkait_list noimage">';
				echo anchor($record->url, $record->title, 'target="blank"');
			echo '</div>';
		}
	}
echo '</div>';
?>