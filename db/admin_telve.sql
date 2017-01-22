-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 22, 2017 at 02:14 PM
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
(2, 1, 'En pahalı yemin töreni - Dünya Haberleri', 'http://www.hurriyet.com.tr/en-pahali-yemin-toreni-40340912', 'Donald Trump bugün resmen ABD Başkanı olacak. Trump’ın ABD Kongresi’nin bahçesindeki yemin törenine 900 bin kişinin katılması bekleniyor. Yemin töreninin masrafı 200 milyon doları bulacak.', 'http://i.hurimg.com/i/hurriyet/90/590x332/58812be467b0a92e545b3867.jpg', 'www.hurriyet.com.tr', 'HABER', '2017-01-20 03:17:49', 0, 0, 0, 0, 1),
(3, 1, 'Baklava', NULL, 'Baklava, Türk, Orta Doğu, Balkan ve Güney Asya mutfaklarında yer etmiş önemli bir hamur tatlısıdır. İnce yufkaların arasına yöreye göre ceviz, antep fıstığı, badem veya fındık konarak yapılır. Genel olarak şeker şerbeti ile tatlandırılır. Ayrıca bal şerbeti de kullanılabilir. Bazı ticari firmalar kendi özel şerbetlerini kullanırlar.\r\n\r\nAB Komisyonu tarafından 8 Ağustos 2013 Tarihinde baklavanın Türk tatlısı olduğu tescil edilmiştir.', NULL, NULL, 'YEMEK', '2017-01-20 03:33:25', 0, 0, 0, 0, 1),
(4, 1, 'Afilli Filtrelerden Vazgeçemeyen Selfie Tutkunlarını Ele Geçiren Yeni Çılgınlık: Meitu - onedio.com', 'https://onedio.com/haber/afilli-filtrelerden-vazgecemeyen-selfie-tutkunlarini-ele-geciren-yeni-cilginlik-meitu-752027', 'Fotoğraf Galerisi.', 'https://onedio.com//images/logo/onedio-new2x-new.png', 'onedio.com', 'KOMİK', '2017-01-20 03:50:13', 0, 0, 0, 0, 1),
(5, 1, 'iPhone 10 yaşında: Apple’ın en önemli ürününün görsel tarihi', 'http://www.teknoblog.com/iphone-10-yasinda-140170/', 'iPhone 10 yıl önce tanıtıldığında yeni bir dönemin kapılarını açmıştı. iPhone\'un 10 yıllık yolculuğunun adımlarını sizler için bir kez daha sıraladık.', 'http://static.teknoblog.com/wp-content/uploads/2017/01/steve-jobs-iphone-110117.jpg', 'www.teknoblog.com', 'TEKNOLOJİ', '2017-01-20 03:53:31', -1, 0, 1, 0, 1),
(6, 1, 'Çin, Saniyede Milyarlarca İşlem Yapabilen Dünyanın İlk Süper Bilgisayarını Yapıyor!', 'http://www.webtekno.com/cin-dunyanin-ilk-saniyede-milyarlarca-islem-yapabilen-super-bilgisayarini-yapiyor-h24317.html', 'Çin, 2017 bitmeden saniyede milyarlarca işlem yapabilen dünyanın ilk exa ölçekli süper bilgisayar prototipini yapmayı planlıyor.', 'http://www.webtekno.com//images/editor/default/0001/09/b226776d500d71c0c2fa775d5922672b59812b4c.jpeg', 'www.webtekno.com', 'TEKNOLOJİ', '2017-01-20 03:55:47', 0, 0, 0, 0, 1),
(7, 1, 'Türk Hava Yolları\'nın Yeni Reklam Yüzü Dünya Yıldızı Morgan Freeman Oldu!', 'http://www.webtekno.com/turk-hava-yollari-nin-yeni-reklam-yuzu-dunya-yildizi-morgan-freeman-oldu-h24330.html', 'Türk Hava Yolları, 800 milyon kişinin izlediği Super Bowl finalindeki reklamı için dünyaca ünlü oyuncu Morgan Freeman ile anlaştı.', 'http://cdn.webtekno.com/media/cache/content_detail_v2/article/24330/turk-hava-yollari-nin-yeni-reklam-yuzu-dunya-yildizi-morgan-freeman-oldu-1484853694.jpg', 'www.webtekno.com', 'HABER', '2017-01-20 03:57:08', 0, 0, 0, 0, 1),
(8, 1, 'CIA, UFO Kayıtları ve Psişik Deneylerin Bulunduğu Dosyaları Yayınladı!', 'http://www.webtekno.com/cia-ufo-kayitlari-ve-psisik-deneylerin-bulundugu-dosyalari-yayinladi-h24331.html', 'CIA\'in bir süre önce yayınladığını 13 milyon sayfadan oluşan dosyalarda oldukça ilgi çekici şeyler mevcut.', 'http://www.webtekno.com//images/editor/default/0001/09/9f77c3347ae303b3ebd7c2241be29b7ebf1aadc6.jpeg', 'www.webtekno.com', 'HABER', '2017-01-20 03:57:51', 0, 1, 0, 0, 1),
(9, 1, 'Logan Filminden Vizyon Öncesi Son Fragman Geldi! - Haberler - Beyazperde', 'http://www.beyazperde.com/haberler/filmler/haberler-77177/', 'Merakla beklenen X-Men spin-offu 3 Mart 2017 tarihinde ülkemize uğrayacak!', 'http://tr.web.img3.acsta.net/newsv7/17/01/19/22/02/031987.jpg', 'www.beyazperde.com', 'SİNEMA', '2017-01-20 04:00:29', 1, 0, 0, 0, 1),
(10, 1, 'Simge\'nin \'Prens ve Prenses\'i  - Müzik Haber - PowerTürk', 'http://www.powerturk.com/muzik/muzik-haber/simge-nin-prens-ve-prenses-i.html', 'Müzikseverlerin \'Miş Miş\' ve \'Yankı\' ile beğenisini kazanan ve bu şarkılar ile birçok...', 'http://asset.powerturk.com/u/img/a/s/i/simge-17kucuk-1484036422.jpg', 'www.powerturk.com', 'MÜZİK', '2017-01-20 05:46:20', 0, 0, 0, 0, 1),
(11, 1, 'AYDİLGE / KİRALIK AŞK -  Sen misin İlacım? KLİP - YouTube', 'https://www.youtube.com/watch?v=qBBIKdD2fo8', 'Yapım: Ortaks Yapım Söz-Müzik-Yorum: Aydilge Düzenleme: Alen Konakoğlu Yönetmen: Devrim Yalçın Sen misin İlacım? Yağmur dinmiyorsa Yollar bitmiyorsa Sen üzül...', 'https://i.ytimg.com/vi/qBBIKdD2fo8/maxresdefault.jpg', 'www.youtube.com', 'MÜZİK', '2017-01-20 05:52:31', 0, 0, 0, 0, 1),
(12, 1, 'Kedi Efsanelerini Test Ettik - Hıyardan Korkuyorlar Mı? - YouTube', 'https://www.youtube.com/watch?v=ebL_YWNN570', 'Bu videoda kedilerle ilgili 2 şehir efsanesini test ediyoruz. İddia edildiği gibi belirli bir alanın içinde, dışarı çıkmadan duruyorlar mı? Salatalık yahut d...', 'https://i.ytimg.com/vi/ebL_YWNN570/maxresdefault.jpg', 'www.youtube.com', 'VİDEO', '2017-01-20 06:06:42', 0, 0, 0, 0, 1),
(13, 1, 'Aleyna Tilki ft. Emrah Karaduman - Cevapsız Çınlama Rap Parodi (#OrkunaMeydanOkuyorum) - YouTube', 'https://youtu.be/MBVX26xPyR4', 'Ben Orkun Işıtmak , #OrkunaMeydanOkuyorum serisinin yeni bölümünde Aleyna Tilki ve Emrah Karaduman\'ın popüler şarkısı Cevapsız Çınlama\'nın rap versiyonunu ya...', 'https://i.ytimg.com/vi/MBVX26xPyR4/maxresdefault.jpg', 'youtu.be', 'VİDEO', '2017-01-20 06:11:04', 0, 0, 0, 0, 1),
(14, 2, 'Çavuşoğlu, Trump\'ın kabine adayları ile görüştü - Dünya Haberleri', 'http://www.hurriyet.com.tr/cavusoglu-trumpin-kabine-adaylari-ile-gorustu-40341022', 'Dışişleri Bakanı Mevlüt Çavuşoğlu, bugün yemin ederek göreve başlayacak seçilmiş Başkan Donald Trump\'ın Dışişleri Bakanı adayı Rex Tillerson ve Savunma Bakanı adayı James Mattis ile görüştü.', 'http://i.hurimg.com/i/hurriyet/90/590x332/5881b2fdc03c0e069c7b5022.jpg', 'www.hurriyet.com.tr', 'HABER', '2017-01-20 11:39:17', 0, 0, 0, 0, 1),
(15, 2, 'Futbol mutasyona uğruyor! - Spor Haberleri', 'http://www.milliyet.com.tr/futbol-mutasyona-ugruyor----2381830-skorergaleri/', 'Futbol mutasyona uğruyor!', 'http://www.milliyet.com.tr/d/i/skorer/fbskorer.jpg', 'www.milliyet.com.tr', 'HABER', '2017-01-20 11:43:48', 0, 0, 0, 0, 1),
(16, 2, 'Son dakika... Tüm gözler Washington\'da! Trump koltuğa oturuyor - Dünya Haberleri', 'http://www.milliyet.com.tr/son-dakika-tum-gozler-dunya-2381897/', 'ABD\'den son dakika haberi geldi.', 'http://icube.milliyet.com.tr/YeniAnaResim/2017/01/20/son-dakika-tum-gozler-washington-da-trump-koltuga-oturuyor-8392999.Jpeg', 'www.milliyet.com.tr', 'HABER', '2017-01-20 11:49:55', 0, 0, 0, 0, 1),
(17, 2, 'Dünyanın En Sevimli Canlıları Olan Hayvanları Mizahına Alet Edip Güldüren 21 Mizahşör - onedio.com', 'https://onedio.com/haber/dunyanin-en-sevimli-canlilari-olan-hayvanlari-mizahina-alet-edip-gulduren-21-mizahsor-752179', 'Fotoğraf Galerisi.', 'https://img-s1.onedio.com/id-588223197102a6fc1b031456/rev-0/w-500/s-1e8765b71ca37e1174fcdb41ef3432dbc5f27c9d.jpg', 'onedio.com', 'KOMİK', '2017-01-21 02:17:37', 0, 0, 0, 0, 1),
(18, 2, 'Son dakika... Eşi benzeri olmayan çatışma! - Dünya Haberleri', 'http://www.milliyet.com.tr/son-dakika-esi-benzeri-olmayan-dunya-2382192/', 'Son dakika... Trump başkanlık koltuğuna oturdu! Eşi benzeri görülmedi.', 'http://icube.milliyet.com.tr/YeniAnaResim/2017/01/20/son-dakika-esi-benzeri-olmayan-catisma--8396724.Jpeg', 'www.milliyet.com.tr', 'HABER', '2017-01-21 02:24:04', 0, 0, 0, 0, 1),
(19, 2, 'Büyümeye 1 puan konuttan gelecek - Ekonomi Haberleri', 'http://www.sabah.com.tr/ekonomi/2017/01/21/buyumeye-1-puan-konuttan-gelecek', 'Konutta şubatta başlaması beklenen yeni seferberlik ile faiz % 0.40 kadar gerileyecek. Özellikle dar gelirlilere yönelik projenin büyümeyi de 1 puan artırması bekleniyor', 'http://ia.sabah.com.tr/3b6164/650/344/0/0/956/505?u=http://i.sabah.com.tr/sbh/2017/01/21/buyumeye-1-puan-konuttan-gelecek-1484953478739.jpg', 'www.sabah.com.tr', 'HABER', '2017-01-21 02:26:15', 0, 0, 0, 0, 1),
(20, 2, 'Son dakika: ikinci tur oylama bitti tasarının tümü oylanıyor - Siyaset Haberleri', 'http://www.milliyet.com.tr/son-dakika-anayasa-degisiklik-siyaset-2382369/', 'Son dakika: Anayasa değişiklik teklifi 339 \'evet\' oyuyla yasalaştı.', 'http://icube.milliyet.com.tr/YeniAnaResim/2017/01/21/son-dakika-anayasa-degisiklik-teklifinin-ikinci-turunda-18-inci-madde-gorusuluyor-8397899.Jpeg', 'www.milliyet.com.tr', 'HABER', '2017-01-21 04:05:40', 0, 0, 0, 0, 1),
(21, 2, 'Washington\'daki Trump karşıtı gösterilerde şiddet artıyor', 'http://www.ensonhaber.com/washingtondaki-trump-karsiti-gosteriler-2017-01-21.html', 'Başkentteki protestolarda 200\'ü aşkın gösterici gözaltına alındı, 6 polisin de aralarında bulunduğu çok sayıda kişi yaralandı.', 'http://i.cdn.ensonhaber.com/resimler/diger/trump-limuzin_872.jpg', 'www.ensonhaber.com', 'HABER', '2017-01-21 09:57:44', 0, 0, 0, 0, 1),
(22, 2, 'Trump konuştu, dolar d&uuml;şt&uuml;! - Ekonomi Haberleri', 'http://ekonomi.haber7.com/ekonomi/haber/2248440-trump-konustu-dolar-dustu', 'ABD\'nin 45. Başkanı Donald Trump\'ın, ABD Kongresi\'ndeki t&ouml;rende yemin ederek yaptığı ilk resmi konuşmanın ardından New York borsasında kayıplar, ABD dolarında d&uuml;ş&uuml;ş g&ouml;r&uuml;ld&uuml;.', 'http://image.cdn.haber7.com//haber/haber7/thumbs/2017/03/trumpin_yillik_buyume_hedefi_yuzde_4_1484980285_9418.jpg', 'ekonomi.haber7.com', 'HABER', '2017-01-21 09:58:26', 0, 0, 0, 0, 1),
(23, 2, 'HDP\'li vekilin s&ouml;zleri Bah&ccedil;eli\'yi g&uuml;ld&uuml;rd&uuml;! - SİYASET Haberleri', 'http://www.haber7.com/siyaset/haber/2248509-hdpli-vekilin-sozleri-bahceliyi-guldurdu', 'Anayasa değişikliği teklifinin kabul edildiği gece HDP\'li Sırrı S&uuml;reyya &Ouml;nder\'in k&uuml;rs&uuml; konuşması sırasında s&ouml;ylediği s&ouml;zler, MHP Genel Başkanı Devlet Bah&ccedil;eli\'yi g&uuml;ld&uuml;rd&uuml;.', 'http://image.cdn.haber7.com//haber/haber7/photos/2017/03/hdpli_vekilin_sozleri_bahceliyi_guldurdu_1484981623_6483.jpg', 'www.haber7.com', 'HABER', '2017-01-21 10:00:22', 0, 0, 0, 0, 1),
(24, 1, 'Kalisi ne gulüyon?', 'https://media.giphy.com/media/Ts6KGvz9qETM4/giphy.gif', NULL, 'https://media.giphy.com/media/Ts6KGvz9qETM4/giphy.gif', 'media.giphy.com', 'GİF', '2017-01-21 10:21:04', 0, 0, 0, 0, 1),
(25, 1, 'Horizon: Zero Dawn - Turuncu Levye', 'http://www.turunculevye.com/oyunlar/goster/horizon-zero-dawn', 'Guerilla Games tarafından geliştirilmekte olan Horizon: Zero Dawn, PlayStation 4 platformuna özel yeni bir projedir. Horizon: Zero Dawn Oyun İncelemesi, Sistem Özellikleri, Ekran Görüntüleri, Videoları ve Horizon: Zero Dawn Haberleri', 'http://img.turunculevye.com/thumbnails/2015/06/horizon_slide_slide.jpg', 'www.turunculevye.com', 'OYUN', '2017-01-21 10:24:17', 0, 0, 0, 0, 1),
(26, 2, '2017 yılında çıkacak oyunlar! - ShiftDelete.Net', 'http://shiftdelete.net/2017-yilinda-cikacak-oyunlar-77521', '2017 yılında çıkacak oyunlarla karşınızdayız. 2017 yılında bizleri yine harika oyunlar bekliyor. Hazırladığımız liste ile 2017\'nin en çok beklenen oyunlarını görebilirsiniz.', 'http://s01.shiftdelete.net/img/general_b/16-12/14/2017-yilinda-cikacak-tum-oyunlar-1.jpg', 'shiftdelete.net', 'OYUN', '2017-01-21 10:25:28', 0, 0, 0, 0, 1),
(27, 1, 'Bu Ivana sert mi? Sertse yumuşatmak mümkün mü?', 'http://www.butarzbenim.net/wp-content/uploads/2014/09/bu-tarz-benim-8-bolum-23-eylul-21.jpg', NULL, 'http://www.butarzbenim.net/wp-content/uploads/2014/09/bu-tarz-benim-8-bolum-23-eylul-21.jpg', 'www.butarzbenim.net', 'SOR', '2017-01-21 10:33:44', 0, 0, 0, 0, 1),
(28, 1, 'İstanbul\'a daha kar yağar mı? Okullar tatil olur mu?', 'http://img.haberler.com/haber/579/istanbul-icin-beklenen-kar-yilbasinda-geliyor-8006579_x_8007_o.jpg', NULL, 'http://img.haberler.com/haber/579/istanbul-icin-beklenen-kar-yilbasinda-geliyor-8006579_x_8007_o.jpg', 'img.haberler.com', 'SOR', '2017-01-21 10:35:34', 0, 0, 0, 0, 1),
(29, 1, 'Hangi Linux dağıtımı en iyisi?', 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/35/Tux.svg/2000px-Tux.svg.png', NULL, 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/35/Tux.svg/2000px-Tux.svg.png', 'upload.wikimedia.org', 'SOR', '2017-01-21 10:37:38', 0, 0, 0, 0, 1),
(30, 1, 'Ünlü giyimcinin AVM isyanı: Herkes haddini bilecek - Ekonomi Haberleri', 'http://www.hurriyet.com.tr/unlu-giyimcinin-avm-isyani-herkes-haddini-bilecek-40342255', 'AVM Endeksi\'ne göre Türkiye\'de 377 AVM var. Sadece 20 kentte AVM bulunmuyor. Erkek giyim markası Kiğılı\'nın Yönetim Kurulu Başkanı Abdullah Kiğılı, Terörü hallettiğimiz takdirde yabancı AVM yatırımcılarıyla bu işi çözeceğiz.. O zaman daha hızlı büyüye...', 'http://i.hurimg.com/i/hurriyet/90/0x0/58830db318c77310540d2ab8.jpg', 'www.hurriyet.com.tr', 'HABER', '2017-01-21 10:46:30', 0, 0, 0, 0, 1),
(31, 1, 'Saffet Sancaklı: Bu olay çok ağır geldi, bir mucize bekliyoruz Allah\'tan - Son Dakika Gündem Haberleri', 'http://www.hurriyet.com.tr/saffet-sancakli-bu-olay-cok-agir-geldi-bir-mucize-bekliyoruz-allahtan-40342163', 'MHP Kocaeli Milletvekili Saffet Sancaklı, Meclis kürsüsünde yaptığı konuşmada  intihar girişiminde bulunan eşi Hülya Sancaklı için dua istedi.  Sancaklı, Bu olay çok ağır geldi bana. Allah kimseye vermesin. 6 günü geçtik, 7’nci güne girdik. Allah’ın d...', 'http://i.hurimg.com/i/hurriyet/90/590x332/5882d85818c77310540d2867.jpg', 'www.hurriyet.com.tr', 'HABER', '2017-01-21 10:48:22', 0, 0, 0, 0, 1),
(32, 1, 'Ocak ayı otomobil kampanyaları - Ekonomi Haberleri', 'http://www.hurriyet.com.tr/galeri-40341840', '2017 yılına girişle birlikte otomobil firmaları hem ÖTV bazında hem de döviz kurlarındaki sabitlemelerle kampanyalara başladı.', 'http://i.hurimg.com/i/hurriyet/90/0x0/5882fb6fc03c0e2c1c461f76.jpg', 'www.hurriyet.com.tr', 'HABER', '2017-01-21 10:48:57', 0, 0, 0, 0, 1),
(33, 2, 'Dijital dünyanın yeni yıldızı Sena Şener - Hayat Haberleri', 'http://www.hurriyet.com.tr/dijital-dunyanin-yeni-yildizi-sena-sener-40342613', 'Kocaman, kıvır kıvır saçları, ışıldayan gözleriyle bir masal kahramanını andırıyor. Daha 18 yaşında... Ama hayallerini gerçekleştirme yolunda önemli adımlar attı bile. Evde yaptığı kayıtları Soundcloud hesabına yükledikten kısa süre sonra dikkatleri üz...', 'http://i.hurimg.com/i/hurriyet/90/0x0/588369690f25440ff0ebbd9b.jpg', 'www.hurriyet.com.tr', 'MÜZİK', '2017-01-22 12:15:09', 0, 0, 0, 0, 1),
(34, 1, 'ODTÜ - Orta Doğu Teknik Üniversitesi | BİZLER DÜNYAYI DEĞİŞTİREBİLİRİZ', 'http://www.metu.edu.tr/tr', 'BİZLER DÜNYAYI DEĞİŞTİREBİLİRİZ', 'http://www.metu.edu.tr/tr/system/files/slider/cover/butunleme-01-tr.png', 'www.metu.edu.tr', 'ÜNİVERSİTE', '2017-01-22 12:26:27', 0, 0, 0, 0, 1),
(35, 1, 'Napoli 9 dakikada bitirdi! | NTVSpor.net', 'http://www.ntvspor.net/futbol/napoli-9-dakikada-bitirdi-5883d63cf7022736e481f885', NULL, 'http://cdn.ntvspor.net/6deb0c055bd44456bdda1da47266f811.jpg?crop=0,29,940,558', 'www.ntvspor.net', 'FUTBOL', '2017-01-22 12:33:31', 0, 0, 0, 0, 1),
(36, 1, 'Yasin&#39;in rekor sezonu! | NTVSpor.net', 'http://www.ntvspor.net/futbol/yasin-in-rekor-sezonu-58838ec9f7022736e481f74d', NULL, 'http://cdn.ntvspor.net/ae0335b57aab4644b47c236eb5439f53.jpg?crop=0,65,940,594', 'www.ntvspor.net', 'FUTBOL', '2017-01-22 12:34:08', 0, 0, 0, 0, 1),
(37, 1, 'Kawhi Leonard şampiyonu devirdi | NTVSpor.net', 'http://www.ntvspor.net/basketbol/kawhi-leonard-sampiyonu-devirdi-588462a2f7022736e481f8dc', NULL, 'http://cdn.ntvspor.net/ff0fca959850445fb43b9c4c3918ec08.jpg?crop=0,0,941,529', 'www.ntvspor.net', 'BASKETBOL', '2017-01-22 12:34:48', 0, 0, 0, 0, 1);

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
('RESİM', NULL, 0, 'https://3b0ad08da0832cf37cf5-435f6e4c96078b01f281ebf62986b022.ssl.cf3.rackcdn.com/articles/content/Catteries-and-Cat%20Sitting-Services.jpg', 0, '2017-01-20 03:09:34'),
('HABER', NULL, 1, 'http://farm9.staticflickr.com/8228/8434207887_1eb86f546e_o.jpg', 0, '2017-01-20 03:17:49'),
('YEMEK', NULL, 0, 'https://www.westindiessoul.com/wp-content/uploads/2014/06/banner03.jpg', 1, '2017-01-20 03:33:25'),
('KOMİK', NULL, 1, 'https://lh4.googleusercontent.com/-4DUyyZvKaKA/UsCOHaIufFI/AAAAAAAAAEU/xRMrY0AAAmQ/s0-d/meme_collage.jpg', 0, '2017-01-20 03:50:13'),
('TEKNOLOJİ', NULL, 1, 'http://www.fixxit.co.ke/fix/fixiit/images/nootheme/vidavo_slider/technology_2560-x-720.jpg', 0, '2017-01-20 03:53:31'),
('SİNEMA', NULL, 0, 'http://www.smarto.com.tr/wp-content/uploads/2015/04/sinema-cinema-istanbul.jpg', 0, '2017-01-20 04:00:29'),
('MÜZİK', NULL, 0, 'http://az616578.vo.msecnd.net/files/2016/07/31/6360553665687961831595419134_concertsfandom.jpg', 0, '2017-01-20 05:46:20'),
('VİDEO', NULL, 1, 'http://jimroyal.com/wp-content/uploads/2016/08/Videos.jpg', 0, '2017-01-20 06:06:42'),
('GİF', NULL, 0, NULL, 0, '2017-01-21 10:21:04'),
('OYUN', NULL, 0, NULL, 0, '2017-01-21 10:24:17'),
('SOR', NULL, 0, 'http://wallpaper.zone/img/4035664.jpg', 0, '2017-01-21 10:33:44'),
('ÜNİVERSİTE', NULL, 0, NULL, 0, '2017-01-22 12:26:27'),
('FUTBOL', NULL, 0, NULL, 0, '2017-01-22 12:33:31'),
('BASKETBOL', NULL, 0, NULL, 0, '2017-01-22 12:34:48');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
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
