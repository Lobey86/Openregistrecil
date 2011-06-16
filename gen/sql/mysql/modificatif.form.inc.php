<?php
//$Id$ 
//gen openMairie le 17/05/2011 11:41 
$DEBUG=0;
$ico="../img/ico_application.png";
$ent="option->modificatif";
$tableSelect=DB_PREFIXE."modificatif";
$champs=array("modificatif","date_modificatif","note","registre");
//champs select
$sql_registre="select * from ".DB_PREFIXE."registre";
?>