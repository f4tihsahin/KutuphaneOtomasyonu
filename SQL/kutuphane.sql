-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 12 Oca 2019, 15:04:42
-- Sunucu sürümü: 5.7.24-0ubuntu0.18.04.1
-- PHP Sürümü: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `kutuphane`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `giriskayitlari`
--

CREATE TABLE `giriskayitlari` (
  `id` int(11) NOT NULL,
  `ogrenciNo` varchar(255) NOT NULL,
  `kullaniciIP` binary(16) NOT NULL,
  `girisZamani` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cikisZamani` varchar(255) NOT NULL,
  `durumBilgisi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `giriskayitlari`
--

INSERT INTO `giriskayitlari` (`id`, `ogrenciNo`, `kullaniciIP`, `girisZamani`, `cikisZamani`, `durumBilgisi`) VALUES
(1, '3', 0x38382e3235352e3231382e3235340000, '2018-12-26 14:38:26', '', 1),
(2, '3', 0x38382e3235352e3231382e3235340000, '2018-12-26 15:50:38', '', 1),
(3, '3', 0x38382e3235352e3231382e3235340000, '2019-01-02 08:44:20', '', 1),
(4, '3 ', 0x38382e3235352e3231382e3235340000, '2019-01-02 09:49:05', '02-01-2019 01:30:47 PM', 1),
(5, '5', 0x38382e3235352e3231382e3235340000, '2019-01-02 10:30:51', '02-01-2019 01:35:04 PM', 1),
(6, '3', 0x38382e3235352e3231382e3235340000, '2019-01-02 10:35:08', '', 1),
(7, '5', 0x38382e3235352e3231382e3235340000, '2019-01-07 15:35:17', '', 1),
(8, '5', 0x3231332e37342e3134322e3133300000, '2019-01-07 16:12:59', '', 1),
(9, '5', 0x38382e3235352e3231382e3235340000, '2019-01-07 16:58:09', '', 1),
(10, '5', 0x38382e3235352e3231382e3235340000, '2019-01-07 17:02:02', '', 1),
(11, '5', 0x38382e3235352e3231382e3235340000, '2019-01-08 09:30:19', '08-01-2019 12:30:27 PM', 1),
(12, '5', 0x38382e3235352e3231382e3235340000, '2019-01-08 09:37:29', '', 1),
(13, '5', 0x38382e3235352e3231382e3235340000, '2019-01-08 09:51:55', '', 1),
(14, '3', 0x38382e3235352e3231382e3235340000, '2019-01-08 10:26:22', '', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategoriAdi` varchar(255) NOT NULL,
  `eklemeTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `kategori`
--

INSERT INTO `kategori` (`id`, `kategoriAdi`, `eklemeTarihi`) VALUES
(9, 'Ekonomi', '2019-01-07 17:01:36'),
(10, 'Tarih', '2019-01-08 09:49:23'),
(11, 'Bilim Kurgu', '2019-01-08 09:49:27'),
(12, 'Ä°slam', '2019-01-08 09:49:30'),
(13, 'Teknoloji', '2019-01-08 09:49:34'),
(14, 'Fantastik', '2019-01-08 09:49:38'),
(15, 'Polisiye', '2019-01-08 09:49:44');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kitap`
--

CREATE TABLE `kitap` (
  `id` int(11) NOT NULL,
  `kategoriid` int(11) NOT NULL,
  `kitapAdi` varchar(255) NOT NULL,
  `yazar` varchar(255) NOT NULL,
  `eklemeTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `guncellemeTarihi` text NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `kitap`
--

INSERT INTO `kitap` (`id`, `kategoriid`, `kitapAdi`, `yazar`, `eklemeTarihi`, `guncellemeTarihi`, `stok`) VALUES
(13, 9, 'UluslarÄ±n DÃ¼ÅŸÃ¼ÅŸÃ¼', 'Daron AcemoÄŸlu', '2019-01-07 17:01:52', '', 2),
(14, 9, 'GÃ¶rÃ¼nmeyen Ekonomist', 'Tim Hanford', '2019-01-08 09:50:20', '', 1),
(15, 10, 'Hayvanlardan TanrÄ±lara Sapiens', 'Yuval Harari', '2019-01-08 09:50:51', '', 1),
(16, 11, 'Zaman Makinesi', 'H.G. Wells', '2019-01-08 09:51:20', '', 2),
(17, 13, 'BaÅŸlangÄ±Ã§', 'Dan Brown', '2019-01-08 09:51:46', '', 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kitapgecmisi`
--

CREATE TABLE `kitapgecmisi` (
  `id` int(11) NOT NULL,
  `ogrenciNo` varchar(255) NOT NULL,
  `pinKodu` int(11) NOT NULL,
  `kitap` int(11) NOT NULL,
  `durum` tinyint(1) NOT NULL,
  `kayitTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `teslimTarihi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `kitapgecmisi`
--

INSERT INTO `kitapgecmisi` (`id`, `ogrenciNo`, `pinKodu`, `kitap`, `durum`, `kayitTarihi`, `teslimTarihi`) VALUES
(5, '5', 651788, 13, 1, '2019-01-07 17:02:15', '2019-01-07 08:45:08 PM'),
(7, '5', 651788, 14, 1, '2019-01-08 09:52:06', '2019-01-08 12:52:54 PM'),
(8, '5', 651788, 17, 0, '2019-01-08 09:54:43', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenciler`
--

CREATE TABLE `ogrenciler` (
  `ogrenciNo` varchar(255) NOT NULL,
  `parola` varchar(255) NOT NULL,
  `ogrenciAdi` varchar(255) NOT NULL,
  `pinKodu` varchar(255) NOT NULL,
  `akts` decimal(10,2) NOT NULL,
  `olusturmaTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `guncellemeTarihi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `ogrenciler`
--

INSERT INTO `ogrenciler` (`ogrenciNo`, `parola`, `ogrenciAdi`, `pinKodu`, `akts`, `olusturmaTarihi`, `guncellemeTarihi`) VALUES
('1', '8f10d078b2799206cfe914b32cc6a5e9', 'Mithat', '928916', '2.50', '2018-12-14 18:42:52', ''),
('2', '8f10d078b2799206cfe914b32cc6a5e9', 'Temel', '979319', '0.00', '2018-12-14 18:43:00', '21-12-2018 04:51:12 PM'),
('3', '8f10d078b2799206cfe914b32cc6a5e9', 'Dursun', '188737', '0.00', '2018-12-14 18:43:06', '24-12-2018 11:36:43 PM'),
('4', '8f10d078b2799206cfe914b32cc6a5e9', 'Ahmet', '171754', '0.00', '2018-12-24 20:03:12', ''),
('5', '8f10d078b2799206cfe914b32cc6a5e9', 'TÃ¼tÃ¼n Sabri', '651788', '0.00', '2018-12-24 20:42:58', ''),
('6', '8f10d078b2799206cfe914b32cc6a5e9', 'Ahmet', '802617', '0.00', '2018-12-26 17:47:07', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `soruncozumleri`
--

CREATE TABLE `soruncozumleri` (
  `id` int(11) NOT NULL,
  `sorunid` int(11) NOT NULL,
  `yoneticiid` int(11) NOT NULL,
  `cozumaciklamasi` text NOT NULL,
  `eklemeTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `soruncozumleri`
--

INSERT INTO `soruncozumleri` (`id`, `sorunid`, `yoneticiid`, `cozumaciklamasi`, `eklemeTarihi`) VALUES
(1, 1, 1, 'Hallettim Hayati. Tekrar deneyebilir misin? deneme', '2019-01-08 09:45:19');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sorunlar`
--

CREATE TABLE `sorunlar` (
  `id` int(11) NOT NULL,
  `ogrenciNo` varchar(255) NOT NULL,
  `sorun` text NOT NULL,
  `durum` tinyint(1) NOT NULL,
  `eklemeTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `sorunlar`
--

INSERT INTO `sorunlar` (`id`, `ogrenciNo`, `sorun`, `durum`, `eklemeTarihi`) VALUES
(1, '5', 'Sistem kaÄŸnÄ± gibi Ã§alÄ±ÅŸÄ±yor', 1, '2019-01-08 09:44:47');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yonetici`
--

CREATE TABLE `yonetici` (
  `id` int(11) NOT NULL,
  `kullaniciadi` varchar(255) NOT NULL,
  `parola` varchar(255) NOT NULL,
  `olusturmaTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `guncellemeTarihi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `yonetici`
--

INSERT INTO `yonetici` (`id`, `kullaniciadi`, `parola`, `olusturmaTarihi`, `guncellemeTarihi`) VALUES
(1, 'deneme', '8f10d078b2799206cfe914b32cc6a5e9', '2019-01-07 16:57:20', '2019-01-07 16:58:20'),
(2, 'Timur Pak', '8f10d078b2799206cfe914b32cc6a5e9', '2019-01-07 16:57:20', '');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `giriskayitlari`
--
ALTER TABLE `giriskayitlari`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ogrencilergiriskayitlari` (`ogrenciNo`);

--
-- Tablo için indeksler `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kitap`
--
ALTER TABLE `kitap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_kategorikitap` (`kategoriid`);

--
-- Tablo için indeksler `kitapgecmisi`
--
ALTER TABLE `kitapgecmisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kitapkitapgecmisi` (`kitap`),
  ADD KEY `fk_ogrencilerkitapgecmisi` (`ogrenciNo`);

--
-- Tablo için indeksler `ogrenciler`
--
ALTER TABLE `ogrenciler`
  ADD PRIMARY KEY (`ogrenciNo`);

--
-- Tablo için indeksler `soruncozumleri`
--
ALTER TABLE `soruncozumleri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_yoneticisoruncozumleri` (`yoneticiid`),
  ADD KEY `fk_sorunlarsoruncozumleri` (`sorunid`);

--
-- Tablo için indeksler `sorunlar`
--
ALTER TABLE `sorunlar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ogrencilersorunlar` (`ogrenciNo`);

--
-- Tablo için indeksler `yonetici`
--
ALTER TABLE `yonetici`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `giriskayitlari`
--
ALTER TABLE `giriskayitlari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Tablo için AUTO_INCREMENT değeri `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Tablo için AUTO_INCREMENT değeri `kitap`
--
ALTER TABLE `kitap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Tablo için AUTO_INCREMENT değeri `kitapgecmisi`
--
ALTER TABLE `kitapgecmisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Tablo için AUTO_INCREMENT değeri `soruncozumleri`
--
ALTER TABLE `soruncozumleri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `sorunlar`
--
ALTER TABLE `sorunlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Tablo için AUTO_INCREMENT değeri `yonetici`
--
ALTER TABLE `yonetici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `giriskayitlari`
--
ALTER TABLE `giriskayitlari`
  ADD CONSTRAINT `fk_ogrencilergiriskayitlari` FOREIGN KEY (`ogrenciNo`) REFERENCES `ogrenciler` (`ogrenciNo`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `kitap`
--
ALTER TABLE `kitap`
  ADD CONSTRAINT `FK_kategorikitap` FOREIGN KEY (`kategoriid`) REFERENCES `kategori` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `kitapgecmisi`
--
ALTER TABLE `kitapgecmisi`
  ADD CONSTRAINT `fk_kitapkitapgecmisi` FOREIGN KEY (`kitap`) REFERENCES `kitap` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ogrencilerkitapgecmisi` FOREIGN KEY (`ogrenciNo`) REFERENCES `ogrenciler` (`ogrenciNo`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `soruncozumleri`
--
ALTER TABLE `soruncozumleri`
  ADD CONSTRAINT `fk_sorunlarsoruncozumleri` FOREIGN KEY (`sorunid`) REFERENCES `sorunlar` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_yoneticisoruncozumleri` FOREIGN KEY (`yoneticiid`) REFERENCES `yonetici` (`id`);

--
-- Tablo kısıtlamaları `sorunlar`
--
ALTER TABLE `sorunlar`
  ADD CONSTRAINT `fk_ogrencilersorunlar` FOREIGN KEY (`ogrenciNo`) REFERENCES `ogrenciler` (`ogrenciNo`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
