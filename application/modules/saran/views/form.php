<article class="latest-article">
	<div class="article-header">
		<h3 class="title">Saran</h3>
		<div class="separator"></div>
	</div>
	<div class="article-content">
		<?php echo $this->session->flashdata('msg'); ?>
		<?php echo validation_errors('<div class="alert alert-error">', '</div>');?>
		<div class="error_container alert alert-error hide">
			<h4>Terjadi kesalahan dalam pengisian form</h4>
			<ol></ol>
		</div>

		<div class="row-fluid">
			<div class="span12"><?php echo $saran_msg;?></div>
			<div class="span12">
				<?php echo form_open($form_action, 'name="form_saran" id="form_saran"');?>
				    <fieldset>
				    	<label>Nama Lengkap</label>
				    	<input type="text" name="nama_lengkap" id="nama_lengkap" class="input-xlarge">
				    </fieldset>

				    <fieldset>
				    	<label>Nomor Identitas (SIM/KTP)</label>
				    	<input type="text" name="no_identitas" id="no_identitas" class="input-xlarge">
				    </fieldset>

				    <fieldset>
				    	<label>Email</label>
				    	<input type="email" name="email" id="email" class="input-xlarge">
				    </fieldset>

				    <fieldset>
				    	<label>Nomor Telepon/HP</label>
				    	<input type="text" name="telepon" id="telepon" class="input-xlarge">
				    </fieldset>

				    <fieldset>
				    	<label>Alamat</label>
				    	<input type="text" name="alamat" id="alamat" class="input-xlarge">
				    </fieldset>

				    <fieldset>
				    	<label>Saran</label>
				    	<textarea name="saran" id="saran" rows="8" class="input-xxlarge"></textarea>
				    </fieldset>

				    <fieldset>
				    	<?php echo $html_captcha;?>
				    </fieldset>				   
				    <br>
				    <br>
				    <button type="submit" class="btn btn-flat">Kirim Saran</button>
			    </form>
			</div>
		</div>
	</div>
</article>
<script type="text/javascript" src="<?php echo base_url();?>inventory/js/jquery.validate.js"></script>
<script type="text/javascript">
	$(document).ready(function($) {
		var error_container = $(".error_container");
		//error_container.css('display', 'none');
		$("#form_saran").validate({
			errorContainer: error_container,
			errorLabelContainer: $("ol", error_container),
			wrapper: 'li',
			rules : {
				nama_lengkap : {
					required:true,
				},
				no_identitas : {
					required: true,
					number: true
				},
				email: {
					email: true,
					required: true
				},
				telepon: {
					required: true,
					number: true
				},
				alamat: {
					required: true
				},
				saran : "required"
			},
			messages: {
				nama_lengkap: {
					required: "Nama Lengkap Harus di isi"
				},
				no_identitas: {
					required: "Nomor Identitas Harus di isi",
					number: "Nomor Identitas Harus Format Angka"
				},
				email: {
					required: "Email Harus di isi",
					email: "Email tidak sesuai format"
				},
				telepon: {
					required: "Telepon/Hp Harus di isi",
					number: "Telepon/Hp Harus Format Angka"
				},
				alamat: {
					required: "Alamat Harus di isi"
				},
				saran: {
					required: "Saran Harus di isi"
				}
			}
		});
	});
</script>