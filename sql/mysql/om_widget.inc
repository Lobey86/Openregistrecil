<?php
//$Id$ 
//gen openMairie le 07/04/2011 10:23 
include('../gen/sql/pgsql/om_widget.inc.php');
$serie=6;
$champAffiche=array('om_widget',
                    'libelle',
                  //  'lien',
                    'om_profil as profil',
                    'om_collectivite as coll');
$tri= " order by om_widget desc"
?>