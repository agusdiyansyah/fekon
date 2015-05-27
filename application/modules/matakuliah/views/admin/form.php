<section class="content-header">
    <h1>
        <?php echo $title;?>
    </h1>    
    <ol class="breadcrumb">
        <li>
            <?php echo anchor('admin/beranda', '<i class="fa fa-dashboard"></i>Beranda', 'attributes');?>
        </li>
        <li>
            <?php echo anchor('konsentrasi/admin', '<i class="fa fa-dashboard"></i>Konsentrasi', 'attributes');?>
        </li>
        <li class="active"><?php echo $title;?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="error_container alert alert-danger">
                        <h4>Terjadi kesalahan dalam pengisian form</h4>
                        <ol></ol>
                    </div>
                    <?php echo form_open($form_action, 'id="form_matakuliah"');?>
                    <?php echo form_hidden('id_matakuliah', set_value('id_matakuliah', isset($default['id_matakuliah']) ? $default['id_matakuliah'] : ''));?>
                    <table class="table">
                        <tr>
                            <td>Nama Program Studi</td>
                            <td><?php echo $combobox_prodi;?></td>
                        </tr>
                        <tr>
                            <td>Nama Konsentrasi</td>
                            <td>
                                <div class="col-md-6" style="padding:0px" id="combobox_konsentrasi_wrapper">
                                    <?php echo $combobox_konsentrasi;?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Mata Kuliah</td>
                            <td><?php echo form_input('matakuliah', set_value('matakuliah', isset($default['matakuliah']) ? $default['matakuliah'] : ''), 'id="matakuliah" class="form-control"');?></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td><?php echo form_textarea('keterangan_matakuliah', set_value('keterangan_matakuliah', isset($default['keterangan_matakuliah']) ? $default['keterangan_matakuliah'] : ''), 'id="keterangan_matakuliah" class="ckeditor"'); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <?php echo form_submit('submit', 'Proses', 'class="btn btn-success"');?>
                                <button class="back btn btn-danger">Batal</button>
                            </td>
                        </tr>
                    </table>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>

</section>

<script type="text/javascript">
    $(document).ready(function() {
        var error_container = $(".error_container");
        error_container.css('display', 'none');
        $("#form_matakuliah").validate({
            errorContainer: error_container,
            errorLabelContainer: $("ol", error_container),
            wrapper: 'li',
            rules : {
                id_prodi : {
                    required:true
                },
                id_konsentrasi : {
                    required:true
                },
                matakuliah : {
                    required:true
                }
            },
            messages : {
                id_konsentrasi : {
                    required : "Nama Program Studi tidak boleh kosong"
                },
                id_prodi : {
                    required : "Nama Program Studi tidak boleh kosong"
                },
                matakuliah : {
                    required : "Nama Mata Kuliah tidak boleh kosong"
                }
            }
        });

        $(".back").click(function(){
            var url_back = "<?php echo site_url('matakuliah/admin');?>";
            location.href(url_back);
        });
        $('#id_prodi').change(function() {
            var id_prodi = $(this).val();
            if (id_prodi) {
                var url_combobox_konsentrasi = '<?php echo site_url("konsentrasi/admin/combobox_konsentrasi/' + id_prodi + '");?>';
                $.ajax({
                    url: url_combobox_konsentrasi,
                    success: function(response){
                        $("#combobox_konsentrasi_wrapper").html(response);                    
                    }
                });            
            }
            else {
                $("#combobox_konsentrasi_wrapper").html("");
            }
        });
        var editor = CKEDITOR.replace('keterangan_matakuliah', {
            filebrowserBrowseUrl: '<?php echo site_url("ckeditor/browser");?>',
            filebrowserUploadUrl: '<?php echo site_url("ckeditor/upload_image");?>',
        });
    });
</script>