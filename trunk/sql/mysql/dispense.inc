<?php
//$Id: dispense.inc,v 1.5 2008-07-08 14:13:05 jbastide Exp $
include('registre.inc');
$ent = "registre -> dispense";
$ico = "../app/img/ico_registre.png";
$champRecherche=array("finalite");
$selection = " where nature='dispense'";
if ($_SESSION['niveau']!= '2')
	$selection.=" and registre.om_collectivite = '".$_SESSION['collectivite']."'";
$tri= "";
// sous formulaire
$sousformulaire=array("destinataire","modificatif","dossier");
?>
