<?php
//$Id$ 
//gen openMairie le 02/09/2011 16:50 
$DEBUG=0;
$serie=15;
$ico="../img/ico_application.png";
$ent = _("option")." -> "._("dossier");
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
$table=DB_PREFIXE."dossier";
$champAffiche=array('dossier','registre','fichier','concat(substring(datedossier,9,2),\'/\',substring(datedossier,6,2),\'/\',substring(datedossier,1,4)) as datedossier','typedossier');
$champRecherche=array('fichier','typedossier');
$tri="";
$edition="dossier";
$selection='';
if ($retourformulaire== 'registre')
	$selection=" where dossier.registre ='".$idx."'";
?>