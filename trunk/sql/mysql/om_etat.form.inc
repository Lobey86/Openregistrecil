<?php
//$Id$ 
//gen openMairie le 18/10/2010 16:23 
include('../gen/sql/mysql/om_etat.form.inc.php');
$champs=array("om_etat","om_collectivite",
              "id","libelle",'om_etat.actif',
              "orientation","format",
              "footerfont","footerattribut","footertaille",
              "logo","logoleft","logotop",
              "titre","titreleft","titretop","titrelargeur","titrehauteur",
              "titrefont","titreattribut","titretaille","titrebordure","titrealign",
              "corps","corpsleft","corpstop","corpslargeur","corpshauteur",
              "corpsfont","corpsattribut","corpstaille","corpsbordure","corpsalign",
              "om_sql",
              "'' as om_sousetat","sousetat", //*** specific
              "se_font","se_margeleft","se_margetop","se_margeright","se_couleurtexte",
              "'lettretype.png' as image");

// on ne peut associer qu'un sousetat de la collectivte actif
$sql_om_sousetat="select id,concat(id,' ',libelle) from om_sousetat";
$sql_om_sousetat.=" where actif='Oui' and om_collectivite=".$_SESSION['collectivite'];
$sql_om_sousetat.=" order by libelle";
// restriction collectivite si multi
?>