<?php
//$Id$ 
//gen openMairie le 17/05/2011 11:40 
$DEBUG=0;
$ico="../img/ico_application.png";
$ent="option->destinataire";
$tableSelect=DB_PREFIXE."destinataire";
$champs=array("destinataire","organisme","libelle","categorie_donnee","registre");
//champs select
$sql_organisme="select * from ".DB_PREFIXE."organisme";
$sql_categorie_donnee="select * from ".DB_PREFIXE."categorie_donnee";
$sql_registre="select * from ".DB_PREFIXE."registre";
?>