<?php
//$Id$ 
//gen openMairie le 17/05/2011 11:42 
include('../gen/sql/mysql/registre.inc.php');
$table="registre inner join om_collectivite on registre.om_collectivite=om_collectivite.om_collectivite";
$champAffiche=array("registre",
                    "finalite",
                    "date_registre","libelle as collectivite");
$href[3] = array(
    "lien" => "../pdf/pdfetat.php?obj=registre&amp;idx=",
    "id" => "",
    "lib" => "<span class=\"om-icon om-icon-16 om-icon-fix pdf-16\" title=\""._("Edition")."\">"._("Edition")."</span>",
);

?>
