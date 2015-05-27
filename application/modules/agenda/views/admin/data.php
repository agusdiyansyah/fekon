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
                </div>
                <div class="box-body">
                    <?php echo $this->session->flashdata('msg');?>
                    <?php echo $table;?>
                </div>
                <div class="box-footer clearfix">
                    <?php echo $pagination;?>
                </div>
            </div>
        </div>
    </div>

</section>
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
    });
</script>