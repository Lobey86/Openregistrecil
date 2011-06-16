<?php
//$Id$ 
//gen openMairie le 17/05/2011 11:42 
$DEBUG=0;
$ico="../img/ico_application.png";
$ent="option->registre";
$tableSelect=DB_PREFIXE."registre";
$champs=array("registre","finalite","numero_cnil","note","date_registre","categorie_personne","categorie_donnee","conservation","nature","service","droit_acces","date_maj","reference","avis","exclusion");
//champs select
$sql_categorie_personne="select * from ".DB_PREFIXE."categorie_personne";
$sql_categorie_donnee="select * from ".DB_PREFIXE."categorie_donnee";
$sql_service="select * from ".DB_PREFIXE."service";
$sql_reference="select * from ".DB_PREFIXE."reference";
?>