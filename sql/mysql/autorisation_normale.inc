<?php
//$Id: autorisation_normale.inc,v 1.1 2008-07-10 13:44:39 fraynaud1 Exp $
include('registre.inc');
$ent = "registre -> autorisation_normale";
$selection = " where nature='autorisation_normale'";
$tri= "";
// sous formulaire
$sousformulaire=array("destinataire","modificatif","dossier");
?>
