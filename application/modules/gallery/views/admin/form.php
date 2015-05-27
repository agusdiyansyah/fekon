<div class="well">
	<div class="form">
		<h3><?php echo $title;?></h3>
		<?php echo $this->session->flashdata('msg_gambar'); ?>
		<?php echo validation_errors('<div class="alert alert-error">', '</div>');?>
		<div class="error_container alert alert-error">
			<h4>Terjadi kesalahan dalam pengisian form</h4>
			<ol></ol>
		</div>
		<?php echo form_open_multipart($form_action, 'name="form_gallery" id="form_gallery" class="form"');?>
		<?php echo form_hidden('id_gallery', set_value('id_gallery', isset($default['id_gallery']) ? $default['id_gallery'] : ''), 'id="id_gallery"');?>
		<table class='table table-condensed'>
			<tr><td>Kategori</td><td>
				<?php
					echo $category;
				?>
			</td></tr>
			<tr><td width='200px'>Judul Galeri</td><td><?php echo form_input('title', set_value('title', isset($default['title']) ? $default['title'] : ''), 'id="title" class="form-control"');?></td></tr>
			<tr>
			    <td>Keterangan</td>
			    <td><?php echo form_input('content', set_value('content', isset($default['content']) ? $default['content'] : ''), 'id="content" class="form-control"'); ?></td>
			</tr>
			<tr>
			    <td>Gambar</td>
			    <td>
			    <?php
			  	if($mode == "edit"){
			  		echo "<img src='".base_url()."inventory/gambar/gallery/thumb/".$default['image']."' class='img-thumbnail'/><br>";	
			  		echo "<br>";
			  	}	    
			    echo form_upload(array('name'=>'userfile')); 
			    ?>
			    </td>
			</tr>
			<tr><td colspan="2"><input type="submit" class="btn btn-primary" value="Proses"> <input type="button" class="back btn btn-danger" value="Batal"></td></tr>
		</table>
		<?php echo form_close();?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function($) {
		var mode = "<?php echo $mode;?>";
		var error_container = $(".error_container");
		error_container.css('display', 'none');

		//alphanumeric method
		$.validator.addMethod("alphanumeric", function(value, element) {
	        return this.optional(element) || /^[a-z0-9]+$/i.test(value);
	    }, "Judul Hanya huruf dan angka saja");

		$("#form_gallery").validate({
			errorContainer: error_container,
			errorLabelContainer: $("ol", error_container),
			wrapper: 'li',
			rules : {
				title : {
					required:true,
					//alphanumeric:true
				},
				id_category : "required"
			},
			messages : {
				title : {
					required : "Judul Galeri tidak boleh kosong"
				},
				id_category : {
					required : "Kategori tidak boleh kosong"
				}
			}
		});

		$(".back").click(function(){
        	window.history.back();
        });
	});
</script>
