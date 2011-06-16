<?php
//$Id$ 
//gen openMairie le 15/10/2010 15:56 
include('../gen/sql/mysql/om_collectivite.inc.php');

// pas de sup ou ajout pour mono coll
if ($_SESSION['niveau']== '1'){
    $href[0] = array("lien" => "#","id" => "","lib" => "",);
    $href[2] = array("lien" => "#", "id" => "", "lib" => "",);
}
//
$href[3] = array(
    "lien" => "../pdf/pdfetat.php?obj=".$obj."&amp;idx=",
    "id" => "",
    "lib" => "<img src=\"../img/pdf-16x16.png\" alt=\""
             ._("Edition PDF")."\" title=\""._("Edition PDF")."\" />",
);
$sousformulaire=array('om_utilisateur',
                      'om_widget',
                      'om_parametre',
                      'om_etat',
                      'om_sousetat',
                      'om_lettretype',
                      'om_sig_point');
?>