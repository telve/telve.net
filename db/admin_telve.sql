-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 04, 2017 at 04:42 AM
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
  `text` varchar(10000) DEFAULT NULL,
  `picurl` varchar(255) DEFAULT NULL,
  `domain` varchar(33) DEFAULT NULL,
  `topic` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `score` int(7) NOT NULL,
  `comments` int(7) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`id`, `uid`, `title`, `url`, `text`, `picurl`, `domain`, `topic`, `created`, `score`, `comments`) VALUES
(10000000, 100000, 'Celebrate Diablo&#039;s 20th Anniv With Diablo 3 Goodies, Events', 'http://www.playstationlifestyle.net/2017/01/01/diablo-3-event-goodies-20th-anniv/', NULL, 'http://cdn2-www.playstationlifestyle.net/wp-content/themes/playstationlifestyle/images/pslslogoWhite.jpg', 'www.playstationlifestyle.net', 'GAMING', '2017-01-02 03:12:47', 0, 0),
(10000001, 100000, 'Apple Loop: New iPhone 8 Leaks, Apple AirPods Latest Issue, Major MacBook Pro Problems', 'http://www.forbes.com/sites/ewanspence/2016/12/30/apple-news-headlines-iphone-leak-rumor-airpods-macbook-pro/#3466cf09ccb4', NULL, 'http://blogs-images.forbes.com/ewanspence/files/2016/09/apple_iphone7_review24_15-300x169.jpg?width=960', 'www.forbes.com', 'NEWS', '2017-01-02 03:14:47', 0, 0),
(10000002, 100000, 'Tech Q&A: Which is better, Netflix or Amazon? | Fox News', 'http://www.foxnews.com/tech/2017/01/01/tech-q-which-is-better-netflix-or-amazon.html', NULL, 'http://a57.foxnews.com/images.foxnews.com/content/fox-news/tech/2017/01/01/tech-q-which-is-better-netflix-or-amazon/_jcr_content/par/featured-media/media-0.img.jpg/876/493/1483118943281.jpg?ve=1&tl=1', 'www.foxnews.com', 'SCIENCE', '2017-01-02 03:20:02', 0, 5),
(10000003, 100000, 'Protect your phone from secret spyware', NULL, 'The smartphone has become one of the most important tools in millions of Americans’ lives. It tracks your movements, displays emails and text messages, and notifies you of every birthday and appointment. Every second, information floods your smartphone. Unless you switch them off, your apps work round-the-clock, obeying your every setting and preference.\r\n\r\nYour phone churns private data through its circuitry all day long, and if criminals can break into it, they can steal all kinds of things, from banking details to compromising photos and videos. And they don’t actually have to steal your phone. They may not even be located in your country.\r\n\r\nHow do they do it? Spyware.', NULL, NULL, 'SCIENCE', '2017-01-02 03:29:29', 0, 2),
(10000004, 100000, 'Twitter considering tweet editing feature | Fox News', 'http://www.foxnews.com/tech/2016/12/30/twitter-considering-tweet-editing-feature.html', NULL, 'http://a57.foxnews.com/images.foxnews.com/content/fox-news/tech/2016/12/30/twitter-considering-tweet-editing-feature/_jcr_content/par/featured-media/media-0.img.jpg/876/493/1483123815085.jpg?ve=1&tl=1', 'www.foxnews.com', 'NEWS', '2017-01-02 03:30:49', 0, 0),
(10000005, 100000, 'Trump expresses doubts about online security | Fox News', 'http://www.foxnews.com/politics/2017/01/01/trump-expresses-doubts-about-online-security.html', NULL, 'http://a57.foxnews.com/images.foxnews.com/content/fox-news/politics/2017/01/01/trump-expresses-doubts-about-online-security/_jcr_content/par/featured-media/media-0.img.jpg/876/493/1483266263108.jpg?ve=1&tl=1', 'www.foxnews.com', 'WORLDNEWS', '2017-01-02 03:31:21', 0, 0),
(10000006, 100000, 'Re-Energized Dollar Looms Over the Rest of the World | Fox Business', 'http://www.foxbusiness.com/markets/2017/01/01/re-energized-dollar-looms-over-rest-world.html', NULL, 'http://a57.foxnews.com/images.foxnews.com/content/fox-business/markets/2017/01/01/re-energized-dollar-looms-over-rest-world/_jcr_content/par/featured-media/media-0.img.jpg/932/470/1483287646794.jpg?ve=1&tl=1', 'www.foxbusiness.com', 'WORLDNEWS', '2017-01-02 03:32:39', 0, 0),
(10000007, 100000, 'The 10 biggest spaceflight stories of 2016  | Fox News', 'http://www.foxnews.com/science/2016/12/28/10-biggest-spaceflight-stories-2016.html', NULL, 'http://a57.foxnews.com/images.foxnews.com/content/fox-news/science/2016/12/28/10-biggest-spaceflight-stories-2016/_jcr_content/par/featured-media/media-0.img.jpg/876/493/1482923965139.jpg?ve=1&tl=1', 'www.foxnews.com', 'SCIENCE', '2017-01-02 03:33:19', 1, 0),
(10000008, 100000, 'The final minute of 2016 will have one extra second -- here\'s why', NULL, 'It might feel like 2016 has already overstayed its welcome, but if you\'re counting down the seconds until 2017 shows up, you better add one more. 2016\'s final minute will be exactly one second longer than every other minute of the year, and it\'s all due to the speed of Earth\'s rotation not lining up perfectly with the ridiculously accurate atomic clocks that timekeepers use to tally every passing second.\r\n\r\nIt\'s called a "leap second" and it\'s not an uncommon occurrence. These extra seconds are added either at the stroke of midnight on June 30th or December 31st of any given year, depending on whether or not the adjustment is needed. The most recent leap second took place in June of 2015, and the most recent before that was June of 2012.', NULL, NULL, 'WORLDNEWS', '2017-01-02 03:34:20', 0, 1),
(10000009, 100000, 'NASA scientists reveal how \'spiders\' grow on Mars | Fox News', 'http://www.foxnews.com/science/2016/12/21/nasa-scientists-reveal-how-spiders-grow-on-mars.html', NULL, 'http://a57.foxnews.com/images.foxnews.com/content/fox-news/science/2016/12/21/nasa-scientists-reveal-how-spiders-grow-on-mars/_jcr_content/par/featured-media/media-0.img.jpg/876/493/1482350204248.jpg?ve=1&tl=1', 'www.foxnews.com', 'NEWS', '2017-01-02 03:35:17', 0, 0),
(10000010, 100000, 'Study: This practice, lost to time, likely made a Stradivarius sing | Fox News', 'http://www.foxnews.com/science/2016/12/23/study-this-practice-lost-to-time-likely-made-stradivarius-sing.html', NULL, 'http://a57.foxnews.com/images.foxnews.com/content/fox-news/science/2016/12/23/study-this-practice-lost-to-time-likely-made-stradivarius-sing/_jcr_content/par/featured-media/media-0.img.jpg/876/493/1482522009476.jpg?ve=1&tl=1', 'www.foxnews.com', 'PICS', '2017-01-02 03:35:55', 0, 0),
(10000011, 100000, 'Put your phone away: An addict\'s guide to unplugging | Fox News', 'http://www.foxnews.com/health/2016/12/31/put-your-phone-away-addicts-guide-to-unplugging.html', NULL, 'https://www.fix.com/assets/content/19833/tech-addiction-fox.png', 'www.foxnews.com', 'NEWS', '2017-01-02 03:37:23', 0, 0),
(10000012, 100000, 'Dogs provide therapy in a Brazilian hospital | Fox News', 'http://www.foxnews.com/health/2016/12/30/dogs-provide-therapy-in-brazilian-hospital.html', NULL, 'http://a57.foxnews.com/images.foxnews.com/content/fox-news/health/2016/12/30/dogs-provide-therapy-in-brazilian-hospital/_jcr_content/par/featured-media/media-0.img.jpg/876/493/1483119722108.jpg?ve=1&tl=1', 'www.foxnews.com', 'NEWS', '2017-01-02 03:41:55', 0, 0),
(10000013, 100000, 'Device can detect 17 diseases by our breath, study says', NULL, 'What if detecting cancer was as easy as breathing in and out? According to a study published last week in American Chemical Society Nano, it pretty much is.\r\n\r\nScientist Hossam Haick has been working on his "electronic nose" for years, the Outline reports, and this new study shows the impressive things it can do.\r\n\r\nAccording to Smithsonian Magazine, scientists used the device to sample the breaths of more than 1,400 people and found it could diagnose 17 different diseases—Parkinson\'s, lung cancer, kidney failure, MS, Crohn\'s disease, ovarian cancer, and prostate cancer, just to name a few—with 86% accuracy.\r\n\r\nHaick\'s device works by using artificially intelligent nanoarrays to "smell" a person\'s breath and identify volatile organic compounds at a molecular level. Thirteen of these compounds, in various amounts and combinations, create a unique "breathprint" for diseases.', NULL, NULL, 'SCIENCE', '2017-01-02 03:42:59', 0, 0),
(10000014, 100000, '9 wacky ways to see Santa Claus this year | Fox News', 'http://www.foxnews.com/travel/2016/12/07/9-wacky-ways-to-see-santa-claus-this-year.html', NULL, 'http://a57.foxnews.com/images.foxnews.com/content/fox-news/travel/2016/12/07/10-wacky-ways-to-see-santa-claus-this-year/_jcr_content/article-text/article-par-5/images/image.img.jpg/880/558/1481143647860.jpg?ve=1&tl=1', 'www.foxnews.com', 'NEWS', '2017-01-02 03:43:51', 0, 0),
(10000015, 100000, 'Flight attendants can\'t \'think straight\' after \'toxic fumes\' leak | Fox News', 'http://www.foxnews.com/world/2017/01/01/flight-attendants-cant-think-straight-after-toxic-fumes-leak.html', NULL, 'http://a57.foxnews.com/images.foxnews.com/content/fox-news/world/2017/01/01/flight-attendants-cant-think-straight-after-toxic-fumes-leak/_jcr_content/par/featured-media/media-0.img.jpg/876/493/1483274469597.jpg?ve=1&tl=1', 'www.foxnews.com', 'NEWS', '2017-01-02 03:44:13', 0, 0),
(10000016, 100000, 'The best concept yachts of 2016 | Fox News', 'http://www.foxnews.com/travel/2016/12/29/best-concept-yachts-2016.html', NULL, 'http://a57.foxnews.com/images.foxnews.com/content/fox-news/travel/2016/12/29/best-concept-yachts-2016/_jcr_content/par/featured-media/media-0.img.jpg/876/493/1481818559947.jpg?ve=1&tl=1', 'www.foxnews.com', 'WORLDNEWS', '2017-01-02 03:45:34', 0, 0),
(10000017, 100000, 'The best concept yachts of 2016 | Fox News', 'http://www.foxnews.com/travel/2016/12/29/best-concept-yachts-2016.html', NULL, 'http://a57.foxnews.com/images.foxnews.com/content/fox-news/travel/2016/12/29/best-concept-yachts-2016/_jcr_content/par/featured-media/media-0.img.jpg/876/493/1481818559947.jpg?ve=1&tl=1', 'www.foxnews.com', 'WORLDNEWS', '2017-01-02 03:46:17', 0, 0),
(10000018, 100000, 'Korean airline will allow crew members to use stun guns | Fox News', 'http://www.foxnews.com/travel/2016/12/27/korean-airline-will-allow-crew-members-to-use-stun-guns.html', NULL, 'http://a57.foxnews.com/images.foxnews.com/content/fox-news/travel/2016/12/27/korean-airline-will-allow-crew-members-to-use-stun-guns/_jcr_content/par/featured-media/media-0.img.jpg/876/493/1482845922160.jpg?ve=1&tl=1', 'www.foxnews.com', 'NEWS', '2017-01-02 03:46:35', 0, 0),
(10000019, 100000, 'Vandal changes iconic LA sign to \'Hollyweed\' | Fox News', 'http://www.foxnews.com/us/2017/01/01/vandal-changes-iconic-la-sign-to-hollyweed.html', NULL, 'http://a57.foxnews.com/images.foxnews.com/content/fox-news/us/2017/01/01/vandal-changes-iconic-la-sign-to-hollyweed/_jcr_content/par/featured-media/media-0.img.jpg/876/493/1483297451886.jpg?ve=1&tl=1', 'www.foxnews.com', 'NEWS', '2017-01-02 03:47:52', 0, 0),
(10000020, 100000, '10 Unusual Places to Hang Christmas Stockings | Fox News', 'http://www.foxnews.com/leisure/2016/12/23/10-unusual-places-to-hang-christmas-stockings/', NULL, 'http://global.fncstatic.com/static/managed/img/share/source/houzz.png', 'www.foxnews.com', 'NEWS', '2017-01-02 03:48:51', 0, 0),
(10000021, 100000, 'New Groove: Vinyl Floors Are Back! | Fox News', 'http://www.foxnews.com/leisure/2016/12/23/new-groove-vinyl-floors-are-back/', NULL, 'http://global.fncstatic.com/static/managed/img/share/source/houzz.png', 'www.foxnews.com', 'NEWS', '2017-01-02 03:49:58', 0, 0),
(10000022, 100000, 'Obama\'s full-blown, year-end temper tantrum | Fox News', 'http://www.foxnews.com/opinion/2016/12/30/obamas-full-blown-year-end-temper-tantrum.html', NULL, 'http://a57.foxnews.com/images.foxnews.com/content/fox-news/opinion/2016/12/30/obamas-full-blown-year-end-temper-tantrum/_jcr_content/par/featured-media/media-0.img.jpg/876/493/1483122077360.jpg?ve=1&tl=1', 'www.foxnews.com', 'WORLDNEWS', '2017-01-02 03:51:32', 0, 0),
(10000030, 100000, 'Billie Lourd speaks out on deaths of mother Carrie Fisher, grandmother | Fox News', 'http://www.foxnews.com/entertainment/2017/01/02/billie-lourd-speaks-out-on-deaths-mother-carrie-fisher-grandmother.html', NULL, 'http://a57.foxnews.com/images.foxnews.com/content/fox-news/entertainment/2017/01/02/billie-lourd-speaks-out-on-deaths-mother-carrie-fisher-grandmother/_jcr_content/par/featured-media/media-0.img.jpg/876/493/1483399145585.jpg?ve=1&tl=1', 'www.foxnews.com', 'WORLDNEWS', '2017-01-03 02:41:09', 0, 0),
(10000023, 100000, '6 surprising facts about french fries | Fox News', 'http://www.foxnews.com/food-drink/2017/01/02/6-surprising-facts-about-french-fries.html', NULL, 'http://a57.foxnews.com/images.foxnews.com/content/fox-news/food-drink/2017/01/02/6-surprising-facts-about-french-fries/_jcr_content/par/featured-media/media-0.img.jpg/876/493/1483107684238.jpg?ve=1&tl=1', 'www.foxnews.com', 'NEWS', '2017-01-02 17:27:45', 0, 0),
(10000024, 100000, 'Annoyed Picard · Memeful', 'http://memeful.com/edit/Annoyed-Picard', NULL, NULL, 'memeful.com', 'FUNNY', '2017-01-02 21:37:27', 0, 0),
(10000025, 100000, 'Dota 2 Best WTF Moments 2016 - YouTube', 'https://www.youtube.com/watch?v=SgiPK9uDrI8', NULL, 'http://yt3.ggpht.com/4KHLzth-MIVTyf1FDECMK2ZWB6spVdRGBrXXdmK7Ur1FP8dur8naTNtRiw_l1PDN7s-835OFsZ0bobZt-0s=w40-nd', 'www.youtube.com', 'VIDEOS', '2017-01-02 21:39:05', 0, 0),
(10000026, 100000, 'Rogue One (2016) - IMDb', 'http://www.imdb.com/title/tt3748528/', NULL, 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjc5Njc4NDc1MV5BMl5BanBnXkFtZTgwNzA3NzU3OTE@._V1_SY525_CR45,0,700,525_AL_.jpg', 'www.imdb.com', 'MOVIES', '2017-01-02 21:42:48', 0, 0),
(10000027, 100000, 'Caravan Palace - Wonderland - YouTube', 'https://youtu.be/vCXsRoyFRQE', NULL, 'https://i.ytimg.com/vi/vCXsRoyFRQE/hqdefault.jpg?custom=true&w=336&h=188&stc=true&jpg444=true&jpgq=90&sp=68&sigh=5iFr-e6JQWJDIpP0U1bQ_vxpzdY', 'youtu.be', 'MUSIC', '2017-01-02 21:44:01', 0, 0),
(10000028, 100000, 'Game of Thrones - Wikipedia', 'https://en.wikipedia.org/wiki/Game_of_Thrones', NULL, 'https://upload.wikimedia.org/wikipedia/en/d/d8/Game_of_Thrones_title_card.jpg', 'en.wikipedia.org', 'TELEVISION', '2017-01-02 21:53:30', 0, 1),
(10000029, 100000, 'Coding for Kids | Tynker', 'https://www.tynker.com/', NULL, 'https://www.tynker.com//image/homepage-update/ourmission-1200.jpg', 'www.tynker.com', 'CODING', '2017-01-02 21:56:40', 0, 0),
(10000031, 100000, 'IBM working on bot to help elderly age at home | Fox News', 'http://www.foxnews.com/tech/2017/01/03/ibm-working-on-bot-to-help-elderly-age-at-home.html', NULL, 'http://a57.foxnews.com/images.foxnews.com/content/fox-news/tech/2017/01/03/ibm-working-on-bot-to-help-elderly-age-at-home/_jcr_content/par/featured-media/media-0.img.jpg/876/493/1483480244101.jpg?ve=1&tl=1', 'www.foxnews.com', 'NEWS', '2017-01-04 04:31:24', 0, 1),
(10000032, 100000, 'Jenny McCarthy: Mariah Carey should stop blaming everyone else for NYE | Fox News', 'http://www.foxnews.com/entertainment/2017/01/03/jenny-mccarthy-mariah-carey-should-stop-blaming-everyone-else-for-nye.html', NULL, 'http://a57.foxnews.com/images.foxnews.com/content/fox-news/entertainment/2017/01/03/jenny-mccarthy-says-mariah-carey-should-stop-blaming-others-for-nye-performance/_jcr_content/par/featured-media/media-0.img.jpg/876/493/1483472892039.jpg?ve=1&tl=1', 'www.foxnews.com', 'NEWS', '2017-01-04 04:34:55', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `id` int(11) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `uid` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `score` int(7) NOT NULL,
  `comments` int(7) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`id`, `content`, `pid`, `uid`, `created`, `score`, `comments`) VALUES
(100000000, 'sample comment', 10000008, 100000, '2017-01-02 03:53:17', 1, 0),
(100000001, 'sample comment1', 10000003, 100000, '2017-01-02 03:53:37', 0, 0),
(100000002, 'sample comment2', 10000003, 100000, '2017-01-02 03:53:48', 0, 0),
(100000003, 'sample comment1', 10000002, 100000, '2017-01-02 03:55:27', 0, 0),
(100000004, 'sample comment2', 10000002, 100000, '2017-01-02 03:55:36', 1, 0),
(100000005, 'sample comment3', 10000002, 100000, '2017-01-02 03:55:44', 0, 0),
(100000006, 'sample comment4', 10000002, 100000, '2017-01-02 03:55:54', 0, 1),
(100000007, 'sample comment5', 10000002, 100000, '2017-01-02 03:56:04', 0, 0),
(100000008, 'sample comment level1', 100000006, 100000, '2017-01-02 03:56:28', 0, 1),
(100000009, 'sample comment level2', 100000008, 100000, '2017-01-02 03:56:38', 0, 0),
(100000010, 'sample comment', 10000028, 100000, '2017-01-04 04:35:25', 0, 1),
(100000011, 'sample comment level1', 100000010, 100000, '2017-01-04 04:35:34', 0, 0),
(100000012, 'sample comment', 10000031, 100000, '2017-01-04 04:35:47', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(33) NOT NULL,
  `email` varchar(33) NOT NULL,
  `karma` int(7) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `karma`, `created`) VALUES
(100000, 'exampleuser', 'b23cf2d0fb74b0ffa0cf4c70e6e04926', 'example@gmail.com', 0, '2017-01-02 03:09:03');

-- --------------------------------------------------------

--
-- Table structure for table `vote_link`
--

CREATE TABLE `vote_link` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `linkid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `vote_link`
--

INSERT INTO `vote_link` (`id`, `uid`, `linkid`) VALUES
(1, 100000, 10000007);

-- --------------------------------------------------------

--
-- Table structure for table `vote_reply`
--

CREATE TABLE `vote_reply` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `reply_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `vote_reply`
--

INSERT INTO `vote_reply` (`id`, `uid`, `reply_id`) VALUES
(1, 100000, 100000004),
(2, 100000, 100000000);

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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000033;
--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100000013;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100001;
--
-- AUTO_INCREMENT for table `vote_link`
--
ALTER TABLE `vote_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vote_reply`
--
ALTER TABLE `vote_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
