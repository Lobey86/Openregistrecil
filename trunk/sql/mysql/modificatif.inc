<?php
//$Id$ 
//gen openMairie le 17/05/2011 11:41 
include('../gen/sql/mysql/modificatif.inc.php');
if ($retourformulaire== 'autorisation_unique')
	$selection=" where modificatif.registre ='".$idx."'";
if ($retourformulaire== 'autorisation_normale')
	$selection=" where modificatif.registre ='".$idx."'";
if ($retourformulaire== 'demande_avis')
	$selection=" where modificatif.registre ='".$idx."'";
if ($retourformulaire== 'norme_simplifiee')
	$selection=" where modificatif.registre ='".$idx."'";
if ($retourformulaire== 'dispense')
	$selection=" where modificatif.registre ='".$idx."'";
?>
