-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 15 déc. 2017 à 08:17
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `epsilon`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id_user` int(11) NOT NULL,
  UNIQUE KEY `idUser` (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id_user`) VALUES
(10);

-- --------------------------------------------------------

--
-- Structure de la table `authors`
--

DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `id_author` int(11) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(128) NOT NULL,
  PRIMARY KEY (`id_author`),
  UNIQUE KEY `author_name` (`author_name`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `authors`
--

INSERT INTO `authors` (`id_author`, `author_name`) VALUES
(1, 'Karl Marx'),
(2, 'Babar'),
(12, 'J. D. Salinger'),
(11, 'Jean-Paul Sartre'),
(7, 'Jean de Brunhoff'),
(8, 'Zep'),
(9, 'Frédéric Beigbeder'),
(13, ' Arthur Rimbaud'),
(14, 'Aldous Huxley'),
(15, 'Hergé');

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id_book` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `id_author` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `path` varchar(128) DEFAULT 'noimage.png',
  PRIMARY KEY (`id_book`),
  UNIQUE KEY `id_book` (`id_book`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id_book`, `title`, `id_author`, `id_categorie`, `description`, `price`, `path`) VALUES
(1, 'Manifeste du Parti communiste', 1, 3, 'Le Manifeste du parti communiste est un essai politico-philosophique commandé par la Ligue des communistes, et rédigé par le philosophe allemand Karl Marx. ', 5.99, '1.jpg'),
(2, 'Le Capital', 1, 3, 'Le Capital. Critique de l\'économie politique est l\'ouvrage majeur du philosophe et théoricien de l\'économie politique allemand Karl Marx. ', 50, '2.jpg'),
(23, 'Le Roi Babar', 7, 3, 'Les premières aventures de Babar. Le roi Babar rentre de son voyage de noces chargé de nombreux cadeaux qu\'il distribuera lorsque Célesteville sera construite. Tous se mettent au travail dans la joie et la bonne humeur.', 7.5, '23.jpg'),
(24, 'Titeuf : Nadia se marie', 8, 6, 'Dans le préau de l\'école, un drame se noue. En effet, à dix jours du bal de fin de l\'école, Titeuf n\'a toujours pas invité « sa » Nadia. Pire ne encore, il semble que celle-ci ait trouvé un nouveau fiancé. Dès lors, Titeuf multiplie les plans pour désunir le ne nouveau couple et faire échouer un éventuel ne mariage. Son obsession : remettre Nadia dans le droit chemin. Et il n\'aura pas assez d\'amis, Manu, Hugo et les autres étant aussi incultes que lui en la matière, pour parvenir à ses fins.', 11, '24.jpg'),
(25, 'Titeuf : Mes meilleurs copains', 8, 6, 'Ça y est Titeuf déménage. Il va tout faire pour que ce départ reste dans les mémoires.', 11, '25.jpg'),
(26, '99 francs', 9, 2, 'Ce roman a été découpé en six chapitres dont chaque partie est nommée par un pronom personnel, en lien avec Octave, le protagoniste. Ainsi, dans le chapitre premier, « Je », l\'auteur s\'exprime à la première personne. Dans le chapitre « Tu », il s\'exprime à la deuxième personne, comme une vue de l\'extérieur de sa propre vie, et ainsi de suite jusqu\'au pronom personnel « Ils ». Ce livre se termine par une pléiade de slogans publicitaires, ceux-ci se finissant par le cynique « Bienvenue dans un monde meilleur ». Cette conclusion résume la promesse mensongère inhérente à l\'ensemble de la publicité — la promesse d\'une vie meilleure — dans un monde où la recherche du bonheur a fusionné avec l\'image publicitaire.', 14.99, '26.jpg'),
(27, 'L\'amour dure trois ans', 9, 2, 'Marc Marronnier raconte dans le désordre ses déboires amoureux et sa vision de l\'Amour avec un grand A. La thèse-titre est martelée plusieurs fois au cours du roman : l\'amour dure trois ans, l\'ennui s\'installant rapidement dans la relation de couple. Le lecteur a donc droit au récit de l\'idylle, du mariage, puis de la séparation d\'avec sa première femme, Anne. Ensuite, il rencontre Alice qui devient sa maîtresse. Le reste du roman consiste en quelques digressions sur la vie mondaine, la superficialité de certaines personnes, le mariage et le sexe.', 13, '27.jpg'),
(28, 'L\'existentialisme est un humanisme', 11, 4, 'L\'existentialisme est un humanisme est un ouvrage philosophique de Jean-Paul Sartre, publié en 1946 et considéré comme l\'exposé de sa conception philosophique, l\'existentialisme. Il est le compte rendu d\'une conférence réalisée en octobre 1945 à Paris.', 8.6, '28.jpg'),
(29, 'L\'Attrape-cœurs', 12, 4, 'Écrit à la première personne, le roman relate les trois jours durant lesquels Holden Caulfield vit seul dans New York, après avoir été expulsé de Pencey Prep (école préparatoire).\r\n\r\nDans les premiers chapitres, il évoque ses rencontres avec des étudiants de Pencey (en particulier Stradlater et Ackley), qu\'il qualifie de superficiels. Après avoir été renvoyé du collège, Holden fait rapidement ses bagages et quitte l\'école en plein milieu de la nuit. Ayant pris un train pour New York, il se refuse à regagner directement l\'appartement familial et préfère réserver une chambre dans un hôtel sordide, Edmont Hotel. Il passe la soirée à danser avec trois jeunes filles de Seattle (dont seulement une est jolie selon lui) et rencontre une prostituée, avec qui Holden aura un léger malentendu : il refuse de faire quoi que ce soit avec elle, mais la paye quand même pour lui avoir accordé son temps. La prostituée, Sunny, revient plus tard dans la soirée pour lui demander plus d\'argent qu\'il était convenu et lorsque Holden refuse de payer, il reçoit un coup violent de la part de son proxénète.\r\n\r\nHolden passe deux jours en ville, largement caractérisés par l\'ivresse et la solitude. Au point qu\'il finit dans un musée, où il compare sa vie avec celles des statues, qui sont fixées et ne changent jamais. L\'adolescent est effrayé et nerveux à l\'idée de grandir, de devenir adulte. Il se pourrait que ses doutes aient, en partie, été causés par la mort de son frère, Allie. À la fin du roman, Holden finira par faire un tour chez lui, pendant l\'absence de ses parents, pour prendre des nouvelles de sa petite sœur Phoebé, « une petite crevette » de 10 ans qui se trouve être la seule personne qu\'il aime littéralement et avec qui il peut communiquer aisément. L\'explication du titre est donnée dans ce chapitre, lorsque Holden et Phoebé parlent du poème de Robert Burns, Comin\' Thro\' the Rye. Il s\'imagine dans un champ de seigle avec des milliers de petits « mômes ». Il est au bord d\'une falaise et doit seulement les empêcher de tomber, s\'ils ne regardent pas où ils vont, s\'ils s\'approchent trop près du bord. Il serait « l\'attrape-cœurs » (« the catcher in the rye »). On peut comprendre ce passage comme étant la plus grande envie de Holden : empêcher les enfants de grandir, de tomber de la falaise.', 4.9, '29.jpg'),
(30, 'Le Guide du zizi sexuel', 8, 3, 'Le Guide du zizi sexuel est un album hors-série de bande-dessinée Titeuf co-écrit par Hélène Bruller et Zep, et dessiné par ce dernier. Sorti en 2001, ce guide a pour but de répondre aux questions des 9-13 ans concernant la sexualité.', 20, '30.jpg'),
(31, 'Cahier de Douai', 13, 1, 'Le Cahier de Douai, expression utilisée notamment par Pierre Brunel, ou Recueil de Douai ou encore Recueil Demeny est un ensemble de vingt-deux poèmes écrits par Arthur Rimbaud alors adolescent de 16 ans. Rimbaud les réunit, lors de son séjour à Douai en septembre-octobre 1870, sous forme d\'une liasse manuscrite sans titre pour les confier à Paul Demeny aux fins de publication.\r\nCes poèmes ont été écrits vraisemblablement entre mars et octobre 1870 et sont décomposées en deux liasses respectivement de 15 et 7 poèmes :\r\n\r\nPremier cahier \r\n\r\n    Première soirée, cette pièce est une version de Trois baisers, précédemment éditée.\r\n    Sensation\r\n    Le Forgeron\r\n    Soleil et chair\r\n    Ophélie\r\n    Bal des pendus\r\n    Le Châtiment de Tartufe\r\n    Vénus anadyomène\r\n    Les Réparties de Nina\r\n    À la musique\r\n    Les Effarés\r\n    Roman\r\n    « Morts de Quatre-vingt-douze »\r\n    Le Mal\r\n    Rages de Césars\r\n\r\nDeuxième Cahier \r\n\r\n    Rêvé pour l\'hiver\r\n    Le Dormeur du val\r\n    Au Cabaret-Vert, cinq heures du soir\r\n    La Maline\r\n    L\'Éclatante Victoire de Sarrebrück\r\n    Le Buffet\r\n    Ma Bohème\r\n', 3.14, '31.gif'),
(32, 'Titeuf : À fond le slip !', 8, 6, ' L\'album qui va faire craquer toute la famille !Que ce soit en classe, dans la cour de récré, à la maison ou dans la rue, Titeuf est très attentif au monde qui l’entoure. Mais en ce moment il est carrément perdu ! Entre les manifs contre les déchets nucléaires qui puent du slip comme les couches de Zizie et les gens qui descendent dans la rue contre les IVGétariens, il a l’impression qu’aujourd’hui il faut avoir un avis sur tout. Mais pô facile de faire le bon choix dans un monde qui devient de plus en plus compliqué ! Heureusement qu’il reste les copains et les vidéos sur internet pour tout nous expliquer.La mèche la plus célèbre de la BD est de retour ! Après un album remarqué imaginant son passage à l’adolescence, Titeuf revient pour un album de gags à la fois drôles, tendres et totalement connectés à notre époque. Des grands phénomènes de notre société moderne aux petites gamelles de la cour de récré, Zep utilise avec une virtuosité rare l’humour du quotidien pour scruter le monde à travers le regard de l’enfance – parfois insolent, toujours juste.', 13, '32.jpg'),
(34, 'Nouvelles sous ecstasy', 9, 2, 'Certains territoires du cervelet et d\'autres champs de la conscience sont restés inexplorés avant les années quatre-vingt et la découverte d\'une nouvelle drogue, la MDMA, plus connue sous le nom d\'ecstasy. Drogue dure, cette &quot;pilule de l\'amour&quot; à effet rapide &quot;avec une montée et une descente comme dans les montagnes russes&quot; rend la vie des personnages de ce recueil de nouvelles parfois difficile : jouissive avant d\'être sombre, heureuse avant d\'être déprimante. On s\'aime, on se déchire, on fait des choses folles comme voir le monde au bord du gouffre, oublier ses inhibitions et ses tabous... et puis... passer les bornes. Oui sans doute, sans doute, car voilà tout le talent de Beigbeder. Avec beaucoup d\'humour et d\'invention, il nous propose une réflexion sur l\'amour et sur la folie, deux concepts aux multiples ramifications. Et avec toute l\'affection dont il est capable, il partage le &quot;trip&quot; de ses personnages, nous offrant la possibilité d\'hésiter : est-ce l\'auteur qui écrit sous ecstasy ou le récit de la vie d\'individus en plein envol ? Peut-être bien les deux, ce qui ne gâche en rien le plaisir de la lecture. --Hector Chavez ', 4.95, '34.jpg'),
(35, 'Au secours pardon', 9, 2, 'Ce roman est présenté comme la suite de 99 francs. Cette fois, Octave Parango est devenu un chasseur de mannequins qui part pour la Russie pour trouver la perle rare pour une firme de cosmétiques nommée L\'Idéal (en référence à la société L\'Oréal). Comme dans 99 francs, il est question de vie facile, d\'amour superficiel avec sa dose de drogue et d\'alcool, mâtiné d\'une histoire d\'amour entre Octave et une gamine de quatorze ans.', 14.99, '35.jpg'),
(36, 'Le Meilleur des mondes', 14, 2, 'Le Meilleur des mondes (Brave New World) est un roman d\'anticipation dystopique, écrit en 1931 par Aldous Huxley. Il paraît en 1932. Huxley le rédige en quatre mois, à Sanary-sur-Mer, dans le sud de la France. Vingt-cinq ans plus tard, Huxley publie un essai dédié à ce livre, Retour au meilleur des mondes, insistant notamment sur les évolutions du monde qu\'il perçoit comme allant dangereusement vers le monde décrit dans son ouvrage. Le titre original du roman, Brave New World, provient de La Tempête de William Shakespeare, acte 5 scène 1. John, le « Sauvage », reprend souvent cette phrase dans le roman (chap. 8, 11, 15). Dans la pièce de Shakespeare, la phrase est ironique et la traduction française reprend la même ironie, mais en référence à la littérature française : le « meilleur des mondes possibles » du Candide de Voltaire.', 8.5, '36.jpg'),
(37, 'Tintin : On a marché sur la Lune', 15, 6, 'Le récit se poursuit au point où l’avait laissé Objectif Lune. Après quelques minutes de peur au lancement, les passagers de la fusée reprennent connaissance et tout semble bien se passer : la fusée se dirige vers la Lune. Cependant, il y a une surprise de taille : les Dupondt, qui ont pris place à bord pour des raisons de sécurité, se sont trompés d’heure. Cette situation force Tournesol à réduire la durée du voyage afin de ne pas manquer d’oxygène…', 6.95, '37.jpg'),
(38, 'Tintin : Objectif Lune', 15, 6, 'De retour de voyage, Tintin et le capitaine Haddock apprennent que le professeur Tournesol qui était censé rester au château de Moulinsart est parti trois semaines auparavant pour la Syldavie. À leur arrivée, ils reçoivent un télégramme du professeur leur demandant de le rejoindre sans pour autant leur expliquer les raisons de son départ.', 6.95, '38.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_name` varchar(32) NOT NULL,
  `category_description` text NOT NULL,
  PRIMARY KEY (`id_categorie`),
  UNIQUE KEY `categorieName` (`categorie_name`),
  UNIQUE KEY `idCategorie` (`id_categorie`),
  UNIQUE KEY `categorie_name` (`categorie_name`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `categorie_name`, `category_description`) VALUES
(1, 'Poésie', 'Retrouvez les plus beaux recueils de poèmes des auteurs français et d\'ailleurs. '),
(2, 'Roman', 'Laissez vous tenter par des histoires prenantes, qui vont feront voyager sans quitter votre fauteuil.'),
(3, 'Éducation', 'Puisqu\'il faut bien éduquer nos petites têtes blondes, voici de quoi leur inculquer les bonnes valeurs'),
(4, 'Culture', 'La culture, c\'est comme la confiture, moins on en a, plus on l\'étale.'),
(6, 'Bande Dessinée', 'La neuvième art saura à coup sûr vous séduire, pour les petits et grands');

-- --------------------------------------------------------

--
-- Structure de la table `commands`
--

DROP TABLE IF EXISTS `commands`;
CREATE TABLE IF NOT EXISTS `commands` (
  `idCommand` varchar(8) NOT NULL,
  `idUser` int(11) NOT NULL,
  `status` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commands`
--

INSERT INTO `commands` (`idCommand`, `idUser`, `status`) VALUES
('A4AEADC', 10, 'Commandé'),
('4955B97', 10, 'Commandé'),
('1DD9182', 10, 'Commandé'),
('076C8DE', 10, 'Commandé'),
('1DEA079', 10, 'Commandé'),
('B071BA9', 10, 'Commandé'),
('28C6394', 10, 'Commandé'),
('C8009B7', 10, 'Commandé');

-- --------------------------------------------------------

--
-- Structure de la table `commands_items`
--

DROP TABLE IF EXISTS `commands_items`;
CREATE TABLE IF NOT EXISTS `commands_items` (
  `idCommand` varchar(8) NOT NULL,
  `idBook` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commands_items`
--

INSERT INTO `commands_items` (`idCommand`, `idBook`, `quantity`, `price`) VALUES
('1DD9182', 2, 5, 50),
('1DD9182', 1, 1, 5.99),
('076C8DE', 2, 5, 50),
('076C8DE', 1, 1, 5.99),
('1DEA079', 1, 2, 5.99),
('B071BA9', 1, 3, 5.99),
('28C6394', 1, 4, 5.99),
('C8009B7', 1, 1, 5.99);

-- --------------------------------------------------------

--
-- Structure de la table `new`
--

DROP TABLE IF EXISTS `new`;
CREATE TABLE IF NOT EXISTS `new` (
  `id_book` int(11) NOT NULL,
  UNIQUE KEY `idBook` (`id_book`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `new`
--

INSERT INTO `new` (`id_book`) VALUES
(26),
(28),
(29),
(32);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(32) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `address` varchar(128) NOT NULL,
  `city` varchar(64) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `id_user` (`id_user`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `login`, `email`, `password`, `user_name`, `address`, `city`) VALUES
(11, 'user', 'user@user.fr', '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', 'Utilisateur', '404 rue Jimi Hendrix', 'Paris'),
(10, 'admin', 'admin@admin.fr', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'Administrateur', '2 Place du Colonel Fabien', 'Paris'),
(12, 'Vincent le BG du 91', 'vincent@vincent.fr', '65c3f75641b22925c737ca657b126cd68c39e423349d43031cf9a3b9a18cee1f', 'Vincent Monard', '1337 rue Allan Turing', 'Bangkok');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
