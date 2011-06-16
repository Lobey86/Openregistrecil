<?php
//$Id$ 
//gen openMairie le 09/11/2010 20:05 
$import= "Insertion dans la table om_utilisateur voir rec/import_utilisateur.inc";
$table= 'om_utilisateur';
$id='om_utilisateur'; // numerotation automatique
$verrou=1;// =0 pas de mise a jour de la base / =1 mise a jour
$DEBUG=0; // =0 pas d affichage messages / =1 affichage detail enregistrement
$fic_erreur=1; // =0 pas de fichier d erreur / =1  fichier erreur
$fic_rejet=1; // =0 pas de fichier pour relance / =1 fichier relance traitement
$ligne1=1;// = 1 : 1ere ligne contient nom des champs / o sinon
$obligatoire['om_utilisateur']=1;// obligatoire = 1
//* cle secondaire=om_profil
$exist['om_profil']=1;//  0=non / 1=oui
$sql_exist['om_profil']= "select * from om_profil where om_profil = '";
//* cle secondaire=om_collectivite
$exist['om_collectivite']=1;//  0=non / 1=oui
$sql_exist['om_collectivite']= "select * from om_collectivite where om_collectivite = '";
// * champ = om_utilisateur
$zone['om_utilisateur']='0';
// $defaut['om_utilisateur']='***'; // *** par defaut si non renseigne
// * champ = nom
$zone['nom']='1';
// $defaut['nom']='***'; // *** par defaut si non renseigne
// * champ = login
$zone['login']='2';
// $defaut['login']='***'; // *** par defaut si non renseigne
// * champ = pwd
$zone['pwd']='3';
// $defaut['pwd']='***'; // *** par defaut si non renseigne
// * champ = om_profil
$zone['om_profil']='4';
// $defaut['om_profil']='***'; // *** par defaut si non renseigne
// * champ = email
$zone['email']='5';
// $defaut['email']='***'; // *** par defaut si non renseigne
// * champ = om_collectivite
$zone['om_collectivite']='6';
// $defaut['om_collectivite']='***'; // *** par defaut si non renseigne
// * champ = om_type
$zone['om_type']='7';
// $defaut['om_type']='***'; // *** par defaut si non renseigne
?>