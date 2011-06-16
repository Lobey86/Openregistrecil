<?php
//$Id$ 
//gen openMairie le 17/05/2011 11:46 
$DEBUG=0;
$ico="../img/ico_application.png";
$ent="option->dossier";
$tableSelect=DB_PREFIXE."dossier";
$champs=array("dossier","registre","fichier","datedossier","observation","typedossier");
//champs select
$sql_registre="select * from ".DB_PREFIXE."registre";
?>