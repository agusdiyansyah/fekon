<div class="well">
	<div class="form">
		<h3><?php echo $title;?></h3>
		<?php echo validation_errors('<div class="alert alert-error">', '</div>');?>
		<div class="error_container alert alert-error">
			<h4>Terjadi kesalahan dalam pengisian form</h4>
			<ol></ol>
		</div>
		<?php echo form_open($form_action, 'name="form_category" id="form_category" class="form"');?>
		<?php echo form_hidden('id_category', set_value('id_category', isset($default['id_category']) ? $default['id_category'] : ''), 'id="id_category"');?>
		<table class='table table-condensed'>
			<tr>
				<td width='200px'>Kategori</td>
				<td colspan="2">
					<?php echo form_input('name_category', set_value('name_category', isset($default['name_category']) ? $default['name_category'] : ''), 'id="name_category" class="form-control"');?>
				</td>
			</tr>
			<tr>
				<td width='200px'>Tanggal</td>
				<td>
					<div class="form-group" id="date">
						<div class='input-group date' id='datepicker'>
							<?php echo form_input('date', set_value('date', isset($default['date']) ? $default['date'] : $tgl_sekarang), ' class="form-control" data-date-format="YYYY-MM-DD"'); ?>
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group" id="time">
						<div class='input-group date' id='timepicker'>
							<?php echo form_input('time', set_value('time', isset($default['time']) ? $default['time'] : $tgl_sekarang), ' class="form-control" data-date-format="hh:mm:ss"'); ?>
							<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<input type="submit" class="btn btn-primary" value="Proses"> 
					<input type="button" class="back btn btn-danger" value="Batal">
				</td>
			</tr>
		</table>
		<?php echo form_close();?>
	</div>
</div>

<script src="<?php echo base_url();?>inventory_admin/bootstrap/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
	$(document).ready(function($) {
		var mode = "<?php echo $mode;?>";
		var error_container = $(".error_container");
		error_container.css('display', 'none');
		
		//alphanumeric method
		$.validator.addMethod("alphanumeric", function(value, element) {
	        return this.optional(element) || /^[a-z0-9\s\-]+$/i.test(value);
	    }, "Judul Kategori Hanya huruf dan angka saja");

		$("#form_category").validate({
			errorContainer: error_container,
			errorLabelContainer: $("ol", error_container),
			wrapper: 'li',
			rules : {
				name_category : {
					required:true,
					alphanumeric:true
				},
				date : {
					required:true,
				},
				time : {
					required:true,
				}
			},
			messages : {
				name_category : {
					required : "Kategori tidak boleh kosong"
				},
				date : {
					required:"Tanggal tidak boleh kosong"
				},
				time : {
					required:"Waktu tidak boleh kosong"
				}
			}
		});

		$(".back").click(function(){
        	window.history.back();
        });
        $('#date').datetimepicker({pickTime:false});
    	$('#time').datetimepicker({pickDate:false});
	});
</script>