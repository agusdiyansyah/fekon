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
                    <?php echo form_hidden('id_prodi', set_value('id_prodi', isset($default['id_prodi']) ? $default['id_prodi'] : ''));?>
                    <table class="table">
                        <tr>
                            <td>Nama Prodi</td>
                            <td><?php echo form_input('prodi', set_value('prodi', isset($default['prodi']) ? $default['prodi'] : ''), 'id="prodi" class="form-control"');?></td>
                        </tr>
                        <tr>
                            <td>Jenjang</td>
                            <td>
                                <!-- <select name="jenjang" class="form-control">
                                    <option value="profesi">profesi</option>
                                    <option value="s2">s2</option>
                                    <option value="s3">s3</option>
                                </select> -->
                                <?php
                                    $opt_pub = array(
                                        'profesi'=>'profesi',
                                        's2'=>'s2',
                                        's3'=>'s3',
                                    );
                                    echo form_dropdown('jenjang', $opt_pub, isset($default['jenjang']) ? $default['jenjang'] : 'profesi', 'class="form-control"');
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>
                                <?php echo form_textarea('keterangan_prodi', set_value('keterangan_prodi', isset($default['keterangan_prodi']) ? $default['keterangan_prodi'] : ''), 'id="keterangan_prodi" class="ckeditor"'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Kurikulum</td>
                            <td>
                                <?php echo form_textarea('kurikulum', set_value('kurikulum', isset($default['kurikulum']) ? $default['kurikulum'] : ''), 'id="kurikulum" class="ckeditor"'); ?>
                            </td>
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
            },
            messages : {
                prodi : {
                    required : "Nama Program Studi tidak boleh kosong"
                },
            }
        });

        $(".back").click(function(){
            window.history.back();
        });
        var editor = CKEDITOR.replace('kurikulum', {
            filebrowserBrowseUrl: '<?php echo site_url("ckeditor/browser");?>',
            filebrowserUploadUrl: '<?php echo site_url("ckeditor/upload_image");?>',
        });
        var editor = CKEDITOR.replace('keterangan_prodi', {
            filebrowserBrowseUrl: '<?php echo site_url("ckeditor/browser");?>',
            filebrowserUploadUrl: '<?php echo site_url("ckeditor/upload_image");?>',
        });
    });
</script>