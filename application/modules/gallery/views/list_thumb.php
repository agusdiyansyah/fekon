<div class="row">
    <div class="spacer">
        <!-- blok hijau -->        
    	<div class="col-md-12 bg border-hijau">Galeri</div>
        <div class="col-md-12 border-hijau padding">
          <ul id="flexiselDemo3">
            <?php
            foreach ($result as $record) {
                $img_properties = array(
                    'src'=> 'inventory/gambar/gallery/thumb/'.$record->image,
                    'alt'=> $record->title,
                    'width'=> '130',
                    'height'=> '130',
                    'title'=> $record->title
                );
                echo "<li><a href='".base_url()."inventory/gambar/gallery/".$record->image."' class='fancybox'>".img($img_properties)."</a></li>";
            }
            ?>
          </ul>
        </div>
    </div>
</div>