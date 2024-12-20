-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 20 déc. 2024 à 10:51
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

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
  `No` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_visiteur` int NOT NULL,
  PRIMARY KEY (`No`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `ds_categories`
--

DROP TABLE IF EXISTS `ds_categories`;
CREATE TABLE IF NOT EXISTS `ds_categories` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `id_option` int NOT NULL,
  `categorie` varchar(70) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb3;

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
-- Structure de la table `ds_commentaires`
--

DROP TABLE IF EXISTS `ds_commentaires`;
CREATE TABLE IF NOT EXISTS `ds_commentaires` (
  `id_commentaire` int NOT NULL AUTO_INCREMENT,
  `id_stream` text NOT NULL,
  `id_visiteur` int NOT NULL,
  `commentaire` text NOT NULL,
  `date` int NOT NULL,
  PRIMARY KEY (`id_commentaire`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `ds_likes`
--

DROP TABLE IF EXISTS `ds_likes`;
CREATE TABLE IF NOT EXISTS `ds_likes` (
  `No` int NOT NULL AUTO_INCREMENT,
  `id_stream` varchar(255) NOT NULL,
  `id_user_stream` int NOT NULL,
  `id_user` int NOT NULL,
  `liked` int NOT NULL,
  PRIMARY KEY (`No`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `ds_options`
--

DROP TABLE IF EXISTS `ds_options`;
CREATE TABLE IF NOT EXISTS `ds_options` (
  `id_option` int NOT NULL AUTO_INCREMENT,
  `option` text NOT NULL,
  PRIMARY KEY (`id_option`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

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
  `id_playlist` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_option` int NOT NULL,
  `playlist` text NOT NULL,
  PRIMARY KEY (`id_playlist`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `ds_resp_cmmt`
--

DROP TABLE IF EXISTS `ds_resp_cmmt`;
CREATE TABLE IF NOT EXISTS `ds_resp_cmmt` (
  `No` int NOT NULL AUTO_INCREMENT,
  `id_commentaire` int NOT NULL,
  `id_visiteur` int NOT NULL,
  `commentaire` text NOT NULL,
  `date` int NOT NULL,
  PRIMARY KEY (`No`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `ds_stream`
--

DROP TABLE IF EXISTS `ds_stream`;
CREATE TABLE IF NOT EXISTS `ds_stream` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_stream` text NOT NULL,
  `id_user` int NOT NULL,
  `id_option` int NOT NULL,
  `id_categorie` int NOT NULL,
  `id_playlist` int NOT NULL DEFAULT '0',
  `titre` text NOT NULL,
  `description` text NOT NULL,
  `tag` text NOT NULL,
  `stream` text NOT NULL,
  `couver` text NOT NULL,
  `size` int NOT NULL,
  `durre` time NOT NULL,
  `date` int NOT NULL,
  `ds_auth` varchar(255) NOT NULL DEFAULT 'true',
  `myright` varchar(255) NOT NULL DEFAULT 'vide',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `ds_user`
--

DROP TABLE IF EXISTS `ds_user`;
CREATE TABLE IF NOT EXISTS `ds_user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `pseudo` text NOT NULL,
  `mail` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text NOT NULL,
  `age` int NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ds_user`
--

INSERT INTO `ds_user` (`id_user`, `pseudo`, `mail`, `password`, `avatar`, `age`) VALUES
(15, 'darking', 'darkxregent@gmail.com', '$2y$10$n3mImpXDynufidr0l3uJTee7P6BPtWsFknnSvBn41dV6gVzjkh/Oa', 'avx_6669cf32a52e9.jpg', 20),
(17, 'admin', 'admin@gmail.com', '$2y$10$pBBzAjK.5B.h8T2zPfLy5eDrGPhDQURnlsxMqWws563r37PJoD7Dm', 'avx_66f09b91b893b.jpeg', 20);

-- --------------------------------------------------------

--
-- Structure de la table `ds_vues`
--

DROP TABLE IF EXISTS `ds_vues`;
CREATE TABLE IF NOT EXISTS `ds_vues` (
  `No` int NOT NULL AUTO_INCREMENT,
  `id_stream` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `vue` int NOT NULL,
  PRIMARY KEY (`No`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
