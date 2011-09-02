<?php
//$Id$ 
//gen openMairie le 02/09/2011 16:50 
$DEBUG=0;
$serie=15;
$ico="../img/ico_application.png";
$ent = _("option")." -> "._("om_utilisateur");
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
$table=DB_PREFIXE."om_utilisateur";
$champAffiche=array('om_utilisateur','nom','email','login','pwd','om_profil','om_collectivite','om_type');
$champRecherche=array('nom','email','login','pwd','om_profil','om_type');
$tri="";
$edition="om_utilisateur";
if ($_SESSION['niveau']== '2')
	$selection='';
else
	$selection=" where om_utilisateur.om_collectivite = '".$_SESSION['collectivite']."'";
if ($retourformulaire== 'om_profil')
	if ($_SESSION['niveau']== '2'){
		$selection=" where om_utilisateur.om_profil ='".$idx."'";
	}else{
		$selection=" where om_utilisateur.om_profil ='".$idx."' and om_utilisateur.om_collectivite = '".$_SESSION['collectivite']."'";
	}
if ($retourformulaire== 'om_collectivite')
	if ($_SESSION['niveau']== '2'){
		$selection=" where om_utilisateur.om_collectivite ='".$idx."'";
	}else{
		$selection=" where om_utilisateur.om_collectivite ='".$idx."' and om_utilisateur.om_collectivite = '".$_SESSION['collectivite']."'";
	}
?>