-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 14 Avril 2017 à 21:05
-- Version du serveur :  10.1.16-MariaDB
-- Version de PHP :  5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `MUN`
--

-- --------------------------------------------------------

--
-- Structure de la table `cabinets`
--

CREATE TABLE `cabinets` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `cabinets`
--

INSERT INTO `cabinets` (`id`, `name`, `description`) VALUES
(0, 'Backroom', 'Big Brother is watching you'),
(17, 'USA', 'The hot-dog'),
(18, 'Russia', 'The bortsch'),
(19, 'France', 'The baguette'),
(20, 'China', 'The rice'),
(21, 'England', 'The tea');

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `message_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cabinet` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `chat`
--

INSERT INTO `chat` (`id`, `user`, `message_date`, `cabinet`, `message`) VALUES
(68, 30, '2017-04-03 15:43:26', 10, ':)'),
(69, 30, '2017-04-03 16:22:23', 10, 'I''m bored'),
(70, 28, '2017-04-05 18:21:45', 0, 'Hi admins!'),
(71, 28, '2017-04-05 18:21:54', 0, 'How do you find this webapp?'),
(72, 28, '2017-04-05 18:21:58', 0, '???'),
(73, 30, '2017-04-07 14:09:45', 10, 'I''m so bored'),
(74, 30, '2017-04-10 21:39:00', 10, 'Hello'),
(75, 39, '2017-04-12 13:23:15', 0, 'yo'),
(76, 39, '2017-04-12 13:26:48', 0, 'hey'),
(77, 39, '2017-04-12 13:30:44', 0, ' nvf'),
(78, 39, '2017-04-12 13:30:51', 0, '    '),
(79, 39, '2017-04-12 13:31:20', 0, 'yos'),
(80, 39, '2017-04-12 13:31:36', 0, ' '),
(81, 39, '2017-04-12 13:34:11', 0, ' '),
(82, 39, '2017-04-12 13:35:17', 0, 'ccc'),
(83, 39, '2017-04-12 13:35:17', 0, 'ccc'),
(84, 39, '2017-04-12 13:36:21', 0, 'ye'),
(85, 39, '2017-04-12 13:36:21', 0, 'ye'),
(86, 52, '2017-04-12 15:52:53', 15, 'hello guys'),
(87, 52, '2017-04-12 15:52:53', 15, 'hello guys'),
(88, 52, '2017-04-14 17:38:31', 15, 'hi'),
(89, 52, '2017-04-14 17:38:37', 15, 'hello'),
(90, 52, '2017-04-14 17:39:01', 15, 'ho'),
(91, 52, '2017-04-14 17:39:07', 15, 'ha'),
(92, 52, '2017-04-14 17:39:38', 15, 'papa'),
(93, 52, '2017-04-14 17:39:46', 15, 'popo'),
(94, 52, '2017-04-14 17:40:35', 15, 'ho'),
(95, 52, '2017-04-14 17:42:14', 15, 'hey'),
(96, 52, '2017-04-14 17:42:16', 15, 'popop'),
(97, 0, '2017-04-14 18:17:53', 0, 'Hello admins ! Nice to meet you'),
(98, 0, '2017-04-14 18:18:07', 0, 'We''re gonna have a great time torturing delegates with improbable events'),
(99, 69, '2017-04-14 18:43:28', 0, 'Hi ! I''m Olivier, we''re going to have soooo much fun together'),
(100, 60, '2017-04-14 18:49:39', 17, 'Hi guys ! Ready to blow up Russia ?');

-- --------------------------------------------------------

--
-- Structure de la table `directives`
--

CREATE TABLE `directives` (
  `id` int(11) NOT NULL,
  `delegate` int(11) NOT NULL,
  `cabinet` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `collective` tinyint(1) NOT NULL DEFAULT '0',
  `answered` tinyint(1) NOT NULL DEFAULT '0',
  `answer` text,
  `favor` int(11) NOT NULL DEFAULT '0',
  `against` int(11) NOT NULL DEFAULT '0',
  `abstention` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `directives`
--

INSERT INTO `directives` (`id`, `delegate`, `cabinet`, `time`, `title`, `content`, `collective`, `answered`, `answer`, `favor`, `against`, `abstention`) VALUES
(1, 60, 17, '2017-04-14 18:49:59', 'My first directive', 'To be honest, I don''t really know what to put in it', 0, 0, NULL, 0, 0, 3),
(2, 60, 17, '2017-04-14 18:50:25', 'Dancing Queen', 'I love ABBA', 1, 0, NULL, 1, 1, 1),
(3, 60, 17, '2017-04-14 18:50:37', 'We will rock you', 'Several times', 0, 1, 'Boum boum clap', 0, 0, 3),
(4, 60, 17, '2017-04-14 18:50:55', 'We don''t need no education', 'We don''t need no thought control', 0, 0, NULL, 0, 0, 3),
(6, 61, 17, '2017-04-14 18:52:14', 'Let it be', 'Let it be (let it be (let it be))\r\nThere will be an answer\r\nLet it be', 0, 1, 'In that case, whisper words of wisdom', 0, 0, 3),
(7, 61, 17, '2017-04-14 18:52:27', 'I''m still loving you', 'Are you still loving me ?', 1, 1, 'Time, it''s high time, to win back my love again', 2, 0, 1),
(8, 61, 17, '2017-04-14 18:53:15', 'Roxanne', 'You don''t have to put on that red light', 0, 0, NULL, 0, 0, 3),
(9, 59, 17, '2017-04-14 18:53:42', 'Jingle Bells', 'Jingle all the way', 1, 0, NULL, 1, 1, 1),
(10, 59, 17, '2017-04-14 18:53:51', 'Love me tender', 'Love me trump', 0, 0, NULL, 0, 0, 3),
(11, 67, 19, '2017-04-14 18:54:20', 'We are the world', 'We are the children', 1, 1, 'Are you sure ?', 2, 0, 1),
(12, 67, 19, '2017-04-14 18:54:33', 'You can''t hurry love', 'Uuuuh, you just have to wait', 0, 0, NULL, 0, 0, 3),
(13, 67, 19, '2017-04-14 18:54:58', 'Highway to hell', 'Aaaaaaargh', 0, 0, NULL, 0, 0, 3),
(14, 65, 19, '2017-04-14 18:55:55', 'Someone like you', 'Was it you who set fire to the rain ?', 0, 0, NULL, 0, 0, 3),
(15, 65, 19, '2017-04-14 18:56:07', 'Prince Ali', 'Fabulous he, Ali Ababwa', 1, 0, NULL, 2, 0, 1),
(16, 66, 19, '2017-04-14 18:57:06', 'Hey Jude', 'Don''t make it bad', 1, 0, NULL, 1, 0, 2),
(17, 66, 19, '2017-04-14 18:57:37', 'Livin on a prayer', 'Take my hand, we''ll make it I swear', 1, 0, NULL, 0, 1, 2),
(18, 67, 19, '2017-04-14 18:59:02', 'Born in the USA', 'I was born in the USA', 1, 0, NULL, 0, 0, 3);

-- --------------------------------------------------------

--
-- Structure de la table `map_points`
--

CREATE TABLE `map_points` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `map_points`
--

INSERT INTO `map_points` (`id`, `title`, `latitude`, `longitude`) VALUES
(9, 'Battle in Paris', 48, 2),
(11, 'Terror attack in NY', 40, -73),
(12, 'Unrest in Moscow', 37, 55),
(14, 'Earthquake in Rio', -22, -43);

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` text NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`id`, `time`, `title`, `content`) VALUES
(24, '2017-04-14 18:40:02', 'Man walking on the moon', 'Just like in the Police song'),
(31, '2017-04-14 18:42:21', 'French revolution underway', 'Stay indoors and beware of baguette-thieves'),
(32, '2017-04-14 18:42:34', 'Winter is coming', 'Brace yourselves'),
(33, '2017-04-14 18:42:51', 'Journalists in dire need of inspiration', 'This may well be the last news item');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` text NOT NULL,
  `password_hash` text NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `name` text NOT NULL,
  `cabinet` int(11) NOT NULL,
  `character` text NOT NULL,
  `description` text,
  `alive` tinyint(1) NOT NULL DEFAULT '1',
  `email` text,
  `phone` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password_hash`, `admin`, `name`, `cabinet`, `character`, `description`, `alive`, `email`, `phone`) VALUES
(0, 'admin', '2a22d996201f3dc5cfd55f056ca6be78b5bdbf86', 1, 'Administrator', 0, 'Administrator', 'The big boss', 1, 'admin@muncrisis.com', '0606060606'),
(59, 'e.presley', '09ef7679e422248711ab3c2f7ea2f5403abffcc9', 0, 'Elvis Presley', 17, 'Elvis Presley', '', 1, NULL, NULL),
(60, 'j.kennedy', '09ef7679e422248711ab3c2f7ea2f5403abffcc9', 0, 'John Fitzgerald Kennedy', 17, 'John Fitzgerald Kennedy', '', 1, NULL, NULL),
(61, 'a.lincoln', '09ef7679e422248711ab3c2f7ea2f5403abffcc9', 0, 'Abraham Lincoln', 17, 'Abraham Lincoln', '', 1, NULL, NULL),
(62, 'l.tolstoi', '09ef7679e422248711ab3c2f7ea2f5403abffcc9', 0, 'Leo Tolstoi', 18, 'Leo Tolstoi', '', 1, NULL, NULL),
(63, 'j.stalin', '09ef7679e422248711ab3c2f7ea2f5403abffcc9', 0, 'Joseph Stalin', 18, 'Joseph Stalin', '', 1, NULL, NULL),
(64, 'p.tchaikowsky', '09ef7679e422248711ab3c2f7ea2f5403abffcc9', 0, 'Piotr Ilitch Tchaikowsky', 18, 'Piotr Ilitch Tchaikowsky', '', 1, NULL, NULL),
(65, 'c.gaulle', '09ef7679e422248711ab3c2f7ea2f5403abffcc9', 0, 'Charles De Gaulle', 19, 'Charles De Gaulle', '', 1, NULL, NULL),
(66, 'v.hugo', '09ef7679e422248711ab3c2f7ea2f5403abffcc9', 0, 'Victor Hugo', 19, 'Victor Hugo', '', 1, NULL, NULL),
(67, 'dominique', '219623922ad8caf366b8f8b7d0de42f0ae66e0ac', 0, 'Dominique', 19, 'Dominique', '', 1, NULL, NULL),
(69, 'olivier', '557330674a6db1ea219a8f213049bc1f915cc5b3', 1, 'Olivier', 0, 'Olivier', 'The one giving grades', 1, NULL, NULL),
(70, 'm.zedong', '09ef7679e422248711ab3c2f7ea2f5403abffcc9', 0, 'Mao Zedong', 20, 'Mao Zedong', '', 1, NULL, NULL),
(71, 'j.chan', '09ef7679e422248711ab3c2f7ea2f5403abffcc9', 0, 'Jackie Chan', 20, 'Jackie Chan', '', 1, NULL, NULL),
(72, 'w.churchill', '09ef7679e422248711ab3c2f7ea2f5403abffcc9', 0, 'Winston Churchill', 21, 'Winston Churchill', '', 1, NULL, NULL),
(73, 'w.shakespeare', '09ef7679e422248711ab3c2f7ea2f5403abffcc9', 0, 'William Shakespeare', 21, 'William Shakespeare', '', 1, NULL, NULL),
(74, 'd.who', '09ef7679e422248711ab3c2f7ea2f5403abffcc9', 0, 'Doctor Who', 21, 'Doctor Who', '', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE `vote` (
  `id` int(11) NOT NULL,
  `directive` int(11) NOT NULL,
  `delegate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `vote`
--

INSERT INTO `vote` (`id`, `directive`, `delegate`) VALUES
(72, 2, 59),
(83, 9, 61),
(91, 16, 66),
(92, 16, 67),
(93, 17, 65),
(94, 17, 66),
(96, 18, 65),
(97, 18, 66),
(98, 18, 67);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `cabinets`
--
ALTER TABLE `cabinets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `directives`
--
ALTER TABLE `directives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delegate` (`delegate`),
  ADD KEY `cabinet` (`cabinet`);

--
-- Index pour la table `map_points`
--
ALTER TABLE `map_points`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `cabinet` (`cabinet`);

--
-- Index pour la table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `directive` (`directive`),
  ADD KEY `delegate` (`delegate`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `cabinets`
--
ALTER TABLE `cabinets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT pour la table `directives`
--
ALTER TABLE `directives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `map_points`
--
ALTER TABLE `map_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT pour la table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `directives`
--
ALTER TABLE `directives`
  ADD CONSTRAINT `cab` FOREIGN KEY (`cabinet`) REFERENCES `cabinets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `delegate` FOREIGN KEY (`delegate`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `cabinet` FOREIGN KEY (`cabinet`) REFERENCES `cabinets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `directive` FOREIGN KEY (`directive`) REFERENCES `directives` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
