<?php echo form_open($form_action, 'id="form_cari"');?>
<table class="table">
	<tr><td>Judul Galeri</td><td><?php echo form_input('title', set_value('title', isset($default['title']) ? $default['title'] : ''), 'id="title" class="form-control"');?></td></tr>
	<tr><td>Kategori Galeri</td><td><?php echo $category;?></td></tr>
</table>
<?php echo form_close();?>