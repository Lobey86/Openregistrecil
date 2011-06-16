<?php
//$Id$ 
//gen openMairie le 17/05/2011 11:41 
$DEBUG=0;
$serie=15;
$ico="../img/ico_application.png";
$ent = _("option")." -> "._("modificatif");
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
$table=DB_PREFIXE."modificatif";
$champAffiche=array('modificatif','concat(substring(date_modificatif,9,2),\'/\',substring(date_modificatif,6,2),\'/\',substring(date_modificatif,1,4)) as date_modificatif','registre');
$champRecherche=array();
$tri="";
$edition="modificatif";
$selection='';
if ($retourformulaire== 'registre')
	$selection=" where modificatif.registre ='".$idx."'";
?>