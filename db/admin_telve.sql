-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 28, 2017 at 12:34 AM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `favourite_reply`
--

CREATE TABLE `favourite_reply` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `reply_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `embed` varchar(5000) DEFAULT NULL,
  `picurl` varchar(255) DEFAULT NULL,
  `domain` varchar(33) DEFAULT NULL,
  `topic` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `score` int(7) NOT NULL DEFAULT '0',
  `comments` int(7) NOT NULL DEFAULT '0',
  `reported` int(7) NOT NULL DEFAULT '0',
  `favorited` int(7) NOT NULL DEFAULT '0',
  `is_link_for_union` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `report_link`
--

CREATE TABLE `report_link` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `link_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `report_reply`
--

CREATE TABLE `report_reply` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `reply_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `report_topic`
--

CREATE TABLE `report_topic` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `topic_name` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `subscribers` int(11) NOT NULL DEFAULT '0',
  `header_image` varchar(255) DEFAULT NULL,
  `creator_uid` int(11) NOT NULL DEFAULT '1',
  `reported` int(7) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

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
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD UNIQUE KEY `email` (`email`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `favourite_reply`
--
ALTER TABLE `favourite_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `report_link`
--
ALTER TABLE `report_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `report_reply`
--
ALTER TABLE `report_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `report_topic`
--
ALTER TABLE `report_topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vote_link`
--
ALTER TABLE `vote_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vote_reply`
--
ALTER TABLE `vote_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
