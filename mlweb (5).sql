-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2022 at 05:38 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mlweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `ad_admin_data`
--

CREATE TABLE `ad_admin_data` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(16) NOT NULL,
  `admin_email` varchar(36) NOT NULL,
  `admin_pass` text NOT NULL,
  `admin_role` tinyint(4) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_last_login` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ad_admin_data`
--

INSERT INTO `ad_admin_data` (`admin_id`, `admin_name`, `admin_email`, `admin_pass`, `admin_role`, `date_created`, `date_last_login`) VALUES
(0, '', '', '', 0, 0, 0),
(1, 'superadmin', 'abi@maisonliving.id', '$2y$10$eDWep6Di.jUDxr0.Yh/7kuVwM69H/Pn5e6zD307zmYOkAFsuiLxbO', 1, 1644478809, 1644487757),
(2, 'Maria', 'maria@maisonliving.id', '$2y$10$hzBraj5/3SNPN3EXKWE5tufvc0D/n2Iw3Pio8pwP0/ioN4h8jQYvq', 1, 1644478809, 1646391888),
(3, 'Soni', 'soni@maisonliving.id', '$2y$10$N5yFumfPd675ia9Hhs4A7.U7C2rL8/AM85GH0wtBc0pTGXi8kDUJe', 1, 1644478809, 1649001657),
(4, 'Novita', 'novita@maisonliving.id', '$2y$10$hzBraj5/3SNPN3EXKWE5tufvc0D/n2Iw3Pio8pwP0/ioN4h8jQYvq', 1, 1644478809, 1644487598);

-- --------------------------------------------------------

--
-- Table structure for table `cd_cashier_data`
--

CREATE TABLE `cd_cashier_data` (
  `cas_id` int(11) NOT NULL,
  `cas_fullname` varchar(32) NOT NULL,
  `cas_email` varchar(32) NOT NULL,
  `cas_password` text NOT NULL,
  `store_id` tinyint(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_last_login` int(11) NOT NULL,
  `cas_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cd_cashier_data`
--

INSERT INTO `cd_cashier_data` (`cas_id`, `cas_fullname`, `cas_email`, `cas_password`, `store_id`, `date_created`, `date_last_login`, `cas_status`) VALUES
(1, 'Lova', 'lova@maisonliving.id', '$2y$10$z.hY1xXT0pm/L6WBF7vNguGpWlpwZ/0exVx6Pel2.drT0VehP5/eO', 2, 1620980379, 1649284436, 1),
(2, 'Shafira', 'shafira@maisonliving.id', '$2y$10$NfBcEUruvYOYR8XyQRkJB.I5zGnelo0LnyYYBO.MFDrxoYNaDiXhq', 1, 1620980379, 1644494087, 1),
(3, 'Abi', 'abi@maisonliving.id', '$2y$10$aQTua61Kh8a6jEq5DjIRC.esn7D0QehcCWuSM5h7zCulGxa8IDmCy', 1, 1620980379, 1649329654, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cd_customer_data`
--

CREATE TABLE `cd_customer_data` (
  `cus_id` int(11) NOT NULL,
  `cus_fullname` varchar(60) DEFAULT NULL,
  `cus_phone` varchar(14) NOT NULL,
  `cus_email` varchar(60) NOT NULL,
  `cus_hash` varchar(32) NOT NULL,
  `cus_pass` text NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_last_login` int(11) NOT NULL,
  `cus_status` tinyint(1) NOT NULL DEFAULT 0,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `is_profiled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cd_customer_data`
--

INSERT INTO `cd_customer_data` (`cus_id`, `cus_fullname`, `cus_phone`, `cus_email`, `cus_hash`, `cus_pass`, `date_created`, `date_last_login`, `cus_status`, `is_verified`, `is_profiled`) VALUES
(25, 'Abi Rahardian', '6281234567895', 'abi@maisonliving.id', 'a3cc382c8f25aeafcb94e3a8850bc215', '$2y$10$fJup7cW6irW.pZ6nQyUpzOMZAAA4c9KebMkbxyRK3th1Gw/xFPY8a', 1635767503, 1649328526, 1, 1, 1),
(45, NULL, '6281234568793', 'kantor.abirutama@gmail.com', 'ca436966721ab341622b3e540d1dbb5b', '$2y$10$gF.sly0mTxTPjBOWNkdqq.eZ.TJhpwzlwSID9JS4h0X5IuKnat5gO', 1649329543, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cp_customer_profile`
--

CREATE TABLE `cp_customer_profile` (
  `profile_id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `profile_first_name` varchar(16) NOT NULL,
  `profile_last_name` varchar(16) NOT NULL,
  `gender_id` tinyint(1) NOT NULL,
  `age_id` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_customer_profile`
--

INSERT INTO `cp_customer_profile` (`profile_id`, `cus_id`, `profile_first_name`, `profile_last_name`, `gender_id`, `age_id`) VALUES
(4, 25, 'Abi', 'Rahardian Utama', 2, 2),
(18, 45, 'Rahardian', 'Abi', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `master_age_group`
--

CREATE TABLE `master_age_group` (
  `age_id` tinyint(1) NOT NULL,
  `age_label` varchar(12) NOT NULL,
  `age_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_age_group`
--

INSERT INTO `master_age_group` (`age_id`, `age_label`, `age_status`) VALUES
(1, '18-24', 1),
(2, '25-34', 1),
(3, '35-44', 1),
(4, '45-54', 1),
(5, '55+', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_gender`
--

CREATE TABLE `master_gender` (
  `gender_id` tinyint(1) NOT NULL,
  `gender_label` varchar(12) NOT NULL,
  `gender_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_gender`
--

INSERT INTO `master_gender` (`gender_id`, `gender_label`, `gender_status`) VALUES
(1, 'Female', 1),
(2, 'Male', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ml_member_level`
--

CREATE TABLE `ml_member_level` (
  `ml_id` int(11) NOT NULL,
  `ml_grade` tinyint(1) NOT NULL,
  `ml_name` varchar(16) NOT NULL,
  `ml_range_min` double NOT NULL,
  `ml_range_max` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ml_member_level`
--

INSERT INTO `ml_member_level` (`ml_id`, `ml_grade`, `ml_name`, `ml_range_min`, `ml_range_max`) VALUES
(5, 1, 'Classic', 0, 9999999),
(6, 2, 'Silver', 10000000, 99999999),
(7, 3, 'Gold', 100000000, 299999999),
(8, 4, 'Platinum', 300000000, 749999999),
(9, 5, 'Diamond', 750000000, 1e30);

-- --------------------------------------------------------

--
-- Table structure for table `otp_request`
--

CREATE TABLE `otp_request` (
  `otp_id` int(11) NOT NULL,
  `otp_requestor` varchar(14) NOT NULL,
  `otp_code` varchar(4) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_expired` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `otp_request`
--

INSERT INTO `otp_request` (`otp_id`, `otp_requestor`, `otp_code`, `date_created`, `date_expired`) VALUES
(404, '6281234567890', '3151', 1649328373, 1649328673),
(405, '6281234568793', '7501', 1649329513, 1649329813);

-- --------------------------------------------------------

--
-- Table structure for table `ps_point_settings`
--

CREATE TABLE `ps_point_settings` (
  `ps_id` int(11) NOT NULL,
  `ps_point_name` varchar(16) NOT NULL,
  `ps_point_per` mediumint(9) NOT NULL,
  `ps_point_multiplier` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ps_point_settings`
--

INSERT INTO `ps_point_settings` (`ps_id`, `ps_point_name`, `ps_point_per`, `ps_point_multiplier`) VALUES
(0, 'M-Point', 1000000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pts_point`
--

CREATE TABLE `pts_point` (
  `pts_id` int(11) NOT NULL,
  `pts_nominal` double NOT NULL,
  `pts_type` tinyint(4) NOT NULL,
  `pts_note` varchar(25) NOT NULL,
  `pts_status` tinyint(1) NOT NULL DEFAULT 0,
  `trx_reff` varchar(18) NOT NULL,
  `cus_id` smallint(6) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_expired` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pts_point`
--

INSERT INTO `pts_point` (`pts_id`, `pts_nominal`, `pts_type`, `pts_note`, `pts_status`, `trx_reff`, `cus_id`, `date_created`, `date_expired`) VALUES
(130, 50, 0, 'Sign Up Bonus', 1, 'REG1648979417', 44, 1648979417, 1704041999),
(131, 15, 0, 'Transaksi Store', 0, 'ML16489980941', 44, 1648998094, 1704041999),
(132, 15, 0, 'Transaksi Store', 1, 'ML16490014671', 25, 1649001467, 1704041999),
(133, 23, 0, 'Transaksi Store', 0, 'ML16490017051', 25, 1649001705, 1704041999),
(134, 5, 1, 'Redeem Voucher', 1, 'MVOU16492854514', 44, 1649285451, 1704041999),
(135, 5, 0, 'Transaksi Store', 0, 'ML16492900741', 44, 1649290074, 1704041999),
(136, 5, 1, 'Redeem Voucher', 1, 'MVOU16493285362', 25, 1649328536, 1704041999),
(137, 5, 1, 'Redeem Voucher', 1, 'MVOU16493285409', 25, 1649328540, 1704041999),
(138, 50, 0, 'Sign Up Bonus', 1, 'REG1649329550', 45, 1649329550, 1704041999);

-- --------------------------------------------------------

--
-- Table structure for table `reset_password_cashier`
--

CREATE TABLE `reset_password_cashier` (
  `reset_id` int(11) NOT NULL,
  `cas_id` int(11) NOT NULL,
  `reset_token` text NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_expired` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reset_password_cashier`
--

INSERT INTO `reset_password_cashier` (`reset_id`, `cas_id`, `reset_token`, `date_created`, `date_expired`) VALUES
(8, 3, 'viNXsKb8pNPM', 1649326924, 1649327224),
(9, 3, 'YnAG3ZygGEp1', 1649327987, 1649328287),
(10, 3, 'W9XR3D9Otp7k', 1649329633, 1649329933);

-- --------------------------------------------------------

--
-- Table structure for table `reset_password_request`
--

CREATE TABLE `reset_password_request` (
  `reset_id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `reset_token` text NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_expired` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sd_store_data`
--

CREATE TABLE `sd_store_data` (
  `store_id` int(11) NOT NULL,
  `store_name` varchar(32) NOT NULL,
  `store_branch` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sd_store_data`
--

INSERT INTO `sd_store_data` (`store_id`, `store_name`, `store_branch`) VALUES
(1, 'Maison Kemang', 'Kemang'),
(2, 'Maison BSD', 'BSD');

-- --------------------------------------------------------

--
-- Table structure for table `trx_transaction`
--

CREATE TABLE `trx_transaction` (
  `trx_id` int(11) NOT NULL,
  `trx_reff` varchar(18) NOT NULL,
  `trx_nominal` double NOT NULL,
  `trx_note` varchar(40) NOT NULL,
  `trx_status` tinyint(4) NOT NULL,
  `store_id` tinyint(4) NOT NULL,
  `jurnal_id` varchar(32) NOT NULL,
  `cas_id` tinyint(4) NOT NULL DEFAULT 0,
  `cus_id` smallint(6) NOT NULL,
  `admin_id` tinyint(4) NOT NULL,
  `pts_multiplier` tinyint(4) NOT NULL DEFAULT 1,
  `date_created` int(11) NOT NULL,
  `date_approved` int(11) NOT NULL,
  `date_expired` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trx_transaction`
--

INSERT INTO `trx_transaction` (`trx_id`, `trx_reff`, `trx_nominal`, `trx_note`, `trx_status`, `store_id`, `jurnal_id`, `cas_id`, `cus_id`, `admin_id`, `pts_multiplier`, `date_created`, `date_approved`, `date_expired`) VALUES
(110, 'ML16489980941', 15000000, 'Transaksi Store', 0, 2, '8659', 1, 44, 0, 1, 1648998094, 0, 1704041999),
(111, 'ML16490014671', 15000000, 'Transaksi Store', 1, 2, '7859', 1, 25, 3, 1, 1649001467, 1649001859, 1704041999),
(112, 'ML16490017051', 23000000, 'Transaksi Store', 0, 2, '7859', 1, 25, 0, 1, 1649001705, 0, 1704041999),
(113, 'ML16492900741', 5000000, 'Transaksi Store', 0, 2, '7777', 1, 44, 0, 1, 1649290074, 0, 1704041999);

-- --------------------------------------------------------

--
-- Table structure for table `vou_voucher_user`
--

CREATE TABLE `vou_voucher_user` (
  `vou_id` int(11) NOT NULL,
  `vou_reff` varchar(16) NOT NULL,
  `vop_uniqueid` varchar(16) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_expired` int(11) NOT NULL,
  `date_used` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vou_voucher_user`
--

INSERT INTO `vou_voucher_user` (`vou_id`, `vou_reff`, `vop_uniqueid`, `cus_id`, `date_created`, `date_expired`, `date_used`) VALUES
(56, 'MVOU16493285362', 'MLV1641782237', 25, 1649328536, 1649933336, 0),
(57, 'MVOU16493285409', 'MLV1641782236', 25, 1649328540, 1649933340, 1649329701);

-- --------------------------------------------------------

--
-- Table structure for table `vp_voucher_program`
--

CREATE TABLE `vp_voucher_program` (
  `vop_id` int(11) NOT NULL,
  `vop_title` varchar(64) NOT NULL,
  `vop_uniqueid` varchar(16) NOT NULL,
  `vop_desc` tinytext NOT NULL,
  `vop_maxpuser` tinyint(4) NOT NULL,
  `vop_maxquota` tinyint(4) NOT NULL,
  `vop_image` varchar(64) NOT NULL,
  `vop_pointprice` decimal(10,0) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_start` int(11) NOT NULL,
  `date_end` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vp_voucher_program`
--

INSERT INTO `vp_voucher_program` (`vop_id`, `vop_title`, `vop_uniqueid`, `vop_desc`, `vop_maxpuser`, `vop_maxquota`, `vop_image`, `vop_pointprice`, `date_created`, `date_start`, `date_end`) VALUES
(2, 'Free 1 Unit Maiden Dining Chair', 'MLV1641782236', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas scelerisque faucibus mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus id vulputate augue, sed tempus lacus. Morbi odio ipsum, al', 1, 8, 'MLV1641782236.jpg', '5', 1641870540, 1642311760, 1659485416),
(3, 'Free 1 Unit Caren Barstool', 'MLV1641782237', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas scelerisque faucibus mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus id vulputate augue, sed tempus lacus. Morbi odio ipsum, al', 2, 5, 'MLV1641782237.jpg', '5', 1641870540, 1641975233, 1659485416),
(4, 'Free 1 Unit Chloe Barstool', 'MLV1641782238', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas scelerisque faucibus mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus id vulputate augue, sed tempus lacus. Morbi odio ipsum, al', 1, 4, 'MLV1641782238.jpg', '5', 1641870540, 1642484560, 1642657360),
(5, 'Free 1 Unit Crown Barstool', 'MLV1641782239', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas scelerisque faucibus mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus id vulputate augue, sed tempus lacus. Morbi odio ipsum, al', 1, 3, 'MLV1641782239.jpg', '5', 1641870540, 1642336960, 1642423360),
(6, 'Free 1 Unit Ellen Pendant', 'MLV1641782240', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas scelerisque faucibus mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus id vulputate augue, sed tempus lacus. Morbi odio ipsum, al', 1, 2, 'MLV1641782240.jpg', '5', 1641870540, 1641975233, 1642046497);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ad_admin_data`
--
ALTER TABLE `ad_admin_data`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cd_cashier_data`
--
ALTER TABLE `cd_cashier_data`
  ADD PRIMARY KEY (`cas_id`);

--
-- Indexes for table `cd_customer_data`
--
ALTER TABLE `cd_customer_data`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `cp_customer_profile`
--
ALTER TABLE `cp_customer_profile`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `master_age_group`
--
ALTER TABLE `master_age_group`
  ADD PRIMARY KEY (`age_id`);

--
-- Indexes for table `master_gender`
--
ALTER TABLE `master_gender`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `ml_member_level`
--
ALTER TABLE `ml_member_level`
  ADD PRIMARY KEY (`ml_id`);

--
-- Indexes for table `otp_request`
--
ALTER TABLE `otp_request`
  ADD PRIMARY KEY (`otp_id`);

--
-- Indexes for table `ps_point_settings`
--
ALTER TABLE `ps_point_settings`
  ADD PRIMARY KEY (`ps_id`);

--
-- Indexes for table `pts_point`
--
ALTER TABLE `pts_point`
  ADD PRIMARY KEY (`pts_id`),
  ADD UNIQUE KEY `trx_reff` (`trx_reff`);

--
-- Indexes for table `reset_password_cashier`
--
ALTER TABLE `reset_password_cashier`
  ADD PRIMARY KEY (`reset_id`);

--
-- Indexes for table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD PRIMARY KEY (`reset_id`);

--
-- Indexes for table `sd_store_data`
--
ALTER TABLE `sd_store_data`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `trx_transaction`
--
ALTER TABLE `trx_transaction`
  ADD PRIMARY KEY (`trx_id`);

--
-- Indexes for table `vou_voucher_user`
--
ALTER TABLE `vou_voucher_user`
  ADD PRIMARY KEY (`vou_id`),
  ADD KEY `vop_uniqueid` (`vop_uniqueid`);

--
-- Indexes for table `vp_voucher_program`
--
ALTER TABLE `vp_voucher_program`
  ADD PRIMARY KEY (`vop_id`),
  ADD KEY `vop_uniqueid` (`vop_uniqueid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ad_admin_data`
--
ALTER TABLE `ad_admin_data`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cd_cashier_data`
--
ALTER TABLE `cd_cashier_data`
  MODIFY `cas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cd_customer_data`
--
ALTER TABLE `cd_customer_data`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `cp_customer_profile`
--
ALTER TABLE `cp_customer_profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `master_age_group`
--
ALTER TABLE `master_age_group`
  MODIFY `age_id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `master_gender`
--
ALTER TABLE `master_gender`
  MODIFY `gender_id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ml_member_level`
--
ALTER TABLE `ml_member_level`
  MODIFY `ml_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `otp_request`
--
ALTER TABLE `otp_request`
  MODIFY `otp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=406;

--
-- AUTO_INCREMENT for table `pts_point`
--
ALTER TABLE `pts_point`
  MODIFY `pts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `reset_password_cashier`
--
ALTER TABLE `reset_password_cashier`
  MODIFY `reset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  MODIFY `reset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sd_store_data`
--
ALTER TABLE `sd_store_data`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trx_transaction`
--
ALTER TABLE `trx_transaction`
  MODIFY `trx_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `vou_voucher_user`
--
ALTER TABLE `vou_voucher_user`
  MODIFY `vou_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `vp_voucher_program`
--
ALTER TABLE `vp_voucher_program`
  MODIFY `vop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vou_voucher_user`
--
ALTER TABLE `vou_voucher_user`
  ADD CONSTRAINT `vou_voucher_user_ibfk_1` FOREIGN KEY (`vop_uniqueid`) REFERENCES `vp_voucher_program` (`vop_uniqueid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
