<?php
//$Id$ 
//gen openMairie le 06/12/2010 13:09 
$DEBUG=0;
$serie=15;
$ico="../img/ico_application.png";
$ent = _("option")." -> "._("om_parametre");
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
$table=DB_PREFIXE."om_parametre";
$champAffiche=array('om_parametre','libelle','valeur','om_collectivite');
$champRecherche=array('libelle','valeur');
$tri="";
$edition="om_parametre";
if ($_SESSION['niveau']== '2')
	$selection='';
else
	$selection=" where om_parametre.om_collectivite = '".$_SESSION['collectivite']."'";
if ($retourformulaire== 'om_collectivite')
	if ($_SESSION['niveau']== '2'){
		$selection=" where om_parametre.om_collectivite ='".$idx."'";
	}else{
		$selection=" where om_parametre.om_collectivite ='".$idx."' and om_parametre.om_collectivite = '".$_SESSION['collectivite']."'";
	}
?>