<?php
//$Id$ 
//gen openMairie le 17/05/2011 11:40 
include('../gen/sql/mysql/destinataire.inc.php');
if ($retourformulaire== 'autorisation_unique')
	$selection=" where destinataire.registre ='".$idx."'";
if ($retourformulaire== 'autorisation_normale')
	$selection=" where destinataire.registre ='".$idx."'";
if ($retourformulaire== 'demande_avis')
	$selection=" where destinataire.registre ='".$idx."'";
if ($retourformulaire== 'norme_simplifiee')
	$selection=" where destinataire.registre ='".$idx."'";
if ($retourformulaire== 'dispense')
	$selection=" where destinataire.registre ='".$idx."'";
?>
