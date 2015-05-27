<section class="content-header">
	<h1>
	<?php echo $title;?>
	</h1>
	<ol class="breadcrumb">
		<li>
			<?php echo anchor('admin/beranda', '<i class="fa fa-dashboard"></i>Beranda', 'attributes');?>
		</li>
		<li>
			<?php echo anchor('profil/admin', '<i class="fa fa-dashboard"></i>Profil', 'attributes');?>
		</li>
		<li class="active"><?php echo $title;?></li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-body">
					<div class="form">
						<?php echo $this->session->flashdata('msg_gambar'); ?>
						<?php echo validation_errors('<div class="alert alert-danger">', '</div>');?>
						<div class="error_container alert alert-error">
							<h4>Terjadi kesalahan dalam pengisian form</h4>
						<ol></ol>
					</div>
					<?php echo form_open_multipart($form_action, 'name="form_profil" id="form_profil" class="form" role="form"');?>
					<?php echo form_hidden('id_profil', set_value('id_profil', isset($default['id_profil']) ? $default['id_profil'] : ''), 'id="id_profil"');?>
					<table class='table table-condensed'>
						<tr><td width='200px'>Profil</td><td><?php echo form_input('title', set_value('title', isset($default['title']) ? $default['title'] : ''), 'id="title" class="form-control"');?></td></tr>
						<tr>
							<td>Berita</td>
							<td><?php echo form_textarea('content', set_value('content', isset($default['content']) ? $default['content'] : ''), 'id="content" class="ckeditor"'); ?></td>
						</tr>
						<tr>
							<td>Gambar</td>
							<td>
								<div class="col-md-6" style="padding:0px">
									<?php
										if($mode == "edit"){
											if ($default['image']) {
												echo "<img src='".base_url()."inventory/gambar/profil/thumb/".$default['image']."' class='img-thumbnail'/>";
													echo "<hr>";
											}
											}
									echo form_upload(array('name'=>'userfile'));
									?>
								</div>
							</td>
						</tr>
						<tr><td colspan="2"><input type="submit" class="btn btn-primary" value="Proses"> <input type="button" class="back btn btn-danger" value="Batal"></td></tr>
					</table>
					<?php echo form_close();?>
				</div>
				
			</div>
		</div>
	</div>
</div>
</section>
<script type="text/javascript">
	$(document).ready(function($) {
var mode = "<?php echo $mode;?>";
var error_container = $(".error_container");
error_container.css('display', 'none');
$("#form_profil").validate({
errorContainer: error_container,
errorLabelContainer: $("ol", error_container),
wrapper: 'li',
rules : {
title : {
required:true,
},
userfile: {
accept: true
},
date : "required"
},
messages : {
title : {
required : "Judul Berita tidak boleh kosong"
},
date: {
required : "Tanggal Berita tidak boleh kosong"
},
userfile: {
accept: "Hanya file format gambar"
}
}
});
$(".back").click(function(){
window.history.back();
});
$('#datepicker').datetimepicker({pickTime:false});
$('#timepicker').datetimepicker({pickDate:false});
});
var editor = CKEDITOR.replace('content', {
            filebrowserBrowseUrl: '<?php echo site_url("ckeditor/browser");?>',
            filebrowserUploadUrl: '<?php echo site_url("ckeditor/upload_image");?>',
        });
</script>