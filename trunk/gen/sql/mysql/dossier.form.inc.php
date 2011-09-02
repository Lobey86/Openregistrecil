<?php
//$Id$ 
//gen openMairie le 02/09/2011 16:50 
$DEBUG=0;
$ico="../img/ico_application.png";
$ent="option->dossier";
$tableSelect=DB_PREFIXE."dossier";
$champs=array("dossier","registre","fichier","datedossier","observation","typedossier");
//champs select
$sql_registre="select * from ".DB_PREFIXE."registre";
?>