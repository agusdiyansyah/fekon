<section class="content-header">
    <h1>
        <?php echo $title;?>
    </h1>    
    <ol class="breadcrumb">
        <li>
            <?php echo anchor('admin/beranda', '<i class="fa fa-dashboard"></i>Beranda', 'attributes');?>
        </li>
        <li>
            <?php echo anchor('prodi/admin', '<i class="fa fa-dashboard"></i>Program Studi', 'attributes');?>
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
						<?php echo validation_errors('<div class="alert alert-error">', '</div>');?>
						<div class="error_container alert alert-error">
							<h4>Terjadi kesalahan dalam pengisian form</h4>
						<ol></ol>
					</div>
					<?php echo form_open($form_action, 'name="form_admin" id="form_admin" class="form"');?>
					<?php echo form_hidden('id_admin', set_value('id_admin', isset($default['id_admin']) ? $default['id_admin'] : ''), 'id="id_admin"');?>
					<table class='table table-condensed'>
						<tr><td width='200px'>User ID</td><td><?php echo form_input('userid', set_value('userid', isset($default['userid']) ? $default['userid'] : ''), 'id="userid"');?></td></tr>
						<tr><td>Password</td><td>
						<?php
							echo form_password('password', '', 'id="password"');
							if ($mode == "edit") {
								echo ' <span class="label label-important">Kosongkan, jika password tidak diganti</span>';
							}
						?>
						</td></tr>
						<tr><td>Password Konfirmasi</td><td><?php echo form_password('password_ulang', '', 'id="password_ulang"');?></td></tr>
						<tr><td>Nama Lengkap</td><td><?php echo form_input('fullname', set_value('fullname', isset($default['fullname']) ? $default['fullname'] : ''), 'id="fullname"');?></td></tr>
						<tr><td>Level</td><td>
						<?php
							$opt_level = array(''=>'level', 1=>'Administrator', 2=>'Operator');
							echo form_dropdown('level', $opt_level, $default['level']);
						?>
						</td></tr>
						<tr><td>Blok</td><td>
						<?php
							$opt_blok = array('n'=>'N', 'y'=>'Y');
							echo form_dropdown('block', $opt_blok, $default['block']);
						?>
						</td></tr>
						<tr><td colspan="2"><input type="submit" class="btn btn-primary" value="Proses"> <input type="button" class="back btn btn-danger" value="Batal"></td></tr>
					</table>
					<?php echo form_close();?>
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
		$("#form_admin").validate({
			errorContainer: error_container,
			errorLabelContainer: $("ol", error_container),
			wrapper: 'li',
			rules : {
				userid : {
					required:true,
					minlength:6
				},
				fullname : "required"
			},
			messages : {
				userid : {
					required : "User ID tidak boleh kosong"
				},
				fullname : {
					required : "Nama Lengkap tidak boleh kosong"
				}
			}
		});

		//jika mode tambah data, tambahkan aturan validasi
		if (mode == "tambah") {
			$("#password").rules("add", {
				required:true,
				minlength:6,
				messages: {
					required: "Password tidak boleh kosong",
					minlength: "Password minimal 6 karakter"					
				}
			});
			$("#password_ulang").rules("add", {
				equalTo : "#password",
				messages:{
					equalTo: "Password Konfirmasi harus sama dengan password"
				}
			})
		};
		$(".back").click(function(){
        	window.history.back();
        });
	});
</script>