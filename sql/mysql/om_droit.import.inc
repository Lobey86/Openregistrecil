<?php
//$Id$ 
//gen openMairie le 15/10/2010 16:06 
$import= "Insertion dans la table om_droit voir rec/import_utilisateur.inc";
$table= 'om_droit';
$id=''; // numerotation non automatique
$verrou=1;// =0 pas de mise a jour de la base / =1 mise a jour
$DEBUG=0; // =0 pas d affichage messages / =1 affichage detail enregistrement
$fic_erreur=1; // =0 pas de fichier d erreur / =1  fichier erreur
$fic_rejet=1; // =0 pas de fichier pour relance / =1 fichier relance traitement
$ligne1=1;// = 1 : 1ere ligne contient nom des champs / o sinon
$obligatoire['om_droit']=1;// obligatoire = 1
//* cle secondaire=om_profil
$exist['om_profil']=1;//  0=non / 1=oui
$sql_exist['om_profil']= "select * from om_profil where om_profil = '";
//* cle secondaire=om_niveau
$exist['om_niveau']=1;//  0=non / 1=oui
$sql_exist['om_niveau']= "select * from om_niveau where om_niveau = '";
// * champ = om_droit
$zone['om_droit']='0';
// $defaut['om_droit']='***'; // *** par defaut si non renseigne
// * champ = om_profil
$zone['om_profil']='1';
// $defaut['om_profil']='***'; // *** par defaut si non renseigne
// * champ = om_niveau
$zone['om_niveau']='2';
// $defaut['om_niveau']='***'; // *** par defaut si non renseigne
?>