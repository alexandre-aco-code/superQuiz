-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 14 fév. 2021 à 18:23
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quiz`
--

-- --------------------------------------------------------

--
-- Structure de la table `avatars`
--

CREATE TABLE `avatars` (
  `Id` int(11) NOT NULL,
  `Image` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `avatars`
--

INSERT INTO `avatars` (`Id`, `Image`) VALUES
(1, 'https://images-na.ssl-images-amazon.com/images/M/MV5BNTczMzk1MjU1MV5BMl5BanBnXkFtZTcwNDk2MzAyMg@@._V1_UY256_CR2,0,172,256_AL_.jpg'),
(2, 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjUzZTJmZDItODRjYS00ZGRhLTg2NWQtOGE0YjJhNWVlMjNjXkEyXkFqcGdeQXVyMTg4NDI0NDM@._V1_UY256_CR42,0,172,256_AL_.jpg'),
(3, 'https://images-na.ssl-images-amazon.com/images/M/MV5BOWViYjUzOWMtMzRkZi00MjNkLTk4M2ItMTVkMDg5MzE2ZDYyXkEyXkFqcGdeQXVyODQwNjM3NDA@._V1_UY256_CR36,0,172,256_AL_.jpg'),
(4, 'https://images-na.ssl-images-amazon.com/images/M/MV5BNjk5NjE5NTczMV5BMl5BanBnXkFtZTcwODI0OTM0NA@@._V1_UY256_CR4,0,172,256_AL_.jpg'),
(5, 'https://images-na.ssl-images-amazon.com/images/M/MV5BOTU2MTI0NTIyNV5BMl5BanBnXkFtZTcwMTA4Nzc3OA@@._V1_UX172_CR0,0,172,256_AL_.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `commentary`
--

CREATE TABLE `commentary` (
  `Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Content` longtext NOT NULL,
  `Created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `Status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentary`
--

INSERT INTO `commentary` (`Id`, `User_Id`, `Content`, `Created_at`, `Status`) VALUES
(1, 1, 'C\'est vraiment un super Quiz! ', '2021-01-28 10:38:37', 1),
(2, 2, 'Tout à fait! Jamais vu aussi incroyable!', '2021-01-28 10:38:37', 1),
(5, 1, 'J&#039;écris un super commentaire avec Charly', '2021-02-11 12:18:52', 1);

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `Id` int(11) NOT NULL,
  `IndexQuestion` int(11) NOT NULL,
  `IndexGoodAnswer` int(11) NOT NULL,
  `Question` varchar(250) NOT NULL,
  `Answers` longtext NOT NULL,
  `Image` longtext NOT NULL,
  `Topic_Id` int(11) NOT NULL,
  `ScoreValue` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`Id`, `IndexQuestion`, `IndexGoodAnswer`, `Question`, `Answers`, `Image`, `Topic_Id`, `ScoreValue`) VALUES
(1, 1, 3, '\"J\'ai fait des cannelés, ils sont sortis tout seuls de mon boule.\"', 'A. \"...de ma poule.\" - B. \"...dans la houle.\" - C. \"...de mon moule.\" - D. je ne vois pas d\'erreur c\'est bien écrit.', 'https://upload.wikimedia.org/wikipedia/commons/a/aa/Caneles_stemilion.jpg', 2, 1),
(2, 2, 2, '\"Tu rentres bientôt ? Moi je suce déjà là.\"', 'A. \"...je lèche déjà là\" - B. \"...je suis déjà là\" - C. \"...je mange déjà là\" - D. je ne vois pas d\'erreur c\'est bien écrit.', 'https://images.pexels.com/photos/4405244/pexels-photo-4405244.jpeg', 2, 1),
(3, 3, 1, '\"Je suis plus au régime étudiant, mais je touche le slip.\"', 'A. \"... je touche le SMIC\" - B. \"...je fais un clip\" - C. \"...je touche du bois\" - D. \"... j\'aime toujours le RU\"', 'https://images.pexels.com/photos/259165/pexels-photo-259165.jpeg', 2, 1),
(4, 4, 4, '\"Je me touche et j\'arrive !\"', 'A. \"Je me louche et j\'arrive.\" - B. \"Je me mouche et j\'arrive.\" - C. \"Je me couche et j\'arrive.\" - D. \"Je me douche et j\'arrive.\"', 'https://images.pexels.com/photos/2365701/pexels-photo-2365701.jpeg', 2, 1),
(5, 5, 1, '\"Allez salut, à très bite!\"', 'A. \"Allez salut, à très vite!\" - B. \"Allez salut, vous en avez une belle!\" - C. \"Allez salut, à très bientôt!\" - D. Je ne vois pas le problème, je dis toujours ça d\'habitude. ', 'https://images.pexels.com/photos/4473406/pexels-photo-4473406.jpeg', 2, 1),
(6, 1, 2, 'Laquelle de ces affirmations est vraie ? ', 'A. Certaines poules ont des dents - B. Certains canards ont des dents. - C. Certains coqs ont des dents. - D. Certains aigles royaux ont des dents en or.', 'https://images.pexels.com/photos/414155/pexels-photo-414155.jpeg', 1, 1),
(7, 2, 2, 'Quelle info sur la survie animalière est vraie ? ', 'A. Les femelles fennecs meurent en accouchant. - B. Les requins ne peuvent pas s\'arrêter de nager sinon ils meurent - C. Les paresseux ne doivent pas faire trop d\'exercice sinon ils meurent. - D. Les girafes ne doivent pas prendre de tunnel quand elles roulent en décapotable.', 'https://images.pexels.com/photos/802112/pexels-photo-802112.jpeg', 1, 1),
(8, 3, 1, 'Comment l\'hippopotame fait-il popo ? ', 'A. Il disperse ses crottes avec sa queue pour marquer son territoire. - B. Il doit arrêter toute activité pour ça tellement c\'est long et pénible. - C. Il expulse un gros rondin d\'un coup et c\'est assez spectaculaire. - D. Il ne fait jamais popo, d\'où sa taille.', 'https://images.pexels.com/photos/667201/pexels-photo-667201.jpeg', 1, 1),
(9, 4, 1, 'Quel est le point commun entre l\'Homme et l\'Aigle royal ? \r\n\r\n', 'A. Ils ont tous les deux intégrés le concept de la fidélité. - B. Ils ont tous les deux intégré le concept du travail - C. Ils ont tous les deux intégré le concept du racisme. - D. Ils ont tous les deux intégré la règle du hors-jeu.', 'https://images.pexels.com/photos/5275516/pexels-photo-5275516.jpeg', 1, 1),
(10, 5, 3, 'Les éléphants peuvent faire baisser la température de leur corps en secouant... ', 'A. Leur trompe. - B. Leur queue. - C. Leurs oreilles. - D. Un éventail, mais tous n\'en ont pas un...', 'https://images.pexels.com/photos/53125/elephant-tusk-ivory-animal-53125.jpeg', 1, 1),
(16, 1, 4, 'Si vous vouliez rejoindre le soleil en avion, combien de jours de congés devriez vous poser ? ', 'A. 15 jours, ça se négocie. - B. 6 mois, ça commence à faire long - C. 5 ans, vaudrait mieux peut être démissionner direct. - D. 17 ans, partez en Vendée comme chaque année, ce sera moins galère.', 'https://images.pexels.com/photos/355508/pexels-photo-355508.jpeg', 3, 1),
(17, 2, 3, 'Sachant que la Tour Eiffel mesure 300m de haut, combien mesure-t-elle avec David Pujadas en unité de mesure ? ', 'A. 158 David Pujadas. - B. 177 David Pujadas. - C. 182 David Pujadas. - D. 300 David Pujadas.', 'http://revuecivique.eu/wp-content/uploads/2012/05/david-pujadas-280x272.jpg', 3, 1),
(18, 3, 3, 'D\'après vous, quelle était la taille de Napoléon ?', 'A. 1,65m comme Bruno Mars. - B. 1,68m comme Nicolas Sarkozy. - C. 1,69m comme Tom Cruise. - D. 1,88m comme Arnold Schwarzenegger.', 'https://resize-parismatch.lanmedia.fr/img/var/news/storage/images/paris-match/royal-blog/royaute-francaise/l-empereur-napoleon-ier-etait-completement-accro-a-l-eau-de-cologne-1676524/27328339-1-fre-FR/Napoleon-Ier-etait-completement-accro-a-l-eau-de-Cologne.jpg', 3, 1),
(19, 4, 1, 'D\'après vous, combien de kilomètres un stylo bille BIC de type Crystal est-il capable d\'écrire ?', 'A. Entre 2 et 3km - B. Entre 3 et 4km - C. Entre 5 et 6km. - D. Entre 10 et 1000km.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/03-BICcristal2008-03-26.jpg/260px-03-BICcristal2008-03-26.jpg', 3, 1),
(20, 5, 1, 'Quelle petite particularité avait François 1er ? ', 'A. Il mesurait presque 2mètres. - B. Il pesait près de 150 kilos. - C. Il chaussait du 57. - D. Il a gagné le cross du collège Jules Ferry à Mantes-La-Jolie d\'où son nom.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/Fran%C3%A7ois_Ier_Louvre.jpg/800px-Fran%C3%A7ois_Ier_Louvre.jpg', 3, 1),
(21, 1, 2, 'Quel film n\'a jamais existé ? ', 'A. Le Trouble-fesses. - B. Vol au dessus d\'un nid de cocus. - C. Titanic 2 - D. Le Mari de la femme à barbe.', 'https://images.pexels.com/photos/390089/film-movie-motion-picture-390089.jpeg', 4, 1),
(22, 2, 4, 'Que faisait Pierce Brosnan avant d\'être acteur ? ', 'A. Avocat. - B. Prof de Sport - C. Homme de ménage. - D. Cracheur de feu.', 'https://gal.img.pmdstatic.net/fit/http.3A.2F.2Fprd2-bone-image.2Es3-website-eu-west-1.2Eamazonaws.2Ecom.2Fgal.2F2020.2F06.2F30.2F31279196-b891-4007-bc7b-b8772ad31f35.2Ejpeg/420x420/crop-from/top/focus-point/993%2C918/pierce-brosnan-le-cancer-lui-a-pris-les-deux-femmes-de-sa-vie.jpg', 4, 1),
(23, 3, 3, 'Lequel de ces films X n\'a jamais existé ? ', 'A. Coupe toi les ongles et passe moi le beurre ! - B. Ecarte les cuisses, je trouve plus ma montre ! - C. Paiement en liquide uniquement ! - D. Suzanne, ouvre-toi!', 'https://images.pexels.com/photos/2945595/pexels-photo-2945595.jpeg', 4, 1),
(24, 4, 2, 'Une seule de ces 4 épreuves de jeu TV n\'existe pas. Laquelle ?', 'A. \"Grosse ou enceinte ?\" : les candidats doivent deviner si une jeune femme attend un enfant ou si elle est en surpoids. - B. \"Hipster ou SDF ?\" : même principe. - C. \"Naturelle ou Retouchée ?\" : même principe. - D. \"Chinois ou Japonais ?\" : même principe. ', 'https://images.pexels.com/photos/2251206/pexels-photo-2251206.jpeg', 4, 1),
(25, 5, 4, 'Laquelle de ces infos ciné est fausse ?', 'A. Gwyneth Paltrow a refusé Titanic. - B. Will Smith a refusé Matrix. - C. Daniel Auteuil a refusé Intouchables - D. Sylvester Stallone a refusé Black Swan', 'https://t1.gstatic.com/images?q=tbn:ANd9GcRXY0Y_ubmeALkB8Rn0ig9A4CX24Ck6S00ds3Bm1TgU4zJwmYWbW8LFIIQrWwVH', 4, 1),
(26, 1, 4, 'Lequel de ces Tweets, l\'ex président Donald Trump n\'a t-il pas envoyé ?', 'A. Robert Pattinson ne devrait pas se remettre avec Kristen Stewart. - B. Fusillade dans une école au Texas. Les premières infos n\'ont pas l\'air terribles. - C. Il gèle et neige à New York, on a besoin du réchauffement climatique ! - D. J\'adore mes petites mains. J\'ai l\'impression d\'avoir une grosse bite.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/56/Donald_Trump_official_portrait.jpg/1200px-Donald_Trump_official_portrait.jpg', 5, 1),
(27, 2, 4, 'A quoi sert le bouton rouge sur le bureau du président Donald Trump ? ', 'A. A lâcher une bombe nucléaire - B. A appeler le chef du FBI. - C. A passer en navigation privée sur internet. - D. A commander du Coca.', 'https://photos.lci.fr/images/1024/576/le-resolute-desk-1b8835-0@1x.png', 5, 1),
(28, 3, 2, 'Laquelle de ces affirmations est vraie ? ', 'A. Bill Clinton a joué dans \"Friends\". - B. Donald Trump a joué dans \"Sex and the City\". - C. Silvio Berlusconi a joué dans \"Mafiosa\". - D. Phillipe Poutou a joué dans \"House of Cards\". ', 'https://images.pexels.com/photos/279009/pexels-photo-279009.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260', 5, 1),
(29, 4, 1, 'L\'ex président des Etats unis s\'appelle Donald J. Trump. Mais ce \"J\", c\'est l\'initiale de quel prénom ?', 'A. John, tout simplement - B. Jamel, ça m\'étonnerait. - C. Jésus, ça serait logique. - D. Jacqueline, mais j\'y crois pas trop.', 'https://static1.purepeople.com/articles/4/35/02/04/@/5010008-jamel-debbouze-montee-des-marches-du-f-624x600-2.jpg', 5, 1),
(30, 5, 3, 'Allez, assez de questions sur Trump, la dernière question n\'aura rien avoir alors. Accrochez vous bien. Pourquoi les chiens aiment-ils sortir leur tête par la fenêtre de la voiture ? ', 'A. Parce que les chiens sont d\'abord des kiffeurs avant d\'être des chiens. - B. Parce qu\'ils ont l\'ouïe hyper sensible et le bruit du moteur les insupporte. - C. Parce que pour eux, les passagers de la voiture puent. - D. Parce qu\'ils ont le mal des transports et vomissent facilement.', 'https://images.pexels.com/photos/134392/pexels-photo-134392.jpeg', 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `score`
--

CREATE TABLE `score` (
  `Id_Topic` int(11) NOT NULL,
  `Id_User` int(11) NOT NULL,
  `ScoreByTopic` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `score`
--

INSERT INTO `score` (`Id_Topic`, `Id_User`, `ScoreByTopic`) VALUES
(1, 1, 2),
(1, 3, 0),
(2, 1, 5),
(2, 3, 5),
(3, 1, 0),
(3, 3, 5),
(4, 1, 3),
(4, 3, 5),
(5, 1, 2),
(5, 3, 5);

-- --------------------------------------------------------

--
-- Structure de la table `topics`
--

CREATE TABLE `topics` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `Created_by` int(11) NOT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `topics`
--

INSERT INTO `topics` (`Id`, `Name`, `Description`, `Created_by`, `CreatedAt`) VALUES
(1, 'Animaux', 'Des questions en tout genre sur les animaux.', 1, '2021-02-02 16:15:53'),
(2, 'Correcteur Automatique', 'Je vous donne une phrase qui a été automatiquement corrigée, mais pas avec le mot que je voulais. Retrouvez le mot que je voulais utiliser.', 1, '2021-02-02 16:15:53'),
(3, 'Longueurs et Distances', 'Des questions en tout genre sur tout type de longueurs, distances, unités de mesure etc.', 1, '2021-02-02 16:15:53'),
(4, 'Films et Télévision', 'Des questions en tout genre sur les films classiques et ce qu\'on peut voir à la TV.', 1, '2021-02-02 16:15:53'),
(5, 'Trump', 'Des questions anecdotiques sur l\'ex-président des Etats-Unis, Donald J. Trump.', 1, '2021-02-02 16:15:53');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Pseudo` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Ranking` int(11) NOT NULL,
  `Admin` tinyint(2) DEFAULT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp(),
  `LastConnectedDate` datetime DEFAULT NULL,
  `Avatar_Id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`Id`, `Pseudo`, `Password`, `Email`, `Ranking`, `Admin`, `CreatedAt`, `LastConnectedDate`, `Avatar_Id`) VALUES
(1, 'ACo', 'x4/PW9xcNL9OR0F/ksl7Pw==', 'aconnaone@gmail.com', 1, 1, '2021-01-28 10:36:30', '2021-02-14 18:20:48', 3),
(2, 'AmiralFusion', 'x4/PW9xcNL9OR0F/ksl7Pw==', 'florian.connangle@gmail.com', 1, 1, '2021-01-28 10:36:30', '2021-02-02 17:38:40', 4),
(3, 'HelloToto', 'W9GAPUpbsmeJYTZWXl5qMg==', 'alexandre.connanglecode@gmail.com', 0, NULL, '2021-02-01 16:00:41', '2021-02-14 18:18:38', 3),
(8, 'Luxurysystem', '4phzataTThdUhLtSe3WF+g==', 'aconnaone2@gmail.com', 0, NULL, '2021-02-14 16:47:15', '2021-02-14 17:01:39', 2),
(9, 'Chewbacca', 'x4/PW9xcNL9OR0F/ksl7Pw==', 'jefaisuntest@gmail.com', 0, NULL, '2021-02-14 16:52:21', '2021-02-14 16:52:28', 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avatars`
--
ALTER TABLE `avatars`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `commentary`
--
ALTER TABLE `commentary`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `User_Id` (`User_Id`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Topic_Id` (`Topic_Id`);

--
-- Index pour la table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`Id_Topic`,`Id_User`),
  ADD KEY `Id_User` (`Id_User`),
  ADD KEY `Id_Topic` (`Id_Topic`) USING BTREE;

--
-- Index pour la table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `User_Id` (`Created_by`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Avatar_Id` (`Avatar_Id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avatars`
--
ALTER TABLE `avatars`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `commentary`
--
ALTER TABLE `commentary`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `topics`
--
ALTER TABLE `topics`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentary`
--
ALTER TABLE `commentary`
  ADD CONSTRAINT `commentary_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`Topic_Id`) REFERENCES `topics` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`Id_Topic`) REFERENCES `topics` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `score_ibfk_2` FOREIGN KEY (`Id_User`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`Created_by`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`Avatar_Id`) REFERENCES `avatars` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
