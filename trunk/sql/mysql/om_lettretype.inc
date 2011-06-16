<?php
//$Id$ 
//gen openMairie le 19/10/2010 18:45 
include('../gen/sql/mysql/om_lettretype.inc.php');
$table="om_lettretype
        left join om_collectivite on om_collectivite.om_collectivite=om_lettretype.om_collectivite"; 
$champAffiche=array("om_lettretype.om_lettretype",
                    "om_lettretype.id",
                    "om_lettretype.libelle",
                    "om_collectivite.libelle as collectivite",
                    "actif",'niveau');
$champRecherche=array("om_lettretype.id","om_lettretype.libelle","om_collectivite.libelle");
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
	$selection=" where om_lettretype.om_collectivite = '".$_SESSION['collectivite']."' or niveau =2";
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