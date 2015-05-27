<section class="content-header">
    <h1>
        <?php echo $title;?>
    </h1>    
    <ol class="breadcrumb">
        <li>
            <?php echo anchor('admin/beranda', '<i class="fa fa-dashboard"></i>Beranda', 'attributes');?>
        </li>
        <li>
            <?php echo anchor('agenda/admin', '<i class="fa fa-dashboard"></i>Agenda', 'attributes');?>
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
                    <?php echo form_open($form_action, 'id="form_agenda"');?>
                    <?php echo form_hidden('id_agenda', set_value('id_agenda', isset($default['id_agenda']) ? $default['id_agenda'] : ''));?>
                    <table class="table">
                        <tr>
                            <td width="150px">Nama Agenda</td>
                            <td><?php echo form_input('title', set_value('title', isset($default['title']) ? $default['title'] : ''), 'id="title" class="form-control"');?></td>
                        </tr>
                        <tr>
                            <td>Tempat Agenda</td>
                            <td><?php echo form_input('place', set_value('place', isset($default['place']) ? $default['place'] : ''), 'id="place" class="form-control"');?></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td><?php echo form_textarea('content', set_value('content', isset($default['content']) ? $default['content'] : ''), 'id="content" class="ckeditor"'); ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai</td>
                            <td>
                                <div class='col-sm-6' style="padding-left:0">
                                <div class="form-group">
                                    <div class='input-group date' id='datepicker'>
                                        <?php echo form_input('date_start', set_value('date_start', isset($default['date_start']) ? $default['date_start'] : ''), 'id="date_start" class="form-control datepicker" data-date-format="YYYY-MM-DD"'); ?>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                    </div>
                                </div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Berakhir</td>
                            <td>
                                <div class='col-sm-6' style="padding-left:0">
                                    <div class="form-group">
                                        <div class='input-group date' id='datepicker'>
                                            <?php echo form_input('date_end', set_value('date_end', isset($default['date_end']) ? $default['date_end'] : ''), 'id="date_end" class="form-control datepicker" data-date-format="YYYY-MM-DD"'); ?>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Waktu</td>
                            <td>
                                <div class='col-sm-6' style="padding-left:0">
                                    <div class="form-group">
                                        <div class='input-group date' id='timepicker'>
                                            <?php echo form_input('time', set_value('time', isset($default['time']) ? $default['time'] : ''), 'id="time" class="form-control timepicker" date-format="hh:mm:ss"'); ?>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Publish</td>
                            <td>
                                <div class="col-xs-2" style="padding-left:0">
                                    <?php
                                        $opt_pub = array('y'=>'Y','n'=>'N');
                                        echo form_dropdown('publish', $opt_pub, $default['publish'], 'class="form-control"');
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <?php echo form_submit('submit', 'Proses', 'class="btn btn-primary"');?>
                                <input type="button" class="back btn btn-danger" value="Batal">
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
        $("#form_agenda").validate({
            errorContainer: error_container,
            errorLabelContainer: $("ol", error_container),
            wrapper: 'li',
            rules : {
                title : {
                    required:true
                },
                place : {
                    required : true
                }
            },
            messages : {
                title : {
                    required : "Judul agenda tidak boleh kosong"
                },
                place : {
                    required : "Tempat Agenda tidak boleh kosong"
                }
            }
        });

        $('.datepicker').datetimepicker({pickTime:false})
        $('.timepicker').datetimepicker({pickDate:false})

        $(".back").click(function(){
            window.history.back();
        });
        var editor = CKEDITOR.replace('content', {
            filebrowserBrowseUrl: '<?php echo site_url("inventory/js/ckeditor/browser");?>',
            filebrowserUploadUrl: '<?php echo site_url("inventory/js/ckeditor/upload_image");?>',
        });
    });
</script>