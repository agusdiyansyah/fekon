<div class="hidden-phone bg_bannerRotator">
	<div id="containingDiv">
	  <div id="allinone_bannerRotator_attractive" style="display:none;">
	    <!-- IMAGES -->
	    <ul class="allinone_bannerRotator_list">
	    	<?php
	    	foreach ($result as $record) {
	    		echo "<li>";
	    		echo img("inventory/gambar/slide/".$record->image);
	    		echo "</li>";
	    	}
	    	?>
	    	<!--
	      <li data-bottom-thumb="inventory/js/banner-rotator/images/attractive/thumbs/01_attractive.jpg" data-text-id="#allinone_bannerRotator_photoText1">
	        <img src="inventory/slide_foto/1.jpg" alt=""/>
	      </li>
	      <li data-bottom-thumb="inventory/js/banner-rotator/images/attractive/thumbs/02_attractive.jpg" data-text-id="#allinone_bannerRotator_photoText2" data-link="http://codecanyon.net/user/LambertGroup" data-target="_blank">
	        <img src="inventory/slide_foto/2.jpg" alt=""/>
	      </li>
	      <li data-bottom-thumb="inventory/js/banner-rotator/images/attractive/thumbs/03_attractive.jpg" data-text-id="#allinone_bannerRotator_photoText3">
	        <img src="inventory/slide_foto/3.jpg" alt=""/>
	      </li>
	      <li data-bottom-thumb="inventory/js/banner-rotator/images/attractive/thumbs/04_attractive.jpg" data-text-id="#allinone_bannerRotator_photoText4">
	        <img src="inventory/slide_foto/4.jpg" alt=""/>
	      </li>
	      <li data-bottom-thumb="inventory/js/banner-rotator/images/attractive/thumbs/05_attractive.jpg" data-text-id="#allinone_bannerRotator_photoText5">
	        <img src="inventory/slide_foto/5.jpg" alt=""/>
	      </li>
	      	-->
	    </ul>
	  </div>
	</div>
</div>