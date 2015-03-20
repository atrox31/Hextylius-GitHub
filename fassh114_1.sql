-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 26 Lut 2015, 09:10
-- Wersja serwera: 5.6.21
-- Wersja PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `fassh114_1`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` int(11) NOT NULL,
  `login` varchar(512) COLLATE utf8_polish_ci NOT NULL,
  `pass` varchar(512) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `admin`
--

INSERT INTO `admin` (`id`, `login`, `pass`) VALUES
(1, 'atrox', 'f7c0d1aed1d65c2da6a13cde8d8c5d8ec3090a2e');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`id` int(11) NOT NULL,
  `kind` varchar(1024) COLLATE utf8_polish_ci NOT NULL,
  `title` varchar(1024) COLLATE utf8_polish_ci NOT NULL,
  `content` varchar(5000) COLLATE utf8_polish_ci NOT NULL,
  `date` int(11) NOT NULL,
  `author` varchar(1024) COLLATE utf8_polish_ci NOT NULL,
  `image` varchar(1024) COLLATE utf8_polish_ci NOT NULL DEFAULT 'default_image'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `news`
--

INSERT INTO `news` (`id`, `kind`, `title`, `content`, `date`, `author`, `image`) VALUES
(4, 'minecraft', 'Startuje nowy serwer!', 'Nowy serwer postawiony na ip: 46.250.186.211\r\nNarazie w trakcie twoÅ¼enia jest caÅ‚y spawn, ktÃ³ry bÄ™dzie wymagaÅ‚ duÅ¼o prawcy w zbudowania go i nadanie mu wspanialego ksztaÅ‚tu! Nad wyglÄ…dem w pocie czoÅ‚a pracujÄ… nasi specialiÅ›ci krÃ³rych imiona narazie bÄ™dÄ… tajne.', 1424693355, 'atrox', 'default_image'),
(5, 'metin2', 'Strona Metin 2 juÅ¼ istnieje!', 'No i staÅ‚o siÄ™! Kolejna strona doÅ‚Ä…cza do naszego katalogu a razem z niÄ… kelejne nowoÅ›ci! Podczas gdy poÅ‚owa ekipy zajmuje siÄ™ minecraft''em (do ktÃ³rego teÅ¼ zaprawszamy) reszta skupiona jest na dopracowywaniu serwisu poÅ›cwiÄ™conego Metinem! Zaprawszamy do zwiedzania naszych Å›wiatÃ³w!', 1424771905, 'atrox', 'default_image');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
`id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `kind` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `left_panel` varchar(1024) COLLATE utf8_polish_ci NOT NULL,
  `right_panel` varchar(1024) COLLATE utf8_polish_ci NOT NULL,
  `news_per_page` int(11) NOT NULL,
  `layaut` varchar(256) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pages`
--

INSERT INTO `pages` (`id`, `name`, `kind`, `left_panel`, `right_panel`, `news_per_page`, `layaut`) VALUES
(1, 'MINECRAFT', 'minecraft', '', 'status_serwera,login_panel', 3, 'standard'),
(2, 'METIN2', 'metin2', 'login_panel,metin_ranking', 'status_serwera', 3, 'standard'),
(3, 'TIBIA', 'tibia', '', '', 4, 'standard');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `nick` varchar(1024) COLLATE utf8_polish_ci NOT NULL,
  `pass` varchar(1024) COLLATE utf8_polish_ci NOT NULL,
  `kind` varchar(128) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `news`
--
ALTER TABLE `news`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `pages`
--
ALTER TABLE `pages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
