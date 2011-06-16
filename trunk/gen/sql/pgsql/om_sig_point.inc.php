<?php
//$Id$ 
//gen openMairie le 12/04/2011 16:08 
$DEBUG=0;
$serie=15;
$ico="../img/ico_application.png";
$ent = _("option")." -> "._("om_sig_point");
if(!isset($premier)) $premier='';
if(!isset($recherche1)) $recherche1='';
if(!isset($tricolsf)) $tricolsf='';
if(!isset($premiersf)) $premiersf='';
if(!isset($selection)) $selection='';
if(!isset($retourformulaire)) $retourformulaire='';
if(isset($idx)){
	if($idx != ']')
	if (trim($idx!=''))
		$ent = $ent."-><font id='idz1'>&nbsp;".$idx."&nbsp;</font>";
	}
	if(isset($idz) ){
	if (trim($idz!=''))
		$ent = $ent."&nbsp;<font id='idz1'>&nbsp;".strtoupper($idz)."&nbsp;</font>";
}
$table=DB_PREFIXE."om_sig_point";
$champAffiche=array('om_sig_point','om_collectivite','id','libelle','actif','zoom','fond_osm','fond_bing','fond_sat','layer_info','etendue','projection_externe','maj','table_update','champ','retour');
$champRecherche=array('id','libelle','actif','zoom','fond_osm','fond_bing','fond_sat','layer_info','etendue','projection_externe','maj','table_update','champ','retour');
$tri="";
$edition="om_sig_point";
if ($_SESSION['niveau']== '2')
	$selection='';
else
	$selection=" where om_sig_point.om_collectivite = '".$_SESSION['collectivite']."'";
if ($retourformulaire== 'om_collectivite')
	if ($_SESSION['niveau']== '2'){
		$selection=" where om_sig_point.om_collectivite ='".$idx."'";
	}else{
		$selection=" where om_sig_point.om_collectivite ='".$idx."' and om_sig_point.om_collectivite = '".$_SESSION['collectivite']."'";
	}
?>