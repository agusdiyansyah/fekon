<div class="tp-banner-container">
	<div class="tp-banner">
		<ul>
			<?php
			foreach ($result as $record) {
			?>
			<!--SLIDE-->
			<li data-transition="fade" data-slotamount="5" data-masterspeed="700" >
				<!-- MAIN IMAGE -->
				<img data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" src="<?php echo base_url().'inventory/gambar/slide/'.$record->image;?>">
				<!-- LAYERS -->
			</li>
			<?php
			}
			?>
		</ul>
	</div>
</div>
