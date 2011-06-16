<?php
//$Id$ 
//gen openMairie le 06/12/2010 10:58 
$reqmo['libelle']=' om_collectivite';
$reqmo['reqmo_libelle']=' om_collectivite';
$reqmo['sql']="select  [om_collectivite], [libelle], [niveau] from ".DB_PREFIXE."om_collectivite  order by [tri]";
$reqmo['om_collectivite']='checked';
$reqmo['libelle']='checked';
$reqmo['niveau']='checked';
$reqmo['tri']=array('om_collectivite','libelle','niveau');
?>