-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2023 at 08:55 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_arsip`
-- 

-- --------------------------------------------------------

--
-- Table structure for table `data_arsip`
--

CREATE TABLE `data_arsip` (
  `id` int(11) NOT NULL,
  `noarsip` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pencipta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit_pengolah` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `uraian` text COLLATE utf8_unicode_ci NOT NULL,
  `ket` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nobox` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `media` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_input` datetime NOT NULL DEFAULT current_timestamp(),
  `tgl_update` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `tgl_berakhir` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `data_arsip`
--

INSERT INTO `data_arsip` (`id`, `noarsip`, `pencipta`, `unit_pengolah`, `tanggal`, `uraian`, `ket`, `kode`, `jumlah`, `nobox`, `lokasi`, `media`, `file`, `tgl_input`, `tgl_update`, `username`, `status`, `tgl_berakhir`) VALUES
(2, '22/A2/HKP.01.01/2011', '5', '6', '2011-11-01', 'ARS kegiatan B .Keputusan Direksi mengenai Kebijakan Tata Kelola Kearsipan dalam lingkungan internal perusahaan. Mulai dari penciptaan, pengolahan hingga retensi', 'asli', '18', 1, 'B02003', '2', '5', 'KEPUTUSAN_DIREKSI_Keputusan_Direksi_Mengenai_Tata_Kelola_Arsip.pdf', '2017-11-10 02:39:50', '2022-08-02 08:47:38', 'admin', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `eksternal_dokumen`
--

CREATE TABLE `eksternal_dokumen` (
  `id` int(11) NOT NULL,
  `tgl_dokumen` date NOT NULL,
  `template` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `no_dokumen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_departemen` int(3) NOT NULL,
  `no_perijinan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nama_perijinan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_klien` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_terbit` datetime NOT NULL,
  `publish_by` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8_unicode_ci NOT NULL,
  `owner_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tim_terkait` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_berlaku` date NOT NULL,
  `tgl_update` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `tgl_reminder` datetime NOT NULL,
  `media` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `jumlah` int(11) NOT NULL,
  `file` text COLLATE utf8_unicode_ci NOT NULL,
  `is_status` int(1) NOT NULL,
  `is_share` int(1) NOT NULL DEFAULT 0,
  `no_urut` int(11) NOT NULL,
  `create_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `create_by` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `eksternal_dokumen`
--

INSERT INTO `eksternal_dokumen` (`id`, `tgl_dokumen`, `template`, `no_dokumen`, `id_departemen`, `no_perijinan`, `nama_perijinan`, `nama_klien`, `tgl_terbit`, `publish_by`, `deskripsi`, `owner_name`, `tim_terkait`, `tgl_berlaku`, `tgl_update`, `tgl_reminder`, `media`, `jumlah`, `file`, `is_status`, `is_share`, `no_urut`, `create_name`, `create_date`, `create_by`) VALUES
(1, '0000-00-00', '29', '001/PKS/DIKA-AFI/I/2022', 47, '', 'Perjanjian Penyediaan Jasa Tenaga Kerja Antara PT Atome Finance Indonesia dan PT Danamas Insan Kreasi Andalan', 'Atome Finance Indonesia', '2022-01-03 00:00:00', 'Legal', 'Labour Supply', 'Legal', 'Legal, BD', '2023-01-02', '2023-04-14 15:31:50', '2022-12-02 00:00:00', '1', 1, 'PKS_Atome_Finance_Indonesia_(AFI)_x_DIKA_compressed.pdf', 1, 0, 1, 'Legal', '2023-04-14 08:31:50', 'D8219484');

-- --------------------------------------------------------

--
-- Table structure for table `internal_dokumen`
--

CREATE TABLE `internal_dokumen` (
  `id` int(11) NOT NULL,
  `tgl_dokumen` date NOT NULL,
  `template` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `group_dokumen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_dokumen` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_departemen` int(3) NOT NULL,
  `nama_dokumen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner_dokumen` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `lokasi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `media` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_input` datetime NOT NULL DEFAULT current_timestamp(),
  `tgl_update` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_status` int(1) NOT NULL DEFAULT 1,
  `is_share` int(1) NOT NULL DEFAULT 0,
  `no_urut` int(11) NOT NULL,
  `tgl_terbit` datetime DEFAULT NULL,
  `tgl_berlaku` date DEFAULT NULL,
  `tgl_reminder` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `internal_dokumen`
--

INSERT INTO `internal_dokumen` (`id`, `tgl_dokumen`, `template`, `group_dokumen`, `no_dokumen`, `id_departemen`, `nama_dokumen`, `owner_dokumen`, `deskripsi`, `jumlah`, `lokasi`, `media`, `file`, `tgl_input`, `tgl_update`, `username`, `is_status`, `is_share`, `no_urut`, `tgl_terbit`, `tgl_berlaku`, `tgl_reminder`) VALUES
(1, '2022-11-23', '19', 'Peraturan Perusahaan-HKP.012323', '1/IM/OPS/XI/2022', 7, 'Anggaran Kabupaten', 'dsaaaa', 'adasdas', 1, '1', '1', 'ya_robbi39.pdf', '2022-11-09 14:06:37', NULL, 'ubai', 1, 0, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_action`
--

CREATE TABLE `master_action` (
  `id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_action`
--

INSERT INTO `master_action` (`id`, `action`) VALUES
(1, 'add group documents'),
(2, 'update group documents'),
(3, 'delete group documents'),
(4, 'add departemen'),
(5, 'update departemen'),
(6, 'delete departemen'),
(7, 'add lokasi penyimpanan'),
(8, 'update lokasi penyimpanan'),
(9, 'delete lokasi penyimpanan'),
(10, 'add media'),
(11, 'update media'),
(12, 'delete media'),
(13, 'add user'),
(14, 'update user'),
(15, 'delete user'),
(16, 'add tingkat akses'),
(17, 'update tingkat akses'),
(18, 'delete tingkat akses'),
(19, 'add template'),
(20, 'update template'),
(21, 'delete template'),
(22, 'add internal dokumen'),
(23, 'view internal dokumen'),
(24, 'print internal dokumen'),
(25, 'add eksternal dokumen'),
(26, 'view eksternal dokumen'),
(27, 'delete eksternal dokumen'),
(28, 'add perijinan'),
(29, 'view perijinan'),
(30, 'delete perijinan'),
(31, 'delete internal dokumen');

-- --------------------------------------------------------

--
-- Table structure for table `master_departemen`
--

CREATE TABLE `master_departemen` (
  `id` int(11) NOT NULL,
  `nama_departemen` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_departemen`
--

INSERT INTO `master_departemen` (`id`, `nama_departemen`) VALUES
(6, 'Finance'),
(4, 'GA'),
(8, 'Business Development'),
(7, 'IT Programmer'),
(10, 'Direksi'),
(30, 'Sales'),
(47, 'HRD'),
(49, 'Tech Recruiter'),
(52, 'Application Processing'),
(53, 'BCA'),
(54, 'Collection'),
(55, 'Flazz'),
(56, 'Indoartha'),
(57, 'IT Support'),
(58, 'Juara Coding'),
(59, 'KTA'),
(60, 'Mandiri Tunas Finance'),
(61, 'Merchant Delivery &amp; Survey'),
(62, 'MIS'),
(63, 'Operational'),
(64, 'Recruitment'),
(65, 'Sales Governance'),
(66, 'SDM'),
(67, 'TEKNISI EDC'),
(68, 'Telecollection'),
(69, 'Training'),
(70, 'Sisdur');

-- --------------------------------------------------------

--
-- Table structure for table `master_kode`
--

CREATE TABLE `master_kode` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `retensi` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_kode`
--

INSERT INTO `master_kode` (`id`, `kode`, `nama`, `retensi`) VALUES
(5, 'SDM.01', 'Rekrutmen Pegawai', 1),
(6, 'SDM.02', 'Mutasi Pegawai', 1),
(7, 'SDM.03', 'Pengembangan Pegawai', 1),
(8, 'SDM.04', 'Cuti Pegawai', 3),
(9, 'SDM.03.01', 'Pelatihan Pegawai', 1),
(10, 'SDM.03.02', 'Beasiswa Pegawai', 1),
(11, 'SDM.01.01', 'Pengangakatan Pegawai', 1),
(12, 'SDM.05', 'Pemberhentian Pegawai', 5),
(13, 'KEU.01', 'Rencana Anggaran', 10),
(14, 'KEU.02', 'Realisasi Anggaran Pegawai', 10),
(15, 'KEU.03', 'Realisasi Anggaran Umum dan Rumah Tangga', 10),
(16, 'HKP.012323', 'Peraturan Perusahaan', 2),
(17, 'HKP.011', 'Peraturan Direksi Perusahaan', 2),
(18, 'HKP.01.02', 'Keputusan Direksi Perusahaan', 1),
(19, 'HKP.02', 'Pengawasan Internal', 10),
(20, 'RND.01', 'Penelitian dan Pengembangan', 3),
(21, 'UMUM.01', 'Inventarisasi Barang Bergerak', 5),
(22, 'UMUM.02', 'Inventarisasi Barang Tidak Bergerak', 5);

-- --------------------------------------------------------

--
-- Table structure for table `master_lokasi`
--

CREATE TABLE `master_lokasi` (
  `id` int(11) NOT NULL,
  `nama_lokasi` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_lokasi`
--

INSERT INTO `master_lokasi` (`id`, `nama_lokasi`) VALUES
(1, 'Server');

-- --------------------------------------------------------

--
-- Table structure for table `master_media`
--

CREATE TABLE `master_media` (
  `id` int(11) NOT NULL,
  `nama_media` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_media`
--

INSERT INTO `master_media` (`id`, `nama_media`) VALUES
(1, 'Digital'),
(22, 'Hardcopy'),
(23, 'Softcopy');

-- --------------------------------------------------------

--
-- Table structure for table `master_pencipta`
--

CREATE TABLE `master_pencipta` (
  `id` int(11) NOT NULL,
  `nama_pencipta` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_pencipta`
--

INSERT INTO `master_pencipta` (`id`, `nama_pencipta`) VALUES
(5, 'Bidang Hukum dan Tata Laksana'),
(3, 'Bidang Kepegawaian'),
(6, 'Bidang Keuangan'),
(4, 'Bidang Pengadaan'),
(8, 'Bidang Produksi'),
(7, 'Bidang Umum dan Rumah Tangga');

-- --------------------------------------------------------

--
-- Table structure for table `master_pengolah`
--

CREATE TABLE `master_pengolah` (
  `id` int(11) NOT NULL,
  `nama_pengolah` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_pengolah`
--

INSERT INTO `master_pengolah` (`id`, `nama_pengolah`) VALUES
(1, 'Unit Arsip Teknologi Informasi'),
(4, 'Unit Arsip Sekretariat Hukum dan Tata Laksana'),
(2, 'Unit Arsip Kepegawaian'),
(5, 'Unit Arsip Pengadaan'),
(6, 'Unit Arsip Biro Umum dan Rumah Tangga'),
(3, 'Unit Kearsipan Pusat');

-- --------------------------------------------------------

--
-- Table structure for table `master_user`
--

CREATE TABLE `master_user` (
  `id` int(11) NOT NULL,
  `nik` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `departemen` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tingkat_akses` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nama_departemen` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_tingkat_akses` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tipe` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_user`
--

INSERT INTO `master_user` (`id`, `nik`, `nama`, `departemen`, `tingkat_akses`, `nama_departemen`, `nama_tingkat_akses`, `username`, `password`, `email`, `tipe`, `status`) VALUES
(1, 'D8180001', 'R. Bunga Veronica', '8', '8', 'Business Development', 'Manager', 'D8180001', '0cc175b9c0f1b6a831c399e269772661', 'rumondang.bunga@ptdika.com', 'user', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ref_akses_eksternal_dokumen`
--

CREATE TABLE `ref_akses_eksternal_dokumen` (
  `id` int(10) NOT NULL,
  `id_dokumen` int(10) NOT NULL,
  `departemen` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ref_akses_internal_dokumen`
--

CREATE TABLE `ref_akses_internal_dokumen` (
  `id` int(10) NOT NULL,
  `id_dokumen` int(10) NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `departemen` varchar(100) NOT NULL,
  `id_tingkat_akses` int(11) NOT NULL,
  `tingkat_akses` varchar(100) NOT NULL,
  `privilege` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ref_dokumen_tingkat_akses`
--

CREATE TABLE `ref_dokumen_tingkat_akses` (
  `id` int(10) NOT NULL,
  `id_dokumen` int(10) NOT NULL,
  `id_tingkat_akses` int(11) NOT NULL,
  `tingkat_akses` varchar(100) NOT NULL,
  `privilege` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ref_template_no_surat`
--

CREATE TABLE `ref_template_no_surat` (
  `id` int(10) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `nama_template` varchar(100) NOT NULL,
  `format_no_surat` varchar(100) NOT NULL,
  `departemen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ref_template_no_surat`
--

INSERT INTO `ref_template_no_surat` (`id`, `kategori`, `nama_template`, `format_no_surat`, `departemen`) VALUES
(18, 'internal', 'Motivasional', 'no_urut/IM/MP/bulan/tahun', 'BD');

-- --------------------------------------------------------

--
-- Table structure for table `ref_tingkat_akses`
--

CREATE TABLE `ref_tingkat_akses` (
  `id` int(11) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `akses` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_tingkat_akses`
--

INSERT INTO `ref_tingkat_akses` (`id`, `departemen`, `akses`) VALUES
(4, 'Business Development', 'Head'),
(8, 'Business Development', 'Manager'),
(12, 'GA', 'Supervisor'),
(14, 'GA', 'Staf'),
(15, 'Business Development', 'Supervisor'),
(17, 'Direksi', 'Presiden Direktur'),
(19, 'Direksi', 'Direktur'),
(22, 'Direksi', 'General Manager'),
(23, 'Finance', 'Manager'),
(24, 'HRD', 'Head'),
(25, 'HRD', 'Manager'),
(26, 'Direksi', 'Manager'),
(27, 'IT Programmer', 'Supervisor'),
(28, 'IT Programmer', 'Staf'),
(29, 'Sales', 'Business Sales Head'),
(44, 'IT Programmer', 'Manager'),
(45, 'Business Development', 'Staf'),
(46, 'Finance', 'Head'),
(47, 'Direksi', 'Kepala Direksi'),
(48, 'HRD', 'Supervisor'),
(49, 'Application Processing', 'Team Leader'),
(50, 'Application Processing', 'Supervisor'),
(51, 'Application Processing', 'Deputy Manager'),
(52, 'BCA', 'Supervisor'),
(53, 'Collection', 'Supervisor'),
(54, 'Flazz', 'Team Leader'),
(55, 'Flazz', 'Supervisor'),
(56, 'Flazz', 'Manager'),
(57, 'Indoartha', 'Supervisor'),
(58, 'IT Support', 'Supervisor'),
(59, 'Juara Coding', 'Head Of Bootcamp'),
(60, 'Juara Coding', 'Deputy Manager'),
(61, 'KTA', 'Supervisor'),
(62, 'Mandiri Tunas Finance', 'Supervisor'),
(63, 'Merchant Delivery &amp; Survey', 'Team Leader'),
(64, 'MIS', 'Manager'),
(65, 'MIS', 'Supervisor'),
(66, 'Operational', 'Head'),
(67, 'Recruitment', 'Supervisor'),
(68, 'Recruitment', 'Deputy Manager'),
(69, 'Recruitment', 'Team Leader'),
(70, 'Sales Governance', 'Supervisor'),
(71, 'SDM', 'Supervisor'),
(72, 'SDM', 'Deputy Manager'),
(73, 'SDM', 'Team Leader'),
(74, 'SDM', 'Staff'),
(75, 'TEKNISI EDC', 'Supervisor'),
(76, 'TEKNISI EDC', 'Team Leader'),
(77, 'Telecollection', 'Supervisor'),
(78, 'Training', 'Supervisor'),
(79, 'GA', 'Manager'),
(80, 'Finance', 'Supervisor'),
(81, 'Business Development', 'Deputy Manager'),
(82, 'Business Development', 'Team Leader'),
(83, 'Sisdur', 'Supervisor'),
(84, 'Sisdur', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `sirkulasi`
--

CREATE TABLE `sirkulasi` (
  `id` int(11) NOT NULL,
  `noarsip` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username_peminjam` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keperluan` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_pinjam` datetime NOT NULL,
  `tgl_haruskembali` datetime NOT NULL,
  `tgl_pengembalian` datetime DEFAULT NULL,
  `tgl_transaksi` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `log_id` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `action` varchar(100) NOT NULL,
  `from_url` varchar(256) NOT NULL,
  `from_ip` varchar(20) NOT NULL,
  `mac_address` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` varchar(128) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  `data` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_arsip`
--
ALTER TABLE `data_arsip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noarsip` (`noarsip`),
  ADD KEY `pencipta` (`pencipta`),
  ADD KEY `unit_pengolah` (`unit_pengolah`);
ALTER TABLE `data_arsip` ADD FULLTEXT KEY `uraian` (`uraian`);

--
-- Indexes for table `eksternal_dokumen`
--
ALTER TABLE `eksternal_dokumen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noarsip` (`no_perijinan`);
ALTER TABLE `eksternal_dokumen` ADD FULLTEXT KEY `uraian` (`publish_by`);

--
-- Indexes for table `internal_dokumen`
--
ALTER TABLE `internal_dokumen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noarsip` (`no_dokumen`);
ALTER TABLE `internal_dokumen` ADD FULLTEXT KEY `uraian` (`deskripsi`);

--
-- Indexes for table `master_action`
--
ALTER TABLE `master_action`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_departemen`
--
ALTER TABLE `master_departemen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_pencipta` (`nama_departemen`);

--
-- Indexes for table `master_kode`
--
ALTER TABLE `master_kode`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`),
  ADD KEY `nama` (`nama`);

--
-- Indexes for table `master_lokasi`
--
ALTER TABLE `master_lokasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_lokasi` (`nama_lokasi`);

--
-- Indexes for table `master_media`
--
ALTER TABLE `master_media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_media` (`nama_media`);

--
-- Indexes for table `master_pencipta`
--
ALTER TABLE `master_pencipta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_pencipta` (`nama_pencipta`);

--
-- Indexes for table `master_pengolah`
--
ALTER TABLE `master_pengolah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_pengolah` (`nama_pengolah`);

--
-- Indexes for table `master_user`
--
ALTER TABLE `master_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `ref_akses_eksternal_dokumen`
--
ALTER TABLE `ref_akses_eksternal_dokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_akses_internal_dokumen`
--
ALTER TABLE `ref_akses_internal_dokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_dokumen_tingkat_akses`
--
ALTER TABLE `ref_dokumen_tingkat_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_template_no_surat`
--
ALTER TABLE `ref_template_no_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_tingkat_akses`
--
ALTER TABLE `ref_tingkat_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sirkulasi`
--
ALTER TABLE `sirkulasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noarsip` (`noarsip`),
  ADD KEY `username_peminjam` (`username_peminjam`),
  ADD KEY `tgl_pinjam` (`tgl_pinjam`),
  ADD KEY `tgl_pengembalian` (`tgl_pengembalian`),
  ADD KEY `tgl_haruskembali` (`tgl_haruskembali`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_arsip`
--
ALTER TABLE `data_arsip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `eksternal_dokumen`
--
ALTER TABLE `eksternal_dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=431;

--
-- AUTO_INCREMENT for table `internal_dokumen`
--
ALTER TABLE `internal_dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `master_action`
--
ALTER TABLE `master_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `master_departemen`
--
ALTER TABLE `master_departemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `master_kode`
--
ALTER TABLE `master_kode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `master_lokasi`
--
ALTER TABLE `master_lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `master_media`
--
ALTER TABLE `master_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `master_pencipta`
--
ALTER TABLE `master_pencipta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `master_pengolah`
--
ALTER TABLE `master_pengolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `master_user`
--
ALTER TABLE `master_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `ref_akses_eksternal_dokumen`
--
ALTER TABLE `ref_akses_eksternal_dokumen`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ref_akses_internal_dokumen`
--
ALTER TABLE `ref_akses_internal_dokumen`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ref_dokumen_tingkat_akses`
--
ALTER TABLE `ref_dokumen_tingkat_akses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ref_template_no_surat`
--
ALTER TABLE `ref_template_no_surat`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `ref_tingkat_akses`
--
ALTER TABLE `ref_tingkat_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `sirkulasi`
--
ALTER TABLE `sirkulasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `log_id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
