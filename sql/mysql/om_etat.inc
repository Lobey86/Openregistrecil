<?php
//$Id$ 
//gen openMairie le 18/10/2010 16:23 
include('../gen/sql/mysql/om_etat.inc.php');
$table=DB_PREFIXE."om_etat inner join ".DB_PREFIXE."om_collectivite on om_collectivite.om_collectivite = om_etat.om_collectivite";
$champAffiche=array('om_etat','om_collectivite.libelle as collectivite','id','om_etat.libelle','om_etat.actif','niveau');
$champRecherche=array('id','om_etat.libelle','om_collectivite.libelle','om_etat.actif');
$tri = " order by niveau";
/**
 * Options
 */
if ($_SESSION['niveau']== '2')
	$selection='';
else{
	$selection=" where om_etat.om_collectivite = '".$_SESSION['collectivite']."' or niveau =2";
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
$href[3] = array(
    "lien" => "../scr/valid_copie.php?obj=".$obj."&amp;idx=",
    "id" => "",
    "lib" => "<img src=\"../img/save.jpg\" alt=\""
             ._("copie")."\" title=\""._("Copie")."\" />",
);
?>