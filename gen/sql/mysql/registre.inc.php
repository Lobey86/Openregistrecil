<?php
//$Id$ 
//gen openMairie le 17/05/2011 11:42 
$DEBUG=0;
$serie=15;
$ico="../img/ico_application.png";
$ent = _("option")." -> "._("registre");
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
$table=DB_PREFIXE."registre";
$champAffiche=array('registre','finalite','numero_cnil','concat(substring(date_registre,9,2),\'/\',substring(date_registre,6,2),\'/\',substring(date_registre,1,4)) as date_registre','nature','service','droit_acces','concat(substring(date_maj,9,2),\'/\',substring(date_maj,6,2),\'/\',substring(date_maj,1,4)) as date_maj','reference','avis');
$champRecherche=array('finalite','numero_cnil','nature','service','droit_acces','reference','avis');
$tri="";
$edition="registre";
$selection='';
if ($retourformulaire== 'categorie_personne')
	$selection=" where registre.categorie_personne ='".$idx."'";
if ($retourformulaire== 'categorie_donnee')
	$selection=" where registre.categorie_donnee ='".$idx."'";
if ($retourformulaire== 'service')
	$selection=" where registre.service ='".$idx."'";
if ($retourformulaire== 'reference')
	$selection=" where registre.reference ='".$idx."'";
$sousformulaire=array('destinataire','dossier','modificatif');
?>