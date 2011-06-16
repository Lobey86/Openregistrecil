<?php
//$Id$ 
//gen openMairie le 17/05/2011 11:46 
include('../gen/sql/mysql/dossier.inc.php');
$champAffiche=array('dossier','fichier',
		    'concat(substring(datedossier,9,2),\'/\',substring(datedossier,6,2),\'/\',substring(datedossier,1,4)) as datedossier',
                    'typedossier');
if ($retourformulaire== 'autorisation_unique')
	$selection=" where dossier.registre ='".$idx."'";
if ($retourformulaire== 'autorisation_normale')
	$selection=" where dossier.registre ='".$idx."'";
if ($retourformulaire== 'demande_avis')
	$selection=" where dossier.registre ='".$idx."'";
if ($retourformulaire== 'norme_simplifiee')
	$selection=" where dossier.registre ='".$idx."'";
if ($retourformulaire== 'dispense')
	$selection=" where dossier.registre ='".$idx."'";

?>
