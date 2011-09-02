<?php
//$Id: dispense.inc,v 1.5 2008-07-08 14:13:05 jbastide Exp $
include('registre.inc');
$ent = "registre -> dispense";
$ico = "../app/img/ico_registre.png";
$table="registre";
$champRecherche=array("finalite");
$selection = " where nature='dispense'";
$tri= "";
// sous formulaire
$sousformulaire=array("destinataire","modificatif","dossier");
?>
