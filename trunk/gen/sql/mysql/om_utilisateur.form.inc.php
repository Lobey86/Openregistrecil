<?php
//$Id$ 
//gen openMairie le 06/12/2010 15:57 
$DEBUG=0;
$ico="../img/ico_application.png";
$ent="option->om_utilisateur";
$tableSelect=DB_PREFIXE."om_utilisateur";
$champs=array("om_utilisateur","nom","email","login","pwd","om_profil","om_collectivite","om_type");
//champs select
$sql_om_profil="select * from ".DB_PREFIXE."om_profil";
$sql_om_collectivite="select * from ".DB_PREFIXE."om_collectivite";
?>