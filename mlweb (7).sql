-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2022 at 03:44 AM
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
(3, 'Soni', 'soni@maisonliving.id', '$2y$10$N5yFumfPd675ia9Hhs4A7.U7C2rL8/AM85GH0wtBc0pTGXi8kDUJe', 1, 1644478809, 1658448108),
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
(1, 'Lova', 'lova@maisonliving.id', '$2y$10$z.hY1xXT0pm/L6WBF7vNguGpWlpwZ/0exVx6Pel2.drT0VehP5/eO', 2, 1620980379, 1652930847, 1),
(2, 'Shafira', 'shafira@maisonliving.id', '$2y$10$NfBcEUruvYOYR8XyQRkJB.I5zGnelo0LnyYYBO.MFDrxoYNaDiXhq', 1, 1620980379, 1644494087, 1),
(3, 'Abi', 'abirutama@gmail.com', '$2y$10$aQTua61Kh8a6jEq5DjIRC.esn7D0QehcCWuSM5h7zCulGxa8IDmCy', 1, 1620980379, 1658365927, 1);

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
  `is_profiled` tinyint(1) NOT NULL DEFAULT 0,
  `suspend_reason` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cd_customer_data`
--

INSERT INTO `cd_customer_data` (`cus_id`, `cus_fullname`, `cus_phone`, `cus_email`, `cus_hash`, `cus_pass`, `date_created`, `date_last_login`, `cus_status`, `is_verified`, `is_profiled`, `suspend_reason`) VALUES
(25, 'Abi Rahardian', '6281234567895', 'abi@maisonliving.id', 'a3cc382c8f25aeafcb94e3a8850bc215', '$2y$10$nB07haglj2ckuyQ309s/9.o1dVeuY97Tk9nC0tInUml/lSMPWlpmi', 1635767503, 1658367461, 2, 1, 1, 0),
(45, NULL, '6281234568793', 'kantor.abirutama@gmail.com', 'ca436966721ab341622b3e540d1dbb5b', '$2y$10$gF.sly0mTxTPjBOWNkdqq.eZ.TJhpwzlwSID9JS4h0X5IuKnat5gO', 1649329543, 1652890152, 1, 1, 1, 0),
(46, NULL, '6281234567896', 'recover.null@gmail.com', '214eec7b868615ee013dd05f172a56f2', '$2y$10$mKDzVsbnQ28zS678PFUDBePvHpJQNHDVQ3bwoYee4k/hzuGBxTaUa', 1651109324, 1652942426, 1, 1, 1, 2),
(47, NULL, '6281234567897', 'soni@maisonliving.id', 'db31fecc3b2f7f6671b92f37a52f5169', '$2y$10$SvN0r8iNaV1HmkmAX2SokeUTY9yuoRFOMpIvK1a6RhUSlvalf3VHm', 1651114385, 1651114812, 1, 1, 0, 0);

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
  `date_of_birth` date NOT NULL DEFAULT current_timestamp(),
  `celebrate_id` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_customer_profile`
--

INSERT INTO `cp_customer_profile` (`profile_id`, `cus_id`, `profile_first_name`, `profile_last_name`, `gender_id`, `date_of_birth`, `celebrate_id`) VALUES
(18, 45, 'Rahardian', 'Abi', 2, '2022-04-28', 0),
(19, 46, 'Abi', 'Abi', 2, '1995-12-12', 2),
(20, 25, 'Abi', 'R U', 2, '2022-04-30', 3);

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
-- Table structure for table `master_celebrate`
--

CREATE TABLE `master_celebrate` (
  `celebrate_id` tinyint(1) NOT NULL,
  `celebrate_label` varchar(36) NOT NULL,
  `celebrate_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_celebrate`
--

INSERT INTO `master_celebrate` (`celebrate_id`, `celebrate_label`, `celebrate_status`) VALUES
(1, 'Not Celebrate', 0),
(2, 'Chinese New Year', 1),
(3, 'Christmas', 1),
(4, 'Eid Al-Fitr / Ramadhan', 1),
(5, 'Nyepi', 1),
(6, 'Vesak', 1);

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
  `ml_range_max` double NOT NULL,
  `ml_color` varchar(7) NOT NULL,
  `ml_text` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ml_member_level`
--

INSERT INTO `ml_member_level` (`ml_id`, `ml_grade`, `ml_name`, `ml_range_min`, `ml_range_max`, `ml_color`, `ml_text`) VALUES
(5, 1, 'Classic', 0, 9999999, '#616858', '#ffffff'),
(6, 2, 'Silver', 10000000, 99999999, '#868686', '#ffffff'),
(7, 3, 'Gold', 100000000, 299999999, '#c7b38b', '#534019'),
(8, 4, 'Platinum', 300000000, 749999999, '#837e64', '#ffeabd'),
(9, 5, 'Diamond', 750000000, 1e30, '#3b3b3b', '#bebdc9');

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
(405, '6281234568793', '7501', 1649329513, 1649329813),
(406, '628123456789', '1283', 1650517117, 1650517417),
(407, '6281234567890', '2543', 1650517126, 1650517426),
(408, '6281234567890', '7302', 1650703049, 1650703349),
(409, '6281234567893', '8448', 1651073260, 1651073560),
(410, '6281234567896', '8237', 1651109311, 1651109611),
(411, '6281234567897', '3666', 1651114369, 1651114669),
(412, '6281234568797', '3003', 1651114749, 1651115049),
(413, '6281234567893', '4362', 1651969833, 1651970133),
(414, '6281234567893', '4609', 1652329445, 1652329745),
(415, '6281234568795', '6818', 1652339828, 1652340128),
(416, '6281234567893', '5992', 1652339836, 1652340136),
(417, '6281234567893', '2340', 1653641528, 1653641828),
(418, '6281234567893', '2471', 1657209735, 1657210035),
(419, '6281234567893', '6780', 1658367447, 1658367747),
(420, '6281325389241', '6384', 1658442626, 1658442926),
(421, '6281234567893', '2314', 1658453231, 1658453531),
(422, '6281325389241', '2960', 1658453246, 1658453546);

-- --------------------------------------------------------

--
-- Table structure for table `pa_post`
--

CREATE TABLE `pa_post` (
  `pa_id` int(11) NOT NULL,
  `pa_title` varchar(180) NOT NULL,
  `pa_slug` varchar(200) NOT NULL,
  `pa_category` varchar(64) NOT NULL,
  `pa_tag` varchar(64) NOT NULL,
  `pa_cover` varchar(64) NOT NULL,
  `pa_body` text NOT NULL,
  `pa_author` varchar(64) NOT NULL,
  `pa_status` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_publish` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pa_post`
--

INSERT INTO `pa_post` (`pa_id`, `pa_title`, `pa_slug`, `pa_category`, `pa_tag`, `pa_cover`, `pa_body`, `pa_author`, `pa_status`, `is_deleted`, `date_created`, `date_publish`) VALUES
(1, 'BABAKAGU', 'BABAKAGU', 'article', 'Sofa,Product', 'MLV1641782236.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>', 'Maison Living', 0, 1, 1657249923, 0),
(2, 'ACOMODEL', 'ACOMODEL', 'article', 'Sofa,Product', 'MLV1641782235.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>', 'Maison Living', 0, 1, 1657250032, 0),
(3, '5 Sofa Terbaik Buatan Jepang', 'asdfg', 'article', 'Sofa,Product', 'voucher_spc_ramadan.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>', 'Maison Living', 1, 0, 1657250109, 1657426440),
(4, '3 Sofa Buatan Italy', '3-sofa-buatan-italy', 'article', 'Sofa,Product', 'images.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>', 'Maison Living', 1, 0, 1657250227, 1657865940),
(5, 'CUSTOM MADE FURNITURE', 'custom-made-furniture', 'article', 'Sofa,Product', 'voucher_spc_ramadan.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>', 'Maison Living', 1, 0, 1657283573, 1657283640),
(6, 'Sejarah Brand Babakagu', 'sejarah-brand-babakagu', 'promotion', 'brand, article', 'MLV1641782235.jpg', '<h4><strong>The standard Lorem Ipsum passage, used since the 1500s</strong></h4><p>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</p><h4><strong>Section 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC</strong></h4><p>\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"</p>', 'Maison Living', 1, 0, 1657331586, 1657213200),
(7, 'Sejarah Maison Living', 'sejarah-maison-living', 'article', 'brand, article', 'MLV1641782235.jpg', '<h4>The standard Lorem Ipsum passage, used since the 1500s</h4><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><h4>Section 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC</h4><p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>', 'Maison Living', 1, 0, 1657331846, 1657245420);

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
(133, 23, 0, 'Transaksi Store', 1, 'ML16490017051', 25, 1649001705, 1704041999),
(134, 5, 1, 'Redeem Voucher', 1, 'MVOU16492854514', 44, 1649285451, 1704041999),
(135, 6, 0, 'Transaksi Store', 0, 'ML16492900741', 44, 1649290074, 1704041999),
(136, 5, 1, 'Redeem Voucher', 1, 'MVOU16493285362', 25, 1649328536, 1704041999),
(137, 5, 1, 'Redeem Voucher', 1, 'MVOU16493285409', 25, 1649328540, 1704041999),
(138, 50, 0, 'Sign Up Bonus', 1, 'REG1649329550', 45, 1649329550, 1704041999),
(139, 5, 1, 'Redeem Voucher', 1, 'MVOU16499092737', 25, 1649909273, 1704041999),
(140, 50, 0, 'Sign Up Bonus', 1, 'REG1651109448', 46, 1651109448, 1704041999),
(141, 50, 0, 'Sign Up Bonus', 1, 'REG1651114849', 25, 1651114849, 1704041999);

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
(10, 3, 'W9XR3D9Otp7k', 1649329633, 1649329933),
(11, 3, '58RytKD58q4h', 1654560413, 1654560713),
(12, 3, 'Qltf1o752nTq', 1654561161, 1654561461),
(13, 3, 'omxX6aSnwTht', 1654562657, 1654562957),
(14, 3, 'Qn0tEGamo5Qk', 1654760982, 1654761282),
(15, 3, '92i45gAl6w6k', 1654761433, 1654761733),
(16, 3, 'vS5jCJC8tKCb', 1658363363, 1658363663),
(17, 3, 'W7e0DskNeTz7', 1658363669, 1658363969),
(18, 3, 'bWSfMoJOK1BO', 1658364371, 1658364671),
(19, 3, '8STC35veoRV2', 1658365345, 1658365645);

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

--
-- Dumping data for table `reset_password_request`
--

INSERT INTO `reset_password_request` (`reset_id`, `cus_id`, `reset_token`, `date_created`, `date_expired`) VALUES
(24, 25, 'XjiDYQc0JjJG', 1649890979, 1649891279);

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
(110, 'ML16489980941', 15000000, 'Transaksi Store', 1, 2, '8659', 1, 45, 0, 1, 1648998094, 0, 1704041999),
(111, 'ML16490014671', 750000000, 'Transaksi Store', 1, 2, '7859', 1, 25, 3, 1, 1649001467, 0, 1704041999),
(112, 'ML16490017051', 40000000, 'Transaksi Store', 1, 2, '7858', 1, 25, 3, 1, 1649001705, 0, 1704041999),
(113, 'ML16492900741', 6000000, 'Transaksi Store', 0, 2, '7777', 1, 45, 0, 1, 1649290074, 0, 1704041999),
(114, 'ML16490017051', 23000000, 'Transaksi Store', 0, 2, '7860', 1, 25, 3, 1, 1652331700, 0, 1704041999);

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

-- --------------------------------------------------------

--
-- Table structure for table `vp_voucher_program`
--

CREATE TABLE `vp_voucher_program` (
  `vop_id` int(11) NOT NULL,
  `vop_title` varchar(64) NOT NULL,
  `vop_uniqueid` varchar(16) NOT NULL,
  `vop_desc` text NOT NULL,
  `vop_maxpuser` tinyint(4) NOT NULL,
  `vop_maxquota` tinyint(4) NOT NULL,
  `vop_image` varchar(64) NOT NULL,
  `vop_pointprice` decimal(10,0) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_start` int(11) NOT NULL,
  `date_end` int(11) NOT NULL,
  `vop_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vp_voucher_program`
--

INSERT INTO `vp_voucher_program` (`vop_id`, `vop_title`, `vop_uniqueid`, `vop_desc`, `vop_maxpuser`, `vop_maxquota`, `vop_image`, `vop_pointprice`, `date_created`, `date_start`, `date_end`, `vop_status`) VALUES
(24, 'Babakagu Collins', 'MLV1653645576', '<p>Redeem points to get a FREE Unit Babakagu Collins&nbsp;</p>', 1, 1, 'vop_babakagu_collins.png', '6250', 1653645576, 1654016400, 1672505940, 1),
(25, 'Baby Sofa', 'MLV1653645676', '<p>Redeem points to get a FREE Unit Baby Sofa</p>', 1, 1, 'vop_baby_sofa.png', '750', 1653645676, 1654016400, 1672505940, 1),
(26, 'NJP Vas Tetes', 'MLV1653645778', '<p>Redeem points to get a FREE Unit NJP Vas Tetes</p>', 1, 1, 'vop_njp_vas_tetes.png', '100', 1653645790, 1653411600, 1672505940, 1),
(27, 'Shella Dining Chair', 'MLV1653645906', '<p>Redeem points to get a FREE Unit Shella Dining Chair</p>', 1, 1, 'vop_shella_dining_chair.png', '700', 1653645906, 1653411600, 1640969940, 1),
(28, 'DB BK Vas Bunga', 'MLV1653645989', '<p>Redeem points to get a FREE Unit DB BK Vas Bunga</p>', 1, 1, 'vop_db_bk_vas_bunga.png', '100', 1653645989, 1653411600, 1672505940, 1),
(29, 'Talenan', 'MLV1653646043', '<p>Redeem points to get a FREE Unit Talenan</p>', 1, 1, 'vop_talenan.png', '110', 1653646051, 1653411600, 1672505940, 1);

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
-- Indexes for table `master_celebrate`
--
ALTER TABLE `master_celebrate`
  ADD PRIMARY KEY (`celebrate_id`);

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
-- Indexes for table `pa_post`
--
ALTER TABLE `pa_post`
  ADD PRIMARY KEY (`pa_id`);

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
  MODIFY `cas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cd_customer_data`
--
ALTER TABLE `cd_customer_data`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `cp_customer_profile`
--
ALTER TABLE `cp_customer_profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `master_age_group`
--
ALTER TABLE `master_age_group`
  MODIFY `age_id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `master_celebrate`
--
ALTER TABLE `master_celebrate`
  MODIFY `celebrate_id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

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
  MODIFY `otp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=423;

--
-- AUTO_INCREMENT for table `pa_post`
--
ALTER TABLE `pa_post`
  MODIFY `pa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pts_point`
--
ALTER TABLE `pts_point`
  MODIFY `pts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `reset_password_cashier`
--
ALTER TABLE `reset_password_cashier`
  MODIFY `reset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  MODIFY `reset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sd_store_data`
--
ALTER TABLE `sd_store_data`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trx_transaction`
--
ALTER TABLE `trx_transaction`
  MODIFY `trx_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `vou_voucher_user`
--
ALTER TABLE `vou_voucher_user`
  MODIFY `vou_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `vp_voucher_program`
--
ALTER TABLE `vp_voucher_program`
  MODIFY `vop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
