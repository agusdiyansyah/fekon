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
                    <?php echo form_hidden('id_prodi', set_value('id_prodi', isset($default['id_prodi']) ? $default['id_prodi'] : ''));?>
                    <?php echo form_hidden('mode', set_value('mode', isset($default['mode']) ? $default['mode'] : ''));?>
                    <table class="table">
                        <tr>
                            <td>Konten</td>
                            <td><?php echo form_textarea('content', set_value('content', isset($default['content']) ? $default['content'] : ''), 'id="content" class="ckeditor"'); ?></td>
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

        $(".back").click(function(){
            window.history.back();
        });
        var editor = CKEDITOR.replace('content', {
            filebrowserBrowseUrl: '<?php echo site_url("ckeditor/browser");?>',
            filebrowserUploadUrl: '<?php echo site_url("ckeditor/upload_image");?>',
        });
    });
</script>