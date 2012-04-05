<?php
//$Id$ 
//gen openMairie le 05/04/2012 18:47 
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
$champAffiche=array('registre','finalite','numero_cnil','concat(substring(date_registre,9,2),\'/\',substring(date_registre,6,2),\'/\',substring(date_registre,1,4)) as date_registre','nature','service','droit_acces','concat(substring(date_maj,9,2),\'/\',substring(date_maj,6,2),\'/\',substring(date_maj,1,4)) as date_maj','reference','avis','om_collectivite');
$champRecherche=array('finalite','numero_cnil','nature','service','droit_acces','reference','avis');
$tri="";
$edition="registre";
if ($_SESSION['niveau']== '2')
	$selection='';
else
	$selection=" where registre.om_collectivite = '".$_SESSION['collectivite']."'";
if ($retourformulaire== 'categorie_personne')
	if ($_SESSION['niveau']== '2'){
		$selection=" where registre.categorie_personne ='".$idx."'";
	}else{
		$selection=" where registre.categorie_personne ='".$idx."' and registre.om_collectivite = '".$_SESSION['collectivite']."'";
	}
if ($retourformulaire== 'categorie_donnee')
	if ($_SESSION['niveau']== '2'){
		$selection=" where registre.categorie_donnee ='".$idx."'";
	}else{
		$selection=" where registre.categorie_donnee ='".$idx."' and registre.om_collectivite = '".$_SESSION['collectivite']."'";
	}
if ($retourformulaire== 'service')
	if ($_SESSION['niveau']== '2'){
		$selection=" where registre.service ='".$idx."'";
	}else{
		$selection=" where registre.service ='".$idx."' and registre.om_collectivite = '".$_SESSION['collectivite']."'";
	}
if ($retourformulaire== 'reference')
	if ($_SESSION['niveau']== '2'){
		$selection=" where registre.reference ='".$idx."'";
	}else{
		$selection=" where registre.reference ='".$idx."' and registre.om_collectivite = '".$_SESSION['collectivite']."'";
	}
if ($retourformulaire== 'om_collectivite')
	if ($_SESSION['niveau']== '2'){
		$selection=" where registre.om_collectivite ='".$idx."'";
	}else{
		$selection=" where registre.om_collectivite ='".$idx."' and registre.om_collectivite = '".$_SESSION['collectivite']."'";
	}
$sousformulaire=array('destinataire','dossier','modificatif');
?>