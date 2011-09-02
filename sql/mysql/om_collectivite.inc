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
    "lib" => "<span class=\"om-icon om-icon-16 om-icon-fix pdf-16\" title=\""._("Edition")."\">"._("Edition")."</span>",
);
$sousformulaire=array('om_parametre',
                      'om_utilisateur',
                      'om_etat',
                      'om_lettretype',
                      'om_sousetat',
                      'om_widget');
?>