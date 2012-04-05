<?php
//$Id$ 
//gen openMairie le 05/04/2012 18:47 
$DEBUG=0;
$ico="";
$ent="option->registre";
$tableSelect=DB_PREFIXE."registre";
$champs=array("registre","finalite","numero_cnil","note","date_registre","categorie_personne","categorie_donnee","conservation","nature","service","droit_acces","date_maj","reference","avis","exclusion","om_collectivite");
//champs select
$sql_categorie_personne="select * from ".DB_PREFIXE."categorie_personne";
$sql_categorie_donnee="select * from ".DB_PREFIXE."categorie_donnee";
$sql_service="select * from ".DB_PREFIXE."service";
$sql_reference="select * from ".DB_PREFIXE."reference";
$sql_om_collectivite="select * from ".DB_PREFIXE."om_collectivite";
?>