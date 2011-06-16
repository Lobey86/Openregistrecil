<?php
//$Id$ 
//gen openMairie le 20/10/2010 18:34 
$import= "Insertion dans la table om_profil voir rec/import_utilisateur.inc";
$table= 'om_profil';
$id=''; // numerotation non automatique
$verrou=1;// =0 pas de mise a jour de la base / =1 mise a jour
$DEBUG=0; // =0 pas d affichage messages / =1 affichage detail enregistrement
$fic_erreur=1; // =0 pas de fichier d erreur / =1  fichier erreur
$fic_rejet=1; // =0 pas de fichier pour relance / =1 fichier relance traitement
$ligne1=1;// = 1 : 1ere ligne contient nom des champs / o sinon
$obligatoire['om_profil']=1;// obligatoire = 1
// * champ = om_profil
$zone['om_profil']='0';
// $defaut['om_profil']='***'; // *** par defaut si non renseigne
// * champ = libelle
$zone['libelle']='1';
// $defaut['libelle']='***'; // *** par defaut si non renseigne
?>