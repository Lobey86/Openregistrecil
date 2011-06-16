<?php
//$Id$ 
//gen openMairie le 17/05/2011 11:27 
$reqmo['libelle']=' categorie_donnee';
$reqmo['reqmo_libelle']=' categorie_donnee';
$reqmo['sql']="select  [categorie_donnee], [libelle] from ".DB_PREFIXE."categorie_donnee  order by [tri]";
$reqmo['categorie_donnee']='checked';
$reqmo['libelle']='checked';
$reqmo['tri']=array('categorie_donnee','libelle');
?>