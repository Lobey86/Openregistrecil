<?php
//$Id$ 
//gen openMairie le 02/09/2011 16:50 
$DEBUG=0;
$ico="../img/ico_application.png";
$ent="option->om_widget";
$tableSelect=DB_PREFIXE."om_widget";
$champs=array("om_widget","om_collectivite","libelle","lien","texte","om_profil");
//champs select
$sql_om_collectivite="select * from ".DB_PREFIXE."om_collectivite";
$sql_om_profil="select * from ".DB_PREFIXE."om_profil";
?>