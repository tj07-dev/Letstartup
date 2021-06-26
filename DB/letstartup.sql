-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2021 at 01:32 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `letstartup`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(100) NOT NULL,
  `tag` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `tag`) VALUES
(1, 'Advertising'),
(2, 'Aeronautics/Aerospace'),
(3, 'Agriculture'),
(4, 'AI'),
(5, 'Analytics'),
(6, 'Animation'),
(7, 'AR/VR'),
(8, 'Architecture'),
(9, 'Art & Photography'),
(10, 'Automotive'),
(11, 'Beauty'),
(12, 'Bigdata'),
(13, 'Blockchain'),
(14, 'Career'),
(15, 'Communication'),
(16, 'Computer Vision'),
(17, 'Construction'),
(18, 'Consumer Goods'),
(19, 'Dating/Matrimonial'),
(20, 'Defence'),
(21, 'Design'),
(22, 'Education'),
(23, 'Energy & Sustainability'),
(24, 'Enterprise Software'),
(25, 'Events'),
(26, 'Fashion'),
(27, 'FinTech : Crowdfunding'),
(28, 'FinTech : Mobile Wallets/Payments'),
(29, 'FinTech: Trading'),
(30, 'FinTech : Foreign exchange'),
(31, 'FinTech : Accounting'),
(32, 'Food & Beverages'),
(33, 'Gaming'),
(34, 'Gifting'),
(35, 'Grocery'),
(36, 'Hardware'),
(37, 'Healthcare'),
(38, 'Human Resources'),
(39, 'Information Technology'),
(40, 'Internet of Things'),
(41, 'IT Services'),
(42, 'Legal'),
(43, 'Logistics'),
(44, 'Manufacturing'),
(45, 'Marketing'),
(46, 'Media & Entertainment'),
(47, 'Nanotechnology'),
(48, 'Networking'),
(49, 'Pets & Animals'),
(50, 'Printing'),
(51, 'Real Estate');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaint_id` int(11) NOT NULL,
  `complainee_id` varchar(100) NOT NULL,
  `date_of_complaint` varchar(100) NOT NULL,
  `complaint_subject` varchar(100) NOT NULL,
  `main_complaint` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`complaint_id`, `complainee_id`, `date_of_complaint`, `complaint_subject`, `main_complaint`) VALUES
(11, 'gpriyanshi1296@gmail.com', 'Tuesday 2021-06-08 15:01:40', 'Inappropiate post Post ID: 28 By: priyanshiguptait18@acropolis.in', 'Required Action To Report'),
(12, 'tarvgupta12@gmail.com', 'Saturday 2021-06-12 15:23:08', 'Inappropiate post Post ID: 30 By: priyanshiguptait18@acropolis.in', 'Required Action To Report');

-- --------------------------------------------------------

--
-- Table structure for table `fundraiser`
--

CREATE TABLE `fundraiser` (
  `fundraiser_email_id` varchar(100) NOT NULL,
  `linked_in` varchar(100) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `address` varchar(200) NOT NULL,
  `gender` varchar(4) DEFAULT NULL,
  `profile_pic` varchar(500) NOT NULL DEFAULT 'DEFAULT.PNG',
  `DOB` varchar(100) NOT NULL,
  `password` longtext NOT NULL,
  `id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fundraiser`
--

INSERT INTO `fundraiser` (`fundraiser_email_id`, `linked_in`, `name`, `phone`, `address`, `gender`, `profile_pic`, `DOB`, `password`, `id`) VALUES
('priyanshiguptait18@acropolis.in', 'https://linked.in/in/priyanshi', 'Priyanshi Gupta', '6235656896', 'Indore', 'F', '60c4a20b6030b0.87686243.jpg', '2000-09-16', '$2y$10$EdAwtuu5hwlYz3nCkc7hwOFadkZJTh9IzPROVXf6/7MdArqCXWVJ.', 13),
('sakshigoyalit18@acropolis.in', 'https://linked.in/in/sakshi', 'Sakshi Goyal', '6235656896', 'Indore', 'F', '60c4c65e34bac7.40046520.jpg', '2021-06-12', '$2y$10$Zja/qZjIuiTiOUtxK2pODOMQPn9xeRLEdvUstLvDFtYXJ9s2WxKJy', 15),
('tanmayjainit18@acropolis.in', 'https://linked.in/in/tanmay07', 'Tanmay Jain', '6935689745', 'Indore', 'M', '60c4aaad1f6766.26567105.jpg', '2000-01-07', '$2y$10$ZbTXwK.pRsyU/8ZmV/ocP.65j6V2LyqTkmXt2FyOqKpWX1OFFwolS', 16),
('tarvgupta12@gmail.com', 'https://linked.in/in/tarv', 'Tarv gupta', '6235656896', 'Indore', 'M', '60c4b38abd7713.76256205.jpg', '2018-06-12', '$2y$10$6RlmUHSdnxGQxwKdfTYYgem3fsMUrgFT.5SCv6X1ZLBIclDDqtKoG', 14),
('vikashsinghit18@acropolis.in', 'https://linked.in/in/Vikash', 'Vikash singh', '6235656896', 'Indore', 'M', '60c5e7c70b4197.14053060.jpg', '2021-06-03', '$2y$10$hy0oclrLNQmyjdGXoh0REuEMJMHo19aWR0caZtoPNT1Z7XspD3Kim', 17);

-- --------------------------------------------------------

--
-- Table structure for table `f_intrested`
--

CREATE TABLE `f_intrested` (
  `id` int(100) NOT NULL,
  `post_id` int(100) NOT NULL,
  `fundraiser_e_id` varchar(100) NOT NULL,
  `visited` varchar(10) DEFAULT 'not'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `f_intrested`
--

INSERT INTO `f_intrested` (`id`, `post_id`, `fundraiser_e_id`, `visited`) VALUES
(6, 32, 'tarvgupta12@gmail.com', 'not'),
(7, 30, 'tarvgupta12@gmail.com', 'not'),
(8, 32, 'priyanshiguptait18@acropolis.in', 'not'),
(9, 33, 'priyanshiguptait18@acropolis.in', 'not'),
(10, 30, 'sakshigoyalit18@acropolis.in', 'true'),
(11, 30, 'tanmayjainit18@acropolis.in', 'not'),
(12, 30, 'vikashsinghit18@acropolis.in', 'not');

-- --------------------------------------------------------

--
-- Table structure for table `investor`
--

CREATE TABLE `investor` (
  `id` int(100) NOT NULL,
  `investor_email_id` varchar(100) NOT NULL,
  `linked_in` varchar(100) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `type_of_invest` varchar(18) DEFAULT NULL,
  `invest_buget` varchar(20) DEFAULT NULL,
  `invested_before` varchar(500) DEFAULT NULL,
  `address` varchar(200) NOT NULL,
  `profile_pic` varchar(500) NOT NULL DEFAULT 'DEFAULT.PNG',
  `DOB` date NOT NULL,
  `password` longtext NOT NULL,
  `gender` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `investor`
--

INSERT INTO `investor` (`id`, `investor_email_id`, `linked_in`, `name`, `phone`, `type_of_invest`, `invest_buget`, `invested_before`, `address`, `profile_pic`, `DOB`, `password`, `gender`) VALUES
(10, 'gpriyanshi1296@gmail.com', 'https://linked.in/in/sakshi', 'Sakshi Goyal', '6235656896', 'Personal Investor', '10000000', 'no', 'Indore', '60c4b33f8267b4.98168983.jpg', '2021-06-12', '$2y$10$x8BDdvMGHi/yE8VUjUNzT.apxP8M.z8P4wJmHH/3UTuXCj654Pn2i', 'F'),
(11, 'gpriyanshi1600@gmail.com', 'https://linked.in/in/RonakJain', 'Ronak Jain', '6235656896', 'Personal Investor', '50000', 'Ask Career : Career Guidance Platform', 'Indore', '60c5ed76e49c85.42141823.jpg', '1989-06-20', '$2y$10$ZpbhBa33lYedGXF6DIkm/OBU5l.uFl4akUTcGLRhi.cyYiAWgLi0K', 'M'),
(9, 'tarvguptait18@acropolis.in', 'https://linked.in/in/RonakJain', 'Ronak Jain', '6935689745', 'Angel Investo', '5000000', 'AskCareer : Career Guidance Portal', 'Indore', '60c4b13b3cf971.52806182.jpg', '1989-05-24', '$2y$10$10S0QOa9IbJdL9oig3DlCOF6Z9WPU6LR4ofL6n0Tddjzxh5O63V7u', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `i_intrested`
--

CREATE TABLE `i_intrested` (
  `id` int(100) NOT NULL,
  `post_id` int(100) DEFAULT NULL,
  `investor_e_id` varchar(100) DEFAULT NULL,
  `visited` varchar(10) DEFAULT 'not'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `i_intrested`
--

INSERT INTO `i_intrested` (`id`, `post_id`, `investor_e_id`, `visited`) VALUES
(8, 30, 'tarvguptait18@acropolis.in', 'not'),
(9, 29, 'tarvguptait18@acropolis.in', 'not'),
(10, 31, 'tarvguptait18@acropolis.in', 'not');

-- --------------------------------------------------------

--
-- Table structure for table `not_single_founder`
--

CREATE TABLE `not_single_founder` (
  `id` int(100) NOT NULL,
  `fundraiser_email_id` varchar(100) DEFAULT NULL,
  `other_f_full_name` varchar(100) DEFAULT NULL,
  `other_f_email_id` varchar(100) DEFAULT NULL,
  `post_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `not_single_founder`
--

INSERT INTO `not_single_founder` (`id`, `fundraiser_email_id`, `other_f_full_name`, `other_f_email_id`, `post_id`) VALUES
(3, 'priyanshiguptait18@acropolis.in', 'tanmay Jain', 'tanmayjainit18@acropolis.in', 28),
(4, 'priyanshiguptait18@acropolis.in', 'Sakshi Goyal', 'sakshigoyalit18@acropolis.in', 29);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(100) NOT NULL,
  `post_title` varchar(1000) NOT NULL,
  `stage` varchar(100) DEFAULT NULL,
  `resgister_name` varchar(200) DEFAULT NULL,
  `post_img` varchar(1000) NOT NULL DEFAULT 'default.svg',
  `post_by` varchar(100) NOT NULL,
  `post_date` varchar(40) DEFAULT NULL,
  `post_content` longtext NOT NULL,
  `post_type` varchar(10) NOT NULL DEFAULT 'PRIVATE',
  `post_tag` varchar(1000) NOT NULL,
  `pitch_file` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_title`, `stage`, `resgister_name`, `post_img`, `post_by`, `post_date`, `post_content`, `post_type`, `post_tag`, `pitch_file`) VALUES
(29, 'Go Green with Plastic', 'Idea Stage', '', '60c4a6f8174cd3.19193747.jpg', 'priyanshiguptait18@acropolis.in', 'Saturday 2021-06-12 14:22:16', 'Caring about the planet can be a great business — especially if we consider the state of our glaciers and oceans. \r\n\r\nOn the positive side, consumers seem more worried now about climate change and reusable materials than before. So, investing in reusable bags promises quite a profit! Filtered and reusable bottles, like the Ocean Bottle, have also become more famous as startup initiatives, too. \r\n\r\nYou could think about making the best of people’s awareness with more eco-friendly daily devices. ', 'public', 'Energy', 'default.pdf'),
(30, 'Social Media Management', 'Idea Stage', 'no', '60c4a7a4b9b276.77548413.png', 'priyanshiguptait18@acropolis.in', 'Saturday 2021-06-12 14:25:08', 'This kind of job is usually performed by expert social media marketers, but people are always looking for cost-effective alternatives.\r\nIf you have some experience and knowledge of managing social media (Facebook & Twitter) pages, you can get paid by making it a business.', 'public', 'Media', 'default.pdf'),
(31, 'Taxi Booking Service And Solution', 'Proof Of Concept', 'no', '60c4a8f21eb6c5.45689089.jpg', 'tarvgupta12@gmail.com', 'Saturday 2021-06-12 14:30:42', 'An online taxi app development business is a costly start-up yet over the long haul the profits are lucrative.\r\n\r\nIt can be begun on a little note with a couple of autos and drivers and later on can be extended bit by bit to procure benefit.\r\n\r\nIt is the entrepreneur with loads of gaining potential with high development rates and huge demand.\r\nThe features of the solution should be engineered for the taxi business. It must provide Flexible, Easy to Manage and End to End Service Solutions.\r\n\r\nThe solution installed should be professionally created, adaptable, and easy to use via any Mobile.', 'public', 'Other', 'default.pdf'),
(32, 'Video Editing', 'Idea Stage', 'no', '60c4ab3a07e2c0.87193403.jpg', 'tanmayjainit18@acropolis.in', 'Saturday 2021-06-12 14:40:26', 'Would you like to make your own video editing application yet not certain how to begin?\r\n\r\nSAGIPL has all the answers for you. You simply prepare yourself for earning money using your editing skills.\r\n\r\nA truly capable video editor application that won’t stamp a watermark or place a timeline on your clasp.\r\n\r\n\r\nTruth be told you can utilize your editing abilities effectively.\r\n\r\nIt will have the capacity to edit your capture videos with a video editing app that must easily operate on Android, iPhone, and other web solutions.', 'public', 'Other', 'default.pdf'),
(33, 'Team Message App Solution', 'Idea Stage', 'no', '60c4c79e04cec2.30028728.jpg', 'sakshigoyalit18@acropolis.in', 'Saturday 2021-06-12 16:41:34', 'People in a corporate world require passing on information regarding projects, sharing ideas, instant messages, etc.\r\nHence, a business messaging app is the requirement of each and every corporate office.\r\nThe App for this purpose can be a great venture and profitable too. the App for this purpose must have the capabilities like image and file sharing in different formats, and also it should have support for Android, iOS, and the web.', 'public', 'Communication', 'default.pdf'),
(34, 'Payment Gateway System', 'Proof Of Concept', 'no', '60c5e86a17e4c5.03831011.jpg', 'vikashsinghit18@acropolis.in', 'Sunday 2021-06-13 13:13:46', 'I think at this moment in the age where innovation is progressing at a quicker rate, one ought to have its secured payment gateway.\r\n\r\nA payment gateway helps us to send money to anybody, anywhere easily and with high-security features.\r\nOne just requires buying a mobile and a web app that can operate on all operating systems and devices like Android and iOS websites.\r\n\r\nHere are some example of Payment Gateways:\r\n\r\nBraintree\r\nSage Pay\r\nAuthorize.net\r\nPaymentExpress\r\nTrustCommerce', 'public', 'FinTech', 'default.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `user_follower`
--

CREATE TABLE `user_follower` (
  `id` int(11) NOT NULL,
  `users_id` varchar(100) NOT NULL,
  `follower_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_follower`
--

INSERT INTO `user_follower` (`id`, `users_id`, `follower_id`) VALUES
(25, 'tanmayjainit18@acropolis.in', 'tarvgupta12@gmail.com'),
(26, 'tanmayjainit18@acropolis.in', 'vikashsinghit18@acropolis.in'),
(27, 'tanmayjainit18@acropolis.in', 'priyanshiguptait18@acropolis.in'),
(28, 'tarvgupta12@gmail.com', 'sakshigoyalit18@acropolis.in'),
(29, 'tarvgupta12@gmail.com', 'gpriyanshi1296@gmail.com'),
(30, 'tarvgupta12@gmail.com', 'priyanshiguptait18@acropolis.in'),
(31, 'tarvgupta12@gmail.com', 'vikashsinghit18@acropolis.in'),
(32, 'priyanshiguptait18@acropolis.in', 'tarvgupta12@gmail.com'),
(33, 'tarvguptait18@acropolis.in', 'tarvgupta12@gmail.com'),
(34, 'tarvguptait18@acropolis.in', 'priyanshiguptait18@acropolis.in'),
(35, 'vikashsinghit18@acropolis.in', 'priyanshiguptait18@acropolis.in'),
(36, 'gpriyanshi1600@gmail.com', 'tarvgupta12@gmail.com'),
(37, 'gpriyanshi1600@gmail.com', 'tanmayjainit18@acropolis.in'),
(38, 'priyanshiguptait18@acropolis.in', 'vikashsinghit18@acropolis.in');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD UNIQUE KEY `unique_cat_letsup` (`id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `fundraiser`
--
ALTER TABLE `fundraiser`
  ADD PRIMARY KEY (`fundraiser_email_id`),
  ADD KEY `unique_id` (`id`);

--
-- Indexes for table `f_intrested`
--
ALTER TABLE `f_intrested`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fr_k_for_f_intrested` (`post_id`);

--
-- Indexes for table `investor`
--
ALTER TABLE `investor`
  ADD PRIMARY KEY (`investor_email_id`),
  ADD KEY `investor_un_id` (`id`);

--
-- Indexes for table `i_intrested`
--
ALTER TABLE `i_intrested`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fr_k_for_i_intrested` (`post_id`);

--
-- Indexes for table `not_single_founder`
--
ALTER TABLE `not_single_founder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `user_follower`
--
ALTER TABLE `user_follower`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `fundraiser`
--
ALTER TABLE `fundraiser`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `f_intrested`
--
ALTER TABLE `f_intrested`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `investor`
--
ALTER TABLE `investor`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `i_intrested`
--
ALTER TABLE `i_intrested`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `not_single_founder`
--
ALTER TABLE `not_single_founder`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user_follower`
--
ALTER TABLE `user_follower`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `f_intrested`
--
ALTER TABLE `f_intrested`
  ADD CONSTRAINT `fr_k_for_f_intrested` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `i_intrested`
--
ALTER TABLE `i_intrested`
  ADD CONSTRAINT `fr_k_for_i_intrested` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
