<link href="<?php echo base_url();?>inventory_admin/bootstrap/css/bootstrap-datepicker.min.css" rel="stylesheet">

<script type="text/javascript">
	$(document).ready(function() {
		$('.date').datepicker({
		    format: 'yyyy-mm-dd'
		});
	});
</script>

<?php echo form_open($form_action, 'id="form_cari"');?>
<table class="table">
	<tr><td>Judul Berita</td><td><?php echo form_input('title', set_value('title', isset($default['title']) ? $default['title'] : ''), 'id="title" class="form-control"');?></td></tr>
	<tr><td>Tanggal Berita</td><td><?php echo form_input('dateStart', set_value('dateStart', isset($default['dateStart']) ? $default['dateStart'] : ''), 'id="dateStart" class="date input-small"')." s/d ".form_input('dateEnd', set_value('dateEnd', isset($default['dateEnd']) ? $default['dateEnd'] : ''), 'id="dateEnd" class="date input-small"');?></td></tr>
	<tr><td>Administrator</td><td><?php echo $administrator;?></td></tr>
	<tr><td>Publish</td><td><?php echo $publish;?></td></tr>	
</table>
<?php echo form_close();?>