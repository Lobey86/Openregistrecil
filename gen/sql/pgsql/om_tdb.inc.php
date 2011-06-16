<?php
//$Id$ 
//gen openMairie le 12/05/2011 19:29 
$DEBUG=0;
$serie=15;
$ico="../img/ico_application.png";
$ent = _("option")." -> "._("om_tdb");
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
$table=DB_PREFIXE."om_tdb";
$champAffiche=array('om_tdb','login','bloc','om_widget','position');
$champRecherche=array('login','bloc');
$tri="";
$edition="om_tdb";
$selection='';
if ($retourformulaire== 'om_widget')
	$selection=" where om_tdb.om_widget ='".$idx."'";
?>