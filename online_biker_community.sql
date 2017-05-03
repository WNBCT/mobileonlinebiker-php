-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2017 at 04:27 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_biker_community`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blog_id` int(10) UNSIGNED NOT NULL,
  `blog_title` varchar(150) DEFAULT NULL,
  `blog_description` text,
  `blog_status` enum('on','off') DEFAULT 'off',
  `blog_image` varchar(150) DEFAULT NULL,
  `blog_public` datetime DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog_id`, `blog_title`, `blog_description`, `blog_status`, `blog_image`, `blog_public`, `user_id`) VALUES
(1061, 'การดูแลรักษารถมอเตอร์ไซต์', 'การดูแลรักษารถจักรยานยนต์ของคุณอย่างสม่ำเสมอ ช่วยให้รถของคุณมีสมรรถนะสูงสุด และคุณจะเพลิดเพลินกับการขับขี่อย่างปลอดภัยและไร้ปัญหารบกวน การดูแลเบื้องต้นโดยส่วนใหญ่ทำได้ง่ายด้วยตัวคุณเอง:', 'off', 'img/mobile_01.jpeg', '2016-12-21 00:00:00', 255900005),
(1063, 'เทคนิคการเข้าโค้งที่ถูกต้อง แบบ Lean-out (ลีน เอ้าท์)', 'การเข้าโค้งแบบนี้ผู้ขับขี่จะถ่วงน้ำหนักตัวค่อนไปทางด้านนอกโค้ง โดยตัวรถจะเอียงเข้าไปด้านในโค้งเล็กน้อย ซึ่งจะเหมาะสำหรับสภาพผิวทางโค้งที่สามารถลื่นไถลได้ง่าย การเข้าโค้งในลักษณะ Lean-out นี้จึงพบมากในการขับขี่รถมอเตอร์ไซค์วิบาก เนื่องจากสามารถควบคุมรถแม้เมื่อเกิดการลื่นไถลต่างๆ ได้ดี', 'off', 'http://s1.boxzaracing.com/news/05/u4/1441105843.jpg', NULL, 255900005),
(1064, 'เทคนิคการเข้าโค้งที่ถูกต้อง แบบ Lean-With (ลีน วิท)', 'การเข้าโค้งในลักษณะนี้ เรียกได้ว่าผู้ขับขี่นั้นจะเป็นอันหนึ่งอันเดียวกันกับตัวรถเลยก็คงจะไม่ผิด กล่าวคือทั้งรถและผู้ขับขี่จะเอียงไปเท่าๆ กัน ซึ่งเหมาะสำหรับการใช้งานปกติเพราะผู้ขับขี่สามารถเปลี่ยนทิศทางและควบคุมรถได้อย่างง่ายดาย โดยที่มือและเท้ายังคงทำงานได้อย่างสะดวก เป็นท่าทางการเข้าโค้งแบบมาตรฐานของการขับขี่รถจักรยานยนต์ทุกประเภท ที่จะช่วยให้เรามีความปลอดภัยในชีวิตประจำวันมากยิ่งขึ้นนั่นเองครับ', 'off', 'http://s1.boxzaracing.com/news/05/u4/1441105972.jpg', NULL, 255900005),
(1065, 'เทคนิคการเข้าโค้งที่ถูกต้อง แบบ Lean-In (ลีน อิน)', 'การเข้าโค้งแบบนี้ทางด้านผู้ขับขี่จะต้องถ่วงน้ำหนักไปทางด้านในโค้ง โดยเอียงมากกว่าตัวรถเล็กน้อย เหมาะสำหรับการเข้าโค้งที่ต้องการความเร็วและมั่นใจในการยึดเกาะของรถได้ การเข้าโค้งแบบนี้จะให้ความคล่องตัวในการบังคับควบคุมน้อยกว่าแบบ Lean-with', 'off', 'http://s1.boxzaracing.com/news/05/u4/1441106050.jpg', NULL, 255900005),
(1066, 'เทคนิคการเข้าโค้งที่ถูกต้อง แบบ Hang-on (แฮงค์ ออน)', 'การเข้าโค้งแบบนี้ผู้ขับขี่จะถ่วงน้ำหนักตัวไปด้านในโค้งมาก จนอยู่ในลักษณะแบบที่เราเรียกกันว่า "โหนรถ" เพื่อการทรงตัวที่ต้องบาล้านซ์กับแรงเหวี่ยงมากๆ จากการเข้าโค้งด้วยความเร็วสูง การเข้าโค้งแบบนี้ผู้ขับขี่จะสามารถควบคุมรถได้ค่อนข้างยาก ไม่เหมาะเป็นอย่างยิ่งสำหรับการใช้งานปกติ เพราะส่วนมากแล้วจะใช้การแบนโค้งในลักษณะนี้เฉพาะในสนามแข่งทางเรียบเท่านั้น', 'off', 'http://s1.boxzaracing.com/news/05/u4/1441106454.jpg', NULL, 255900005),
(1068, 'น้ำมันเครื่องรถมอเตอร์ไซ์ 4 จังหวะที่ดี ควรมีคุณสมบัติอย่างไร', '- หล่อลื่นชิ้นส่วนต่างๆ ของเครื่องยนต์ ลดแรงเสียดทาน และป้องกันการสึกหรอ\r\n\r\n- ช่วยระบายความร้อนให้เครื่องยนต์\r\n\r\n- ชะล้างสิ่งสกปรกที่เกิดจากการเผาไหม้ และทำความสะอาดชิ้นส่วนต่างๆ ภายในเครื่องยนต์\r\n\r\n- ช่วยในการรักษากำลังอัดของเครื่องยนต์\r\n\r\n- ป้องกันการเกิดสนิม และลดการกัดกร่อนชิ้นส่วนต่างๆ ในเครื่องยนต์\r\n\r\n- ความหนืด (Viscosity) ที่เหมาะสม และคงที่\r\n\r\n- สามารถยึดติดกับผิววัตถุได้ (Oiliness) ทำให้ลดแรงเสียดทาน และการสึกหรอ\r\n\r\n- ความเหนียวของฟิล์มสูง (Film) เพื่อป้องกันการสัมผัสของผิว\r\n\r\n- ไม่กัดกร่อนส่วนใดๆ ของเครื่องยนต์\r\n\r\n- จุดเยือกแข็งต่ำ (Low pour point) เพื่อให้น้ำมันเครื่องสามารถที่จะไหลได้ในอุณหภูมิต่ำ\r\n\r\n- ตัวน้ำมันเครื่องไม่เป็นเขม่า (Deposit) ได้ง่าย เมื่อรวมกับอากาศ น้ำ หรือน้ำมัน\r\n\r\n- สามารถทำความสะอาดเครื่องยนต์ได้ดี (Cleaning Ability)\r\n\r\n- สามารถขจัดสารอื่นๆ ภายในเครื่องยนต์ได้ (Dispersing Ability)\r\n\r\n- ไม่เป็นฟองได้ง่าย (Non Foaming Characteristic)\r\n\r\n- ไม่ทำปฏิกิริยา หรือระเบิดง่าย และไม่เป็นพิษ\r\n\r\n- ราคาไม่แพงเกิน คุ้มกับเงินที่จ่าย', 'off', 'http://s1.boxzaracing.com/news/0c/8y/n.jpg', '2016-12-21 19:02:55', 255900004);

-- --------------------------------------------------------

--
-- Table structure for table `blogs_users_symbol`
--

CREATE TABLE `blogs_users_symbol` (
  `blog_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `symbol` enum('star','heart','smile','like') DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `blogs_users_symbol`
--

INSERT INTO `blogs_users_symbol` (`blog_id`, `user_id`, `symbol`, `created_at`) VALUES
(1068, 255900004, NULL, '2016-12-21 19:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `blog_tag`
--

CREATE TABLE `blog_tag` (
  `blog_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(5) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_tag`
--

INSERT INTO `blog_tag` (`blog_id`, `tag_id`, `created_at`) VALUES
(1068, 102, '2016-12-21 19:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `comments_forum`
--

CREATE TABLE `comments_forum` (
  `forum_id` int(10) UNSIGNED NOT NULL,
  `cmm_id` int(5) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `comments` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `forum_id` int(10) UNSIGNED NOT NULL,
  `forum_title` varchar(100) NOT NULL,
  `forum_details` text,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `count_comment` int(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`forum_id`, `forum_title`, `forum_details`, `user_id`, `created_at`, `image`, `count_comment`) VALUES
(10005, 'ปรึกษาเรื่องน้ำมันเครื่องครับ', NULL, 255900004, '2016-12-19 00:00:00', NULL, 0),
(10009, 'ป้ายทะเบียนหล่นหาย ต้องทำอย่างไร', '-', 255900004, '2016-12-07 00:00:00', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `forums_users_symbol`
--

CREATE TABLE `forums_users_symbol` (
  `forum_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `symbol` enum('star','heart','smile','like') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum_tag`
--

CREATE TABLE `forum_tag` (
  `forum_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(5) UNSIGNED NOT NULL,
  `crated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(5) UNSIGNED NOT NULL,
  `tag_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`) VALUES
(101, 'กฏจราจร'),
(102, 'การดูแลรักษารถ'),
(103, 'เทคนิคการใช้รถใช้ถนน'),
(104, 'แนะนำสถานที่น่าเที่ยว'),
(105, 'รถบิ๊กไบค์ (Bigbike)'),
(106, 'รีวิว (Review)');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `unique_id` varchar(23) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `birthday` datetime DEFAULT NULL,
  `encrypted_password` varchar(256) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `permission` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `name`, `email`, `image`, `birthday`, `encrypted_password`, `salt`, `created_at`, `permission`) VALUES
(255900002, '58570c48bc7196.85403375', 'name 01', 'name01@gmail.com', '', NULL, '$2y$10$d7I1YCJeAMWIzLs2Jmw2qutazSAm8kKcFHsdHGtda4iizEVBxQl9G', '739d7a7a2e', '2016-12-19 05:23:04', 'user'),
(255900003, '58570c8c8e4073.39093201', 'name 02', 'name02@gmail.com', '', NULL, '$2y$10$3wdLLW83BTmawCTWrVNFfeCPjmv4VCK4vVHNP6wMksyhr5OLiHN5u', '3e348c673e', '2016-12-19 05:24:12', 'user'),
(255900004, '58571337186004.07918354', 'tis', 'tis@m.com', '', NULL, '$2y$10$O6uvaoNTFHA1GlYpiTjVtO5DpzTEgb91z4W8/X47kBM/RE.hu/6.i', 'aef9ee4333', '2016-12-19 05:52:39', 'user'),
(255900005, '585a15214d53a9.09179379', 'admin', 'admin@mail.com', '', NULL, '$2y$10$mSW.6DOQ0MuDq6s.pfrWhuAND5q3/rQZVi6QSdvHutUpV4nbB5Jt2', 'ae9bd02cf0', '2016-12-21 12:37:37', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `blogs_users_symbol`
--
ALTER TABLE `blogs_users_symbol`
  ADD PRIMARY KEY (`blog_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `blog_tag`
--
ALTER TABLE `blog_tag`
  ADD PRIMARY KEY (`blog_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `comments_forum`
--
ALTER TABLE `comments_forum`
  ADD PRIMARY KEY (`forum_id`,`cmm_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`forum_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `forums_users_symbol`
--
ALTER TABLE `forums_users_symbol`
  ADD PRIMARY KEY (`forum_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `forum_tag`
--
ALTER TABLE `forum_tag`
  ADD PRIMARY KEY (`forum_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1069;
--
-- AUTO_INCREMENT for table `forums`
--
ALTER TABLE `forums`
  MODIFY `forum_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10010;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255900006;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `foreign_blog_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE SET NULL;

--
-- Constraints for table `blogs_users_symbol`
--
ALTER TABLE `blogs_users_symbol`
  ADD CONSTRAINT `fk_blog_symbol_blog_id` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`blog_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_blog_symbol_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `blog_tag`
--
ALTER TABLE `blog_tag`
  ADD CONSTRAINT `fk_blog_id` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`blog_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE CASCADE;

--
-- Constraints for table `comments_forum`
--
ALTER TABLE `comments_forum`
  ADD CONSTRAINT `comments_forum_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `forums` (`forum_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_forum_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `forums`
--
ALTER TABLE `forums`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `forums_users_symbol`
--
ALTER TABLE `forums_users_symbol`
  ADD CONSTRAINT `forums_users_symbol_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `forums` (`forum_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forums_users_symbol_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION;

--
-- Constraints for table `forum_tag`
--
ALTER TABLE `forum_tag`
  ADD CONSTRAINT `forum_tag_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `forums` (`forum_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forum_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
