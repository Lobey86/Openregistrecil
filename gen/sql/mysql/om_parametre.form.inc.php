<?php
//$Id$ 
//gen openMairie le 02/09/2011 16:50 
$DEBUG=0;
$ico="../img/ico_application.png";
$ent="option->om_parametre";
$tableSelect=DB_PREFIXE."om_parametre";
$champs=array("om_parametre","libelle","valeur","om_collectivite");
//champs select
$sql_om_collectivite="select * from ".DB_PREFIXE."om_collectivite";
?>