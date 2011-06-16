<?php
//$Id$ 
//gen openMairie le 15/10/2010 15:55 
include('../gen/sql/mysql/om_utilisateur.inc.php');
$table="om_utilisateur
        left join om_profil on om_profil.om_profil=om_utilisateur.om_profil
        left join om_collectivite on om_collectivite.om_collectivite=om_utilisateur.om_collectivite"; 
$champAffiche=array("om_utilisateur.om_utilisateur",
                    "om_utilisateur.nom",
                    "om_utilisateur.email",
                    "om_utilisateur.login",
                    "om_profil.libelle as profil",
                    "om_collectivite.libelle as collectivite");
$champRecherche=array("nom","login","om_profil.libelle","om_collectivite.libelle");
$href[4] = array(
    "lien" => "../pdf/pdflettretype.php?obj=".$obj."&amp;idx=",
    "id" => "",
    "lib" => "<img src=\"../img/pdf-16x16.png\" alt=\""
             ._("Edition PDF")."\" title=\""._("Edition PDF")."\" />",
);
?>