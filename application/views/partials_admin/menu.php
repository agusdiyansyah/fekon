<aside class="left-side sidebar-offcanvas">                
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <!--  <img src="<?php // echo base_url();?>inventory/adminlte/img/avatar5.png" class="img-circle" alt="User Image" /> -->
            </div>
            <div class="pull-left info">
                <p>Selamat Datang, Admin</p>
                <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <!-- <li class="active"> -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-camera-retro"></i>
                    <span>Header</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <?php echo anchor('header/admin', '<i class="fa fa-table"></i> Header');?>
                    </li>
                    <li>
                        <?php echo anchor('promosi/admin', '<i class="fa fa-table"></i> Promosi');?>
                    </li>
                </ul>
            <li>
                <?php echo anchor('news/admin', '<i class="fa fa-edit"></i>Berita');?>
            </li>
            <li>
                <?php echo anchor('prodi/admin', '<i class="fa fa-edit"></i>Program Studi');?>
            </li>
            <li>
                <?php echo anchor('konsentrasi/admin', '<i class="fa fa-edit"></i>Konsentrasi');?>
            </li>
            <li>
                <?php echo anchor('dosen/admin', '<i class="fa fa-edit"></i>Dosen');?>
            </li>
            <li>
                <?php echo anchor('upload/admin', '<i class="fa fa-edit"></i>Upload');?>
            </li>
            <li>
                <?php echo anchor('infoakademik/admin', '<i class="fa fa-edit"></i>Informasi Akademik');?>
            </li>
            <li>
                <?php echo anchor('matakuliah/admin', '<i class="fa fa-edit"></i>Mata Kuliah');?>
            </li>
            <li>
                <?php echo anchor('profil/admin', '<i class="fa fa-dashboard"></i>Profil');?>
            </li>
            <li>
                <?php echo anchor('agenda/admin', '<i class="fa fa-calendar"></i>Agenda');?>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-camera-retro"></i>
                    <span>Pendaftaran</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <?php echo anchor('daftar/admin', '<i class="fa fa-table"></i> Data Pendaftar');?>
                    </li>
                    <li>
                        <?php echo anchor('daftar/admin/registrasi', '<i class="fa fa-table"></i> Informasi');?>
                    </li>
                </ul>
            </li>          
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-camera-retro"></i>
                    <span>Galeri</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <?php echo anchor('gallery/admin', '<i class="fa fa-table"></i> Foto');?>
                    </li>
                    <li>
                        <?php echo anchor('gallery/category', '<i class="fa fa-table"></i> Album');?>
                    </li>
                </ul>
            </li>
<!-- 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Charts</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/charts/morris.html"><i class="fa fa-angle-double-right"></i> Morris</a></li>
                    <li><a href="pages/charts/flot.html"><i class="fa fa-angle-double-right"></i> Flot</a></li>
                    <li><a href="pages/charts/inline.html"><i class="fa fa-angle-double-right"></i> Inline charts</a></li>
                </ul>
            </li>
 -->
        </ul>
    </section>
</aside>