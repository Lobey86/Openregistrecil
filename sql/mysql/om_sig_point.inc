<?php
//$Id$ 
//gen openMairie le 06/04/2011 08:50 
include('../gen/sql/pgsql/om_sig_point.inc.php');
$table=DB_PREFIXE."om_sig_point inner join ".DB_PREFIXE.
        "om_collectivite on om_collectivite.om_collectivite = om_sig_point.om_collectivite";
$champAffiche=array('om_sig_point',
                    'om_sig_point.libelle',
                    'id',
                    "concat(om_collectivite.libelle,' (',om_collectivite.niveau,')') as collectivite",
                    'zoom',
                    'fond_osm as osm',
                    'fond_bing as bing',
                    'fond_sat as sat',
                    'layer_info as info',
                    'etendue',
                    'projection_externe as projection',
                    'maj',
                    'table_update as table_update',
		    'champ',
                    'actif');
$champRecherche=array('id',
                      'om_sig_point.libelle',
                      'zoom',
                      'fond_osm',
                      'fond_bing',
                      'fond_sat',
                      'etendue',
                      'projection_externe',
                      'maj',
                      'table_update',
                      'actif');
$tri=' order by om_sig_point.id';//.libelle';
$href[3] = array(
    "lien" => "../scr/valid_copie.php?obj=".$obj."&amp;idx=",
    "id" => "",
    "lib" => "<img src=\"../img/save.jpg\" alt=\""
             ._("copie")."\" title=\""._("Copie")."\" />",
);
if ($_SESSION['niveau']== '2')
	$selection='';
else{
	$selection=" where om_sig_point.om_collectivite = '".$_SESSION['collectivite']."' or om_collectivite.niveau ='2'";
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
                    //3 => array("lien" => "", "id" => "", "lib" => ""),
		    3 => array("lien" => "../scr/valid_copie.php?obj=".$obj."&amp;idx=","id" => "",
			      "lib" => "<img src=\"../img/save.jpg\" alt=\""._("copie")."\" title=\""._("Copie")."\" />"),
		),
              ),
	   ),
	);
    array_push($options, $option);
}
?>