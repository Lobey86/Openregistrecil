-- phpMyAdmin SQL Dump
-- version 3.2.2.1deb1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mar 19 Octobre 2010 à 14:24
-- Version du serveur: 5.0.83
-- Version de PHP: 5.2.10-2ubuntu6.5


--
-- Base de données: 'openmairie' ...
--

-- --------------------------------------------------------

--
-- Structure de la table 'om_collectivite'
--

CREATE TABLE om_collectivite (
  om_collectivite int(11) NOT NULL,
  libelle varchar(100) NOT NULL,
  niveau varchar(1) NOT NULL,
  PRIMARY KEY  (om_collectivite)
) TYPE=MyISAM;

--
-- Contenu de la table 'om_collectivite'
--

INSERT INTO om_collectivite (om_collectivite, libelle, niveau) VALUES
(1, 'ARLES', '2');

-- --------------------------------------------------------

--
-- Structure de la table 'om_collectivite_seq'
--

CREATE TABLE om_collectivite_seq (
  id int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (id)
) TYPE=MyISAM ;

--
-- Contenu de la table 'om_collectivite_seq'
--

INSERT INTO om_collectivite_seq (id) VALUES
(2);

-- --------------------------------------------------------

--
-- Structure de la table 'om_droit'
--

CREATE TABLE om_droit (
  om_droit varchar(30) NOT NULL,
  om_profil varchar(2) NOT NULL default '0',
  PRIMARY KEY  (om_droit)
) TYPE=MyISAM;

--
-- Contenu de la table 'om_droit'
--

INSERT INTO om_droit (om_droit, om_profil) VALUES
('om_droit', '5'),
('edition', '3'),
('gen', '5'),
('om_utilisateur', '5'),
('om_collectivite', '5'),
('om_parametre', '5'),
('om_etat', '4'),
('om_sousetat', '4'),
('om_lettretype', '4'),
('om_droit_tab', '5'),
('om_profil_tab', '5'),
('om_collectivite_tab', '5'),
('om_parametre_tab', '5'),
('om_etat_tab', '5'),
('om_sousetat_tab', '5'),
('om_lettretype_tab', '5'),
('sauvegarde', '5'),
('import', '5'),
('om_utilisateur_tab', '5'),
('om_droit_multi', '5'),
('om_widget', '4'),
('om_tbc', '4');



--
-- Structure de la table 'om_etat'
--

CREATE TABLE om_etat (
  om_etat int(11) NOT NULL,
  om_collectivite int(11) NOT NULL,
  id varchar(50) NOT NULL,
  libelle varchar(50) NOT NULL,
  actif VARCHAR( 3 ) NOT NULL,
  orientation varchar(2) NOT NULL,
  format varchar(5) NOT NULL,
  footerfont varchar(20) NOT NULL,
  footerattribut varchar(20) NOT NULL,
  footertaille int(8) NOT NULL,
  logo varchar(30) NOT NULL,
  logoleft int(8) NOT NULL,
  logotop int(8) NOT NULL,
  titre text NOT NULL,
  titreleft int(8) NOT NULL,
  titretop int(8) NOT NULL,
  titrelargeur int(20) NOT NULL,
  titrehauteur int(8) NOT NULL,
  titrefont varchar(20) NOT NULL,
  titreattribut varchar(20) NOT NULL,
  titretaille int(8) NOT NULL,
  titrebordure varchar(20) NOT NULL,
  titrealign varchar(20) NOT NULL,
  corps text NOT NULL,
  corpsleft int(8) NOT NULL,
  corpstop int(8) NOT NULL,
  corpslargeur int(8) NOT NULL,
  corpshauteur int(8) NOT NULL,
  corpsfont varchar(20) NOT NULL,
  corpsattribut varchar(20) NOT NULL,
  corpstaille int(8) NOT NULL,
  corpsbordure varchar(20) NOT NULL,
  corpsalign varchar(20) NOT NULL,
  om_sql text NOT NULL,
  sousetat text NOT NULL,
  se_font varchar(20) NOT NULL,
  se_margeleft int(8) NOT NULL,
  se_margetop int(8) NOT NULL,
  se_margeright int(8) NOT NULL,
  se_couleurtexte varchar(11) NOT NULL,
  PRIMARY KEY  (om_etat)
) TYPE=MyISAM;

--
-- Contenu de la table 'om_etat'
--

INSERT INTO `om_etat` (`om_etat`, `om_collectivite`, `id`, `libelle`, `actif`, `orientation`, `format`, `footerfont`, `footerattribut`, `footertaille`, `logo`, `logoleft`, `logotop`, `titre`, `titreleft`, `titretop`, `titrelargeur`, `titrehauteur`, `titrefont`, `titreattribut`, `titretaille`, `titrebordure`, `titrealign`, `corps`, `corpsleft`, `corpstop`, `corpslargeur`, `corpshauteur`, `corpsfont`, `corpsattribut`, `corpstaille`, `corpsbordure`, `corpsalign`, `om_sql`, `sousetat`, `se_font`, `se_margeleft`, `se_margetop`, `se_margeright`, `se_couleurtexte`) VALUES(1, 1, 'om_collectivite', 'om_collectivite gen le 12/11/2010', 'Oui', 'P', 'A4', 'helvetica', 'I', 8, 'logopdf.png', 58, 7, 'le &aujourdhui', 41, 36, 130, 10, 'helvetica', 'B', 15, '0', 'C', '[om_collectivite]\r\n[libelle]\r\n[niveau]', 7, 57, 195, 5, 'helvetica', '', 10, '0', 'J', 'select om_collectivite.om_collectivite as om_collectivite,om_collectivite.libelle as libelle,om_collectivite.niveau as niveau from om_collectivite where om_collectivite.om_collectivite=''&idx''', 'om_parametre.om_collectivite', 'helvetica', 8, 5, 5, '0-0-0');


--
-- Structure de la table 'om_etat_seq'
--

CREATE TABLE om_etat_seq (
  id int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (id)
) TYPE=MyISAM ;

--
-- Contenu de la table 'om_sousetat_seq'
--

INSERT INTO om_etat_seq (id) VALUES
(1);



-- --------------------------------------------------------

--
-- Structure de la table 'om_parametre'
--

CREATE TABLE om_parametre (
  om_parametre int(11) NOT NULL,
  libelle varchar(20) NOT NULL,
  valeur varchar(50) NOT NULL,
  om_collectivite int(11) NOT NULL,
  PRIMARY KEY  (om_parametre)
) TYPE=MyISAM;

--
-- Contenu de la table 'om_parametre'
--

INSERT INTO om_parametre (om_parametre, libelle, valeur, om_collectivite) VALUES
(1, 'maire', 'O PENMAIRIE', 1),
(2, 'ville', 'Ville d''ARLES', 1);

-- --------------------------------------------------------

--
-- Structure de la table 'om_parametre_seq'
--

CREATE TABLE om_parametre_seq (
  id int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (id)
) TYPE=MyISAM ;

--
-- Contenu de la table 'om_parametre_seq'
--

INSERT INTO om_parametre_seq (id) VALUES
(2);

-- --------------------------------------------------------

--
-- Structure de la table 'om_profil'
--

CREATE TABLE om_profil (
  om_profil varchar(2) NOT NULL default '0',
  libelle varchar(30) NOT NULL,
  PRIMARY KEY  (om_profil)
) TYPE=MyISAM;

--
-- Contenu de la table 'om_profil'
--

INSERT INTO om_profil (om_profil, libelle) VALUES
('5', 'ADMINISTRATEUR'),
('4', 'SUPER UTILISATEUR'),
('3', 'UTILISATEUR'),
('2', 'UTILISATEUR LIMITE'),
('1', 'CONSULTATION');


-- --------------------------------------------------------

--
-- Structure de la table 'om_sousetat'
--

CREATE TABLE om_sousetat (
  om_sousetat int(11) NOT NULL,
  om_collectivite int(11) NOT NULL,
  id varchar(50) NOT NULL,
  libelle varchar(50) NOT NULL,
  actif VARCHAR( 3 ) NOT NULL,
  titre text NOT NULL,
  titrehauteur int(8) NOT NULL,
  titrefont varchar(20) NOT NULL,
  titreattribut varchar(20) NOT NULL,
  titretaille int(8) NOT NULL,
  titrebordure varchar(20) NOT NULL,
  titrealign varchar(20) NOT NULL,
  titrefond varchar(20) NOT NULL,
  titrefondcouleur varchar(11) NOT NULL,
  titretextecouleur varchar(11) NOT NULL,
  intervalle_debut int(8) NOT NULL,
  intervalle_fin int(8) NOT NULL,
  entete_flag varchar(20) NOT NULL,
  entete_fond varchar(20) NOT NULL,
  entete_orientation varchar(100) NOT NULL,
  entete_hauteur int(8) NOT NULL,
  entetecolone_bordure varchar(200) NOT NULL,
  entetecolone_align varchar(100) NOT NULL,
  entete_fondcouleur varchar(11) NOT NULL,
  entete_textecouleur varchar(11) NOT NULL,
  tableau_largeur int(8) NOT NULL,
  tableau_bordure varchar(20) NOT NULL,
  tableau_fontaille int(8) NOT NULL,
  bordure_couleur varchar(11) NOT NULL,
  se_fond1 varchar(11) NOT NULL,
  se_fond2 varchar(11) NOT NULL,
  cellule_fond varchar(20) NOT NULL,
  cellule_hauteur int(8) NOT NULL,
  cellule_largeur varchar(200) NOT NULL,
  cellule_bordure_un varchar(200) NOT NULL,
  cellule_bordure varchar(200) NOT NULL,
  cellule_align varchar(100) NOT NULL,
  cellule_fond_total varchar(20) NOT NULL,
  cellule_fontaille_total int(8) NOT NULL,
  cellule_hauteur_total int(8) NOT NULL,
  cellule_fondcouleur_total varchar(11) NOT NULL,
  cellule_bordure_total varchar(200) NOT NULL,
  cellule_align_total varchar(100) NOT NULL,
  cellule_fond_moyenne varchar(20) NOT NULL,
  cellule_fontaille_moyenne int(8) NOT NULL,
  cellule_hauteur_moyenne int(8) NOT NULL,
  cellule_fondcouleur_moyenne varchar(11) NOT NULL,
  cellule_bordure_moyenne varchar(200) NOT NULL,
  cellule_align_moyenne varchar(100) NOT NULL,
  cellule_fond_nbr varchar(20) NOT NULL,
  cellule_fontaille_nbr int(8) NOT NULL,
  cellule_hauteur_nbr int(8) NOT NULL,
  cellule_fondcouleur_nbr varchar(11) NOT NULL,
  cellule_bordure_nbr varchar(200) NOT NULL,
  cellule_align_nbr varchar(100) NOT NULL,
  cellule_numerique varchar(200) NOT NULL,
  cellule_total varchar(100) NOT NULL,
  cellule_moyenne varchar(100) NOT NULL,
  cellule_compteur varchar(100) NOT NULL,
  om_sql text NOT NULL,
  PRIMARY KEY  (om_sousetat)
) TYPE=MyISAM;


--
-- Contenu de la table 'om_sousetat'
--

INSERT INTO `om_sousetat` VALUES
(1, 1, 'om_parametre.om_collectivite', 'gen le 12/11/2010', '', 'liste om_parametre', 10, 'helvetica', 'B', 10, '0', 'L', '0', '255-255-255', '0-0-0', 0, 5, '1', '1', '0|0|0', 7, 'TLB|TLB|LTBR', 'C|C|C', '255-255-255', '0-0-0', 195, '1', 10, '0-0-0', '243-246-246', '255-255-255', '1', 7, '65|65|65', 'TLB|TLB|LTBR', 'TLB|TLB|LTBR', 'C|C|C', '1', 10, 15, '255-255-255', 'TLB|TLB|LTBR', 'C|C|C', '1', 10, 5, '212-219-220', 'TLB|TLB|LTBR', 'C|C|C', '1', 10, 7, '255-255-255', 'TLB|TLB|LTBR', 'C|C|C', '999|999|999', '0|0|0', '0|0|0', '0|0|0', 'select om_parametre.om_parametre as om_parametre,om_parametre.libelle as libelle,om_parametre.valeur as valeur from om_parametre where om_parametre.om_collectivite=''&idx''');

-- --------------------------------------------------------

--
-- Structure de la table 'om_sousetat_seq'
--

CREATE TABLE om_sousetat_seq (
  id int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (id)
) TYPE=MyISAM ;

--
-- Contenu de la table 'om_sousetat_seq'
--

INSERT INTO om_sousetat_seq (id) VALUES
(1);

-- --------------------------------------------------------

--
-- Structure de la table 'om_utilisateur'
--

CREATE TABLE om_utilisateur (
  om_utilisateur int(8) NOT NULL default '0',
  nom varchar(30) NOT NULL default '',
  email varchar(40) NOT NULL default '',
  Login varchar(30) NOT NULL default '',
  Pwd varchar(100) NOT NULL default '',
  om_profil varchar(2) NOT NULL default '0',
  om_collectivite int(11) NOT NULL,
  om_type VARCHAR( 20 ) NOT NULL,
  PRIMARY KEY  (om_utilisateur)
) TYPE=MyISAM;

--
-- Contenu de la table 'om_utilisateur'
--

INSERT INTO om_utilisateur (om_utilisateur, nom, Login, Pwd, om_profil, email, om_collectivite,om_type) VALUES
(1, 'ADMINISTRATEUR', 'admin', '21232f297a57a5a743894a0e4a801fc3', '5', 'contact@openmairie.org', 1,''),
(2, 'demo', 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', '5', 'contact@openmairie.org', 1,'');

-- --------------------------------------------------------

--
-- Structure de la table 'om_utilisateur_seq'
--

CREATE TABLE om_utilisateur_seq (
  id int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- Contenu de la table 'om_utilisateur_seq'
--

INSERT INTO om_utilisateur_seq (id) VALUES
(3);

--
-- Structure de la table 'om_lettretype'
--

CREATE TABLE om_lettretype (
  om_lettretype int(11) NOT NULL,
  om_collectivite int(11) NOT NULL,
  id varchar(50) NOT NULL,
  libelle varchar(50) NOT NULL,
  actif VARCHAR( 3 ) NOT NULL,
  orientation varchar(2) NOT NULL,
  format varchar(5) NOT NULL,
  logo varchar(30) NOT NULL,
  logoleft int(8) NOT NULL,
  logotop int(8) NOT NULL,
  titre text NOT NULL,
  titreleft int(8) NOT NULL,
  titretop int(8) NOT NULL,
  titrelargeur int(8) NOT NULL,
  titrehauteur int(8) NOT NULL,
  titrefont varchar(20) NOT NULL,
  titreattribut varchar(20) NOT NULL,
  titretaille int(8) NOT NULL,
  titrebordure varchar(20) NOT NULL,
  titrealign varchar(20) NOT NULL,
  corps text NOT NULL,
  corpsleft int(8) NOT NULL,
  corpstop int(8) NOT NULL,
  corpslargeur int(8) NOT NULL,
  corpshauteur int(8) NOT NULL,
  corpsfont varchar(20) NOT NULL,
  corpsattribut varchar(20) NOT NULL,
  corpstaille int(8) NOT NULL,
  corpsbordure varchar(20) NOT NULL,
  corpsalign varchar(20) NOT NULL,
  om_sql text NOT NULL,
  PRIMARY KEY  (om_lettretype)
) TYPE=MyISAM;

--
-- Contenu de la table 'om_lettretype'
--

INSERT INTO om_lettretype (om_lettretype, om_collectivite, id, libelle, actif, orientation, format, logo, logoleft, logotop, titre, titreleft, titretop, titrelargeur, titrehauteur, titrefont, titreattribut, titretaille, titrebordure, titrealign, corps, corpsleft, corpstop, corpslargeur, corpshauteur, corpsfont, corpsattribut, corpstaille, corpsbordure, corpsalign, om_sql) VALUES
(1, 1, 'om_utilisateur', 'lettre aux utilisateur', 'Oui', 'P', 'A4', 'logo.png', 10, 10, 'le &datecourrier\r\n\r\n\r\n[nom]\r\n[collectivite]', 130, 16, 0, 10, 'arial', '', 14, '0', 'L', 'Nous avons le plaisir de vous envoyer votre login et votre mot de passe\r\n\r\nvotre login [login]\r\nvotre mot de passe ******\r\n\r\nVous souhaitant bonne reception.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n                                                                                                                                 Votre administrateur', 40, 106, 110, 5, 'times', '', 10, '0', 'J', 'select nom,login,om_collectivite.libelle as collectivite\r\nfrom om_utilisateur inner join om_collectivite\r\non om_collectivite.om_collectivite=om_utilisateur.om_collectivite\r\nwhere om_utilisateur= &idx');

--
-- Structure de la table 'om_lettretype_seq'
--

CREATE TABLE om_lettretype_seq (
  id int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (id)
) TYPE=MyISAM ;

--
-- Contenu de la table 'om_lettretype_seq'
--

INSERT INTO om_lettretype_seq (id) VALUES
(1);

--
-- Structure de la table 'om_widget'
--
CREATE TABLE om_widget (
  om_widget int(8) NOT NULL,
  om_collectivite int(8) NOT NULL,
  libelle varchar(40) NOT NULL,
  lien varchar(80) NOT NULL,
  texte text NOT NULL,
  om_profil varchar(2),
  PRIMARY KEY  (om_widget)
) ;
-- Structure de la table 'om_widget_seq'
CREATE TABLE om_widget_seq (
  id int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (id)
) TYPE=MyISAM ;

INSERT INTO om_widget_seq (id) VALUES
(0);

--
-- Structure de la table 'om_tdb'
--
CREATE TABLE om_tdb (
  om_tdb int(8) NOT NULL,
  login varchar(40) NOT NULL,
  bloc varchar(10) NOT NULL,
  position int(8),
  om_widget int(8) NOT NULL,
  PRIMARY KEY  (om_tdb)
) ;
-- Structure de la table 'om_tdb_seq'

CREATE TABLE om_tdb_seq (
  id int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (id)
) TYPE=MyISAM ;

INSERT INTO om_tdb_seq (id) VALUES
(0);

-- sig
CREATE TABLE om_sig_point
(
  om_sig_point int(8) NOT NULL,
  om_collectivite int(11) NOT NULL,
  id varchar(50) NOT NULL,
  libelle varchar(50) NOT NULL,
  actif varchar(3),
  zoom varchar(3) NOT NULL,
  fond_osm varchar(3) NOT NULL,
  fond_bing varchar(3) NOT NULL,
  fond_sat varchar(3) NOT NULL,
  layer_info varchar(3) NOT NULL,
  etendue varchar(60) NOT NULL,
  projection_externe varchar(60) NOT NULL,
  url text NOT NULL,
  om_sql text NOT NULL,
  maj varchar(3) NOT NULL,
  table_update varchar(30) NOT NULL,
  champ varchar(30) NOT NULL,
  retour varchar(50) NOT NULL,
  PRIMARY KEY  (om_sig_point)
);
CREATE TABLE om_sig_point_seq (
  id int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (id)
) TYPE=MyISAM ;

INSERT INTO om_sig_point_seq (id) VALUES
(0);
