-- phpMyAdmin SQL Dump
-- version 2.11.3deb1ubuntu1.3
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mar 17 Mai 2011 à 09:21
-- Version du serveur: 5.0.51
-- Version de PHP: 5.2.4-2ubuntu5.10


--
-- Base de données: `openregistrecil`
--

--
-- Structure de la table 'categorie_donnee'
--

CREATE TABLE categorie_donnee (
  categorie_donnee char(3) NOT NULL default '0',
  libelle varchar(80) NOT NULL default '',
  PRIMARY KEY  (categorie_donnee)
) TYPE=MyISAM;

--
-- Contenu de la table 'categorie_donnee'
--

INSERT INTO categorie_donnee (categorie_donnee, libelle) VALUES
('A', '- identitee'),
('B', '- Numero de securite Sociale'),
('C', '- Situation familiale'),
('D', '- Situation militaire'),
('E', '- Formation - Diplomes - Distinctions'),
('F', '- Logement'),
('G', '- Vie professionnelle'),
('H', '- Situation economique et financiere'),
('I', '- Deplacement des personnes'),
('J', '- Utilisation media et moyens de communication'),
('K', '- Consommation autres biens et services'),
('L', '- Loisirs'),
('M', '- Sante'),
('N', '- Habitudes de vie et comportement'),
('O', '- Operation en rapport avec la police'),
('P', '- Information en rapport avec la justice');

-- --------------------------------------------------------

--
-- Structure de la table 'categorie_personne'
--

CREATE TABLE categorie_personne (
  categorie_personne char(3) NOT NULL default '',
  libelle varchar(80) NOT NULL default '',
  PRIMARY KEY  (categorie_personne)
) TYPE=MyISAM;

--
-- Contenu de la table 'categorie_personne'
--

INSERT INTO categorie_personne (categorie_personne, libelle) VALUES
('A', '- Agent de la collectivite'),
('B', '- entreprise'),
('C', '- usagers');

-- --------------------------------------------------------

--
-- Structure de la table 'destinataire'
--

CREATE TABLE destinataire (
  destinataire int(8) NOT NULL default '0',
  organisme varchar(20) NOT NULL default '',
  libelle varchar(60) NOT NULL default '',
  categorie_donnee text NOT NULL,
  registre int(8) NOT NULL default '0',
  PRIMARY KEY  (destinataire)
) TYPE=MyISAM;



--
-- Structure de la table 'dossier'
--

CREATE TABLE dossier (
  dossier int(8) NOT NULL default '0',
  registre int(8) NOT NULL default '0',
  fichier varchar(40) NOT NULL default '',
  datedossier date NOT NULL default '0000-00-00',
  observation longtext NOT NULL,
  typedossier varchar(20) NOT NULL default '',
  PRIMARY KEY  (dossier)
) TYPE=MyISAM;

-- droit

INSERT INTO om_droit (om_droit, om_profil) VALUES
('reference', 4),
('service', 3),
('registre', 3),
('dispense', 3),
('demande_avis', 3),
('norme_simplifiee', 3),
('autorisation_unique', 3),
('autorisation_normale', 3),
('organisme', 4),
('categorie_personne', 4),
('categorie_donnee', 4),
('dossier', 3),
('destinataire', 3);


--
-- Structure de la table 'modificatif'
--

CREATE TABLE modificatif (
  modificatif int(8) NOT NULL default '0',
  date_modificatif date NOT NULL default '0000-00-00',
  note text NOT NULL,
  registre int(8) NOT NULL default '0',
  PRIMARY KEY  (modificatif)
) TYPE=MyISAM;

--
-- contenu om_etat
--

INSERT INTO om_etat (om_etat, om_collectivite, id, libelle, actif, orientation, format, footerfont, footerattribut, footertaille, logo, logoleft, logotop, titre, titreleft, titretop, titrelargeur, titrehauteur, titrefont, titreattribut, titretaille, titrebordure, titrealign, corps, corpsleft, corpstop, corpslargeur, corpshauteur, corpsfont, corpsattribut, corpstaille, corpsbordure, corpsalign, om_sql, sousetat, se_font, se_margeleft, se_margetop, se_margeright, se_couleurtexte) VALUES
(2, 1, 'registre', 'import du 17/05/2011', '', 'L', 'A4', 'helvetica', 'I', 8, 'logopdf.jpg', 15, 8, '<b> [nature]\r\n\r\n</b>\r\n<b>T R A I T E M E N T       No  C N I L   :  [numero_cnil]</b>\r\nFinalité : [finalite]\r\n<b>Date du Registre  :  [date_registre]</b>', 90, 8, 195, 6, 'arial', 'I', 13, '0', 'C', '<b>C a t e g o r i e    de  d o n n é e s</b> :\r\n[categorie_donnee]\r\n\r\n<b>E x c l  u s i  o n</b> : [exclusion]\r\n\r\n<b>C o n s e r v a t i o n</b> :     [conservation]\r\n\r\n<b>N o r m e    C N I L</b>  :  [nature]     [reference]\r\n<b>S e r v i c e  du  T r a i t e m e n t</b>  :     [service]\r\n<b>S e r v i c e    o u   s '' e x e r c e    le     D r o i t    d ''  A c c è s</b>  :    [droit_acces]\r\n<b>D a t e    de   M i s e    à  J o u r</b>  :     [date_maj]           <b>A v i s</b>  :     [avis]\r\n\r\n<b>D e s c r i p t i on</b>  :  [note]', 7, 43, 280, 5, 'helvetica', 'I', 9, '1', 'J', 'select numero_cnil,finalite,concat(substring(date_registre,9,2),''/'',substring(date_registre,6,2),''/'',substring(date_registre,1,4)) as date_registre,note,categorie_personne,categorie_donnee,exclusion,\r\n              conservation,\r\n              concat(registre.service,'' - '',service.libelle) as service,\r\n              concat(registre.droit_acces,'' - '',service1.libelle) as droit_acces,\r\n              concat(registre.reference,'' - '',reference.libelle) as reference,\r\n              concat(substring(date_maj,9,2),''/'',substring(date_maj,6,2),''/'',substring(date_maj,1,4)) as date_maj,\r\n              avis,\r\n              registre.nature from registre\r\n              left join service on registre.service=service.service\r\n              left join reference  on registre.reference=reference.reference\r\n              left join service as service1   on registre.droit_acces=service1.service\r\n              where registre=''&idx''', 'destinataire\r\ndossier\r\nmodificatif', 'helvetica', 8, 5, 5, '0-0-0');

update om_etat_seq set id=2;

--
-- Contenu de la table 'om_sousetat'
--

INSERT INTO om_sousetat (om_sousetat, om_collectivite, id, libelle, actif, titre, titrehauteur, titrefont, titreattribut, titretaille, titrebordure, titrealign, titrefond, titrefondcouleur, titretextecouleur, intervalle_debut, intervalle_fin, entete_flag, entete_fond, entete_orientation, entete_hauteur, entetecolone_bordure, entetecolone_align, entete_fondcouleur, entete_textecouleur, tableau_largeur, tableau_bordure, tableau_fontaille, bordure_couleur, se_fond1, se_fond2, cellule_fond, cellule_hauteur, cellule_largeur, cellule_bordure_un, cellule_bordure, cellule_align, cellule_fond_total, cellule_fontaille_total, cellule_hauteur_total, cellule_fondcouleur_total, cellule_bordure_total, cellule_align_total, cellule_fond_moyenne, cellule_fontaille_moyenne, cellule_hauteur_moyenne, cellule_fondcouleur_moyenne, cellule_bordure_moyenne, cellule_align_moyenne, cellule_fond_nbr, cellule_fontaille_nbr, cellule_hauteur_nbr, cellule_fondcouleur_nbr, cellule_bordure_nbr, cellule_align_nbr, cellule_numerique, cellule_total, cellule_moyenne, cellule_compteur, om_sql) VALUES
(2, 1, 'destinataire', 'import du 17/05/2011', 'Oui', 'D   E   S   T   I   N   A   T   A   I   R   E', 10, 'helvetica', 'B', 10, '0', 'L', '0', '243-246-246', '0-0-0', 8, 0, '1', '1', '0|0|0|0|0|0|0|0|0|0|0|0|0', 10, 'TLB|LTB|LTBR|TLB|LTB|LTBR|TLB|LTB|LTBR|TLB|LTB|LTBR|LTBR', 'C|C|C|C|C|C|C|C|C|C|C|C|C', '255-212-0', '0-0-0', 280, '1', 8, '0-0-0', '243-243-246', '255-255-255', '1', 7, '40|100|140|15|15|15|15|15|15|15|15|15|15', 'LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR', 'LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR', 'L|L|L|C|C|C|C|C|C|C|C|C|C', '1', 10, 15, '196-213-215', 'LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR', 'C|C|C|C|C|C|C|C|C|C|C|C|C', '1', 10, 15, '196-213-215', 'LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR', 'C|C|C|C|C|C|C|C|C|C|C|C|C', '1', 10, 15, '196-213-215', 'LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR', 'C|C|C|C|C|C|C|C|C|C|C|C|C', '999|999|999|999|999|999|999|999|999|999|999|999|999', '0|0|0|0|0|0|0|0|0|0|0|0|0', '0|0|0|0|0|0|0|0|0|0|0|0|0', '0|0|0|0|0|0|0|0|0|0|0|0|0', 'select organisme.organisme,organisme.libelle,categorie_donnee\r\n from destinataire inner join organisme\r\n on destinataire.organisme = organisme.organisme\r\n where registre=''&idx'''),
(3, 1, 'dossier', 'import du 17/05/2011', 'Oui', 'D   O   S   S   I   E  R', 10, 'helvetica', 'B', 10, '0', 'L', '0', '243-246-246', '0-0-0', 0, 5, '1', '1', '0|0|0|0|0|0|0|0|0|0|0|0|0', 10, 'TLBR|LTBR|LTBR|TLBR|LTBR|LTBR|TLB|LTB|LTBR|TLB|LTB|LTBR|LTBR', 'C|C|C|C|C|C|C|C|C|C|C|C|C', '255-212-0', '0-0-0', 280, '1', 8, '0-0-0', '243-243-246', '255-255-255', '1', 7, '16|26|26|176|36|15|15|15|15|15|15|15|15', 'LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR', 'LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR', 'C|C|C|L|C|C|C|C|C|C|C|C|C', '1', 10, 15, '196-213-215', 'LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR', 'C|C|C|C|C|C|C|C|C|C|C|C|C', '1', 10, 15, '196-213-215', 'LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR', 'C|C|C|C|C|C|C|C|C|C|C|C|C', '1', 10, 15, '196-213-215', 'LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR', 'C|C|C|C|C|C|C|C|C|C|C|C|C', '999|999|999|999|999|999|999|999|999|999|999|999|999', '0|0|0|0|0|0|0|0|0|0|0|0|0', '0|0|0|0|0|0|0|0|0|0|0|0|0', '0|0|0|0|0|0|0|0|0|0|0|0|0', 'select dossier,fichier,concat(substring(datedossier,9,2),''/'',substring(datedossier,6,2),''/'',substring(datedossier,1,4)) as datedossier,observation,typedossier\r\n                  from dossier\r\n                  where registre=''&idx'''),
(4, 1, 'modificatif', 'import du 17/05/2011', 'Oui', 'M   O   D   I   F   I   C   A   T   I   F', 10, 'helvetica', 'B', 10, '0', 'L', '0', '243-246-246', '0-0-0', 5, 5, '1', '1', '0|0|0|0|0|0|0|0|0|0|0|0|0', 10, 'TLB|LTB|LTBR|TLB|LTB|LTBR|TLB|LTB|LTBR|TLB|LTB|LTBR|LTBR', 'C|C|C|C|C|C|C|C|C|C|C|C|C', '255-212-0', '0-0-0', 280, '1', 8, '0-0-0', '243-243-246', '255-255-255', '1', 7, '30|30|220|15|15|15|15|15|15|15|15|15|15', 'LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR', 'LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR', 'C|C|L|C|C|C|C|C|C|C|C|C|C', '1', 10, 15, '196-213-215', 'LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR', 'C|C|C|C|C|C|C|C|C|C|C|C|C', '1', 10, 15, '196-213-215', 'LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR', 'C|C|C|C|C|C|C|C|C|C|C|C|C', '1', 10, 15, '196-213-215', 'LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR|LTBR', 'C|C|C|C|C|C|C|C|C|C|C|C|C', '999|999|999|999|999|999|999|999|999|999|999|999|999', '0|0|0|0|0|0|0|0|0|0|0|0|0', '0|0|0|0|0|0|0|0|0|0|0|0|0', '0|0|0|0|0|0|0|0|0|0|0|0|0', 'select modificatif,concat(substring(date_modificatif,9,2),''/'',substring(date_modificatif,6,2),''/'',substring(date_modificatif,1,4)) as date_modificatif,note\r\n                  from modificatif\r\n                  where registre=''&idx''');

-- om_sousetat_seq
update om_sousetat_seq set id=4;



--
-- Structure de la table 'organisme'
--

CREATE TABLE organisme (
  organisme varchar(20) NOT NULL default '',
  libelle varchar(80) NOT NULL default '',
  PRIMARY KEY  (organisme)
) TYPE=MyISAM;

--
-- Contenu de la table 'organisme'
--

INSERT INTO organisme (organisme, libelle) VALUES
('INSEE', 'Direction regionale de l INSEE'),
('TG', 'Tresorerie generale'),
('CNAM', 'Assurance maladie');

-- --------------------------------------------------------

--
-- Structure de la table 'reference'
--

CREATE TABLE reference (
  reference varchar(10) NOT NULL default '',
  libelle varchar(80) NOT NULL default '',
  nature varchar(30) NOT NULL default '',
  PRIMARY KEY  (reference)
) TYPE=MyISAM;

--
-- Contenu de la table 'reference'
--

INSERT INTO reference (reference, libelle, nature) VALUES
('DI-001', 'Gestion de la paie', 'dispense'),
('NS-042', 'Gestion controle acces aux locaux, horaires et restauration', 'norme_simplifiee'),
('NS-046', 'Gestion du personnel', 'norme_simplifiee'),
('NS-047', 'telephonie', 'norme_simplifiee'),
('DI-010', 'Comite entreprise', 'dispense'),
('NS-044', 'Exploitation des donnees de la matrice cadastrale', 'norme_simplifiee'),
('AU-007', 'Biometrie Contour de la main', 'autorisation_unique'),
('NS-041', 'Geolocaliser les vehicules utilises par leurs employes', 'norme_simplifiee'),
('NS-043', 'Gestion de l''etat civil', 'norme_simplifiee'),
('NS-015', 'Listes d''adresses ayant pour objet l''envoi d''informations', 'norme_simplifiee'),
('NS-045', 'Exploitation de donnees issues des roles des impots locaux', 'norme_simplifiee'),
('NS-010', 'Mise en recouvrement de certaines taxes et redevances', 'norme_simplifiee'),
('NS-027', 'Facturation des differents services offerts aux parents par les collectivites te', 'norme_simplifiee'),
('NS-039', 'autocommutateurs telephoniques desservant des postes telephoniques mis a la disp', 'norme_simplifiee'),
('NS-033', 'Gestion des eleves inscrits dans les ecoles maternelles et elementaires', 'norme_simplifiee'),
('NS-009', 'Gestion de prets de livres, de supports audiovisuels et d''oeuvres artistiques', 'norme_simplifiee'),
('NS-020', 'Gestion du patrimoine immobilier a caractere social', 'norme_simplifiee'),
('NS-021', 'Gestion des biens immobiliers', 'norme_simplifiee'),
('DI-012', ' gestion du fichier electoral des communes', 'dispense'),
('DI-007', 'information ou de communication externe', 'dispense'),
('DI-004', 'gestion des fichiers de fournisseurs comportant des personnes physiques', 'dispense'),
('DI-003', 'Dematerialisation des marches publics', 'dispense'),
('AU-001', 'gestion de l urbanisme ou du service public de l assaint non collectif  - SIG', 'autorisation_unique'),
('AU-004', 'dispositifs d alerte professionnelle', 'autorisation_unique'),
('RU-001', 'demandes de validation des attestations d accueil', 'dispense'),
('RU-002', 'Teleservice demande d acte de naissance (DGME)', 'dispense');

-- --------------------------------------------------------

--
-- Structure de la table 'registre'
--

CREATE TABLE registre (
  registre int(8) NOT NULL default '0',
  finalite varchar(80) NOT NULL default '',
  numero_cnil varchar(20) NOT NULL default '',
  note text NOT NULL,
  date_registre date NOT NULL default '0000-00-00',
  categorie_personne text NOT NULL,
  categorie_donnee text NOT NULL,
  conservation text NOT NULL,
  nature varchar(30) NOT NULL default '',
  service varchar(10) NOT NULL default '',
  droit_acces varchar(10) NOT NULL default '',
  date_maj date NOT NULL default '0000-00-00',
  reference varchar(10) NOT NULL default '',
  avis char(3) NOT NULL default '',
  exclusion text NOT NULL,
  PRIMARY KEY  (registre)
) TYPE=MyISAM;


--
-- Structure de la table 'service'
--

CREATE TABLE service (
  service varchar(10) NOT NULL default '',
  libelle varchar(50) NOT NULL default ''
) TYPE=MyISAM;

--
-- Contenu de la table 'service'
--

INSERT INTO service (service, libelle) VALUES
('33500', 'Service Informatique'),
('33510', 'Reseaux Telecoms');
