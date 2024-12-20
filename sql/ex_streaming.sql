-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 17 août 2024 à 17:11
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `streaming`
--

-- --------------------------------------------------------

--
-- Structure de la table `ds_abonnements`
--

DROP TABLE IF EXISTS `ds_abonnements`;
CREATE TABLE IF NOT EXISTS `ds_abonnements` (
  `id_user` int(255) NOT NULL,
  `id_visiteur` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ds_abonnements`
--

INSERT INTO `ds_abonnements` (`id_user`, `id_visiteur`) VALUES
(16, 15);

-- --------------------------------------------------------

--
-- Structure de la table `ds_categories`
--

DROP TABLE IF EXISTS `ds_categories`;
CREATE TABLE IF NOT EXISTS `ds_categories` (
  `id_categorie` int(255) NOT NULL AUTO_INCREMENT,
  `id_option` int(255) NOT NULL,
  `categorie` varchar(70) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ds_categories`
--

INSERT INTO `ds_categories` (`id_categorie`, `id_option`, `categorie`) VALUES
(1, 1, 'documentaire '),
(2, 1, 'Cuisine'),
(3, 1, 'Sports'),
(4, 1, 'Formations'),
(5, 1, 'Informations'),
(6, 2, 'Short'),
(7, 2, 'Jeux Videos'),
(8, 2, 'Comedie'),
(9, 2, 'Astuces'),
(10, 3, 'Amour'),
(11, 3, 'Drame'),
(12, 3, 'Actions'),
(13, 3, 'Comedie '),
(14, 3, 'Fantastique'),
(15, 4, 'Actions'),
(16, 4, 'Aventures'),
(17, 4, 'Science-Fiction '),
(18, 4, 'Horreur'),
(19, 4, 'Romance '),
(20, 4, 'Autres'),
(21, 5, 'Actions'),
(22, 5, 'Aventures'),
(23, 5, 'Drame'),
(24, 5, 'Science-Fiction'),
(25, 5, 'Fantastique'),
(26, 6, 'Actions'),
(27, 6, 'Aventures'),
(28, 6, 'Fantastiques'),
(29, 6, 'Isekai'),
(30, 6, 'Drame'),
(31, 6, 'Tranche de vie'),
(32, 6, 'Vengeance'),
(33, 6, 'Autres'),
(34, 7, 'Classiques'),
(35, 7, 'Rock'),
(36, 7, 'Jazz'),
(37, 7, 'Rap/Hip-hop'),
(38, 7, 'Musique du mondes'),
(39, 8, 'Actions'),
(40, 8, 'Aventures'),
(41, 8, 'comedies'),
(42, 8, 'Morales'),
(43, 8, 'Animations'),
(44, 9, 'Heterosexuel '),
(45, 9, 'Transsexuels'),
(46, 9, 'Gays'),
(47, 9, 'Blanc'),
(48, 9, 'Noire'),
(49, 10, 'allHentail');

-- --------------------------------------------------------

--
-- Structure de la table `ds_options`
--

DROP TABLE IF EXISTS `ds_options`;
CREATE TABLE IF NOT EXISTS `ds_options` (
  `id_option` int(255) NOT NULL AUTO_INCREMENT,
  `option` text NOT NULL,
  PRIMARY KEY (`id_option`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ds_options`
--

INSERT INTO `ds_options` (`id_option`, `option`) VALUES
(1, 'Actualites '),
(2, 'Divertissements'),
(3, 'Movies'),
(4, 'Films'),
(5, 'Series'),
(6, 'Mangas'),
(7, 'Musiques'),
(8, 'Dessin-animes'),
(9, 'X-videos'),
(10, 'Hentai');

-- --------------------------------------------------------

--
-- Structure de la table `ds_playlists`
--

DROP TABLE IF EXISTS `ds_playlists`;
CREATE TABLE IF NOT EXISTS `ds_playlists` (
  `id_playlist` int(255) NOT NULL AUTO_INCREMENT,
  `id_user` int(255) NOT NULL,
  `id_option` int(255) NOT NULL,
  `playlist` text NOT NULL,
  PRIMARY KEY (`id_playlist`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ds_playlists`
--

INSERT INTO `ds_playlists` (`id_playlist`, `id_user`, `id_option`, `playlist`) VALUES
(1, 15, 7, 'mix-all musique tout it');

-- --------------------------------------------------------

--
-- Structure de la table `ds_stream`
--

DROP TABLE IF EXISTS `ds_stream`;
CREATE TABLE IF NOT EXISTS `ds_stream` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `id_stream` text NOT NULL,
  `id_user` int(255) NOT NULL,
  `id_option` int(255) NOT NULL,
  `id_categorie` int(255) NOT NULL,
  `id_playlist` int(255) NOT NULL DEFAULT '0',
  `titre` text NOT NULL,
  `description` text NOT NULL,
  `tag` text NOT NULL,
  `stream` text NOT NULL,
  `couver` text NOT NULL,
  `size` int(255) NOT NULL,
  `durre` time NOT NULL,
  `date` int(255) NOT NULL,
  `ds_auth` varchar(255) NOT NULL DEFAULT 'true',
  `myright` varchar(255) NOT NULL DEFAULT 'vide',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ds_stream`
--

INSERT INTO `ds_stream` (`id`, `id_stream`, `id_user`, `id_option`, `id_categorie`, `id_playlist`, `titre`, `description`, `tag`, `stream`, `couver`, `size`, `durre`, `date`, `ds_auth`, `myright`) VALUES
(1, '2892-6477-2794', 15, 2, 6, 0, 'DJ Khaled - Hold You Down ft. Chris Brown, August Alsina, Future, Jeremih', 'fff', 'ff', 'src_667d612d384ef.mp4', 'cavx_667d61254c74e.jpeg', 121305506, '00:06:31', 1719492909, 'true', 'invalide'),
(2, '7702-9228-8622', 15, 2, 7, 0, 'Adekunle Gold - Pick Up [Official Video]_Full-HD', 'f', 'f', 'src_667d6176b2f61.mp4', 'cavx_667d616e58dde.jpeg', 65147037, '00:03:27', 1719492982, 'true', 'invalide'),
(3, '1736-0032-0373', 15, 3, 11, 0, 'Adekunle Gold - Ready [Official Video]_Full-HD', 'f', 'f', 'src_667d61a901186.mp4', 'cavx_667d61a900e17.jpg', 92303991, '00:03:39', 1719493033, 'true', 'invalide'),
(4, '0509-4863-3425', 15, 2, 6, 0, 'Yemi Alade - Bum Bum (Official Video)_HD-1', 'gg', 'gg', 'src_6688658596980.mp4', 'cavx_6688657f685fe.jpeg', 56577932, '00:03:40', 1720214917, 'true', 'invalide'),
(5, 'src_ANY5oWe', 15, 7, 34, 0, 'AXEL MERRYL \'CELIBATAIRE\' FT LIL JAY BINGERACK', 'AXEL MERRYL \'CELIBATAIRE\' FT LIL JAY BINGERACK........', 'AXEL MERRYL \'CELIBATAIRE\' FT LIL JAY BINGERACK.......', 'src_6692ef417adea.mp4', 'cavx_6692ef39e26e0.jpeg', 31357234, '00:04:05', 1720905537, 'true', 'vide'),
(6, 'src_6PgcLCn', 15, 7, 38, 1, 'Tayc, Marjinal - Ne Doute Pas', 'Tayc, Marjinal - Ne Doute Pas;;;;;.....', 'Tayc, Marjinal - Ne Doute Pas/////', 'src_669305d984580.mp4', 'cavx_669305d65f13d.jpeg', 14801070, '00:03:17', 1720911321, 'true', 'vide');

-- --------------------------------------------------------

--
-- Structure de la table `ds_user`
--

DROP TABLE IF EXISTS `ds_user`;
CREATE TABLE IF NOT EXISTS `ds_user` (
  `id_user` int(255) NOT NULL AUTO_INCREMENT,
  `pseudo` text NOT NULL,
  `mail` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text NOT NULL,
  `age` int(11) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ds_user`
--

INSERT INTO `ds_user` (`id_user`, `pseudo`, `mail`, `password`, `avatar`, `age`) VALUES
(15, 'darking', 'darkxregent@gmail.com', '$2y$10$n3mImpXDynufidr0l3uJTee7P6BPtWsFknnSvBn41dV6gVzjkh/Oa', 'avx_6669cf32a52e9.jpg', 20),
(16, 'admin', 'admin@gmail.com', '$2y$10$ua5bTe.OFOQUIQy//kTASulNlHM7LgwvmXND18GtqzhYOa.azZBA.', 'avx_6699721defc6d.jpg', 22);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
