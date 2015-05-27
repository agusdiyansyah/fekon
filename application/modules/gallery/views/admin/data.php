<script type="text/javascript">
	$(document).ready(function() {
		//hapus
		$('.hapus').click(function(e){
			e.preventDefault();
			if (!$(this).hasClass('disabled')) {
				 var url_delete = $(this).attr("href");
				 if (confirm('Anda Yakin Akan Menghapus Data Ini ?')) {
				 	$(location).attr('href', url_delete);
				 }
			};
		});
		//cari data
		$('#btn_cari').click(function(e) {
			e.preventDefault();
			var url_form_cari = "<?php echo site_url('gallery/admin/cari');?>";
			$.ajax({
				url: url_form_cari,
				success : function(data){
					$("#wrapper_form").html(data);
					$("#proses_cari").click(function() {
						var data_cari = $("#form_cari").serialize();
						$.ajax({
							type : 'POST',
							url : $("#form_cari").attr('action'),
							data : data_cari,
							success : function(){
								location.reload();
							},
							error : function(){
								alert("Error");
							}
						});
					});
				},
				error : function(){
					alert("Error");
				}
			});			
		});
		$("#proses_reset").click(function() {
			var url_form_cari = "<?php echo site_url('gallery/cari_proses/reset');?>";
			$.ajax({
				url: url_form_cari,
				success : function(){
					location.reload();
				},
				error : function(){
					alert("Error");
				}
			});
		});
	});
</script>
<section class="content-header">
	<h1>
        <?php echo $title;?>
    </h1>    
    <ol class="breadcrumb">
        <li>
            <?php echo anchor('admin/beranda', '<i class="fa fa-dashboard"></i>Beranda', 'attributes');?>
        </li>
        <li class="active"><?php echo $title;?></li>
    </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data</h3>
                    <div class="box-tools pull-right">
                        <div class="input-group">
							<?php echo anchor('gallery/category', '<span class="glyphicon glyphicon-th"></span>', 'class="btn btn-sm btn-default" title="Data Album"');?>	
                            <?php echo anchor('gallery/admin/tambah', '<span class="glyphicon glyphicon-plus"></span>', 'class="btn btn-sm btn-default"');?>                            
							<?php echo anchor('#myModal', '<span class="glyphicon glyphicon-search"></span>', 'class="btn btn-sm btn-default" data-toggle="modal" id="btn_cari"');?>
                        </div>
                    </div>
                </div>
                <div class="box-body">
					<?php
						if ($cari['status'] == "ada") {
							echo "<table class='table table-condensed' width=100% style='margin-top:20px'><tr>";
							if ($cari['title']) {
								echo "<tr><td width='200px'>Judul Galeri</td><td>: <b>".$cari['title']."</b></td></tr>";
							}
							if ($cari['category']) {
								echo "<tr><td width='200px'>Kategory </td><td>: <b>".$cari['category']."</b></td></tr>";
							}
							echo "</table>";
						}
					?>
					<br><br>
					<?php echo $this->session->flashdata('msg'); ?>
					<table class="table table-hover">
							<tr>
								<th>No</th>
								<th>Judul Galeri</th>
								<th>Kategori Galeri</th>
								<th width="80px">Aksi</th>
							</tr>
							<?php echo $gallery_list;?>
					</table>
				</div>
				<div class="box-footer clearfix">
					<?php echo $pagination;?>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Cari Data Galeri</h3>
  </div>
  <div class="modal-body" id="wrapper_form">
    
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
    <button class="btn btn-danger" id="proses_reset">Reset</button>
    <button class="btn btn-primary" id="proses_cari">Proses</button>
  </div>
</div>