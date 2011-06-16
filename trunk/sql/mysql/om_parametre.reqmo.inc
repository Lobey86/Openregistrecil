<?php
//$Id$ 
//gen openMairie le 06/12/2010 10:59 
$reqmo['libelle']=' om_parametre';
$reqmo['reqmo_libelle']=' om_parametre';
$reqmo['sql']="select  [om_parametre], [libelle], [valeur], [om_collectivite] from ".DB_PREFIXE."om_parametre  order by [tri]";
$reqmo['om_parametre']='checked';
$reqmo['libelle']='checked';
$reqmo['valeur']='checked';
$reqmo['om_collectivite']='checked';
$reqmo['tri']=array('om_parametre','libelle','valeur','om_collectivite');
?>