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
                    <?php echo $this->session->flashdata('msg_gambar'); ?>
                    <?php echo validation_errors('<div class="alert alert-error">', '</div>');?>
                    <div class="error_container alert alert-danger">
                        <h4>Terjadi kesalahan dalam pengisian form</h4>
                        <ol></ol>
                    </div>
                    <?php echo form_open_multipart($form_action, 'id="form_dosen"');?>
                    <?php echo form_hidden('id_header', set_value('id_header', isset($default['id_header']) ? $default['id_header'] : ''));?>
                    <table class="table">                        
                <?php  
                    if (!empty($default['image'])) {
                        ?>
                        <tr>
                            <td></td>
                            <td>
                                <img src="<?php echo base_url().'inventory/gambar/header/thumb/'.$default['image'] ?>" alt="">
                            </td>
                        </tr>
                        <?php
                    }
                ?>  
                        <tr>
                            <td>Photo</td>
                            <td>
                                <?php echo form_upload('image'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Judul Header</td>
                            <td><?php echo form_input('title', set_value('title', isset($default['title']) ? $default['title'] : set_value('title')), 'id="title" class="form-control"');?></td>
                        </tr> 
                        <tr>
                            <td>Keterangan</td>
                            <td>
                                <?php echo form_textarea('keterangan', set_value('keterangan', isset($default['keterangan']) ? $default['keterangan'] : ''), 'id="keterangan" class="ckeditor"'); ?>
                            </td>
                        </tr>  
                        <tr>
                             <td>Publish</td>
                             <td>
                                <?php
                                    $opt_pub = array('y'=>'Y','n'=>'N');
                                    echo form_dropdown('publish', $opt_pub, isset($default['publish']) ? $default['publish'] : 'y', 'class="form-control"');
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
        $("#form_dosen").validate({
            errorContainer: error_container,
            errorLabelContainer: $("ol", error_container),
            wrapper: 'li',
            rules : {
                title : {
                    required:true
                },
            },
            messages : {
                title : {
                    required : "Nama Dosen tidak boleh kosong"
                },
            }
        });

        $(".back").click(function(){
            window.history.back();
        });
        var editor = CKEDITOR.replace('keterangan', {
            filebrowserBrowseUrl: '<?php echo site_url("inventory/js/ckeditor/browser");?>',
            filebrowserUploadUrl: '<?php echo site_url("inventory/js/ckeditor/upload_image");?>',
        });
    });
</script>