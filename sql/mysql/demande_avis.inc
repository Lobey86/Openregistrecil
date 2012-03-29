<?php
//$Id: demande_avis.inc,v 1.1 2008-07-10 13:44:39 fraynaud1 Exp $
include('registre.inc');
$ent = "registre -> demande_avis";
$selection = " where nature='demande_avis'";
if ($_SESSION['niveau']!= '2')
	$selection.=" and registre.om_collectivite = '".$_SESSION['collectivite']."'";
?>
