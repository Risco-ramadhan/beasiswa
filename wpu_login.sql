-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 25, 2023 at 07:21 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wpu_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `ID_Data` int(11) NOT NULL,
  `NIM` varchar(128) NOT NULL,
  `ID_Kriteria` int(128) NOT NULL,
  `Nilai` float NOT NULL,
  `K` float NOT NULL,
  `U` float NOT NULL,
  `Nilai_Kriteria_Akhir` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`ID_Data`, `NIM`, `ID_Kriteria`, `Nilai`, `K`, `U`, `Nilai_Kriteria_Akhir`) VALUES
(1, '2242110010', 1, 95, 95, 1, 0.3),
(2, '2242110010', 2, 52, 52, 0.647059, 0.0647059),
(3, '2242110010', 3, 80, 80, 0.8, 0.24),
(4, '2242110010', 4, 80, 80, 0.8, 0.12),
(5, '2242110010', 5, 85, 85, 1, 0.15),
(6, '2242114298', 1, 90, 90, 0.857143, 0.257143),
(7, '2242114298', 2, 64, 64, 1, 0.1),
(8, '2242114298', 3, 75, 75, 0.6, 0.18),
(9, '2242114298', 4, 75, 75, 0.6, 0.09),
(10, '2242114298', 5, 75, 75, 0.777778, 0.116667),
(11, '2242114228', 1, 85, 85, 0.714286, 0.214286),
(12, '2242114228', 2, 42, 42, 0.352941, 0.0352941),
(13, '2242114228', 3, 85, 85, 1, 0.3),
(14, '2242114228', 4, 85, 85, 1, 0.15),
(15, '2242114228', 5, 80, 80, 0.888889, 0.133333),
(16, '2242110102', 1, 85, 85, 0.714286, 0.214286),
(17, '2242110102', 2, 48, 48, 0.529412, 0.0529412),
(18, '2242110102', 3, 80, 80, 0.8, 0.24),
(19, '2242110102', 4, 80, 80, 0.8, 0.12),
(20, '2242110102', 5, 75, 75, 0.777778, 0.116667),
(21, '2242114217', 1, 77, 77, 0.485714, 0.145714),
(22, '2242114217', 2, 48, 48, 0.529412, 0.0529412),
(23, '2242114217', 3, 80, 80, 0.8, 0.24),
(24, '2242114217', 4, 80, 80, 0.8, 0.12),
(25, '2242114217', 5, 60, 60, 0.444444, 0.0666666),
(26, '2242114263', 1, 77, 77, 0.485714, 0.145714),
(27, '2242114263', 2, 30, 30, 0, 0),
(28, '2242114263', 3, 60, 60, 0, 0),
(29, '2242114263', 4, 60, 60, 0, 0),
(30, '2242114263', 5, 40, 40, 0, 0),
(31, '2242110006', 1, 75, 75, 0.428571, 0.128571),
(32, '2242110006', 2, 46, 46, 0.470588, 0.0470588),
(33, '2242110006', 3, 70, 70, 0.4, 0.12),
(34, '2242110006', 4, 70, 70, 0.4, 0.06),
(35, '2242110006', 5, 70, 70, 0.666667, 0.1),
(36, '2242110066', 1, 80, 80, 0.571429, 0.171429),
(37, '2242110066', 2, 48, 48, 0.529412, 0.0529412),
(38, '2242110066', 3, 80, 80, 0.8, 0.24),
(39, '2242110066', 4, 80, 80, 0.8, 0.12),
(40, '2242110066', 5, 70, 70, 0.666667, 0.1),
(41, '2242114234', 1, 80, 80, 0.571429, 0.171429),
(42, '2242114234', 2, 52, 52, 0.647059, 0.0647059),
(43, '2242114234', 3, 75, 75, 0.6, 0.18),
(44, '2242114234', 4, 75, 75, 0.6, 0.09),
(45, '2242114234', 5, 60, 60, 0.444444, 0.0666666),
(46, '2242110059', 1, 60, 60, 0, 0),
(47, '2242110059', 2, 46, 46, 0.470588, 0.0470588),
(48, '2242110059', 3, 60, 60, 0, 0),
(49, '2242110059', 4, 60, 60, 0, 0),
(50, '2242110059', 5, 60, 60, 0.444444, 0.0666666);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `ID_Kriteria` int(11) NOT NULL,
  `Nama_Kriteria` varchar(128) NOT NULL,
  `Bobot_Kriteria` int(11) NOT NULL,
  `Normalisasi_Kriteria` float NOT NULL,
  `Status` int(11) NOT NULL,
  `Nilai_Kriteria_1` float NOT NULL,
  `Nilai_Kriteria_2` float NOT NULL,
  `Nilai_Kriteria_3` float NOT NULL,
  `Nilai_Kriteria_4` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`ID_Kriteria`, `Nama_Kriteria`, `Bobot_Kriteria`, `Normalisasi_Kriteria`, `Status`, `Nilai_Kriteria_1`, `Nilai_Kriteria_2`, `Nilai_Kriteria_3`, `Nilai_Kriteria_4`) VALUES
(1, 'AIK', 30, 0.3, 1, 95, 90, 85, 80),
(2, 'TKAD', 10, 0.1, 1, 90, 85, 80, 70),
(3, 'hafalan', 30, 0.3, 1, 90, 85, 70, 60),
(4, 'Ibadah', 15, 0.15, 1, 90, 85, 80, 70),
(5, 'Kemuhammadiyahan', 15, 0.15, 1, 90, 80, 70, 60);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `NIM` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` varchar(128) NOT NULL,
  `Nilai_Akhir` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `NIM`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`, `Nilai_Akhir`) VALUES
(6, 'Riska Rahmawati', '2000018376', 'admin@gmail.com', 'default.jpg', '$2y$10$pRJwAa18HaNMh9eV7VIkdeFIG9t6awNCyVgrONwsa/stnBdaJ/fxy', 1, 1, '1683558218', 0),
(306, 'FATMA NAZHIIROTUNNAJA', '2242110010', '2242110010@gmail.com', 'default.jpg', '$2y$10$SkcrTlhXV.y2Mw/FJtfNwOzfuFhClSFct9CU.OShniGJ1g28kouxm', 2, 1, '1684905084', 0.874706),
(307, 'MUHAMMAD \'AMMAR KHADAFI', '2242114298', '2242114298@gmail.com', 'default.jpg', '$2y$10$.1jVcZPHgcCrJVMUdRoLIOrwESKEMP3KMVujnr9ujVJeqjuyrtFLK', 2, 1, '1684905084', 0.74381),
(308, 'NISSA DWI AL-FITRA', '2242114228', '2242114228@gmail.com', 'default.jpg', '$2y$10$O0OyssUGeUAot/6EpFEZLOBnIJDO49bdS729Lv./pI7NQUJoLTbGW', 2, 1, '1684905084', 0.832913),
(309, '\'ADN', '2242110102', '2242110102@gmail.com', 'default.jpg', '$2y$10$Np8JAl./6Nf3Zo68doAX6uPeMeCawanKGJ9Jo5X1hYKdp6vZyCrgm', 2, 1, '1684905084', 0.743894),
(310, 'NADIA ARINA NABILA SHOFA', '2242114217', '2242114217@gmail.com', 'default.jpg', '$2y$10$7eEF9qRefPmDVyylEF2fhOjqJj9mTwCt66BzqkEyCazKLOFcVT6x6', 2, 1, '1684905084', 0.625322),
(311, 'AZMA SAAD SAID', '2242114263', '2242114263@gmail.com', 'default.jpg', '$2y$10$IVVnkLOnNV4CrUHCnQwwRuw8aa.pgbNdNlAWDTLTMOGOQrbXNxNqu', 2, 1, '1684905084', 0.145714),
(312, 'TAZKIYATUN NAFS AZ ZAHRA', '2242110006', '2242110006@gmail.com', 'default.jpg', '$2y$10$Oalv7Wrln7a.A8/N98BMFuHIH.9OlAwUyL/uqIJOHXgHNVqXEREwS', 2, 1, '1684905084', 0.45563),
(313, 'BILQIES FATIHATUR RAHMAH', '2242110066', '2242110066@gmail.com', 'default.jpg', '$2y$10$1o8RUKzLO5WmylS2p7LV0eDUjPctvdlNQPp3wydj45e4evCUC0Zwi', 2, 1, '1684905084', 0.68437),
(314, 'GHOZI ZUFAR QUSHOYYI', '2242114234', '2242114234@gmail.com', 'default.jpg', '$2y$10$T6aDF2OTCyJxUMww8/cfMOiUFitwiFJqHwlwxHxFJevGetmlyT/m2', 2, 1, '1684905084', 0.572801),
(315, 'DYAH AYU RETNOWATI', '2242110059', '2242110059@gmail.com', 'default.jpg', '$2y$10$P1wjam73hnz6mOGMGBCht.BXWpXti2UMx8PCOesgdzRfNhC0iKO06', 2, 1, '1684905084', 0.113725);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'User', 'fas fa-fw fa-user', 1),
(4, 2, 'Input Data', 'User/input', 'fas fa-fw fa-user', 1),
(5, 1, 'Kriteria', 'admin/detaildata', 'fas fa-fw fa-keyboard', 1),
(6, 1, 'Penilaian', 'admin/hasilAkhir', 'fas fa-fw fa-file', 1),
(8, 1, 'Analisis', 'admin/analisis', 'fas fa-fw fa-solid fa-chart-line', 1),
(9, 1, 'User', 'admin/kelolauser', 'fas fa-fw fa-solid fa-user', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`ID_Data`),
  ADD KEY `NIM` (`NIM`),
  ADD KEY `ID_Kriteria` (`ID_Kriteria`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`ID_Kriteria`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `NIM` (`NIM`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `ID_Data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `ID_Kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=316;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data`
--
ALTER TABLE `data`
  ADD CONSTRAINT `data_ibfk_1` FOREIGN KEY (`ID_Kriteria`) REFERENCES `kriteria` (`ID_Kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
