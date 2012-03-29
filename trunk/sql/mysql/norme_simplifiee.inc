<?php
//$Id: norme_simplifiee.inc,v 1.2 2008-08-26 13:38:45 jbastide Exp $
include('registre.inc');
$ent = "registre -> norme_simplifiee";
$selection = " where nature='norme_simplifiee'";
if ($_SESSION['niveau']!= '2')
	$selection.=" and registre.om_collectivite = '".$_SESSION['collectivite']."'";
?>
