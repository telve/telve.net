-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 20, 2017 at 12:09 PM
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
-- Table structure for table `favourite_link`
--

CREATE TABLE `favourite_link` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `link_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favourite_link`
--

INSERT INTO `favourite_link` (`id`, `uid`, `link_id`, `created`) VALUES
(1, 2, 1, '2017-01-20 07:21:48'),
(2, 1, 1, '2017-01-20 07:26:24');

-- --------------------------------------------------------

--
-- Table structure for table `favourite_reply`
--

CREATE TABLE `favourite_reply` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `reply_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favourite_reply`
--

INSERT INTO `favourite_reply` (`id`, `uid`, `reply_id`, `created`) VALUES
(1, 1, 1, '2017-01-20 07:47:20'),
(2, 2, 2, '2017-01-20 08:22:33');

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `text` varchar(10000) DEFAULT NULL,
  `picurl` varchar(255) DEFAULT NULL,
  `domain` varchar(33) DEFAULT NULL,
  `topic` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `score` int(7) NOT NULL DEFAULT '0',
  `comments` int(7) NOT NULL DEFAULT '0',
  `reported` int(7) NOT NULL DEFAULT '0',
  `favorited` int(7) NOT NULL DEFAULT '0',
  `is_link_for_union` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`id`, `uid`, `title`, `url`, `text`, `picurl`, `domain`, `topic`, `created`, `score`, `comments`, `reported`, `favorited`, `is_link_for_union`) VALUES
(1, 1, 'Sevimli kedicik', 'http://funnycats.blogin.com.au/wp-content/uploads/2015/01/aww-too-cute-cat.jpg', NULL, 'http://funnycats.blogin.com.au/wp-content/uploads/2015/01/aww-too-cute-cat.jpg', 'funnycats.blogin.com.au', 'RESİM', '2017-01-20 03:09:34', 0, 1, 0, 2, 1),
(2, 1, 'En pahalı yemin töreni - Dünya Haberleri', 'http://www.hurriyet.com.tr/en-pahali-yemin-toreni-40340912', NULL, 'http://i.hurimg.com/i/hurriyet/90/590x332/58812be467b0a92e545b3867.jpg', 'www.hurriyet.com.tr', 'HABER', '2017-01-20 03:17:49', 0, 0, 0, 0, 1),
(3, 1, 'Baklava', NULL, 'Baklava, Türk, Orta Doğu, Balkan ve Güney Asya mutfaklarında yer etmiş önemli bir hamur tatlısıdır. İnce yufkaların arasına yöreye göre ceviz, antep fıstığı, badem veya fındık konarak yapılır. Genel olarak şeker şerbeti ile tatlandırılır. Ayrıca bal şerbeti de kullanılabilir. Bazı ticari firmalar kendi özel şerbetlerini kullanırlar.\r\n\r\nAB Komisyonu tarafından 8 Ağustos 2013 Tarihinde baklavanın Türk tatlısı olduğu tescil edilmiştir.', NULL, NULL, 'YEMEK', '2017-01-20 03:33:25', 0, 0, 0, 0, 1),
(4, 1, 'Afilli Filtrelerden Vazgeçemeyen Selfie Tutkunlarını Ele Geçiren Yeni Çılgınlık: Meitu - onedio.com', 'https://onedio.com/haber/afilli-filtrelerden-vazgecemeyen-selfie-tutkunlarini-ele-geciren-yeni-cilginlik-meitu-752027', NULL, 'https://onedio.com//images/logo/onedio-new2x-new.png', 'onedio.com', 'KOMİK', '2017-01-20 03:50:13', 0, 0, 0, 0, 1),
(5, 1, 'iPhone 10 yaşında: Apple’ın en önemli ürününün görsel tarihi', 'http://www.teknoblog.com/iphone-10-yasinda-140170/', NULL, NULL, 'www.teknoblog.com', 'TEKNOLOJİ', '2017-01-20 03:53:31', -1, 0, 1, 0, 1),
(6, 1, 'Çin, Saniyede Milyarlarca İşlem Yapabilen Dünyanın İlk Süper Bilgisayarını Yapıyor!', 'http://www.webtekno.com/cin-dunyanin-ilk-saniyede-milyarlarca-islem-yapabilen-super-bilgisayarini-yapiyor-h24317.html', NULL, 'http://www.webtekno.com//images/editor/default/0001/09/b226776d500d71c0c2fa775d5922672b59812b4c.jpeg', 'www.webtekno.com', 'TEKNOLOJİ', '2017-01-20 03:55:47', 0, 0, 0, 0, 1),
(7, 1, 'Türk Hava Yolları\'nın Yeni Reklam Yüzü Dünya Yıldızı Morgan Freeman Oldu!', 'http://www.webtekno.com/turk-hava-yollari-nin-yeni-reklam-yuzu-dunya-yildizi-morgan-freeman-oldu-h24330.html', NULL, NULL, 'www.webtekno.com', 'HABER', '2017-01-20 03:57:08', 0, 0, 0, 0, 1),
(8, 1, 'CIA, UFO Kayıtları ve Psişik Deneylerin Bulunduğu Dosyaları Yayınladı!', 'http://www.webtekno.com/cia-ufo-kayitlari-ve-psisik-deneylerin-bulundugu-dosyalari-yayinladi-h24331.html', NULL, 'http://www.webtekno.com//images/editor/default/0001/09/9f77c3347ae303b3ebd7c2241be29b7ebf1aadc6.jpeg', 'www.webtekno.com', 'HABER', '2017-01-20 03:57:51', 0, 1, 0, 0, 1),
(9, 1, 'Logan Filminden Vizyon Öncesi Son Fragman Geldi! - Haberler - Beyazperde', 'http://www.beyazperde.com/haberler/filmler/haberler-77177/', NULL, 'http://tr.web.img3.acsta.net/newsv7/17/01/19/22/02/031987.jpg', 'www.beyazperde.com', 'SİNEMA', '2017-01-20 04:00:29', 1, 0, 0, 0, 1),
(10, 1, 'Simge\'nin \'Prens ve Prenses\'i  - Müzik Haber - PowerTürk', 'http://www.powerturk.com/muzik/muzik-haber/simge-nin-prens-ve-prenses-i.html', NULL, 'http://www.powerturk.com//i/logo.png', 'www.powerturk.com', 'MÜZİK', '2017-01-20 05:46:20', 0, 0, 0, 0, 1),
(11, 1, 'AYDİLGE / KİRALIK AŞK -  Sen misin İlacım? KLİP - YouTube', 'https://www.youtube.com/watch?v=qBBIKdD2fo8', NULL, 'https://i.ytimg.com/vi/qBBIKdD2fo8/maxresdefault.jpg', 'www.youtube.com', 'MÜZİK', '2017-01-20 05:52:31', 0, 0, 0, 0, 1),
(12, 1, 'Kedi Efsanelerini Test Ettik - Hıyardan Korkuyorlar Mı? - YouTube', 'https://www.youtube.com/watch?v=ebL_YWNN570', NULL, 'https://i.ytimg.com/vi/ebL_YWNN570/maxresdefault.jpg', 'www.youtube.com', 'VİDEO', '2017-01-20 06:06:42', 0, 0, 0, 0, 1),
(13, 1, 'Aleyna Tilki ft. Emrah Karaduman - Cevapsız Çınlama Rap Parodi (#OrkunaMeydanOkuyorum) - YouTube', 'https://youtu.be/MBVX26xPyR4', NULL, 'https://i.ytimg.com/vi/MBVX26xPyR4/maxresdefault.jpg', 'youtu.be', 'VİDEO', '2017-01-20 06:11:04', 0, 0, 0, 0, 1),
(14, 2, 'Çavuşoğlu, Trump\'ın kabine adayları ile görüştü - Dünya Haberleri', 'http://www.hurriyet.com.tr/cavusoglu-trumpin-kabine-adaylari-ile-gorustu-40341022', NULL, 'http://i.hurimg.com/i/hurriyet/90/590x332/5881b2fdc03c0e069c7b5022.jpg', 'www.hurriyet.com.tr', 'HABER', '2017-01-20 11:39:17', 0, 0, 0, 0, 1),
(15, 2, 'Futbol mutasyona uğruyor! - Spor Haberleri', 'http://www.milliyet.com.tr/futbol-mutasyona-ugruyor----2381830-skorergaleri/', NULL, 'http://www.milliyet.com.tr/d/i/skorer/fbskorer.jpg', 'www.milliyet.com.tr', 'HABER', '2017-01-20 11:43:48', 0, 0, 0, 0, 1),
(16, 2, 'Son dakika... Tüm gözler Washington\'da! Trump koltuğa oturuyor - Dünya Haberleri', 'http://www.milliyet.com.tr/son-dakika-tum-gozler-dunya-2381897/', NULL, 'http://icube.milliyet.com.tr/YeniAnaResim/2017/01/20/son-dakika-tum-gozler-washington-da-trump-koltuga-oturuyor-8392999.Jpeg', 'www.milliyet.com.tr', 'HABER', '2017-01-20 11:49:55', 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `id` int(11) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `score` int(7) NOT NULL DEFAULT '0',
  `comments` int(7) NOT NULL DEFAULT '0',
  `is_parent_link` tinyint(1) NOT NULL DEFAULT '1',
  `link_id` int(11) NOT NULL,
  `reported` int(7) NOT NULL DEFAULT '0',
  `favorited` int(7) NOT NULL DEFAULT '0',
  `is_link_for_union` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`id`, `content`, `pid`, `uid`, `created`, `score`, `comments`, `is_parent_link`, `link_id`, `reported`, `favorited`, `is_link_for_union`) VALUES
(1, 'haha gerçekten de sevimli bir kedicik', 1, 2, '2017-01-20 07:33:26', 1, 1, 1, 1, 0, 1, 0),
(2, 'aynen :)', 1, 1, '2017-01-20 07:34:30', 1, 0, 0, 1, 0, 1, 0),
(3, 'en büyük pşişik Yuri bir kere!', 8, 2, '2017-01-20 11:07:31', 1, 2, 1, 8, 0, 0, 0),
(4, 'Red Alert 2 fanı tespit edildi', 3, 1, '2017-01-20 11:09:01', 1, 0, 0, 8, 0, 0, 0),
(5, 'biri bana mı seslendi?', 3, 3, '2017-01-20 11:29:32', 1, 0, 0, 8, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `report_link`
--

CREATE TABLE `report_link` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `link_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `report_link`
--

INSERT INTO `report_link` (`id`, `uid`, `link_id`, `created`) VALUES
(1, 2, 5, '2017-01-20 11:12:19');

-- --------------------------------------------------------

--
-- Table structure for table `report_reply`
--

CREATE TABLE `report_reply` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `reply_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `report_reply`
--

INSERT INTO `report_reply` (`id`, `uid`, `reply_id`, `created`) VALUES
(1, 2, 5, '2017-01-20 11:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `report_topic`
--

CREATE TABLE `report_topic` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `topic_name` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `report_topic`
--

INSERT INTO `report_topic` (`id`, `uid`, `topic_name`, `created`) VALUES
(1, 2, 'YEMEK', '2017-01-20 11:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `uid`, `topic`, `created`) VALUES
(1, 3, 'HABER', '2017-01-20 11:31:18'),
(2, 3, 'TEKNOLOJİ', '2017-01-20 11:31:57'),
(3, 3, 'VİDEO', '2017-01-20 11:31:59'),
(4, 3, 'KOMİK', '2017-01-20 11:32:03');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `subscribers` int(11) NOT NULL DEFAULT '0',
  `header_image` varchar(255) DEFAULT NULL,
  `reported` int(7) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`name`, `description`, `subscribers`, `header_image`, `reported`, `created`) VALUES
('RESİM', NULL, 0, NULL, 0, '2017-01-20 03:09:34'),
('HABER', NULL, 1, NULL, 0, '2017-01-20 03:17:49'),
('YEMEK', NULL, 0, NULL, 1, '2017-01-20 03:33:25'),
('KOMİK', NULL, 1, NULL, 0, '2017-01-20 03:50:13'),
('TEKNOLOJİ', NULL, 1, NULL, 0, '2017-01-20 03:53:31'),
('SİNEMA', NULL, 0, NULL, 0, '2017-01-20 04:00:29'),
('MÜZİK', NULL, 0, NULL, 0, '2017-01-20 05:46:20'),
('VİDEO', NULL, 1, NULL, 0, '2017-01-20 06:06:42');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(33) NOT NULL,
  `email` varchar(33) NOT NULL,
  `karma` int(7) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `karma`, `created`) VALUES
(1, 'admin', 'b23cf2d0fb74b0ffa0cf4c70e6e04926', 'admin@telve.net', 0, '2017-01-20 01:58:01'),
(2, 'moderator', 'b23cf2d0fb74b0ffa0cf4c70e6e04926', 'moderator@telve.net', 0, '2017-01-20 07:17:32'),
(3, 'yuri', 'b23cf2d0fb74b0ffa0cf4c70e6e04926', 'yuri@telve.net', 0, '2017-01-20 11:28:40');

-- --------------------------------------------------------

--
-- Table structure for table `vote_link`
--

CREATE TABLE `vote_link` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `link_id` int(11) NOT NULL,
  `up_down` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `vote_link`
--

INSERT INTO `vote_link` (`id`, `uid`, `link_id`, `up_down`, `created`) VALUES
(1, 2, 9, 1, '2017-01-20 07:20:11'),
(2, 2, 5, 0, '2017-01-20 07:21:04');

-- --------------------------------------------------------

--
-- Table structure for table `vote_reply`
--

CREATE TABLE `vote_reply` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `reply_id` int(11) NOT NULL,
  `up_down` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `vote_reply`
--

INSERT INTO `vote_reply` (`id`, `uid`, `reply_id`, `up_down`, `created`) VALUES
(1, 1, 1, 1, '2017-01-20 07:34:59'),
(2, 2, 2, 1, '2017-01-20 11:03:19'),
(3, 1, 3, 1, '2017-01-20 11:07:45'),
(4, 2, 4, 1, '2017-01-20 11:09:19'),
(5, 3, 5, 1, '2017-01-20 11:29:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favourite_link`
--
ALTER TABLE `favourite_link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourite_reply`
--
ALTER TABLE `favourite_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `link` ADD FULLTEXT KEY `title` (`title`);
ALTER TABLE `link` ADD FULLTEXT KEY `text` (`text`);
ALTER TABLE `link` ADD FULLTEXT KEY `domain` (`domain`);
ALTER TABLE `link` ADD FULLTEXT KEY `url` (`url`);
ALTER TABLE `link` ADD FULLTEXT KEY `topic` (`topic`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_link`
--
ALTER TABLE `report_link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_reply`
--
ALTER TABLE `report_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_topic`
--
ALTER TABLE `report_topic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vote_link`
--
ALTER TABLE `vote_link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vote_reply`
--
ALTER TABLE `vote_reply`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favourite_link`
--
ALTER TABLE `favourite_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `favourite_reply`
--
ALTER TABLE `favourite_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `report_link`
--
ALTER TABLE `report_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `report_reply`
--
ALTER TABLE `report_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `report_topic`
--
ALTER TABLE `report_topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vote_link`
--
ALTER TABLE `vote_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vote_reply`
--
ALTER TABLE `vote_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
