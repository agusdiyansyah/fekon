<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse alpha omega" id="bs-example-navbar-collapse-1">
            <?php 
                $prodi_list = prodi_list();
            ?>
            <ul class="nav navbar-nav">
                <li><a href="<?php echo site_url('beranda') ?>">Beranda</a></li>
                <!--
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Page <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo site_url() ?>ui/berita">Home Berita</a></li>
                        <li><a href="<?php echo site_url() ?>ui/detail">Detail Berita</a></li>
                        <li><a href="<?php echo site_url() ?>ui/profil">Profil</a></li>
                        <li><a href="<?php echo site_url() ?>ui/galeri/gdetail">Galeri</a></li>
                        <li><a href="<?php echo site_url() ?>admin">Admin</a></li>
                    </ul>
                </li> -->
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Program Studi</a>
                    <ul class="dropdown-menu" role="menu">
                        <?php
                        foreach ($prodi_list as $key => $profil) {
                            echo '<li>'.anchor('prodi/detil/'.$profil['id_prodi'], $profil['prodi']).'</li>';
                        }
                        ?>
                    </ul>
                </li>                
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kurikulum</a>
                    <ul class="dropdown-menu" role="menu">
                        <?php
                        foreach ($prodi_list as $key => $profil) {
                            echo '<li>'.anchor('prodi/kurikulum/'.$profil['id_prodi'], $profil['prodi']).'</li>';
                        }
                        ?>
                    </ul>
                </li>  
                <li><a href="<?php echo site_url('dosen') ?>">Staf Pengajar</a></li>
                <!-- <li><a href="#">Tim Pengelola</a></li> -->
                <li><a href="http://jurnal.untan.ac.id/">Jurnal</a></li>
                <li><a href="http://siakad.untan.ac.id/">Siakad</a></li>
                <!-- <li><a href="#">Kemitraan</a></li> -->
            </ul>
        </div>
    </div>
</nav>