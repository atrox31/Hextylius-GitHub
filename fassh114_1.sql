-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 29 Mar 2015, 17:27
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
-- Struktura tabeli dla tabeli `forum_category`
--

CREATE TABLE IF NOT EXISTS `forum_category` (
`id` int(11) NOT NULL,
  `name` varchar(1024) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `forum_category`
--

INSERT INTO `forum_category` (`id`, `name`) VALUES
(1, 'Minecraft'),
(2, 'Metin'),
(3, 'Tibia'),
(4, 'Kosz'),
(5, 'Administracja / Serwis');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `forum_threads`
--

CREATE TABLE IF NOT EXISTS `forum_threads` (
`id` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `last_answer` int(11) NOT NULL,
  `open` varchar(8) COLLATE utf8_polish_ci NOT NULL DEFAULT 'true',
  `name` varchar(1024) COLLATE utf8_polish_ci NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `forum_threads`
--

INSERT INTO `forum_threads` (`id`, `author`, `last_answer`, `open`, `name`, `category`) VALUES
(1, 1, 234234, 'true', 'Moja pierwsza kategoria!', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `news`
--

INSERT INTO `news` (`id`, `kind`, `title`, `content`, `date`, `author`, `image`) VALUES
(1, 'minecraft', 'LOREM IPSUM PIERWSZY NJUS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nunc mattis, posuere quam sed, efficitur ipsum. Phasellus ut urna elementum, finibus sem in, ornare velit. Praesent auctor egestas dui id gravida. Phasellus lacinia massa non iaculis facilisis. Vestibulum placerat quam non ultricies placerat. Mauris neque neque, commodo a est sit amet, ultrices laoreet sapien. Sed pellentesque interdum massa, euismod posuere arcu pulvinar sit amet. Aliquam pretium lobortis felis quis hendrerit. Sed consequat dolor efficitur, malesuada lorem id, porta nulla. Aliquam tincidunt aliquam risus at bibendum. Cras ut porttitor dui, a rhoncus mauris. Nulla eget fringilla lectus. Aenean auctor porta pellentesque. Integer viverra, nulla ut interdum pharetra, mauris ipsum volutpat odio, ut viverra tortor velit sed magna. Nunc scelerisque augue ac tellus lacinia, vel fringilla nibh luctus. Donec volutpat tincidunt malesuada. Donec interdum, massa ac consectetur lobortis, purus purus aliquet orci, ut rutrum quam augue a quam. Maecenas a euismod arcu. Aliquam vitae pellentesque lacus. Quisque ac malesuada eros. Fusce ultrices nibh enim, eget mollis diam posuere ac. Curabitur in augue ullamcorper, convallis mauris vitae, lacinia enim. Suspendisse laoreet dictum lorem. Aliquam nec lobortis sem, ut tincidunt erat.', 4681048, 'atrox', 'default_image.jpg'),
(5, 'minecraft', 'sdfgdfg', 'IstniejÄ…ce ksiÄ…Å¼ki i publikacje z reguÅ‚y koncentrujÄ… siÄ™ na wybranych aspektach czy narzÄ™dziach inÅ¼ynierii wymagaÅ„, brak jest natomiast publikacji opisujÄ…cych caÅ‚oÅ›ciowo proces inÅ¼ynierii wymagaÅ„, jego kontekst w wytwarzaniu produktu, czynnoÅ›ci i ich praktyczne zastosowanie, moÅ¼liwe ryzyka i sposoby ich unikniÄ™cia. KsiÄ…Å¼ka skierowana jest do osÃ³b zawodowo zajmujÄ…cych siÄ™ analizÄ… biznesowÄ… i systemowÄ…, odpowiedzialnych za jakoÅ›Ä‡ oprogramowania i systemÃ³w oraz architektÃ³w czy kierownikÃ³w projektÃ³w, jak rÃ³wnieÅ¼ osÃ³b pragnÄ…cych zrozumieÄ‡ wyzwania zwiÄ…zane z inÅ¼ynieriÄ… wymagaÅ„ i jej powiÄ…zania z innymi procesami w ogÃ³lnym procesie wytwarzania produktu.', 1425325065, 'atrox', 'BTNShieldElvenBearMark2.png'),
(6, 'minecraft', 'cxvbg', 'treÅ›Ä‡...', 1427040124, 'atrox', 'minecraft.png');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pages`
--

INSERT INTO `pages` (`id`, `name`, `kind`, `left_panel`, `right_panel`, `news_per_page`, `layaut`) VALUES
(1, 'MINECRAFT', 'minecraft', 'login_panel', 'status_serwera', 3, 'standard');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`id` int(11) NOT NULL,
  `thread` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `time_add` int(11) NOT NULL,
  `content` varchar(5000) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `posts`
--

INSERT INTO `posts` (`id`, `thread`, `author`, `time_add`, `content`) VALUES
(2, 1, 2, 4324345, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis nunc ex, eu dignissim nulla pulvinar sed. Sed et iaculis velit, ac vehicula purus. Sed malesuada, nisi quis temp'),
(3, 1, 1, 43445345, 'fgdgdfgdfgdfg'),
(4, 1, 1, 1427640595, 'axszcfevgrbthnjyuk, thjn, i.lo'),
(5, 1, 1, 1427640630, 'axszcfevgrbthnjyuk, thjn, i.lo'),
(6, 1, 1, 1427640644, 'dajesz'),
(7, 1, 1, 1427640828, 'rdsfge hh fhj j'),
(8, 1, 1, 1427640888, 'xcghjkl;'),
(9, 1, 1, 1427640891, 'dgfhjkhlj;k'';'),
(10, 1, 1, 1427640894, 'dfgdjkl;'''),
(11, 1, 1, 1427640898, 'ghjgfjghj\r\nfghfhg'),
(12, 1, 1, 1427641035, 'fgddgdfhfdg hfgh fh \r\nasdas fdsaf\r\nsda fasd \r\ngfdg df\r\ng dfg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rank`
--

CREATE TABLE IF NOT EXISTS `rank` (
`id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8_polish_ci NOT NULL,
  `color` varchar(8) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `rank`
--

INSERT INTO `rank` (`id`, `name`, `color`) VALUES
(1, 'n00b', 'DD2020'),
(2, 'new but not noob', '20DD20');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `nick` varchar(1024) COLLATE utf8_polish_ci NOT NULL,
  `pass` varchar(1024) COLLATE utf8_polish_ci NOT NULL,
  `kind` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `desc` varchar(2048) COLLATE utf8_polish_ci NOT NULL,
  `avatar` varchar(256) COLLATE utf8_polish_ci NOT NULL DEFAULT 'avatar',
  `rank` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `nick`, `pass`, `kind`, `desc`, `avatar`, `rank`) VALUES
(1, 'atrox13', 'asdasd', 'minecraft', '', 'avatar', 1),
(2, 'atrox13', 'asdasd', 'minecraft', '', 'avatar', 1),
(3, 'atrox13', 'asdasd', 'minecraft', '', 'avatar', 1),
(4, 'asdfdf', 'asdewq', 'minecraft', '', 'avatar', 1),
(5, 'esfdsdf', 'asdasd', 'minecraft', '', 'avatar', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_category`
--
ALTER TABLE `forum_category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_threads`
--
ALTER TABLE `forum_threads`
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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rank`
--
ALTER TABLE `rank`
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
-- AUTO_INCREMENT dla tabeli `forum_category`
--
ALTER TABLE `forum_category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `forum_threads`
--
ALTER TABLE `forum_threads`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `news`
--
ALTER TABLE `news`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT dla tabeli `pages`
--
ALTER TABLE `pages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `posts`
--
ALTER TABLE `posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT dla tabeli `rank`
--
ALTER TABLE `rank`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
