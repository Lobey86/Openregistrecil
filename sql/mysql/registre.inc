<?php
//$Id$ 
//gen openMairie le 17/05/2011 11:42 
include('../gen/sql/mysql/registre.inc.php');
$champAffiche=array("registre",
                    "finalite",
                    "date_registre");
$href[3] = array(
    "lien" => "../pdf/pdfetat.php?obj=registre&amp;idx=",
    "id" => "",
    "lib" => "<img src=\"../img/pdf-16x16.png\" alt=\""
             ._("Edition PDF")."\" title=\""._("Edition PDF")."\" />",
);
?>
