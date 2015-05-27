<section class="content-header">
    <h1>
        <?php echo $title;?>
    </h1>    
    <ol class="breadcrumb">
        <li>
            <?php echo anchor('admin/beranda', '<i class="fa fa-dashboard"></i>Beranda', 'attributes');?>
        </li>
        <li>
            <?php echo anchor('news/admin', '<i class="fa fa-dashboard"></i>Berita', 'attributes');?>
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
						<?php echo validation_errors('<div class="alert alert-error">', '</div>');?>
						<div class="error_container alert alert-error">
							<h4>Terjadi kesalahan dalam pengisian form</h4>
						<ol></ol>
					</div>
					<?php echo form_open_multipart($form_action, 'name="form_news" id="form_news" class="form" role="form"');?>
					<?php echo form_hidden('id_news', set_value('id_news', isset($default['id_news']) ? $default['id_news'] : ''), 'id="id_news"');?>
					<table class='table table-condensed'>
						<tr><td width='200px'>Judul Berita</td><td><?php echo form_input('title', set_value('title', isset($default['title']) ? $default['title'] : ''), 'id="title" class="form-control"');?></td></tr>
						<tr>
							<td>Berita</td>
							<td><?php echo form_textarea('content', set_value('content', isset($default['content']) ? $default['content'] : ''), 'id="content" class="ckeditor"'); ?></td>
						</tr>
						<tr><td>Adminisitrator</td><td>
						<div class="col-xs-3">
							<?php
								echo $administrator;
							?>
						</div>
					</td></tr>
					<tr>
						<td>Gambar</td>
						<td>
							<div class="col-md-6">
								<?php
									if($mode == "edit"){
										if ($default['image']) {
											echo "<img src='".base_url()."inventory/gambar/news/thumb/".$default['image']."' class='img-thumbnail'/>";
												echo "<hr>";
										}
										}
								//echo form_upload(array('name'=>'userfile'));

								?>
								<input type="file" name="userfile">
							</div>
						</td>
					</tr>
					<tr>
						<td>Tanggal Berita</td>
						<td>
							<div class='col-sm-6'>
								<div class="form-group">
									<div class='input-group date' id='datepicker'>
										<?php echo form_input('date', set_value('date', isset($default['date']) ? $default['date'] : $tgl_sekarang), 'id="date" class="form-control" data-date-format="YYYY-MM-DD"'); ?>
										<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
									</div>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>Jam Berita</td>
						<td>
							<div class='col-sm-6'>
								<div class="form-group">
									<div class='input-group date' id='timepicker'>
										<?php echo form_input('time', set_value('time', isset($default['time']) ? $default['time'] : $tgl_sekarang), 'id="time" class="form-control" data-date-format="hh:mm:ss"'); ?>
										<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
									</div>
								</div>
							</div>
						</td>
					</tr>
					<tr><td>Publish</td><td>
					<div class="col-xs-2">
						<?php
							$opt_pub = array('y'=>'Y','n'=>'N');
							echo form_dropdown('publish', $opt_pub, $default['publish'], 'class="form-control"');
						?>
					</div>
				</td></tr>
				<tr><td colspan="2"><input type="submit" class="btn btn-primary" value="Proses"> <input type="button" class="back btn btn-danger" id="back" value="Batal"></td></tr>
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
		var editor = CKEDITOR.replace('content', {
            filebrowserBrowseUrl: '<?php echo site_url("ckeditor/browser");?>',
            filebrowserUploadUrl: '<?php echo site_url("ckeditor/upload_image");?>',
        });
		var mode = "<?php echo $mode;?>";
		var error_container = $(".error_container");
		error_container.css('display', 'none');
		$("#form_news").validate({
			errorContainer: error_container,
			errorLabelContainer: $("ol", error_container),
			wrapper: 'li',
			rules : {
				title : {
					required:true,
				},
				date : {
					required:true,
				},
				userfile: {
					accept: true,
				},
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

		$("#back").click(function(){
        	window.history.back();
        });
    	$('#datepicker').datetimepicker({pickTime:false});
    	$('#timepicker').datetimepicker({pickDate:false});
	});
</script>