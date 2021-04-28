-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 28, 2021 at 04:37 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rapor`
--

-- --------------------------------------------------------

--
-- Table structure for table `t00_siswa`
--

CREATE TABLE `t00_siswa` (
  `idsiswa` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Panggilan` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t00_siswa`
--

INSERT INTO `t00_siswa` (`idsiswa`, `Nama`, `Panggilan`) VALUES
(1, 'Anindita Alya Magfiroh', 'Dita'),
(2, 'Annisa Zahirotus S.', 'Annisa'),
(3, 'A. Risky Syarifunnazal', 'Kiki'),
(4, 'Aliya Noura K.', 'Lily'),
(5, 'Alifia Resya Putri Ramadhani', 'Rere');

--
-- Triggers `t00_siswa`
--
DELIMITER $$
CREATE TRIGGER `auto_insert_idsiswa` AFTER INSERT ON `t00_siswa` FOR EACH ROW BEGIN

insert into t30_absensi (idsiswa) values (new.idsiswa);
insert into t31_talent (idsiswa) values (new.idsiswa);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `t01_talent`
--

CREATE TABLE `t01_talent` (
  `idtalent` int(11) NOT NULL,
  `Talent` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t01_talent`
--

INSERT INTO `t01_talent` (`idtalent`, `Talent`) VALUES
(1, 'PRAMUKA'),
(2, 'TARI'),
(3, 'MEWARNA / TAHFIDZ'),
(4, 'PUBLIC SPEAKING');

-- --------------------------------------------------------

--
-- Table structure for table `t02_kelompok`
--

CREATE TABLE `t02_kelompok` (
  `idkelompok` int(11) NOT NULL,
  `Kelompok` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t02_kelompok`
--

INSERT INTO `t02_kelompok` (`idkelompok`, `Kelompok`) VALUES
(1, 'PAI'),
(2, 'UMUM'),
(3, 'MULOK');

-- --------------------------------------------------------

--
-- Table structure for table `t03_mapel`
--

CREATE TABLE `t03_mapel` (
  `idmapel` int(11) NOT NULL,
  `idkelompok` int(11) NOT NULL,
  `MataPelajaran` varchar(50) NOT NULL,
  `SKM` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t03_mapel`
--

INSERT INTO `t03_mapel` (`idmapel`, `idkelompok`, `MataPelajaran`, `SKM`) VALUES
(1, 1, 'Al Qur\'an Hadist', 'B+'),
(2, 1, 'Aqidah Akhlak', 'B+'),
(3, 1, 'Fiqih', 'B+'),
(4, 1, 'SKI', 'B+'),
(5, 2, 'Pendidikan Kewarganegaraan', 'B+'),
(6, 2, 'Bahasa Indonesia', 'B+'),
(7, 2, 'Bahasa Arab', 'B+'),
(8, 2, 'Matematika', 'B+'),
(9, 2, 'IPA', 'B+'),
(10, 2, 'IPS', 'B+'),
(11, 2, 'SBK', 'B+'),
(12, 2, 'Pendidikan Jasmani & Kesehatan', 'B+'),
(13, 3, 'Bahasa Jawa', 'B+'),
(14, 3, 'Bahasa Inggris', 'B+'),
(15, 3, 'TIK', 'B+'),
(16, 3, 'Aswaja', 'B+');

-- --------------------------------------------------------

--
-- Table structure for table `t04_wsheet`
--

CREATE TABLE `t04_wsheet` (
  `idwsheet` int(11) NOT NULL,
  `idmapel` int(11) NOT NULL,
  `NoUrut` int(11) NOT NULL,
  `Kdasar` text NOT NULL,
  `induk` int(11) NOT NULL,
  `urut` varchar(6) NOT NULL,
  `SiswaNilai` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t04_wsheet`
--

INSERT INTO `t04_wsheet` (`idwsheet`, `idmapel`, `NoUrut`, `Kdasar`, `induk`, `urut`, `SiswaNilai`) VALUES
(1, 1, 1, 'Mengetahui urutan ayat QS. al-Humazah (104), at-Takâtsur (102), dan az-Zalzalah (99)', 0, '010100', 'a:5:{i:0;a:2:{s:5:\"Siswa\";s:4:\"Dita\";s:5:\"Nilai\";s:0:\"\";}i:1;a:2:{s:5:\"Siswa\";s:6:\"Annisa\";s:5:\"Nilai\";s:0:\"\";}i:2;a:2:{s:5:\"Siswa\";s:4:\"Kiki\";s:5:\"Nilai\";s:0:\"\";}i:3;a:2:{s:5:\"Siswa\";s:4:\"Lily\";s:5:\"Nilai\";s:0:\"\";}i:4;a:2:{s:5:\"Siswa\";s:4:\"Rere\";s:5:\"Nilai\";s:0:\"\";}}'),
(2, 1, 1, 'Mengetahui urutan surat al- humazah dengan baik dan benar', 1, '010101', 'a:5:{i:0;a:2:{s:5:\"Siswa\";s:4:\"Dita\";s:5:\"Nilai\";s:2:\"75\";}i:1;a:2:{s:5:\"Siswa\";s:6:\"Annisa\";s:5:\"Nilai\";s:3:\"100\";}i:2;a:2:{s:5:\"Siswa\";s:4:\"Kiki\";s:5:\"Nilai\";s:3:\"100\";}i:3;a:2:{s:5:\"Siswa\";s:4:\"Lily\";s:5:\"Nilai\";s:0:\"\";}i:4;a:2:{s:5:\"Siswa\";s:4:\"Rere\";s:5:\"Nilai\";s:0:\"\";}}'),
(3, 1, 2, 'Mengetahui urutan surat at-takatsur  dengan baik dan benar', 1, '010102', 'a:5:{i:0;a:2:{s:5:\"Siswa\";s:4:\"Dita\";s:5:\"Nilai\";s:0:\"\";}i:1;a:2:{s:5:\"Siswa\";s:6:\"Annisa\";s:5:\"Nilai\";s:0:\"\";}i:2;a:2:{s:5:\"Siswa\";s:4:\"Kiki\";s:5:\"Nilai\";s:0:\"\";}i:3;a:2:{s:5:\"Siswa\";s:4:\"Lily\";s:5:\"Nilai\";s:0:\"\";}i:4;a:2:{s:5:\"Siswa\";s:4:\"Rere\";s:5:\"Nilai\";s:0:\"\";}}'),
(9, 1, 3, 'Mengetahui urutan surat al-zalzalah dengan baik dan benar', 1, '010103', 'a:5:{i:0;a:2:{s:5:\"Siswa\";s:4:\"Dita\";s:5:\"Nilai\";s:0:\"\";}i:1;a:2:{s:5:\"Siswa\";s:6:\"Annisa\";s:5:\"Nilai\";s:0:\"\";}i:2;a:2:{s:5:\"Siswa\";s:4:\"Kiki\";s:5:\"Nilai\";s:0:\"\";}i:3;a:2:{s:5:\"Siswa\";s:4:\"Lily\";s:5:\"Nilai\";s:0:\"\";}i:4;a:2:{s:5:\"Siswa\";s:4:\"Rere\";s:5:\"Nilai\";s:0:\"\";}}'),
(10, 1, 2, 'Menerjemahkan hadis tentang salat berjamaah riwayat Bukhari, Muslim, Tirmizi, Nasai, Ibnu Majah, dan Ahmad dari Ibnu Umar', 0, '010200', 'a:5:{i:0;a:2:{s:5:\"Siswa\";s:4:\"Dita\";s:5:\"Nilai\";s:0:\"\";}i:1;a:2:{s:5:\"Siswa\";s:6:\"Annisa\";s:5:\"Nilai\";s:0:\"\";}i:2;a:2:{s:5:\"Siswa\";s:4:\"Kiki\";s:5:\"Nilai\";s:0:\"\";}i:3;a:2:{s:5:\"Siswa\";s:4:\"Lily\";s:5:\"Nilai\";s:0:\"\";}i:4;a:2:{s:5:\"Siswa\";s:4:\"Rere\";s:5:\"Nilai\";s:0:\"\";}}'),
(11, 1, 1, 'Mengetahui arti hadits tentang sholat berjamaah dengan fasih dan benar.', 10, '010201', 'a:5:{i:0;a:2:{s:5:\"Siswa\";s:4:\"Dita\";s:5:\"Nilai\";s:0:\"\";}i:1;a:2:{s:5:\"Siswa\";s:6:\"Annisa\";s:5:\"Nilai\";s:0:\"\";}i:2;a:2:{s:5:\"Siswa\";s:4:\"Kiki\";s:5:\"Nilai\";s:0:\"\";}i:3;a:2:{s:5:\"Siswa\";s:4:\"Lily\";s:5:\"Nilai\";s:0:\"\";}i:4;a:2:{s:5:\"Siswa\";s:4:\"Rere\";s:5:\"Nilai\";s:0:\"\";}}'),
(12, 1, 3, 'Memahami isi kandungan hadits tentang salat berjamaah riwayat Bukhari, Muslim, Tirmizi, Nasai, Ibnu Majah, dan Ahmad dari Ibnu Umar', 0, '010300', 'a:5:{i:0;a:2:{s:5:\"Siswa\";s:4:\"Dita\";s:5:\"Nilai\";s:0:\"\";}i:1;a:2:{s:5:\"Siswa\";s:6:\"Annisa\";s:5:\"Nilai\";s:0:\"\";}i:2;a:2:{s:5:\"Siswa\";s:4:\"Kiki\";s:5:\"Nilai\";s:0:\"\";}i:3;a:2:{s:5:\"Siswa\";s:4:\"Lily\";s:5:\"Nilai\";s:0:\"\";}i:4;a:2:{s:5:\"Siswa\";s:4:\"Rere\";s:5:\"Nilai\";s:0:\"\";}}'),
(13, 1, 1, 'Menjelaskan kandungan hadits tentang keutamaan shalat berjamaah secara sederhana', 12, '010301', 'a:5:{i:0;a:2:{s:5:\"Siswa\";s:4:\"Dita\";s:5:\"Nilai\";s:0:\"\";}i:1;a:2:{s:5:\"Siswa\";s:6:\"Annisa\";s:5:\"Nilai\";s:0:\"\";}i:2;a:2:{s:5:\"Siswa\";s:4:\"Kiki\";s:5:\"Nilai\";s:0:\"\";}i:3;a:2:{s:5:\"Siswa\";s:4:\"Lily\";s:5:\"Nilai\";s:0:\"\";}i:4;a:2:{s:5:\"Siswa\";s:4:\"Rere\";s:5:\"Nilai\";s:0:\"\";}}'),
(14, 1, 4, 'Membaca QS. al-Humazah (104), at-Takâtsur (102), dan az-Zalzalah (99) secara benar dan fasih.', 0, '010400', 'a:5:{i:0;a:2:{s:5:\"Siswa\";s:4:\"Dita\";s:5:\"Nilai\";s:0:\"\";}i:1;a:2:{s:5:\"Siswa\";s:6:\"Annisa\";s:5:\"Nilai\";s:0:\"\";}i:2;a:2:{s:5:\"Siswa\";s:4:\"Kiki\";s:5:\"Nilai\";s:0:\"\";}i:3;a:2:{s:5:\"Siswa\";s:4:\"Lily\";s:5:\"Nilai\";s:0:\"\";}i:4;a:2:{s:5:\"Siswa\";s:4:\"Rere\";s:5:\"Nilai\";s:0:\"\";}}'),
(15, 1, 1, 'membaca surat al-humazah dengan benar dan  fasih', 14, '010401', 'a:5:{i:0;a:2:{s:5:\"Siswa\";s:4:\"Dita\";s:5:\"Nilai\";s:0:\"\";}i:1;a:2:{s:5:\"Siswa\";s:6:\"Annisa\";s:5:\"Nilai\";s:0:\"\";}i:2;a:2:{s:5:\"Siswa\";s:4:\"Kiki\";s:5:\"Nilai\";s:0:\"\";}i:3;a:2:{s:5:\"Siswa\";s:4:\"Lily\";s:5:\"Nilai\";s:0:\"\";}i:4;a:2:{s:5:\"Siswa\";s:4:\"Rere\";s:5:\"Nilai\";s:0:\"\";}}'),
(16, 1, 2, 'membaca surat at-takatsur dengan benar dan  fasih', 14, '010402', 'a:5:{i:0;a:2:{s:5:\"Siswa\";s:4:\"Dita\";s:5:\"Nilai\";s:0:\"\";}i:1;a:2:{s:5:\"Siswa\";s:6:\"Annisa\";s:5:\"Nilai\";s:0:\"\";}i:2;a:2:{s:5:\"Siswa\";s:4:\"Kiki\";s:5:\"Nilai\";s:0:\"\";}i:3;a:2:{s:5:\"Siswa\";s:4:\"Lily\";s:5:\"Nilai\";s:0:\"\";}i:4;a:2:{s:5:\"Siswa\";s:4:\"Rere\";s:5:\"Nilai\";s:0:\"\";}}'),
(17, 1, 3, 'membaca surat al-zalzalah  dengan benar dan  fasih', 14, '010403', 'a:5:{i:0;a:2:{s:5:\"Siswa\";s:4:\"Dita\";s:5:\"Nilai\";s:0:\"\";}i:1;a:2:{s:5:\"Siswa\";s:6:\"Annisa\";s:5:\"Nilai\";s:0:\"\";}i:2;a:2:{s:5:\"Siswa\";s:4:\"Kiki\";s:5:\"Nilai\";s:0:\"\";}i:3;a:2:{s:5:\"Siswa\";s:4:\"Lily\";s:5:\"Nilai\";s:0:\"\";}i:4;a:2:{s:5:\"Siswa\";s:4:\"Rere\";s:5:\"Nilai\";s:0:\"\";}}');

-- --------------------------------------------------------

--
-- Table structure for table `t30_absensi`
--

CREATE TABLE `t30_absensi` (
  `idabsensi` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `S` int(11) NOT NULL DEFAULT 0,
  `I` int(11) NOT NULL DEFAULT 0,
  `A` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t30_absensi`
--

INSERT INTO `t30_absensi` (`idabsensi`, `idsiswa`, `S`, `I`, `A`) VALUES
(1, 1, 0, 0, 0),
(2, 2, 0, 0, 0),
(3, 3, 0, 0, 0),
(4, 4, 0, 0, 0),
(5, 5, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t31_talent`
--

CREATE TABLE `t31_talent` (
  `idtalenttr` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `TalentNilai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t31_talent`
--

INSERT INTO `t31_talent` (`idtalenttr`, `idsiswa`, `TalentNilai`) VALUES
(1, 1, 'a:4:{i:0;a:2:{s:6:\"Talent\";s:7:\"PRAMUKA\";s:5:\"Nilai\";s:0:\"\";}i:1;a:2:{s:6:\"Talent\";s:4:\"TARI\";s:5:\"Nilai\";s:0:\"\";}i:2;a:2:{s:6:\"Talent\";s:17:\"MEWARNA / TAHFIDZ\";s:5:\"Nilai\";s:0:\"\";}i:3;a:2:{s:6:\"Talent\";s:15:\"PUBLIC SPEAKING\";s:5:\"Nilai\";s:0:\"\";}}'),
(2, 2, 'a:4:{i:0;a:2:{s:6:\"Talent\";s:7:\"PRAMUKA\";s:5:\"Nilai\";s:0:\"\";}i:1;a:2:{s:6:\"Talent\";s:4:\"TARI\";s:5:\"Nilai\";s:0:\"\";}i:2;a:2:{s:6:\"Talent\";s:17:\"MEWARNA / TAHFIDZ\";s:5:\"Nilai\";s:0:\"\";}i:3;a:2:{s:6:\"Talent\";s:15:\"PUBLIC SPEAKING\";s:5:\"Nilai\";s:0:\"\";}}'),
(3, 3, 'a:4:{i:0;a:2:{s:6:\"Talent\";s:7:\"PRAMUKA\";s:5:\"Nilai\";s:0:\"\";}i:1;a:2:{s:6:\"Talent\";s:4:\"TARI\";s:5:\"Nilai\";s:0:\"\";}i:2;a:2:{s:6:\"Talent\";s:17:\"MEWARNA / TAHFIDZ\";s:5:\"Nilai\";s:0:\"\";}i:3;a:2:{s:6:\"Talent\";s:15:\"PUBLIC SPEAKING\";s:5:\"Nilai\";s:0:\"\";}}'),
(4, 4, 'a:4:{i:0;a:2:{s:6:\"Talent\";s:7:\"PRAMUKA\";s:5:\"Nilai\";s:0:\"\";}i:1;a:2:{s:6:\"Talent\";s:4:\"TARI\";s:5:\"Nilai\";s:0:\"\";}i:2;a:2:{s:6:\"Talent\";s:17:\"MEWARNA / TAHFIDZ\";s:5:\"Nilai\";s:0:\"\";}i:3;a:2:{s:6:\"Talent\";s:15:\"PUBLIC SPEAKING\";s:5:\"Nilai\";s:0:\"\";}}'),
(5, 5, 'a:4:{i:0;a:2:{s:6:\"Talent\";s:7:\"PRAMUKA\";s:5:\"Nilai\";s:0:\"\";}i:1;a:2:{s:6:\"Talent\";s:4:\"TARI\";s:5:\"Nilai\";s:0:\"\";}i:2;a:2:{s:6:\"Talent\";s:17:\"MEWARNA / TAHFIDZ\";s:5:\"Nilai\";s:0:\"\";}i:3;a:2:{s:6:\"Talent\";s:15:\"PUBLIC SPEAKING\";s:5:\"Nilai\";s:0:\"\";}}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t00_siswa`
--
ALTER TABLE `t00_siswa`
  ADD PRIMARY KEY (`idsiswa`);

--
-- Indexes for table `t01_talent`
--
ALTER TABLE `t01_talent`
  ADD PRIMARY KEY (`idtalent`);

--
-- Indexes for table `t02_kelompok`
--
ALTER TABLE `t02_kelompok`
  ADD PRIMARY KEY (`idkelompok`);

--
-- Indexes for table `t03_mapel`
--
ALTER TABLE `t03_mapel`
  ADD PRIMARY KEY (`idmapel`);

--
-- Indexes for table `t04_wsheet`
--
ALTER TABLE `t04_wsheet`
  ADD PRIMARY KEY (`idwsheet`);

--
-- Indexes for table `t30_absensi`
--
ALTER TABLE `t30_absensi`
  ADD PRIMARY KEY (`idabsensi`),
  ADD UNIQUE KEY `idsiswa` (`idsiswa`);

--
-- Indexes for table `t31_talent`
--
ALTER TABLE `t31_talent`
  ADD PRIMARY KEY (`idtalenttr`),
  ADD UNIQUE KEY `idsiswa` (`idsiswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t00_siswa`
--
ALTER TABLE `t00_siswa`
  MODIFY `idsiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t01_talent`
--
ALTER TABLE `t01_talent`
  MODIFY `idtalent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t02_kelompok`
--
ALTER TABLE `t02_kelompok`
  MODIFY `idkelompok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t03_mapel`
--
ALTER TABLE `t03_mapel`
  MODIFY `idmapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `t04_wsheet`
--
ALTER TABLE `t04_wsheet`
  MODIFY `idwsheet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `t30_absensi`
--
ALTER TABLE `t30_absensi`
  MODIFY `idabsensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t31_talent`
--
ALTER TABLE `t31_talent`
  MODIFY `idtalenttr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t30_absensi`
--
ALTER TABLE `t30_absensi`
  ADD CONSTRAINT `t30_absensi_ibfk_1` FOREIGN KEY (`idsiswa`) REFERENCES `t00_siswa` (`idsiswa`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `t31_talent`
--
ALTER TABLE `t31_talent`
  ADD CONSTRAINT `t31_talent_ibfk_1` FOREIGN KEY (`idsiswa`) REFERENCES `t00_siswa` (`idsiswa`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
