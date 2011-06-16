<?php
//$Id$ 
//gen openMairie le 06/12/2010 10:58 
$reqmo['libelle']=' om_droit';
$reqmo['reqmo_libelle']=' om_droit';
$reqmo['sql']="select  [om_droit], [om_profil] from ".DB_PREFIXE."om_droit  order by [tri]";
$reqmo['om_droit']='checked';
$reqmo['om_profil']='checked';
$reqmo['tri']=array('om_droit','om_profil');
?>