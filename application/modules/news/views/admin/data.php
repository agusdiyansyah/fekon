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
			var url_form_cari = "<?php echo site_url('news/cari');?>";
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
			var url_form_cari = "<?php echo site_url('news/cari_proses/reset');?>";
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


<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data</h3>
                    <div class="box-tools pull-right">
                        <div class="input-group">
                            <?php echo anchor($link_tambah, '<span class="glyphicon glyphicon-plus"></span>', 'btn btn-sm btn-default');?>                            
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-12">
                        	<?php
								if ($cari['status'] == "ada") {
									echo "<table class='table table-condensed' width=100% style='margin-top:20px'><tr>";
									if ($cari['title']) {
										echo "<tr><td width='200px'>Judul Berita</td><td>: <b>".$cari['title']."</b></td></tr>";
									}
									if ($cari['dateStart']) {
										echo "<tr><td width='200px'>Tanggal Berita </td><td>: <b>".$cari['dateStart']."</b></td></tr>";
									}
									if ($cari['admin']) {
										echo "<tr><td width='200px'>Administrator </td><td>: <b>".$cari['admin']."</b></td></tr>";
									}
									if ($cari['dateEnd']) {
										echo "<tr><td width='200px'>Sampai Tanggal </td><td>: <b>".$cari['dateEnd']."</b></td></tr>";
									}
									if ($cari['publish']) {
										echo "<tr><td width='200px'>Publish</td><td>: <b>".$cari['publish']."</b></td></tr>";
									}
									echo "</tr></table>";
								}
							?>
							<br><br>
							<?php echo $this->session->flashdata('msg'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo $table;?>
                        </div>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <?php echo $pagination;?>
                </div>
            </div>
        </div>
    </div>

</section>