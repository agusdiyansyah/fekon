<section class="content-header">
    <h1>
        <?php echo $title;?>
    </h1>    
    <ol class="breadcrumb">
        <li>
            <?php echo anchor('admin/beranda', '<i class="fa fa-dashboard"></i>Beranda', 'attributes');?>
        </li>
        <li>
            <?php echo anchor('upload/admin', '<i class="fa fa-dashboard"></i>User', 'attributes');?>
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
                    <?php echo form_hidden('id_admin', set_value('id_admin', isset($default['id_admin']) ? $default['id_admin'] : ''));?>
                    <table class="table">
                        <tr>
                            <td>Fullname</td>
                            <td>
                                <?php echo form_input('fullname', set_value('fullname',isset($default['fullname']) ? $default['fullname'] : ''), 'class="form-control"'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>
                                <?php echo form_input('userid', set_value('userid',isset($default['userid']) ? $default['userid'] : ''), 'class="form-control"'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>
                                <?php echo form_password('password', set_value('password',isset($default['password']) ? $default['password'] : ''), 'class="form-control"'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Block User</td>
                            <td>
                                <?php
                                    $opt_pub = array('y'=>'Y','n'=>'N');
                                    echo form_dropdown('block', $opt_pub, isset($default['block']) ? $default['block'] : 'n', 'class="form-control"');
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
        $(".back").click(function(){
            
        });
        $("#form_upload").validate({
            errorContainer: error_container,
            errorLabelContainer: $("ol", error_container),
            wrapper: 'li',
            rules : {
                fullname : {
                    required:true
                },
                userid : {
                    required:true
                },
            },
            messages : {
                fullname : {
                    required : "Nama Dosen tidak boleh kosong"
                },
                userid : {
                    required: "Username tidak boleh kosong"
                },
            }
        });

        
    });
</script>