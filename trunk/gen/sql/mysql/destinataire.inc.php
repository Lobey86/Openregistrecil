<?php
//$Id$ 
//gen openMairie le 02/09/2011 16:50 
$DEBUG=0;
$serie=15;
$ico="../img/ico_application.png";
$ent = _("option")." -> "._("destinataire");
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
$table=DB_PREFIXE."destinataire";
$champAffiche=array('destinataire','organisme','libelle','registre');
$champRecherche=array('organisme','libelle');
$tri="";
$edition="destinataire";
$selection='';
if ($retourformulaire== 'organisme')
	$selection=" where destinataire.organisme ='".$idx."'";
if ($retourformulaire== 'categorie_donnee')
	$selection=" where destinataire.categorie_donnee ='".$idx."'";
if ($retourformulaire== 'registre')
	$selection=" where destinataire.registre ='".$idx."'";
?>