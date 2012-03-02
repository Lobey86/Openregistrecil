<?php
//$Id: registre_visu.inc,v 1.1 2008-09-25 14:40:07 jbastide Exp $
$DEBUG=0;
$serie=15;
$ent = "registre -> visualisation";
$ico = "../img/ico_registre.png";
$edition="";
$table="registre";
$champAffiche=array("registre", "service",
                    "finalite",
                    "date_registre");
$champRecherche=array("registre", "service","finalite","date_registre");
$selection = "";
$tri= "";
$href[0]['lien']= "#";
$href[0]['id']= "";
$href[0]['lib']= "";
$href[1]['lien'] = "";
$href[1]['id']= "";
$href[1]['lib']= "";
$href[2]['lien'] = "#";
$href[2]['id']= "";
$href[2]['lib']= "";
$href[3] = array(
    "lien" => "../pdf/pdfetat.php?obj=registre&amp;idx=",
    "id" => "",
    "lib" => "<span class=\"om-icon om-icon-16 om-icon-fix pdf-16\" title=\""._("Edition")."\">"._("Edition")."</span>",
);
?>