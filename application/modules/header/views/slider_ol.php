<style type="text/css">
	.header .title{
		position: absolute;
		background: #000;
		color: #fff;
		padding: 10px;
		bottom: 10px;
	}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'inventory/slider/responsiveslides.css' ?>">
<div class="col-lg-12 alpha omega header">
	<ul class="rslides" style="border:1px solid silver;height:300px;overflow:hidden">
		<?php foreach ($data as $res): 
			if ($res->publish == 'n') {
				continue;
			}
		?>
			<a href="<?php echo site_url('header/detil/'.$res->id_header.'-'.$res->slug) ?>">
				<li>
					<img src="<?php echo base_url().'inventory/gambar/header/'.$res->image ?>" style="width:100%;height:300px">
					<div class="title">
						<?php echo word_limiter($res->title, 15) ?>
					</div>
				</li>
			</a>
		<?php endforeach ?>
	</ul>
</div>
<!-- js -->
<script type="text/javascript" src="<?php echo base_url().'inventory/js/jquery.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'inventory/slider/responsiveslides.min.js' ?>"></script>
<script type="text/javascript">
	$(".rslides").responsiveSlides({
		auto: true,             // Boolean: Animate automatically, true or false
		speed: 1000,            // Integer: Speed of the transition, in milliseconds
		timeout: 2000,          // Integer: Time between slide transitions, in milliseconds
		pager: false,           // Boolean: Show pager, true or false
		nav: false,             // Boolean: Show navigation, true or false
		random: false,          // Boolean: Randomize the order of the slides, true or false
		pause: true,           // Boolean: Pause on hover, true or false
		pauseControls: true,    // Boolean: Pause when hovering controls, true or false
		prevText: "Previous",   // String: Text for the "previous" button
		nextText: "Next",       // String: Text for the "next" button
		maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
		navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
		manualControls: "",     // Selector: Declare custom pager navigation
		namespace: "rslides",   // String: Change the default namespace used
		before: function(){},   // Function: Before callback
		after: function(){}     // Function: After callback
	});
</script>