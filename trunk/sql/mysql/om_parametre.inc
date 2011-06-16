<?php
//$Id$ 
//gen openMairie le 15/10/2010 15:54 
include('../gen/sql/mysql/om_parametre.inc.php');
$table="om_parametre inner join om_collectivite on om_parametre.om_collectivite=om_collectivite.om_collectivite";
$champAffiche=array('om_parametre','om_parametre.libelle','valeur','om_collectivite.libelle as collectivite');
$champRecherche=array('om_parametre.libelle','valeur','om_collectivite.libelle');
?>