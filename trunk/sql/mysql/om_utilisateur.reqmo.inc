<?php
//$Id$ 
//gen openMairie le 06/12/2010 10:59 
$reqmo['libelle']=' om_utilisateur';
$reqmo['reqmo_libelle']=' om_utilisateur';
$reqmo['sql']="select  [om_utilisateur], [nom], [email], [login], [pwd], [om_profil], [om_collectivite], [om_type] from ".DB_PREFIXE."om_utilisateur  order by [tri]";
$reqmo['om_utilisateur']='checked';
$reqmo['nom']='checked';
$reqmo['email']='checked';
$reqmo['login']='checked';
$reqmo['pwd']='checked';
$reqmo['om_profil']='checked';
$reqmo['om_collectivite']='checked';
$reqmo['om_type']='checked';
$reqmo['tri']=array('om_utilisateur','nom','email','login','pwd','om_profil','om_collectivite','om_type');
?>