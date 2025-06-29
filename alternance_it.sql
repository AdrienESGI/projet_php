-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2025 at 07:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alternance_it`
--

-- --------------------------------------------------------

--
-- Table structure for table `annonces`
--

CREATE TABLE `annonces` (
  `id` int(11) NOT NULL,
  `recruteur_id` int(11) NOT NULL,
  `titre` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `date_publication` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `annonces`
--

INSERT INTO `annonces` (`id`, `recruteur_id`, `titre`, `description`, `date_publication`) VALUES
(1, 40, 'Alternance Mobile #1', 'Développez des scripts pour renforcer la cybersécurité interne.', '2025-05-20 21:41:10'),
(2, 27, 'Alternance DevOps #2', 'Apprenez aux côtés de développeurs seniors et de designers.', '2025-05-20 21:41:10'),
(3, 25, 'Alternance Systèmes #3', 'Participez au développement d\'une application innovante.', '2025-05-20 21:41:10'),
(4, 30, 'Alternance Machine Learning #4', 'Aidez au maintien en condition opérationnelle de nos serveurs.', '2025-05-20 21:41:10'),
(5, 37, 'Alternance Full-Stack #5', 'Apprenez aux côtés de développeurs seniors et de designers.', '2025-05-20 21:41:10'),
(6, 25, 'Alternance Back-End #6', 'Participez à l\'évolution d\'un jeu en ligne temps réel.', '2025-05-20 21:41:10'),
(7, 31, 'Alternance Support IT #7', 'Contribuez à la sécurisation d\'une infrastructure critique.', '2025-05-20 21:41:10'),
(8, 22, 'Alternance Développement Web #8', 'Aidez au maintien en condition opérationnelle de nos serveurs.', '2025-05-20 21:41:10'),
(9, 29, 'Alternance Cybersécurité #9', 'Apprenez aux côtés de développeurs seniors et de designers.', '2025-05-20 21:41:10'),
(10, 31, 'Alternance Machine Learning #10', 'Développez des scripts pour renforcer la cybersécurité interne.', '2025-05-20 21:41:10'),
(11, 31, 'Alternance Jeu vidéo #11', 'Déployez des outils d\'automatisation et de monitoring.', '2025-05-20 21:41:10'),
(12, 34, 'Alternance UX/UI #12', 'Participez au développement d\'une application innovante.', '2025-05-20 21:41:10'),
(13, 25, 'Alternance DevOps #13', 'Participez au développement d\'une application innovante.', '2025-05-20 21:41:10'),
(14, 37, 'Alternance Back-End #14', 'Contribuez à la sécurisation d\'une infrastructure critique.', '2025-05-20 21:41:10'),
(15, 34, 'Alternance Jeu vidéo #15', 'Aidez au maintien en condition opérationnelle de nos serveurs.', '2025-05-20 21:41:10'),
(16, 35, 'Alternance Cybersécurité #16', 'Rejoignez une équipe Agile sur un projet national.', '2025-05-20 21:41:10'),
(17, 28, 'Alternance IA #17', 'Analysez des données pour optimiser nos processus métiers.', '2025-05-20 21:41:10'),
(18, 27, 'Alternance UX/UI #18', 'Travaillez sur une app mobile multiplateforme en React Native.', '2025-05-20 21:41:10'),
(19, 25, 'Alternance Back-End #19', 'Apprenez aux côtés de développeurs seniors et de designers.', '2025-05-20 21:41:10'),
(20, 39, 'Alternance Full-Stack #20', 'Aidez au maintien en condition opérationnelle de nos serveurs.', '2025-05-20 21:41:10'),
(21, 40, 'Alternance Machine Learning #21', 'Analysez des données pour optimiser nos processus métiers.', '2025-05-20 21:41:10'),
(22, 21, 'Alternance Cybersécurité #22', 'Participez à l\'évolution d\'un jeu en ligne temps réel.', '2025-05-20 21:41:10'),
(23, 37, 'Alternance Machine Learning #23', 'Rejoignez une équipe Agile sur un projet national.', '2025-05-20 21:41:10'),
(24, 28, 'Alternance Cybersécurité #24', 'Analysez des données pour optimiser nos processus métiers.', '2025-05-20 21:41:10'),
(25, 28, 'Alternance Back-End #25', 'Déployez des outils d\'automatisation et de monitoring.', '2025-05-20 21:41:10'),
(26, 39, 'Alternance Back-End #26', 'Développez des scripts pour renforcer la cybersécurité interne.', '2025-05-20 21:41:10'),
(27, 40, 'Alternance Back-End #27', 'Développez des scripts pour renforcer la cybersécurité interne.', '2025-05-20 21:41:10'),
(28, 39, 'Alternance Développement Web #28', 'Aidez au maintien en condition opérationnelle de nos serveurs.', '2025-05-20 21:41:10'),
(29, 31, 'Alternance Machine Learning #29', 'Apprenez aux côtés de développeurs seniors et de designers.', '2025-05-20 21:41:10'),
(30, 28, 'Alternance Support IT #30', 'Rejoignez une équipe Agile sur un projet national.', '2025-05-20 21:41:10'),
(31, 28, 'Alternance Mobile #31', 'Participez au développement d\'une application innovante.', '2025-05-20 21:41:10'),
(32, 32, 'Alternance Mobile #32', 'Déployez des outils d\'automatisation et de monitoring.', '2025-05-20 21:41:10'),
(33, 39, 'Alternance Développement Web #33', 'Analysez des données pour optimiser nos processus métiers.', '2025-05-20 21:41:10'),
(34, 38, 'Alternance DevOps #34', 'Développez des scripts pour renforcer la cybersécurité interne.', '2025-05-20 21:41:10'),
(35, 32, 'Alternance Full-Stack #35', 'Rejoignez une équipe Agile sur un projet national.', '2025-05-20 21:41:10'),
(36, 40, 'Alternance Front-End #36', 'Déployez des outils d\'automatisation et de monitoring.', '2025-05-20 21:41:10'),
(37, 21, 'Alternance Front-End #37', 'Apprenez aux côtés de développeurs seniors et de designers.', '2025-05-20 21:41:10'),
(38, 30, 'Alternance Machine Learning #38', 'Analysez des données pour optimiser nos processus métiers.', '2025-05-20 21:41:10'),
(39, 40, 'Alternance Mobile #39', 'Apprenez aux côtés de développeurs seniors et de designers.', '2025-05-20 21:41:10'),
(40, 34, 'Alternance Full-Stack #40', 'Rejoignez une équipe Agile sur un projet national.', '2025-05-20 21:41:10'),
(41, 31, 'Alternance UX/UI #41', 'Analysez des données pour optimiser nos processus métiers.', '2025-05-20 21:41:10'),
(42, 39, 'Alternance Support IT #42', 'Travaillez sur une app mobile multiplateforme en React Native.', '2025-05-20 21:41:10'),
(43, 22, 'Alternance UX/UI #43', 'Participez au développement d\'une application innovante.', '2025-05-20 21:41:10'),
(44, 22, 'Alternance UX/UI #44', 'Aidez au maintien en condition opérationnelle de nos serveurs.', '2025-05-20 21:41:10'),
(45, 23, 'Alternance Front-End #45', 'Participez à l\'évolution d\'un jeu en ligne temps réel.', '2025-05-20 21:41:10'),
(46, 34, 'Alternance Systèmes #46', 'Travaillez sur une app mobile multiplateforme en React Native.', '2025-05-20 21:41:10'),
(47, 25, 'Alternance Data #47', 'Rejoignez une équipe Agile sur un projet national.', '2025-05-20 21:41:10'),
(48, 35, 'Alternance Jeu vidéo #48', 'Apprenez aux côtés de développeurs seniors et de designers.', '2025-05-20 21:41:10'),
(49, 21, 'Alternance Cybersécurité #49', 'Travaillez sur une app mobile multiplateforme en React Native.', '2025-05-20 21:41:10'),
(50, 36, 'Alternance Full-Stack #50', 'Participez à l\'évolution d\'un jeu en ligne temps réel.', '2025-05-20 21:41:10'),
(51, 27, 'Alternance Front-End #51', 'Analysez des données pour optimiser nos processus métiers.', '2025-05-20 21:41:10'),
(52, 34, 'Alternance Systèmes #52', 'Participez à l\'évolution d\'un jeu en ligne temps réel.', '2025-05-20 21:41:10'),
(53, 37, 'Alternance Développement Web #53', 'Rejoignez une équipe Agile sur un projet national.', '2025-05-20 21:41:10'),
(54, 31, 'Alternance Jeu vidéo #54', 'Développez des scripts pour renforcer la cybersécurité interne.', '2025-05-20 21:41:10'),
(55, 35, 'Alternance Machine Learning #55', 'Rejoignez une équipe Agile sur un projet national.', '2025-05-20 21:41:10'),
(56, 28, 'Alternance Full-Stack #56', 'Rejoignez une équipe Agile sur un projet national.', '2025-05-20 21:41:10'),
(57, 29, 'Alternance Cybersécurité #57', 'Participez à l\'évolution d\'un jeu en ligne temps réel.', '2025-05-20 21:41:10'),
(58, 30, 'Alternance DevOps #58', 'Analysez des données pour optimiser nos processus métiers.', '2025-05-20 21:41:10'),
(59, 34, 'Alternance Back-End #59', 'Rejoignez une équipe Agile sur un projet national.', '2025-05-20 21:41:10'),
(60, 21, 'Alternance Mobile #60', 'Développez des scripts pour renforcer la cybersécurité interne.', '2025-05-20 21:41:10'),
(61, 23, 'Alternance Back-End #61', 'Développez des scripts pour renforcer la cybersécurité interne.', '2025-05-20 21:41:10'),
(62, 38, 'Alternance UX/UI #62', 'Aidez au maintien en condition opérationnelle de nos serveurs.', '2025-05-20 21:41:10'),
(63, 22, 'Alternance Back-End #63', 'Participez au développement d\'une application innovante.', '2025-05-20 21:41:10'),
(64, 27, 'Alternance Full-Stack #64', 'Déployez des outils d\'automatisation et de monitoring.', '2025-05-20 21:41:10'),
(65, 35, 'Alternance UX/UI #65', 'Travaillez sur une app mobile multiplateforme en React Native.', '2025-05-20 21:41:10'),
(66, 38, 'Alternance Jeu vidéo #66', 'Développez des scripts pour renforcer la cybersécurité interne.', '2025-05-20 21:41:10'),
(67, 39, 'Alternance DevOps #67', 'Participez au développement d\'une application innovante.', '2025-05-20 21:41:10'),
(68, 33, 'Alternance IA #68', 'Contribuez à la sécurisation d\'une infrastructure critique.', '2025-05-20 21:41:10'),
(69, 40, 'Alternance Réseaux #69', 'Déployez des outils d\'automatisation et de monitoring.', '2025-05-20 21:41:10'),
(70, 29, 'Alternance Jeu vidéo #70', 'Aidez au maintien en condition opérationnelle de nos serveurs.', '2025-05-20 21:41:10'),
(71, 39, 'Alternance Back-End #71', 'Apprenez aux côtés de développeurs seniors et de designers.', '2025-05-20 21:41:10'),
(72, 36, 'Alternance Mobile #72', 'Développez des scripts pour renforcer la cybersécurité interne.', '2025-05-20 21:41:10'),
(73, 31, 'Alternance UX/UI #73', 'Participez à l\'évolution d\'un jeu en ligne temps réel.', '2025-05-20 21:41:10'),
(74, 39, 'Alternance Back-End #74', 'Aidez au maintien en condition opérationnelle de nos serveurs.', '2025-05-20 21:41:10'),
(75, 24, 'Alternance IA #75', 'Rejoignez une équipe Agile sur un projet national.', '2025-05-20 21:41:10'),
(76, 33, 'Alternance Systèmes #76', 'Participez au développement d\'une application innovante.', '2025-05-20 21:41:10'),
(77, 36, 'Alternance Full-Stack #77', 'Apprenez aux côtés de développeurs seniors et de designers.', '2025-05-20 21:41:10'),
(78, 32, 'Alternance UX/UI #78', 'Apprenez aux côtés de développeurs seniors et de designers.', '2025-05-20 21:41:10'),
(79, 32, 'Alternance Réseaux #79', 'Développez des scripts pour renforcer la cybersécurité interne.', '2025-05-20 21:41:10'),
(80, 39, 'Alternance Systèmes #80', 'Rejoignez une équipe Agile sur un projet national.', '2025-05-20 21:41:10'),
(81, 38, 'Alternance DevOps #81', 'Analysez des données pour optimiser nos processus métiers.', '2025-05-20 21:41:10'),
(82, 27, 'Alternance Cybersécurité #82', 'Contribuez à la sécurisation d\'une infrastructure critique.', '2025-05-20 21:41:10'),
(83, 35, 'Alternance Back-End #83', 'Participez à l\'évolution d\'un jeu en ligne temps réel.', '2025-05-20 21:41:10'),
(84, 23, 'Alternance Support IT #84', 'Apprenez aux côtés de développeurs seniors et de designers.', '2025-05-20 21:41:10'),
(85, 36, 'Alternance Data #85', 'Participez au développement d\'une application innovante.', '2025-05-20 21:41:10'),
(86, 28, 'Alternance Support IT #86', 'Déployez des outils d\'automatisation et de monitoring.', '2025-05-20 21:41:10'),
(87, 25, 'Alternance Support IT #87', 'Contribuez à la sécurisation d\'une infrastructure critique.', '2025-05-20 21:41:10'),
(88, 32, 'Alternance UX/UI #88', 'Rejoignez une équipe Agile sur un projet national.', '2025-05-20 21:41:10'),
(89, 23, 'Alternance DevOps #89', 'Rejoignez une équipe Agile sur un projet national.', '2025-05-20 21:41:10'),
(90, 33, 'Alternance Back-End #90', 'Travaillez sur une app mobile multiplateforme en React Native.', '2025-05-20 21:41:10'),
(91, 40, 'Alternance Systèmes #91', 'Aidez au maintien en condition opérationnelle de nos serveurs.', '2025-05-20 21:41:10'),
(92, 29, 'Alternance Full-Stack #92', 'Apprenez aux côtés de développeurs seniors et de designers.', '2025-05-20 21:41:10'),
(93, 34, 'Alternance Jeu vidéo #93', 'Rejoignez une équipe Agile sur un projet national.', '2025-05-20 21:41:10'),
(94, 28, 'Alternance Data #94', 'Aidez au maintien en condition opérationnelle de nos serveurs.', '2025-05-20 21:41:10'),
(95, 22, 'Alternance Systèmes #95', 'Aidez au maintien en condition opérationnelle de nos serveurs.', '2025-05-20 21:41:10'),
(96, 35, 'Alternance Cybersécurité #96', 'Travaillez sur une app mobile multiplateforme en React Native.', '2025-05-20 21:41:10'),
(97, 39, 'Alternance Data #97', 'Participez au développement d\'une application innovante.', '2025-05-20 21:41:10'),
(98, 40, 'Alternance Mobile #98', 'Travaillez sur une app mobile multiplateforme en React Native.', '2025-05-20 21:41:10'),
(99, 23, 'Alternance Support IT #99', 'Aidez au maintien en condition opérationnelle de nos serveurs.', '2025-05-20 21:41:10'),
(100, 34, 'Alternance UX/UI #100', 'Travaillez sur une app mobile multiplateforme en React Native.', '2025-05-20 21:41:10');

-- --------------------------------------------------------

--
-- Table structure for table `annonces_competences`
--

CREATE TABLE `annonces_competences` (
  `id` int(11) NOT NULL,
  `annonce_id` int(11) NOT NULL,
  `competence_id` int(11) NOT NULL,
  `niveau_minimum` int(11) DEFAULT NULL CHECK (`niveau_minimum` between 1 and 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `candidatures`
--

CREATE TABLE `candidatures` (
  `id` int(11) NOT NULL,
  `candidat_id` int(11) NOT NULL,
  `annonce_id` int(11) NOT NULL,
  `date_candidature` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidatures`
--

INSERT INTO `candidatures` (`id`, `candidat_id`, `annonce_id`, `date_candidature`) VALUES
(2, 42, 2, '2025-05-20 22:34:19'),
(3, 42, 4, '2025-05-20 22:34:24');

-- --------------------------------------------------------

--
-- Table structure for table `competences`
--

CREATE TABLE `competences` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `categorie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `competences`
--

INSERT INTO `competences` (`id`, `nom`, `categorie`) VALUES
(1, 'HTML', 'Développement Web'),
(2, 'CSS', 'Développement Web'),
(3, 'JavaScript', 'Développement Web'),
(4, 'PHP', 'Back-End'),
(5, 'Python', 'Back-End'),
(6, 'Langage C', 'Programmation Système'),
(7, 'SQL', 'Base de Données'),
(8, 'Réseaux', 'Infrastructure'),
(9, 'Cybersécurité', 'Sécurité'),
(10, 'Windows / AD', 'Administration'),
(11, 'Algorithmes', 'Informatique Générale'),
(12, 'Active Directory', 'Personnalisée');

-- --------------------------------------------------------

--
-- Table structure for table `experiences_professionnelles`
--

CREATE TABLE `experiences_professionnelles` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `poste` varchar(100) NOT NULL,
  `entreprise` varchar(100) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `experiences_professionnelles`
--

INSERT INTO `experiences_professionnelles` (`id`, `utilisateur_id`, `poste`, `entreprise`, `date_debut`, `date_fin`, `description`) VALUES
(1, 44, 'paléontologue', 'Munoz', '2023-09-07', '2023-10-14', 'Aujourd\'Hui peur hauteur gouvernement.'),
(2, 45, 'conseiller en fusions-acquisitions', 'Bourdon', '2023-09-15', '2024-03-13', 'Nouveau jeu tu inventer solitude. Respect cinquante chaîne.'),
(3, 45, 'déménageur', 'Dubois', '2021-06-01', '2022-09-09', 'Faire pourtant demi monter malade. Sueur immense fenêtre veille y. Monsieur liberté frère grandir.'),
(4, 46, 'physicien médical médicale', 'Martel S.A.', '2023-05-14', '2025-04-02', 'Cent commander endormir. Aucun désir seulement pas y cas.'),
(5, 47, 'spécialiste de l\'accessibilité numérique', 'Mercier', '2020-06-07', '2024-07-22', 'Quarante douleur tendre produire depuis parvenir peur. Moi puis l\'une. Éclairer année causer lire.'),
(6, 47, 'chef de projet web/mobile', 'Garcia', '2022-03-15', '2024-12-01', 'Distinguer chanter sujet doucement élever.'),
(7, 48, 'agent de propreté urbaine', 'Laroche SA', '2020-09-10', '2022-12-26', 'Confier particulier fil maladie sous plein cacher. Représenter paupière cent troubler.'),
(8, 49, 'assistant réalisateur réalisatrice', 'Hamel', '2021-09-02', '2024-11-30', 'Nombre solitude posséder réponse toile président intérieur. Somme de interroger discussion propre.'),
(9, 50, 'ingénieur technico-commercial technico-commerciale en chimie', 'Tanguy SARL', '2022-12-27', '2024-08-23', 'Cerveau pitié unique voyage adresser. Juger admettre mesure effort bataille.'),
(10, 51, 'technicien packaging', 'Delorme', '2021-12-28', '2023-01-24', 'Également aider gauche honte pourquoi.'),
(11, 52, 'façonnier des industries graphiques', 'Tessier et Fils', '2021-05-06', '2021-12-28', 'Pied plein brusquement ouvrage. Main renverser notre.'),
(12, 53, 'architecte naval', 'Gonzalez', '2023-06-03', '2024-07-18', 'Couleur douter salle remercier étage au. Lisser chambre nu beau. Vieil certes air forêt réponse.');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `expediteur_id` int(11) NOT NULL,
  `destinataire_id` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `date_envoi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `expediteur_id`, `destinataire_id`, `contenu`, `date_envoi`) VALUES
(1, 42, 4, 'Bonjour espèce de gros gland', '2025-05-20 22:12:58');

-- --------------------------------------------------------

--
-- Table structure for table `profil_utilisateur`
--

CREATE TABLE `profil_utilisateur` (
  `utilisateur_id` int(11) NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `ville` varchar(100) DEFAULT NULL,
  `ecole` varchar(255) DEFAULT NULL,
  `niveau_etude` varchar(50) DEFAULT NULL,
  `objectif` text DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `portfolio` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil_utilisateur`
--

INSERT INTO `profil_utilisateur` (`utilisateur_id`, `date_naissance`, `ville`, `ecole`, `niveau_etude`, `objectif`, `linkedin`, `portfolio`) VALUES
(44, '1997-07-17', 'Grégoire', 'Lemaître Delahaye S.A.S. School', 'Bac', 'Menacer produire animal frais joie gauche chaud théâtre situation noir.', 'https://linkedin.com/in/candidat1', 'https://portfolio-candidat1.fr'),
(45, '1999-07-29', 'Sainte Benjamindan', 'Pelletier SA School', 'Bac+5', 'Noir fermer noir claire finir remettre quinze quart point vite appartenir vue.', 'https://linkedin.com/in/candidat2', 'https://portfolio-candidat2.fr'),
(46, '2004-02-09', 'De Oliveira-les-Bains', 'Giraud School', 'Bac+3', 'Oublier étoile cher puis jaune sur agent pitié enfin.', 'https://linkedin.com/in/candidat3', 'https://portfolio-candidat3.fr'),
(47, '2003-11-10', 'Saint Sophie', 'Charles School', 'Bac+3', 'Vingt trace soin d\'autres espèce ouvrir rire attention magnifique société mille vingt avouer effacer.', 'https://linkedin.com/in/candidat4', 'https://portfolio-candidat4.fr'),
(48, '2003-02-15', 'Saint GabrielleVille', 'Jacquot School', 'Bac', 'Avant parler produire accord savoir ensuite endroit.', 'https://linkedin.com/in/candidat5', 'https://portfolio-candidat5.fr'),
(49, '2000-04-07', 'Sainte Thierry-les-Bains', 'Perrin SARL School', 'Bac+3', 'Papier soumettre détacher devoir service mariage frère colère serrer relation un oublier ton vieux transformer cour.', 'https://linkedin.com/in/candidat6', 'https://portfolio-candidat6.fr'),
(50, '1999-10-24', 'Rocher', 'Ruiz S.A.S. School', 'Bac+5', 'Quelqu\'Un beauté dresser colère emmener machine même.', 'https://linkedin.com/in/candidat7', 'https://portfolio-candidat7.fr'),
(51, '1995-10-11', 'LaineBourg', 'Lambert School', 'Bac+3', 'Puissance relever décrire obtenir violence fonder condition élever recueillir départ moment article songer.', 'https://linkedin.com/in/candidat8', 'https://portfolio-candidat8.fr'),
(52, '1990-10-06', 'Le Goff', 'Valette School', 'Bac+2', 'Chaise exiger lendemain chercher bois cabinet dos importance soudain pauvre idée.', 'https://linkedin.com/in/candidat9', 'https://portfolio-candidat9.fr'),
(53, '2004-01-15', 'Lacombe-sur-David', 'Germain S.A. School', 'Bac+3', 'Près davantage intérieur tenter classe craindre parole victime livre poitrine voile inviter prononcer désirer livre quel.', 'https://linkedin.com/in/candidat10', 'https://portfolio-candidat10.fr');

-- --------------------------------------------------------

--
-- Table structure for table `suivi_competences`
--

CREATE TABLE `suivi_competences` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `nom_competence` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` enum('candidat','recruteur','admin') NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `email`, `mot_de_passe`, `role`, `date_creation`) VALUES
(1, 'Nathan Lefevre', 'nathan_lefevre_2413@test.com', '$2b$12$muKyRF4F5frGSEi./3Z4XOf71TZl1ofwlFh84YpV/u546bGgLr0/6', 'candidat', '2025-05-20 21:18:15'),
(2, 'Luca Faure', 'luca_faure_1578@test.com', '$2b$12$bU7/M5zGUNTTgjpnB7Z.aO19miK/Ev37rzXZAhm/fJhj.2D2pNe3i', 'candidat', '2025-05-20 21:18:15'),
(3, 'Sara Roux', 'sara_roux_9910@test.com', '$2b$12$qVmmLhXIN4VgmbtMzZHRgu2AuCgc238/wo.U.5HnJRIzLH3IogOK.', 'candidat', '2025-05-20 21:18:15'),
(4, 'Sara Caron', 'sara_caron_7187@test.com', '$2b$12$4zyFZbdHkVbVHwhtdu564uVxDJmtHm5UztYu75RW1nqY3YCxm2/C.', 'candidat', '2025-05-20 21:18:15'),
(5, 'Nina Lefevre', 'nina_lefevre_4957@test.com', '$2b$12$/yu/mSPvqIESqj/YPY3Z.usFQdoY/9CiC.hEl2nunw/6hVaBjxvGu', 'candidat', '2025-05-20 21:18:15'),
(6, 'Enzo Blanc', 'enzo_blanc_1126@test.com', '$2b$12$nNsaR113w0U.UamSrypUYubanH2a2pbC3p3p5Jmdz1rG0vNKFPkPK', 'candidat', '2025-05-20 21:18:15'),
(7, 'Emma Lemoine', 'emma_lemoine_5753@test.com', '$2b$12$AA0PLp9ljDZyz.3GZmPCF.CcLin9rsNbjfIYT/uoy3jK57Eq7ZdPS', 'candidat', '2025-05-20 21:18:15'),
(8, 'Enzo Morel', 'enzo_morel_9207@test.com', '$2b$12$xF797stTw.SVFTiX6Tj70uxZL5soON6QgPYBYMEfgsZqQxspCirSa', 'candidat', '2025-05-20 21:18:15'),
(9, 'Luca Perez', 'luca_perez_5936@test.com', '$2b$12$s/wtTl3peKXFGsvv.J6CLu7p2swAr2fC0rkayxAW59Pf9.zX7G99K', 'candidat', '2025-05-20 21:18:15'),
(10, 'Luca Lefevre', 'luca_lefevre_9224@test.com', '$2b$12$t/R/.gHeCPVbManMasyJLOMle0PQD0TtBja7i9IimwNXo1QdihEWq', 'candidat', '2025-05-20 21:18:15'),
(11, 'Leo Durand', 'leo_durand_7979@test.com', '$2b$12$apukkak8hhwOlwo8w5efIOXRa/mf4oHLUIVUj1U.GsyZoY4yyivem', 'candidat', '2025-05-20 21:18:15'),
(12, 'Luca Perez', 'luca_perez_1376@test.com', '$2b$12$BnJ/t8FKEC4Q1gjgt5Y/JOHror5dLJRrrnYEhhwEtXXdyAjDHQjCO', 'candidat', '2025-05-20 21:18:15'),
(13, 'Nina Perez', 'nina_perez_4049@test.com', '$2b$12$.rViXW3mMcWIexA9TGbOPeWckIz3vdyH5D9cLlDiTFt5PfS9jQx2C', 'candidat', '2025-05-20 21:18:15'),
(14, 'Jade Roux', 'jade_roux_8856@test.com', '$2b$12$DAl6wXpQvh1mvT2NTzVy1uRYAm/LIR/OecYXNA90JiL6spvM6gL5a', 'candidat', '2025-05-20 21:18:15'),
(15, 'Sara Dupuis', 'sara_dupuis_9469@test.com', '$2b$12$ep10qKwLDJrOHcaespMe6ORZS7cRox00.Geps.HEJxZXqswECfcpe', 'candidat', '2025-05-20 21:18:15'),
(16, 'Nina Perez', 'nina_perez_6614@test.com', '$2b$12$4cG9a1WWXd4l/OrB0KF1cOauw5OiypwW4Z0uxIXPGnylEz3970916', 'candidat', '2025-05-20 21:18:15'),
(17, 'Leo Morel', 'leo_morel_2434@test.com', '$2b$12$eLAvKQsDn1kxelwKcZXBeul2wEp7R7WUcNBwDCW8NJoTl8oO042uK', 'candidat', '2025-05-20 21:18:15'),
(18, 'Emma Dupuis', 'emma_dupuis_8712@test.com', '$2b$12$B88500TZxv2uXX./kSBXee5ezOhesEZqsdZ/R0frPKCzNJQH081E2', 'candidat', '2025-05-20 21:18:15'),
(19, 'Emma Blanc', 'emma_blanc_2870@test.com', '$2b$12$Pa/7SEbYOpGpl5TxOzsQou9/MFKEDHPXrc6MBmHc5tqFwi7H8Ty62', 'candidat', '2025-05-20 21:18:15'),
(20, 'Sara Durand', 'sara_durand_7413@test.com', '$2b$12$R3LKDMEiWQYGjkWq2U9oxuCiWT32MLcN1n7UIpejZ0MFiYcM.3l0m', 'candidat', '2025-05-20 21:18:15'),
(21, 'Luca Perez', 'luca_perez_4649@test.com', '$2b$12$/RnPjZAFpCmObLzO/.sXzeaL4f9Qj53Co0btkD4kJcPfuwenVnIpu', 'recruteur', '2025-05-20 21:18:15'),
(22, 'Enzo Dupuis', 'enzo_dupuis_3670@test.com', '$2b$12$1iklC7BmKG5vMxtauA9CB./n83FWbTZg9G4lR7LSirNvc827j3JOK', 'recruteur', '2025-05-20 21:18:15'),
(23, 'Emma Faure', 'emma_faure_6378@test.com', '$2b$12$jebaPZ4z4zX2WbwinByj3u6JA0O9J.dXo26Acq4fDOk183qapKb/6', 'recruteur', '2025-05-20 21:18:15'),
(24, 'Alex Blanc', 'alex_blanc_7141@test.com', '$2b$12$NPyH5vA2O2Lq8IJYt6D6ceotht2vbSKQTcYFFZd8IaXm0xbaO33MK', 'recruteur', '2025-05-20 21:18:15'),
(25, 'Emma Durand', 'emma_durand_8965@test.com', '$2b$12$KLD.rP6dgFGjfvVgVOBBruBzkdbh3Rgxlz2qAZW/KTrsXC6nminQS', 'recruteur', '2025-05-20 21:18:15'),
(26, 'Alex Perez', 'alex_perez_7196@test.com', '$2b$12$Y/hDpjtz44xxbbjllytLr.eM4dwrCulXT.eF96DxdL.WxRI.Baq6S', 'recruteur', '2025-05-20 21:18:15'),
(27, 'Enzo Lefevre', 'enzo_lefevre_7014@test.com', '$2b$12$iO6Nn9HvlFC37FAHGidaTuNyAbu5xvg233p8XeRZ4e4NJFCRDLjde', 'recruteur', '2025-05-20 21:18:15'),
(28, 'Enzo Faure', 'enzo_faure_8531@test.com', '$2b$12$H0VNIOTNONcmtgNwGrUYDOzvafGd/yHE.NpNAl1rLQBH7of/Sil8W', 'recruteur', '2025-05-20 21:18:15'),
(29, 'Alex Perez', 'alex_perez_9425@test.com', '$2b$12$irJ/nm6dOyTAunlJmAHeB.BqvF.bkB6RQ5/aSNyiUGhKBF7h/0Maq', 'recruteur', '2025-05-20 21:18:15'),
(30, 'Alex Blanc', 'alex_blanc_7209@test.com', '$2b$12$gmwwWUw/4qJDgw1luSgGdOM2iOQNTSMDPv3KmmOcmOZrBWNmallAS', 'recruteur', '2025-05-20 21:18:15'),
(31, 'Luca Lemoine', 'luca_lemoine_5520@test.com', '$2b$12$r06Lbqdx5v45B58tCjHllOOdc77vGLV0ssbS5Ao7W0RPltmZ13SPy', 'recruteur', '2025-05-20 21:18:15'),
(32, 'Alex Blanc', 'alex_blanc_5322@test.com', '$2b$12$gB7N7nJyVp2WriAhBH3SKO/ORaXTd6IkQylvhRq3.TCBAO7g76Dz2', 'recruteur', '2025-05-20 21:18:15'),
(33, 'Nathan Lemoine', 'nathan_lemoine_7958@test.com', '$2b$12$qiBGynv1N4A/LZClcB/Jk.nRPC.Tx66nw9ndsmcVCU0Co27SfcPai', 'recruteur', '2025-05-20 21:18:15'),
(34, 'Nina Blanc', 'nina_blanc_6435@test.com', '$2b$12$Pd3L/1c30MF9QQaGnXQqDeC4.pRLeb8wITsw871AX7hZxLk99qiJq', 'recruteur', '2025-05-20 21:18:15'),
(35, 'Nathan Blanc', 'nathan_blanc_8009@test.com', '$2b$12$ucfYb0qYd6A/yVUym.Rbnefw2LlRK7FB1zEnbfzYDmDlg6sYYlIfm', 'recruteur', '2025-05-20 21:18:15'),
(36, 'Mila Perez', 'mila_perez_2670@test.com', '$2b$12$dq4N97chQXq81T5.LeFNmODvahdpWYEme5I4tpUvIfCsM1tpSR7h.', 'recruteur', '2025-05-20 21:18:15'),
(37, 'Jade Blanc', 'jade_blanc_2653@test.com', '$2b$12$IPoabzB5BhBmAyfpjViXWupx33J145oFVmElfSGGNcg3yisqwo2Ke', 'recruteur', '2025-05-20 21:18:15'),
(38, 'Jade Faure', 'jade_faure_8330@test.com', '$2b$12$Ido3FL0b15IfyAjvwyHER.RKHoaRWnYs09ZbQkd1Z0VUlJwTmJGHy', 'recruteur', '2025-05-20 21:18:15'),
(39, 'Emma Perez', 'emma_perez_9426@test.com', '$2b$12$Ml9M4oTnHHxzv7o.L0Dnqe1BDm9LLiAPMqajs5.aOWg2nmP9d7ND6', 'recruteur', '2025-05-20 21:18:15'),
(40, 'Jade Faure', 'jade_faure_1496@test.com', '$2b$12$urPpctbXEFPbl.XLoVZAaO0JA/3ntTEoRBBTfL0nLqpttzeNIGcby', 'recruteur', '2025-05-20 21:18:15'),
(41, 'Admin Aguillon', 'aguillon@projet.fr', '$2b$12$ONubiVnaoRwsvrul8i3ZHOQkxvIm6p62cZnE7nAH/Wi7J0hlTXX46', 'admin', '2025-05-20 21:24:11'),
(42, 'Candidat Test', 'candidat@projet.fr', '$2b$12$p4tl1jPvGMmC3aL490n3IemYbc6.EkIiRTUd0XZLvyCVBvmQaX6VO', 'candidat', '2025-05-20 21:38:15'),
(43, 'Recruteur Test', 'recruteur@projet.fr', '$2b$12$NG8VnFhJ88Di89ZV092gV.9rkvKgS23pKu5FeX16KgoLkrP6y7d96', 'recruteur', '2025-05-20 21:38:15'),
(44, 'Honoré Brun', 'candidat1@projet.fr', '$2b$12$Z1ng.GtUVWUdM.I4ONaZheh4dlLhBxESoGTCUNj356Bjbe4cAKyTe', 'candidat', '2025-05-24 16:57:43'),
(45, 'Benoît Leclercq', 'candidat2@projet.fr', '$2b$12$Z1ng.GtUVWUdM.I4ONaZheh4dlLhBxESoGTCUNj356Bjbe4cAKyTe', 'candidat', '2025-05-24 16:57:43'),
(46, 'Christine Blin', 'candidat3@projet.fr', '$2b$12$Z1ng.GtUVWUdM.I4ONaZheh4dlLhBxESoGTCUNj356Bjbe4cAKyTe', 'candidat', '2025-05-24 16:57:43'),
(47, 'Odette Moulin', 'candidat4@projet.fr', '$2b$12$Z1ng.GtUVWUdM.I4ONaZheh4dlLhBxESoGTCUNj356Bjbe4cAKyTe', 'candidat', '2025-05-24 16:57:43'),
(48, 'Josette Fernandes Le Huet', 'candidat5@projet.fr', '$2b$12$Z1ng.GtUVWUdM.I4ONaZheh4dlLhBxESoGTCUNj356Bjbe4cAKyTe', 'candidat', '2025-05-24 16:57:43'),
(49, 'Geneviève de Normand', 'candidat6@projet.fr', '$2b$12$Z1ng.GtUVWUdM.I4ONaZheh4dlLhBxESoGTCUNj356Bjbe4cAKyTe', 'candidat', '2025-05-24 16:57:43'),
(50, 'Michèle Lucas', 'candidat7@projet.fr', '$2b$12$Z1ng.GtUVWUdM.I4ONaZheh4dlLhBxESoGTCUNj356Bjbe4cAKyTe', 'candidat', '2025-05-24 16:57:43'),
(51, 'Joseph-Alfred Michaud', 'candidat8@projet.fr', '$2b$12$Z1ng.GtUVWUdM.I4ONaZheh4dlLhBxESoGTCUNj356Bjbe4cAKyTe', 'candidat', '2025-05-24 16:57:43'),
(52, 'Philippe Ferrand', 'candidat9@projet.fr', '$2b$12$Z1ng.GtUVWUdM.I4ONaZheh4dlLhBxESoGTCUNj356Bjbe4cAKyTe', 'candidat', '2025-05-24 16:57:43'),
(53, 'Éric Rossi', 'candidat10@projet.fr', '$2b$12$Z1ng.GtUVWUdM.I4ONaZheh4dlLhBxESoGTCUNj356Bjbe4cAKyTe', 'candidat', '2025-05-24 16:57:43');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs_competences`
--

CREATE TABLE `utilisateurs_competences` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `competence_id` int(11) NOT NULL,
  `niveau` int(11) DEFAULT NULL CHECK (`niveau` between 1 and 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateurs_competences`
--

INSERT INTO `utilisateurs_competences` (`id`, `utilisateur_id`, `competence_id`, `niveau`) VALUES
(12, 42, 10, 1),
(13, 42, 4, 1),
(14, 42, 5, 1),
(15, 42, 7, 1),
(16, 42, 2, 1),
(17, 42, 1, 1),
(18, 42, 3, 1),
(19, 42, 11, 1),
(20, 42, 8, 1),
(21, 42, 12, 1),
(22, 42, 6, 1),
(23, 42, 9, 1),
(24, 44, 9, 5),
(25, 44, 5, 4),
(26, 44, 11, 1),
(27, 44, 7, 5),
(28, 45, 3, 5),
(29, 45, 5, 3),
(30, 45, 6, 1),
(31, 45, 9, 4),
(32, 46, 7, 5),
(33, 46, 2, 2),
(34, 46, 6, 3),
(35, 46, 5, 3),
(36, 46, 11, 2),
(37, 46, 10, 3),
(38, 47, 1, 2),
(39, 47, 7, 3),
(40, 47, 10, 4),
(41, 47, 8, 2),
(42, 47, 5, 4),
(43, 48, 7, 5),
(44, 48, 1, 2),
(45, 48, 4, 3),
(46, 48, 8, 3),
(47, 48, 3, 3),
(48, 49, 11, 1),
(49, 49, 8, 5),
(50, 49, 7, 4),
(51, 50, 11, 2),
(52, 50, 4, 4),
(53, 50, 1, 5),
(54, 50, 8, 2),
(55, 51, 2, 2),
(56, 51, 10, 3),
(57, 51, 11, 1),
(58, 51, 4, 3),
(59, 51, 7, 2),
(60, 51, 9, 1),
(61, 52, 10, 4),
(62, 52, 9, 4),
(63, 52, 4, 1),
(64, 53, 6, 2),
(65, 53, 3, 4),
(66, 53, 5, 4),
(67, 53, 2, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `annonces`
--
ALTER TABLE `annonces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recruteur_id` (`recruteur_id`);

--
-- Indexes for table `annonces_competences`
--
ALTER TABLE `annonces_competences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `annonce_id` (`annonce_id`),
  ADD KEY `competence_id` (`competence_id`);

--
-- Indexes for table `candidatures`
--
ALTER TABLE `candidatures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidat_id` (`candidat_id`),
  ADD KEY `annonce_id` (`annonce_id`);

--
-- Indexes for table `competences`
--
ALTER TABLE `competences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experiences_professionnelles`
--
ALTER TABLE `experiences_professionnelles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expediteur_id` (`expediteur_id`),
  ADD KEY `destinataire_id` (`destinataire_id`);

--
-- Indexes for table `profil_utilisateur`
--
ALTER TABLE `profil_utilisateur`
  ADD PRIMARY KEY (`utilisateur_id`);

--
-- Indexes for table `suivi_competences`
--
ALTER TABLE `suivi_competences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `utilisateurs_competences`
--
ALTER TABLE `utilisateurs_competences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`),
  ADD KEY `competence_id` (`competence_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `annonces_competences`
--
ALTER TABLE `annonces_competences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidatures`
--
ALTER TABLE `candidatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `competences`
--
ALTER TABLE `competences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `experiences_professionnelles`
--
ALTER TABLE `experiences_professionnelles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suivi_competences`
--
ALTER TABLE `suivi_competences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `utilisateurs_competences`
--
ALTER TABLE `utilisateurs_competences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `annonces_ibfk_1` FOREIGN KEY (`recruteur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `annonces_competences`
--
ALTER TABLE `annonces_competences`
  ADD CONSTRAINT `annonces_competences_ibfk_1` FOREIGN KEY (`annonce_id`) REFERENCES `annonces` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `annonces_competences_ibfk_2` FOREIGN KEY (`competence_id`) REFERENCES `competences` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `candidatures`
--
ALTER TABLE `candidatures`
  ADD CONSTRAINT `candidatures_ibfk_1` FOREIGN KEY (`candidat_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `candidatures_ibfk_2` FOREIGN KEY (`annonce_id`) REFERENCES `annonces` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `experiences_professionnelles`
--
ALTER TABLE `experiences_professionnelles`
  ADD CONSTRAINT `experiences_professionnelles_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`expediteur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`destinataire_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profil_utilisateur`
--
ALTER TABLE `profil_utilisateur`
  ADD CONSTRAINT `profil_utilisateur_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `suivi_competences`
--
ALTER TABLE `suivi_competences`
  ADD CONSTRAINT `suivi_competences_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `utilisateurs_competences`
--
ALTER TABLE `utilisateurs_competences`
  ADD CONSTRAINT `utilisateurs_competences_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `utilisateurs_competences_ibfk_2` FOREIGN KEY (`competence_id`) REFERENCES `competences` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
