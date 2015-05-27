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
                    <?php echo form_hidden('id_dosen', set_value('id_dosen', isset($default['id_dosen']) ? $default['id_dosen'] : ''));?>
                    <table class="table">
                        <tr>
                            <td colspan="2"><b>Data Akademis</b></td>
                        </tr>
                        <tr>
                            <td>Program Studi</td>
                            <td>
                                <?php echo $combobox_prodi ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Staf</td>
                            <td>
                                <?php 
                                    $options = array('1' => 'Dalam', '2' => 'Luar' );
                                    echo form_dropdown('staf', $options, isset($default['staf']) ? $default['staf'] : '1', 'class="form-control"'); 
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Data Pribadi</b></td>
                        </tr>
                <?php  
                    if (!empty($default['img'])) {
                        ?>
                        <tr>
                            <td></td>
                            <td>
                                <img src="<?php echo base_url().'inventory/gambar/dosen/thumb/'.$default['img'] ?>" alt="">
                            </td>
                        </tr>
                        <?php
                    }
                ?>  
                        <tr>
                            <td>Photo</td>
                            <td>
                                <?php echo form_upload('img'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Dosen</td>
                            <td><?php echo form_input('nama', set_value('nama', isset($default['nama']) ? $default['nama'] : set_value('nama')), 'id="nama" class="form-control"');?></td>
                        </tr>
                        <tr>
                            <td>Telp/Hp</td>
                            <td><?php echo form_input('telp', set_value('telp', isset($default['telp']) ? $default['telp'] : set_value('telp')), 'id="telp" class="form-control"');?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo form_input('email', set_value('email', isset($default['email']) ? $default['email'] : set_value('email')), 'id="email" class="form-control"');?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>
                                <?php echo form_textarea('alamat', set_value('alamat', isset($default['alamat']) ? $default['alamat'] : ''), 'id="alamat" class="ckeditor"'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Data Pendidikan Dosen/Staf Pengajar</b></td>
                        </tr>
                        <tr>
                            <td>Fokus Studi</td> 
                             <td>
                                <?php echo form_textarea('fokus', set_value('fokus', isset($default['fokus']) ? $default['fokus'] : ''), 'id="fokus" class="ckeditor"'); ?>
                             </td>
                        </tr>
                        <tr>
                            <td>Riwayat Pendidikan</td>
                             <td>
                                <?php echo form_textarea('pendidikan', set_value('pendidikan', isset($default['pendidikan']) ? $default['pendidikan'] : ''), 'id="pendidikan" class="ckeditor"'); ?>
                             </td>
                        </tr>
                        <tr>
                            <td>Pelatihan dan Seminar</td>
                            <td>
                                <?php echo form_textarea('pelatihan', set_value('pelatihan', isset($default['pelatihan']) ? $default['pelatihan'] : ''), 'id="pelatihan" class="ckeditor"'); ?>
                             </td>
                        </tr>
                        <tr>
                            <td>Jurnal/Publikasi Ilmiah</td>
                            <td>
                                <?php echo form_textarea('jurnal', set_value('jurnal', isset($default['jurnal']) ? $default['jurnal'] : ''), 'id="jurnal" class="ckeditor"'); ?>
                             </td>
                        </tr>
                        <tr>
                            <td>Organisasi dan Keanggotaan</td>
                            <td>
                                <?php echo form_textarea('organisasi', set_value('organisasi', isset($default['organisasi']) ? $default['organisasi'] : ''), 'id="organisasi" class="ckeditor"'); ?>
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
        var editor = CKEDITOR.replace('alamat, fokus, pendidikan, pelatihan, jurnal, organisasi', {
            filebrowserBrowseUrl: '<?php echo site_url("ckeditor/browser");?>',
            filebrowserUploadUrl: '<?php echo site_url("ckeditor/upload_image");?>',
        });
    });
</script>