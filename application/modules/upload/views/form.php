<section class="content-header">
    <h1>
        <?php echo $title;?>
    </h1>    
    <ol class="breadcrumb">
        <li>
            <?php echo anchor('admin/beranda', '<i class="fa fa-dashboard"></i>Beranda', 'attributes');?>
        </li>
        <li>
            <?php echo anchor('upload/admin', '<i class="fa fa-dashboard"></i>Upload dokumen', 'attributes');?>
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
                    <?php echo $this->session->flashdata('msg_gambar'); ?>
                    <?php echo validation_errors('<div class="alert alert-error">', '</div>');?>
                    <div class="error_container alert alert-danger">
                        <h4>Terjadi kesalahan dalam pengisian form</h4>
                        <ol></ol>
                    </div>
                    <?php echo form_open_multipart($form_action, 'id="form_upload"');?>
                    <?php echo form_hidden('id_upload', set_value('id_upload', isset($default['id_upload']) ? $default['id_upload'] : ''));?>
                    <table class="table">
                    <?php  
                        if (!empty($default['nama'])) {
                            ?>
                        <tr>
                            <td>Uploaded</td>
                            <td>
                                <?php echo $default['nama'];
                                echo form_hidden('nama', $default['nama']); ?>
                            </td>
                        </tr>
                            <?php
                        }
                    ?>
                        <tr>
                            <td>Upload Dokumen</td>
                            <td>
                                <?php echo form_upload('doc'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Tampilkan pada foother</td>
                            <td>
                                <?php
                                    $opt_pub = array('y'=>'Y','n'=>'N');
                                    echo form_dropdown('foot', $opt_pub, isset($default['foot']) ? $default['foot'] : 'n', 'class="form-control"');
                                ?>
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
        $("#form_upload").validate({
            errorContainer: error_container,
            errorLabelContainer: $("ol", error_container),
            wrapper: 'li',
            rules : {
                nama : {
                    required:true
                }
            },
            messages : {
                nama : {
                    required : "Nama Dosen tidak boleh kosong"
                }
            }
        });

        $(".back").click(function(){
            window.history.back();
        });
        var editor = CKEDITOR.replace('content', {
            filebrowserBrowseUrl: '<?php echo site_url("inventory/js/ckeditor/browser");?>',
            filebrowserUploadUrl: '<?php echo site_url("inventory/js/ckeditor/upload_image");?>',
        });
    });
</script>