<?php
//$Id$ 
//gen openMairie le 12/05/2011 19:29 
$DEBUG=0;
$ico="../img/ico_application.png";
$ent="option->om_tdb";
$tableSelect=DB_PREFIXE."om_tdb";
$champs=array("om_tdb","login","bloc","om_widget","position");
//champs select
$sql_om_widget="select * from ".DB_PREFIXE."om_widget";
?>