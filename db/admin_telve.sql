-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 01, 2017 at 08:24 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_telve`
--

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `picurl` varchar(255) DEFAULT NULL,
  `domain` varchar(33) DEFAULT NULL COMMENT '域名',
  `category` varchar(255) NOT NULL,
  `created` int(11) NOT NULL,
  `score` int(6) NOT NULL,
  `comments` int(6) NOT NULL COMMENT '评论条数'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`id`, `uid`, `title`, `url`, `text`, `picurl`, `domain`, `category`, `created`, `score`, `comments`) VALUES
(10000004, 41, 'Asd', NULL, 'adsda', NULL, NULL, 'GAME', 1483294734, 0, 0),
(10000005, 41, 'Post1', NULL, 'Post1', NULL, NULL, 'GAME', 1483294815, 0, 5),
(10000003, 41, 'Mariah Carey has NYE performance fiasco | Fox News', 'http://www.foxnews.com/entertainment/2017/01/01/mariah-carey-has-nye-performance-fiasco.html', NULL, 'http://a57.foxnews.com/images.foxnews.com/content/fox-news/entertainment/2017/01/01/mariah-carey-has-nye-performance-fiasco/_jcr_content/par/featured-media/media-0.img.jpg/876/493/1483271792196.jpg?ve=1&tl=1', 'www.foxnews.com', 'NEWS', 1483278100, 0, 24);

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `uid` int(6) NOT NULL COMMENT '用户id',
  `rank` int(6) NOT NULL,
  `created` int(11) NOT NULL COMMENT '回复时间',
  `score` int(6) NOT NULL,
  `comments` int(11) NOT NULL COMMENT '子评论条数'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='回复表单';

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`id`, `content`, `pid`, `uid`, `rank`, `created`, `score`, `comments`) VALUES
(100000074, 'comment1', 100000071, 41, 0, 1483300330, 0, 0),
(100000073, '5', 10000005, 41, 0, 1483300202, 0, 0),
(100000072, '4', 10000005, 41, 0, 1483300196, 0, 0),
(100000071, '3', 10000005, 41, 0, 1483300192, 0, 1),
(100000070, '2', 10000005, 41, 0, 1483300189, 1, 0),
(100000069, '1', 10000005, 41, 0, 1483300184, 0, 0),
(100000068, '24-2', 100000066, 41, 0, 1483283520, 0, 0),
(100000067, '24-1', 100000066, 41, 0, 1483283511, 0, 0),
(100000066, '24', 10000003, 41, 0, 1483283414, 0, 2),
(100000065, '23', 10000003, 41, 0, 1483283412, 0, 0),
(100000064, '22', 10000003, 41, 0, 1483283410, 0, 0),
(100000063, '21', 10000003, 41, 0, 1483283402, 0, 0),
(100000062, 'asdads', 10000003, 41, 0, 1483283395, 1, 0),
(100000061, 'asd', 10000003, 41, 0, 1483283393, 0, 0),
(100000060, 'asda', 10000003, 41, 0, 1483283389, 0, 0),
(100000059, 'asda', 10000003, 41, 0, 1483283387, 0, 0),
(100000058, 'asda', 10000003, 41, 0, 1483283381, 0, 0),
(100000057, 'asda', 10000003, 41, 0, 1483283379, 0, 0),
(100000056, 'asdasqw123123\n', 10000003, 41, 0, 1483283376, 0, 0),
(100000055, 'asdsa', 10000003, 41, 0, 1483283372, 0, 0),
(100000054, 'asd', 10000003, 41, 0, 1483283370, 0, 0),
(100000053, '123', 10000003, 41, 0, 1483283366, 0, 0),
(100000052, 'asd123\n', 10000003, 41, 0, 1483283362, 0, 0),
(100000051, 'asd6\n', 10000003, 41, 0, 1483283360, 0, 0),
(100000050, 'asd5\n', 10000003, 41, 0, 1483283358, 0, 0),
(100000049, 'asd4', 10000003, 41, 0, 1483283356, 0, 0),
(100000048, 'asd3', 10000003, 41, 0, 1483283344, 0, 0),
(100000047, 'asd2', 10000003, 41, 0, 1483283342, 0, 0),
(100000046, 'asd\n', 10000003, 41, 0, 1483283335, 0, 0),
(100000045, 'asd', 10000003, 41, 0, 1483283332, 0, 0),
(100000044, 'level1-2', 10000003, 41, 0, 1483278889, 0, 0),
(100000043, 'level2-1', 100000042, 41, 0, 1483278854, 0, 0),
(100000042, 'level1-1', 10000003, 41, 0, 1483278744, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rply_vote`
--

CREATE TABLE `rply_vote` (
  `uid` int(11) NOT NULL,
  `rply_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rply_vote`
--

INSERT INTO `rply_vote` (`uid`, `rply_id`) VALUES
(41, 100000000),
(41, 100000001),
(41, 100000003),
(41, 100000002),
(42, 100000005),
(42, 100000004),
(42, 100000006),
(42, 100000007),
(41, 100000005),
(41, 100000004),
(41, 100000006),
(41, 100000007),
(41, 56),
(41, 0),
(41, 100000062),
(41, 100000070);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL COMMENT '提交用户的id',
  `rank` int(6) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `score` int(6) NOT NULL,
  `created` int(11) NOT NULL,
  `up` int(11) NOT NULL COMMENT '支持',
  `down` int(11) NOT NULL COMMENT '反对'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `uid`, `rank`, `title`, `url`, `category`, `score`, `created`, `up`, `down`) VALUES
(1, 0, 1, '', '', '', 3331, 1375078343, 0, 0),
(2, 0, 2, '', '', '', 2780, 1375078343, 0, 0),
(3, 0, 3, '', '', '', 2500, 1375078343, 0, 0),
(4, 0, 4, '', '', '', 2000, 1375078343, 0, 0),
(5, 0, 10, '', '', '', 0, 0, 0, 0),
(6, 0, 5, '', '', '', 1800, 1375078343, 0, 0),
(7, 0, 6, '', '', '', 1600, 1375079694, 0, 0),
(8, 0, 7, '', '', '', 900, 1375080103, 0, 0),
(9, 0, 8, '', '', '', 500, 1375147081, 0, 0),
(10, 0, 0, '', '', '', 0, 1375152409, 0, 0),
(11, 0, 0, '', '', '', 0, 1375152518, 0, 0),
(12, 0, 0, '', '', '', 0, 1375153176, 0, 0),
(13, 0, 0, '', '', '', 0, 1375162266, 0, 0),
(14, 0, 0, '', '', '', 0, 1375240751, 0, 0),
(15, 0, 0, '', '', '', 0, 1375240847, 0, 0),
(16, 0, 0, '', '', '', 0, 1375240875, 0, 0),
(17, 0, 0, '', '', '', 0, 1375240882, 0, 0),
(18, 0, 0, '', '', '', 0, 1375240899, 0, 0),
(19, 0, 0, '', '', '', 0, 1375241231, 0, 0),
(20, 0, 0, '', '', '', 0, 1375241255, 0, 0),
(21, 0, 0, '', '', '', 0, 1375247793, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(33) NOT NULL,
  `email` varchar(33) NOT NULL,
  `credit` int(6) NOT NULL COMMENT '积分',
  `created` int(11) NOT NULL COMMENT '注册时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `credit`, `created`) VALUES
(22, '大王叫我叫我', 'e10adc3949ba59abbe56e057f20f883e', 'dawang@126.com', 1, 1375581732),
(23, '叫我大王大王', 'e10adc3949ba59abbe56e057f20f883e', 'dawang@dw.com', 1, 1375583496),
(24, 'lizhijun', 'e10adc3949ba59abbe56e057f20f883e', 'lizhijun20@126.com', 1, 1375583567),
(25, 'lizhijun20', 'e10adc3949ba59abbe56e057f20f883e', 'lizhijunx@126.com', 1, 1375583763),
(26, 'lizhijunx', 'e10adc3949ba59abbe56e057f20f883e', 'lizhijunxx@126.com', 1, 1375583823),
(27, 'lizhijunxxx', 'e10adc3949ba59abbe56e057f20f883e', 'lizhijunxxx@126.com', 1, 1375584226),
(28, 'lizhijunxxxx', 'e10adc3949ba59abbe56e057f20f883e', 'lizhijunxxxx@126.com', 1, 1375584270),
(29, '123456', 'e10adc3949ba59abbe56e057f20f883e', '123456@126.com', 9, 1375584471),
(30, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@iyourl.com', 1, 1375684872),
(31, 'lizhijunn', 'e10adc3949ba59abbe56e057f20f883e', 'lizhijnu@127.com', 1, 1375760531),
(32, 'lizhijunn', 'e10adc3949ba59abbe56e057f20f883e', 'lizhijnu@127.com', 1, 1375760531),
(33, 'helloworld', '24f7d73ffc9a55258a1f5766923eefbe', 'hello@world.com', 1, 1375761612),
(34, 'hahaha', '4ba449f39af2de99517e5e6d9840580b', 'haha@ha.com', 1, 1375761908),
(35, 'wawowawo', '8c0f8e00e392f2e30077ad4883ff8d21', 'wo@wa.com', 1, 1375762041),
(36, 'haowubai', '113035048d5e87ee1c0a10142a545544', 'haiwu@bai.com', 1, 1375762639),
(37, 'haowubaii', '113035048d5e87ee1c0a10142a545544', 'haiwu@baii.com', 1, 1375762717),
(38, 'haowubaiii', '113035048d5e87ee1c0a10142a545544', 'haiwu@baiii.com', 1, 1375762759),
(39, 'fsfsf', 'e10adc3949ba59abbe56e057f20f883e', 'afsaf@ada.com', 1, 1375762880),
(40, 'fsfsffg', 'e10adc3949ba59abbe56e057f20f883e', 'afsaf@adfa.com', 1, 1375762916),
(41, 'mert1', 'b23cf2d0fb74b0ffa0cf4c70e6e04926', 'mert1@gmail.com', 1, 1482922600),
(42, 'mert2', 'b23cf2d0fb74b0ffa0cf4c70e6e04926', 'mert2@gmail.com', 1, 1483055009);

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `uid` int(11) NOT NULL,
  `linkid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`uid`, `linkid`) VALUES
(41, 52),
(41, 52),
(41, 52),
(41, 52),
(41, 52),
(41, 52),
(41, 52),
(41, 52),
(41, 52),
(41, 53),
(41, 54),
(41, 55),
(41, 56),
(41, 57),
(41, 58),
(41, 59),
(41, 60),
(41, 61),
(41, 63),
(42, 53),
(42, 54),
(42, 63),
(41, 64);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000006;
--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100000075;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
