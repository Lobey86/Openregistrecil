<?php
//$Id: autorisation_unique.inc,v 1.1 2008-07-10 13:44:39 fraynaud1 Exp $
include('registre.inc');
$ent = "registre -> autorisation_unique";
$selection = " where nature='autorisation_unique'";
if ($_SESSION['niveau']!= '2')
	$selection.=" and registre.om_collectivite = '".$_SESSION['collectivite']."'";
?>
