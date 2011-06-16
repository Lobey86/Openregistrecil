<?php
//$Id$ 
//gen openMairie le 12/05/2011 19:30 
$DEBUG=0;
$ico="../img/ico_application.png";
$ent="option->om_widget";
$tableSelect=DB_PREFIXE."om_widget";
$champs=array("om_widget","om_collectivite","libelle","lien","texte","om_profil");
//champs select
$sql_om_collectivite="select * from ".DB_PREFIXE."om_collectivite";
$sql_om_profil="select * from ".DB_PREFIXE."om_profil";
?>