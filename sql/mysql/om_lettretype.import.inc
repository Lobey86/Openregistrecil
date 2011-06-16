<?php
//$Id$ 
//gen openMairie le 11/11/2010 22:36 
$import= "Insertion dans la table om_lettretype voir rec/import_utilisateur.inc";
$table= 'om_lettretype';
$id='om_lettretype'; // numerotation automatique
$verrou=1;// =0 pas de mise a jour de la base / =1 mise a jour
$DEBUG=0; // =0 pas d affichage messages / =1 affichage detail enregistrement
$fic_erreur=1; // =0 pas de fichier d erreur / =1  fichier erreur
$fic_rejet=1; // =0 pas de fichier pour relance / =1 fichier relance traitement
$ligne1=1;// = 1 : 1ere ligne contient nom des champs / o sinon
$obligatoire['om_lettretype']=1;// obligatoire = 1
//* cle secondaire=om_collectivite
$exist['om_collectivite']=1;//  0=non / 1=oui
$sql_exist['om_collectivite']= "select * from om_collectivite where om_collectivite = '";
// * champ = om_lettretype
$zone['om_lettretype']='0';
// $defaut['om_lettretype']='***'; // *** par defaut si non renseigne
// * champ = om_collectivite
$zone['om_collectivite']='1';
// $defaut['om_collectivite']='***'; // *** par defaut si non renseigne
// * champ = id
$zone['id']='2';
// $defaut['id']='***'; // *** par defaut si non renseigne
// * champ = libelle
$zone['libelle']='3';
// $defaut['libelle']='***'; // *** par defaut si non renseigne
// * champ = orientation
$zone['orientation']='4';
// $defaut['orientation']='***'; // *** par defaut si non renseigne
// * champ = format
$zone['format']='5';
// $defaut['format']='***'; // *** par defaut si non renseigne
// * champ = logo
$zone['logo']='6';
// $defaut['logo']='***'; // *** par defaut si non renseigne
// * champ = logoleft
$zone['logoleft']='7';
// $defaut['logoleft']='***'; // *** par defaut si non renseigne
// * champ = logotop
$zone['logotop']='8';
// $defaut['logotop']='***'; // *** par defaut si non renseigne
// * champ = titre
$zone['titre']='9';
// $defaut['titre']='***'; // *** par defaut si non renseigne
// * champ = titreleft
$zone['titreleft']='10';
// $defaut['titreleft']='***'; // *** par defaut si non renseigne
// * champ = titretop
$zone['titretop']='11';
// $defaut['titretop']='***'; // *** par defaut si non renseigne
// * champ = titrelargeur
$zone['titrelargeur']='12';
// $defaut['titrelargeur']='***'; // *** par defaut si non renseigne
// * champ = titrehauteur
$zone['titrehauteur']='13';
// $defaut['titrehauteur']='***'; // *** par defaut si non renseigne
// * champ = titrefont
$zone['titrefont']='14';
// $defaut['titrefont']='***'; // *** par defaut si non renseigne
// * champ = titreattribut
$zone['titreattribut']='15';
// $defaut['titreattribut']='***'; // *** par defaut si non renseigne
// * champ = titretaille
$zone['titretaille']='16';
// $defaut['titretaille']='***'; // *** par defaut si non renseigne
// * champ = titrebordure
$zone['titrebordure']='17';
// $defaut['titrebordure']='***'; // *** par defaut si non renseigne
// * champ = titrealign
$zone['titrealign']='18';
// $defaut['titrealign']='***'; // *** par defaut si non renseigne
// * champ = corps
$zone['corps']='19';
// $defaut['corps']='***'; // *** par defaut si non renseigne
// * champ = corpsleft
$zone['corpsleft']='20';
// $defaut['corpsleft']='***'; // *** par defaut si non renseigne
// * champ = corpstop
$zone['corpstop']='21';
// $defaut['corpstop']='***'; // *** par defaut si non renseigne
// * champ = corpslargeur
$zone['corpslargeur']='22';
// $defaut['corpslargeur']='***'; // *** par defaut si non renseigne
// * champ = corpshauteur
$zone['corpshauteur']='23';
// $defaut['corpshauteur']='***'; // *** par defaut si non renseigne
// * champ = corpsfont
$zone['corpsfont']='24';
// $defaut['corpsfont']='***'; // *** par defaut si non renseigne
// * champ = corpsattribut
$zone['corpsattribut']='25';
// $defaut['corpsattribut']='***'; // *** par defaut si non renseigne
// * champ = corpstaille
$zone['corpstaille']='26';
// $defaut['corpstaille']='***'; // *** par defaut si non renseigne
// * champ = corpsbordure
$zone['corpsbordure']='27';
// $defaut['corpsbordure']='***'; // *** par defaut si non renseigne
// * champ = corpsalign
$zone['corpsalign']='28';
// $defaut['corpsalign']='***'; // *** par defaut si non renseigne
// * champ = om_sql
$zone['om_sql']='29';
// $defaut['om_sql']='***'; // *** par defaut si non renseigne
?>