<?php
//$Id$ 
//gen openMairie le 06/12/2010 10:59 
$reqmo['libelle']=' om_profil';
$reqmo['reqmo_libelle']=' om_profil';
$reqmo['sql']="select  [om_profil], [libelle] from ".DB_PREFIXE."om_profil  order by [tri]";
$reqmo['om_profil']='checked';
$reqmo['libelle']='checked';
$reqmo['tri']=array('om_profil','libelle');
?>