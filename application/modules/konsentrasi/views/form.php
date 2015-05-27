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
                    <?php echo form_open($form_action, 'id="form_prodi"');?>
                    <?php echo form_hidden('id_konsentrasi', set_value('id_konsentrasi', isset($default['id_konsentrasi']) ? $default['id_konsentrasi'] : ''));?>
                    <table class="table">
                        <tr>
                            <td>Nama Program Studi</td>
                            <td><?php echo $combobox_prodi;?></td>
                        </tr>
                        <tr>
                            <td>Nama Konsentrasi</td>
                            <td><?php echo form_input('konsentrasi', set_value('konsentrasi', isset($default['konsentrasi']) ? $default['konsentrasi'] : ''), 'id="konsentrasi" class="form-control"');?></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td><?php echo form_textarea('keterangan_konsentrasi', set_value('keterangan_konsentrasi', isset($default['keterangan_konsentrasi']) ? $default['keterangan_konsentrasi'] : ''), 'id="keterangan_konsentrasi" class="ckeditor"'); ?></td>
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
        $("#form_prodi").validate({
            errorContainer: error_container,
            errorLabelContainer: $("ol", error_container),
            wrapper: 'li',
            rules : {
                prodi : {
                    required:true
                },
                konsentrasi : {
                    required:true
                }
            },
            messages : {
                konsentrasi : {
                    required : "Nama Program Studi tidak boleh kosong"
                },
                prodi : {
                    required : "Nama Program Studi tidak boleh kosong"
                }
            }
        });

        $(".back").click(function(){
            window.history.back();
        });
        var editor = CKEDITOR.replace('keterangan_konsentrasi', {
            filebrowserBrowseUrl: '<?php echo site_url("ckeditor/browser");?>',
            filebrowserUploadUrl: '<?php echo site_url("ckeditor/upload_image");?>',
        });
    });
</script>