-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 02 Mar 2015 pada 12.43
-- Versi Server: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_fekon`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbb_level`
--

CREATE TABLE IF NOT EXISTS `tbb_level` (
  `id_level` int(3) NOT NULL AUTO_INCREMENT,
  `level` varchar(50) NOT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_administrator`
--

CREATE TABLE IF NOT EXISTS `tb_administrator` (
  `id_admin` int(3) NOT NULL AUTO_INCREMENT,
  `userid` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `id_level` int(2) NOT NULL,
  `block` enum('y','n') NOT NULL,
  `info` text NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_agenda`
--

CREATE TABLE IF NOT EXISTS `tb_agenda` (
  `id_agenda` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `slug` text NOT NULL,
  `content` text NOT NULL,
  `date_start` text NOT NULL,
  `date_end` text NOT NULL,
  `time` text NOT NULL,
  `place` varchar(100) NOT NULL,
  `publish` enum('y','n') NOT NULL,
  PRIMARY KEY (`id_agenda`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_daftar`
--

CREATE TABLE IF NOT EXISTS `tb_daftar` (
  `id_daftar` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(100) NOT NULL,
  `id_prodi` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  KEY `id_daftar` (`id_daftar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_data_pribadi`
--

CREATE TABLE IF NOT EXISTS `tb_data_pribadi` (
  `nik` varchar(100) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `ttl` varchar(50) DEFAULT NULL,
  `jk` varchar(1) DEFAULT NULL,
  `darah` varchar(2) DEFAULT NULL,
  `agama` varchar(20) DEFAULT NULL,
  `nikah` varchar(20) DEFAULT NULL,
  `alamat` text,
  `kota` varchar(100) DEFAULT NULL,
  `pos` int(11) DEFAULT NULL,
  `telp` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `biaya` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dosen`
--

CREATE TABLE IF NOT EXISTS `tb_dosen` (
  `id_dosen` int(11) NOT NULL AUTO_INCREMENT,
  `id_prodi` int(11) NOT NULL,
  `img` text NOT NULL,
  `nama` text NOT NULL,
  `slug` text NOT NULL,
  `alamat` text NOT NULL,
  `telp` int(11) NOT NULL,
  `email` text,
  `fokus` text NOT NULL,
  `sekolah` text,
  `pelatihan` text,
  `jurnal` text,
  `organisasi` text,
  `staf` enum('1','2') NOT NULL,
  PRIMARY KEY (`id_dosen`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gallery`
--

CREATE TABLE IF NOT EXISTS `tb_gallery` (
  `id_gallery` int(4) NOT NULL AUTO_INCREMENT,
  `id_category` int(3) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `clean_url` varchar(500) NOT NULL,
  PRIMARY KEY (`id_gallery`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gallery_category`
--

CREATE TABLE IF NOT EXISTS `tb_gallery_category` (
  `id_category` int(3) NOT NULL AUTO_INCREMENT,
  `name_category` varchar(200) NOT NULL,
  `clean_url` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_header`
--

CREATE TABLE IF NOT EXISTS `tb_header` (
  `id_header` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `slug` text NOT NULL,
  `image` text NOT NULL,
  `keterangan` text NOT NULL,
  `publish` enum('y','n') NOT NULL,
  PRIMARY KEY (`id_header`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_info_akademik`
--

CREATE TABLE IF NOT EXISTS `tb_info_akademik` (
  `id_info` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `slug` text NOT NULL,
  `content` text NOT NULL,
  `publish` enum('y','n') NOT NULL,
  `date` date NOT NULL,
  `view` int(11) NOT NULL,
  PRIMARY KEY (`id_info`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_konsentrasi`
--

CREATE TABLE IF NOT EXISTS `tb_konsentrasi` (
  `id_konsentrasi` int(3) NOT NULL AUTO_INCREMENT,
  `id_prodi` int(3) NOT NULL,
  `konsentrasi` varchar(200) NOT NULL,
  `keterangan_konsentrasi` text NOT NULL,
  PRIMARY KEY (`id_konsentrasi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kontak`
--

CREATE TABLE IF NOT EXISTS `tb_kontak` (
  `id_kontak` int(4) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `kodepos` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `twitter` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_matakuliah`
--

CREATE TABLE IF NOT EXISTS `tb_matakuliah` (
  `id_matakuliah` int(5) NOT NULL AUTO_INCREMENT,
  `id_konsentrasi` int(3) NOT NULL,
  `matakuliah` varchar(100) NOT NULL,
  `keterangan_matakuliah` text NOT NULL,
  PRIMARY KEY (`id_matakuliah`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_news`
--

CREATE TABLE IF NOT EXISTS `tb_news` (
  `id_news` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `id_admin` int(4) NOT NULL,
  `publish` enum('y','n') NOT NULL,
  `view` int(4) NOT NULL,
  `clean_url` varchar(200) NOT NULL,
  PRIMARY KEY (`id_news`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pekerjaan`
--

CREATE TABLE IF NOT EXISTS `tb_pekerjaan` (
  `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(100) NOT NULL,
  `jenis` varchar(20) DEFAULT NULL,
  `instansi` varchar(100) DEFAULT NULL,
  `nip` int(11) DEFAULT NULL,
  `pangkat` varchar(50) DEFAULT NULL,
  `alamat_k` text,
  `kota_k` varchar(50) DEFAULT NULL,
  `pos_k` int(11) DEFAULT NULL,
  `telp_k` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pekerjaan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pendidikan`
--

CREATE TABLE IF NOT EXISTS `tb_pendidikan` (
  `id_pendidikan` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(100) NOT NULL,
  `jenjang` varchar(10) DEFAULT NULL,
  `nama_pt` varchar(100) DEFAULT NULL,
  `program` text,
  `alamat_pt` text,
  `masuk` year(4) DEFAULT NULL,
  `lulus` year(4) DEFAULT NULL,
  `ipk` int(11) DEFAULT NULL,
  `ipkun` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `gelar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pendidikan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_prodi`
--

CREATE TABLE IF NOT EXISTS `tb_prodi` (
  `id_prodi` int(3) NOT NULL AUTO_INCREMENT,
  `jenjang` text NOT NULL,
  `prodi` varchar(200) NOT NULL,
  `keterangan_prodi` text NOT NULL,
  `kurikulum` text NOT NULL,
  `reg` text,
  `syarat` text,
  PRIMARY KEY (`id_prodi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_profil`
--

CREATE TABLE IF NOT EXISTS `tb_profil` (
  `id_profil` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `clean_url` varchar(200) NOT NULL,
  PRIMARY KEY (`id_profil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_promosi`
--

CREATE TABLE IF NOT EXISTS `tb_promosi` (
  `id_promosi` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `image` text NOT NULL,
  `slug` text NOT NULL,
  PRIMARY KEY (`id_promosi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_publikasi`
--

CREATE TABLE IF NOT EXISTS `tb_publikasi` (
  `id_publikasi` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(100) NOT NULL,
  `penelitian` text,
  `ilmiah` text,
  PRIMARY KEY (`id_publikasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_upload`
--

CREATE TABLE IF NOT EXISTS `tb_upload` (
  `id_upload` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `foot` enum('y','n') NOT NULL,
  PRIMARY KEY (`id_upload`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
