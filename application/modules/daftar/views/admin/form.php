<section class="content-header">
    <h1>
        <!-- <?php echo $title;?> -->
    </h1>    
    <ol class="breadcrumb">
        <li>
            <?php echo anchor('admin/beranda', '<i class="fa fa-dashboard"></i>Beranda', 'attributes');?>
        </li>
        <li>
            <?php echo anchor('daftar/admin', '<i class="fa fa-dashboard"></i>Pendaftaran', 'attributes');?>
        </li>
        <!-- <li class="active"><?php echo $title;?></li> -->
    </ol>
</section>
<style type="text/css">
    .tbl tr{
        height: 25px;
    }
    .tbl tr:hover{
        background: #F9FAFB;
    }
    .tbl tr:nth-child(even){
        background: #F9FAFB;
    }
    .tbl .non{
        background: #fff !important;
    }
    .tbl .non:hover{
        background: #fff;
    }
</style>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <table width="100%" class="tbl">
                        <tr class="non">
                            <td colspan="2"><legend>Pendaftar</legend></td>
                        </tr>
                        <tr class="non">
                            <td><b>NIK</b></td>
                            <td><b><?php echo $default['nik'] ?></b></td>
                        </tr>
                        <tr class="non">
                            <td>Nama</td>
                            <td><?php echo $default['nama'] ?></td>
                        </tr>
                        <tr class="non">
                            <td>Jenjang</td>
                            <td><?php echo $default['jenjang'] ?></td>
                        </tr>
                        <tr class="non">
                            <td>Mendaftar Jurusan</td>
                            <td><?php echo $default['prodi'] ?></td>
                        </tr>
                        <tr></tr>
                        <tr class="non">
                            <td colspan="2"><legend>Data Pribadi</legend></td>
                        </tr>
                        <tr>
                            <td>Tempat dan Tanggal Lahir</td>
                            <td><?php echo $default['ttl'] ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td><?php echo $default['jk'] ?></td>
                        </tr>
                        <tr>
                            <td>Golongan Darah</td>
                            <td><?php echo $default['darah'] ?></td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td><?php echo $default['agama'] ?></td>
                        </tr>
                        <tr>
                            <td>Status Pernikahan</td>
                            <td><?php echo $default['nikah'] ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><?php echo $default['alamat'] ?></td>
                        </tr>
                        <tr>
                            <td>Kota</td>
                            <td><?php echo $default['kota'] ?></td>
                        </tr>
                        <tr>
                            <td>Pos</td>
                            <td><?php echo $default['pos'] ?></td>
                        </tr>
                        <tr>
                            <td>Telephone/Hp. </td>
                            <td><?php echo $default['telp'] ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $default['email'] ?></td>
                        </tr>
                        <tr>
                            <td>Sumber Biaya</td>
                            <td><?php echo $default['biaya'] ?></td>
                        </tr>
                        <tr></tr>
                        <tr class="non">
                            <td colspan="2"><legend>Pendidikan</legend></td>
                        </tr>
                        <?php  
                        foreach ($pendidikan as $key) {
                            ?>
                        <tr>
                            <td><b>Jenjang</b></td>
                            <td><b><?php echo $key->jenjang ?></b></td>
                        </tr>
                        <tr>
                            <td>Nama Perguruan Tinggi</td>
                            <td><?php echo $key->nama_pt ?></td>
                        </tr>
                        <tr>
                            <td>Program Studi</td>
                            <td><?php echo $key->program ?></td>
                        </tr>
                        <tr>
                            <td>Alamat Perguruan Tinggi</td>
                            <td><?php echo $key->alamat_pt ?></td>
                        </tr>
                        <tr>
                            <td>Tahun Masuk</td>
                            <td><?php echo $key->masuk ?></td>
                        </tr>
                        <tr>
                            <td>Tahun Lulus</td>
                            <td><?php echo $key->lulus ?></td>
                        </tr>
                        <tr>
                            <td>IPK</td>
                            <td><?php echo $key->ipk ?></td>
                        </tr>
                        <tr>
                            <td>IPK UN</td>
                            <td><?php echo $key->ipkun ?></td>
                        </tr>
                        <tr>
                            <td>Status Perguruan Tinggi</td>
                            <td><?php echo $key->status ?></td>
                        </tr>
                        <tr>
                            <td>Gelar yang Diraih</td>
                            <td><?php echo $key->gelar ?></td>
                        </tr>
                            <?php
                        }
                        ?>
                        <tr></tr>
                        <tr class="non">
                            <td colspan="2"><legend>Pekerjaan</legend></td>
                        </tr>
                        <tr>
                            <td>Jenis Pekerjaan</td>
                            <td><?php echo $default['jenis'] ?></td>
                        </tr>
                        <tr>
                            <td>Instansi</td>
                            <td><?php echo $default['instansi'] ?></td>
                        </tr>
                        <tr>
                            <td>NIP/NIS</td>
                            <td><?php echo $default['nip'] ?></td>
                        </tr>
                        <tr>
                            <td>Pangkat/Golongan</td>
                            <td><?php echo $default['pangkat'] ?></td>
                        </tr>
                        <tr>
                            <td>Alamat Instansi</td>
                            <td><?php echo $default['alamat_k'] ?></td>
                        </tr>
                        <tr>
                            <td>Kota</td>
                            <td><?php echo $default['kota_k'] ?></td>
                        </tr>
                        <tr>
                            <td>Pos</td>
                            <td><?php echo $default['pos_k'] ?></td>
                        </tr>
                        <tr>
                            <td>Telephone</td>
                            <td><?php echo $default['telp_k'] ?></td>
                        </tr>
                        <tr></tr>
                        <tr class="non">
                            <td colspan="2"><legend>Kegiatan Lain</legend></td>
                        </tr>
                        <tr>
                            <td>Penelitian</td>
                            <td><?php echo $default['penelitian'] ?></td>
                        </tr>
                        <tr>
                            <td>Publikasi Ilmiah</td>
                            <td><?php echo $default['ilmiah'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>