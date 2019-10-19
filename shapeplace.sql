-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 18 oct. 2019 à 08:55
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `shapeplace`
--

-- --------------------------------------------------------

--
-- Structure de la table `area`
--

DROP TABLE IF EXISTS `area`;
CREATE TABLE IF NOT EXISTS `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `lng` geometry NOT NULL,
  `lat` geometry NOT NULL,
  `adress` text NOT NULL,
  `cp` int(11) NOT NULL,
  `ville` text NOT NULL,
  `id_category` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `area_note`
--

DROP TABLE IF EXISTS `area_note`;
CREATE TABLE IF NOT EXISTS `area_note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_area` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modification` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_area` (`id_area`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `area_tools`
--

DROP TABLE IF EXISTS `area_tools`;
CREATE TABLE IF NOT EXISTS `area_tools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_area` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_area` (`id_area`),
  KEY `id_category` (`id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_area` int(11) DEFAULT NULL,
  `id_program` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `pseudo` text NOT NULL,
  `comment` text NOT NULL,
  `note` int(11) DEFAULT NULL,
  `report` int(11) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modification` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_program` (`id_program`),
  KEY `id_area` (`id_area`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `id_area`, `id_program`, `id_user`, `pseudo`, `comment`, `note`, `report`, `date_creation`, `date_modification`) VALUES
(2, NULL, 1, 4, 'poisson', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed felis quam. Nunc vehicula lorem purus, non dapibus lectus mattis porta. Nullam non facilisis mauris. Nulla facilisi. Donec facilisis hendrerit est, a tempus ligula aliquam nec. Mauris pellentesque quis sem a volutpat. Duis interdum laoreet dolor, consectetur semper mi placerat nec. Suspendisse in ipsum sit amet nunc auctor dapibus. In cursus odio libero, in laoreet leo cursus vitae. Cras mattis ultrices mi, at maximus dui fringilla nec. Nullam id nibh vitae ex ornare bibendum. Duis vel aliquam augue. Vestibulum ac ex vitae eros ultricies facilisis. Aenean auctor ex non dui vestibulum, id dignissim turpis sagittis. Maecenas tempor sed ex ut facilisis.', NULL, 0, '2019-10-18 01:56:07', NULL),
(3, NULL, 1, 3, 'fish', 'Le programme est génial bravo !', NULL, 0, '2019-10-18 02:32:01', '2019-10-18 02:32:17'),
(7, NULL, 1, 3, 'fish', 'L\'ajout de commentaire est fonctionnel !', NULL, 0, '2019-10-18 03:06:40', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `program`
--

DROP TABLE IF EXISTS `program`;
CREATE TABLE IF NOT EXISTS `program` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_section` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `extract` varchar(255) NOT NULL,
  `description` text,
  `good_point` text,
  `bad_point` text,
  `program` text,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_section` (`id_section`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `program`
--

INSERT INTO `program` (`id`, `id_section`, `name`, `extract`, `description`, `good_point`, `bad_point`, `program`, `date_added`) VALUES
(1, 1, 'HIIT', 'Forme d\'entrainement ou vous alternez des exercices ou un circuit d\'exercice avec une forte intensité voir l\'intensité la plus importante que vous pouvez soutenir, avec une période de repos plus ou moins courte.', 'LE HIIT, EN DEUX MOTS\r\nSi pour vous sport doit rimer avec rapidité, alors la pratique du HIIT va pleinement vous satisfaire. D’une manière générale, et bien qu’il existe plusieurs nuances (on y reviendra plus bas), l’idée est de travailler de façon très courte, mais en prenant également des temps de repos court.\r\n\r\nPar exemple, si la durée de mon exercice est de 20 secondes, je prends seulement 10 secondes de repos avant d’enchaîner sur une nouvelle série. Et ainsi de suite jusqu’à réaliser le nombre de séries que l’on s’est fixé.\r\n\r\nEn travaillant de la sorte, vous allez demander à votre corps de venir rapidement puiser dans ses réserves, et ce en un minimum de temps. Ainsi, 30 minutes à raison de 3 fois par semaine pendant 6 semaines suffiront à se bâtir un physique tout à fait respectable.\r\n\r\nLes principes du HIIT sont applicables à différentes pratiques : la course à pied (dans le cadre d’un travail en fractionné), le vélo, la boxe, la musculation...\r\n\r\nLES BIENFAITS DU HIIT\r\n1 - Un gain musculaire intéressant\r\n\r\nL’une des principales raisons de la pratique d’un sport est cette envie d’être plus musclé. Grâce au HIIT, vous pourrez toucher du doigt cet objectif, à condition d\'adapter, en parallèle, votre alimentation.\r\n\r\n2 - Des effets qui durent dans le temps\r\n\r\nL’un des gros avantages du HIIT, c’est sa capacité à être efficace dans le temps. Le corps continuait à brûler des calories plusieurs heures après la fin d’une séance, et ce même en mangeant ou dormant. Les bénéfices d’une séance se feraient même ressentir jusqu’à 24h après la session pratiquée !\r\n\r\n3 - Un gain de temps non négligeable\r\n\r\nQuand le temps vient à manquer, pratiquer le HIIT va vous permettre de garder un contact régulier avec le sport tout en ne sacrifiant pas une soirée entière à la cause. En 3 x 30 mn, par exemple, vous arriverez à des résultats tout à fait satisfaisants et difficilement atteignables en si peu de temps avec la pratique d’autres sports.\r\n\r\n4 - Une amélioration notable des capacités respiratoires\r\n\r\nVous connaissez la VO2Max ? C’est la capacité qu’a votre muscle à consommer de l’oxygène. En pratiquant le HIIT de manière régulière, vous allez augmenter votre VO2Max en bien moins de temps qu’il n’en faudrait lors de séances cardio traditionnelles.\r\n\r\nLe bonus : une perte de poids accélérée\r\n\r\nL’avantage principal du HIIT, et celui qui va intéresser beaucoup de personnes, c’est sa capacité à brûler beaucoup de calories en un minimum de temps. Plus que tout autre activité physique, d’après différentes études ! Sans même changer votre alimentation, et en quelques mois, vous allez perdre de la graisse...\r\n\r\nIl existe différents types de pratique du HIIT : la méthode TABATA (nom d’un chercheur japonais), la méthode little… Ici, 4 minutes pour vous lancer dans la méthode TABATA', 'Le HIIT est l’entraînement idéal si vous n’avez pas beaucoup de temps à consacrer à l’exercice physique dans votre emploi du temps ou si les longues séances de cardio vous ennuient. Si vous optez pour la méthode Tabata, vous pouvez même faire un entraînement efficace en seulement 4 minutes.', 'Les entraînements de HIIT sont intensifs par rapport à des entraînements « classiques » d’endurance. Vous aurez donc besoin d’une période de récupération plus longue.\r\nLa pratique du HIIT est potentiellement dangereuse et non adaptée aux personnes qui ont des problèmes cardiaques ou une très mauvaise condition physique.', 'Les exercices sont à réaliser pendant 30 secondes de manière intensive (20 répétitions à chaque exercice minimum) avec 10 secondes de transition pour passer à l’exercice suivant.\r\nListe des exercices  : \r\n\r\nJumping jack\r\n\r\nchaise contre un mur : c’est ce qu’on appelle « faire la chaise »\r\n\r\nPompes\r\n\r\nAbdominaux : mettez votre dos au sol, ne mettez pas les mains derrière la tête, tendez les bras et décollez juste le haut des épaules en gardant toujours le bas du dos collé au sol\r\n \r\nMonter sur une chaise\r\n\r\nSquats : pieds à largeur d’épaules, baissez-vous en gardant le dos droit, les bras parallèles au sol et regardez devant vous\r\n\r\nDips sur une chaise\r\n\r\nPlanche : mettez-vous sur les coudes et la pointe des pieds, gaînez tout le corps et pensez à garder les jambes, les fesses et le dos alignés\r\n\r\nCourir sur place : levez les genoux le plus haut possible\r\n\r\nFentes avants\r\n\r\nPompes en T : ce sont les même que les pompes classiques sauf qu’en position haute, bras tendus, le corps gaîné, vous pivotez votre corps d’un côté pour former un T\r\n\r\nPlanche sur le côté : gardez l’alignement jambes, hanches et buste.\r\n\r\n\r\nsource : https://www.litobox.com/7-minutes-hiit .', '2019-10-15 01:36:00'),
(2, 1, 'Corde à Sauter', 'La corde à sauter est l\'exercice de musculation parfait pour perdre du ventre et brûler des calories. Les problèmes de cellulite et de retour veineux sont aussi évités. La progressivité est essentielle pour suivre efficacement un programme de saut.', 'test', NULL, 'test', NULL, '2019-10-15 02:00:15');

-- --------------------------------------------------------

--
-- Structure de la table `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `extract` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `section`
--

INSERT INTO `section` (`id`, `name`, `extract`, `content`) VALUES
(1, 'Cardio', 'Cette activité très physique consiste à enchaîner des exercices qui vont stimuler votre rythme cardiaque et renforcer tout votre système cardio-vasculaire.', 'Le cardio et ses exercices\r\nDu cardio, on peut en faire partout, mais les salles de sport sont très bien équipées pour varier les exercices et dispensent des cours collectifs centrés autour des pratiques de fitness. Les exercices autour du cardio ne se limitent pas à de l\'endurance. Ils imposent au coeur de fortes accélérations qui stimulent le débit sanguin. Le coeur se muscle dans son intégralité grâce à des stimulations de courte et longue durées.'),
(2, 'Les Tractions', 'Les tractions ont pour objectif principal le développement des muscles du dos et des bras.', ''),
(3, 'Les dips', 'Un exercice destiné à développer principalement la force et le volume des triceps, des pectoraux et des épaules (deltoïde antérieur)', ''),
(4, 'Les pompes', 'La pompe est un exercice physique de musculation qui sollicite principalement le grand pectoral, le deltoïde et les triceps. Cet exercice est populaire car il peut être pratiqué n\'importe où, ne nécessitant pas de matériel.', 'Les muscles qui travaillent sur les pompes sont globalement les mêmes et ne dépendent pas de la position. La différence, légère, est le fait que plus les mains sont écartées, plus les secteurs extérieurs travaillent. Les pompes diamant travaillant vraiment l\'intérieur des pectoraux et les triceps.\r\n\r\nLes pompes déclinées sont un peu plus simples, alors que les pompes inclinées augmentent le niveau de difficulté. Vous pouvez aussi faire des pompes décalées avec les deux mains qui ne sont pas au même niveau. Les pompes claquées demandent de l\'explosivité et proposent un impact plus important.');

-- --------------------------------------------------------

--
-- Structure de la table `tools`
--

DROP TABLE IF EXISTS `tools`;
CREATE TABLE IF NOT EXISTS `tools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  `muscle` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` text NOT NULL,
  `pw` text NOT NULL,
  `role` text NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `email` text NOT NULL,
  `date_birth` date NOT NULL,
  `city` text NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `pw`, `role`, `name`, `surname`, `email`, `date_birth`, `city`, `date_creation`) VALUES
(1, 'corne', 'd7e3ae45e03d20c4f27e7f65c06f01cb1399f526', 'a', '', '', '', '2019-10-01', '', '2019-10-17 00:39:16'),
(2, 'user', 'user', 'a', 'user', 'user', 'user@user.fr', '2019-10-01', 'user', '2019-10-17 01:50:01'),
(3, 'fish', '64875fcccaac069fcb3e0e201e7d5b9166641608', 'user', 'fish', 'fish', 'fish@fish.fr', '1999-01-01', 'Castres', '2019-10-17 17:30:44'),
(4, 'poisson', '1133990592d5f5df1870aca8e94d83ada91b8d77', 'user', 'poisson', 'poisson', 'poisson@poisson.fr', '1999-01-01', 'castres', '2019-10-17 17:31:43'),
(5, 'caca', 'a16358be6e2306b153b1f071477e68837266075e', 'user', 'caca', 'caca', 'caca@caca.fr', '1999-01-01', 'caca', '2019-10-17 20:16:14');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `area_note`
--
ALTER TABLE `area_note`
  ADD CONSTRAINT `area_note_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `area` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `area_note_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `area_tools`
--
ALTER TABLE `area_tools`
  ADD CONSTRAINT `area_tools_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `area` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `area_tools_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `tools` (`id`);

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_program`) REFERENCES `program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_area`) REFERENCES `area` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `program_ibfk_1` FOREIGN KEY (`id_section`) REFERENCES `section` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
