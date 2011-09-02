<?php
//$Id$ 
//gen openMairie le 02/09/2011 16:50 
$DEBUG=0;
$ico="../img/ico_application.png";
$ent="option->om_tdb";
$tableSelect=DB_PREFIXE."om_tdb";
$champs=array("om_tdb","login","bloc","position","om_widget");
//champs select
$sql_om_widget="select * from ".DB_PREFIXE."om_widget";
?>