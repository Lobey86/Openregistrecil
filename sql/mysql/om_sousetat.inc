<?php
//$Id$ 
//gen openMairie le 18/10/2010 21:29 
include('../gen/sql/mysql/om_sousetat.inc.php');
$table="om_sousetat inner join om_collectivite on
        om_collectivite.om_collectivite=om_sousetat.om_collectivite";
$champAffiche=array('om_sousetat','om_collectivite.libelle as collectivite',
                    'id','om_sousetat.libelle as libelle','om_sousetat.actif as actif','niveau');
$champRecherche=array('id','om_collectivite.libelle','om_sousetat.libelle','om_sousetat.actif');
$href[3] = array(
    "lien" => "../scr/valid_copie.php?obj=".$obj."&amp;idx=",
    "id" => "",
    "lib" => "<img src=\"../img/save.jpg\" alt=\""
             ._("copie")."\" title=\""._("Copie")."\" />",
);
/**
 * Options
 */
if ($_SESSION['niveau']== '2')
	$selection='';
else{
	$selection=" where om_sousetat.om_collectivite = '".$_SESSION['collectivite']."' or niveau =2";
    $options = array();
    $option = array(
        "type" => "condition",
        "field" => "niveau",
        "case" => array(
            "0" => array(
                "values" => array('2', ),
                "style" => "tab_desactive",
                "href" => array(
                    0 => array("lien" => "", "id" => "", "lib" => ""),
                    1 => array("lien" => "", "id" => "", "lib" => ""),
                    2 => array("lien" => "", "id" => "", "lib" => ""),
                    3 => array("lien" => "../scr/valid_copie.php?obj=".$obj."&amp;idx=",
                               "id" => "",
                               "lib" => "<img src=\"../img/save.jpg\" alt=\""
                                        ._("copie")."\" title=\""._("Copie")."\" />"),
                ),
            ),
        ),
    );
    array_push($options, $option);
}
?>