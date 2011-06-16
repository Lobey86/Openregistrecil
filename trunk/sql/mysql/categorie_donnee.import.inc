<?php
//$Id$ 
//gen openMairie le 17/05/2011 11:27 
$import= "Insertion dans la table categorie_donnee voir rec/import_utilisateur.inc";
$table= DB_PREFIXE."categorie_donnee";
$id=''; // numerotation non automatique
$verrou=1;// =0 pas de mise a jour de la base / =1 mise a jour
$DEBUG=0; // =0 pas d affichage messages / =1 affichage detail enregistrement
$fic_erreur=1; // =0 pas de fichier d erreur / =1  fichier erreur
$fic_rejet=1; // =0 pas de fichier pour relance / =1 fichier relance traitement
$ligne1=1;// = 1 : 1ere ligne contient nom des champs / o sinon
$obligatoire['categorie_donnee']=1;// obligatoire = 1
// * champ = categorie_donnee
$zone['categorie_donnee']='0';
// $defaut['categorie_donnee']='***'; // *** par defaut si non renseigne
// * champ = libelle
$zone['libelle']='1';
// $defaut['libelle']='***'; // *** par defaut si non renseigne
?>