<?php
//$Id$ 
//gen openMairie le 02/09/2011 16:50 
$DEBUG=0;
$ico="../img/ico_application.png";
$ent="option->om_sig_point";
$tableSelect=DB_PREFIXE."om_sig_point";
$champs=array("om_sig_point","om_collectivite","id","libelle","actif","zoom","fond_osm","fond_bing","fond_sat","layer_info","etendue","projection_externe","url","om_sql","maj","table_update","champ","retour");
//champs select
$sql_om_collectivite="select * from ".DB_PREFIXE."om_collectivite";
?>