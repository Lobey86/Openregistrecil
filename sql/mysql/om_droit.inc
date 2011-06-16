<?php
//$Id$ 
//gen openMairie le 15/10/2010 15:55 
include('../gen/sql/mysql/om_droit.inc.php');
$table="om_droit
        inner join om_profil on om_profil.om_profil=om_droit.om_profil"; 
$champAffiche=array("om_droit.om_droit",
                    "om_profil.libelle as profil");
$champRecherche=array("om_profil.libelle","om_droit.om_droit");
?>