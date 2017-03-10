-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 10 Mars 2017 à 17:18
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
(2, 'England', 'The worst'),
(4, 'Italy', 'The pizza');

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
  `answer` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `recipient` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` text NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, '2017-03-10 13:04:12', 'Info1', 'Texte info 1'),
(2, '2017-03-10 13:04:18', 'Info 2', 'Texte info 2');

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
(4, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'Admin', 0, 'Admin', NULL, 1, NULL, NULL),
(9, 'c', '84a516841ba77a5b4648de2cd0dfcb30ea46dbb4', 0, 'C', 2, 'C', NULL, 1, NULL, NULL),
(10, 'd', '3c363836cf4e16666669a25da280a1865c2d2874', 0, 'D', 2, 'D', NULL, 1, NULL, NULL),
(12, 'z', '395df8f7c51f007019cb30201c49e884b46b92fa', 0, 'z', 4, 'z', 'Nothing to say', 1, NULL, NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `cabinets`
--
ALTER TABLE `cabinets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `directives`
--
ALTER TABLE `directives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delegate` (`delegate`),
  ADD KEY `cabinet` (`cabinet`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender` (`sender`),
  ADD KEY `recipient` (`recipient`);

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
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `cabinets`
--
ALTER TABLE `cabinets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `directives`
--
ALTER TABLE `directives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
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
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `recipient` FOREIGN KEY (`recipient`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sender` FOREIGN KEY (`sender`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `cabinet` FOREIGN KEY (`cabinet`) REFERENCES `cabinets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
