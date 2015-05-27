<div class="panel-body">
  <div class="padtop"></div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <h1 class="media-heading4"><?php echo $module_name;?></h1>
        <?php 
          	if ($image != "") {
              echo "<br>";
              $img_properties = array(
                'src'=>base_url().'inventory/gambar/static_content/'.$image,
                'width'=>'600',
                'height'=>'365',
                );
  	          echo '<div class="img-thumbnail">'.anchor($img_properties['src'], img($img_properties), 'class="fancybox"').'</div>';
              echo "<br>";
            }
          	echo $content_static;
        ?>
    </div>
  </div>
  
</div>