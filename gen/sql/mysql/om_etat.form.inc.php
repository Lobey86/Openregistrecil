<?php
//$Id$ 
//gen openMairie le 06/12/2010 15:57 
$DEBUG=0;
$ico="../img/ico_application.png";
$ent="option->om_etat";
$tableSelect=DB_PREFIXE."om_etat";
$champs=array("om_etat","om_collectivite","id","libelle","actif","orientation","format","footerfont","footerattribut","footertaille","logo","logoleft","logotop","titre","titreleft","titretop","titrelargeur","titrehauteur","titrefont","titreattribut","titretaille","titrebordure","titrealign","corps","corpsleft","corpstop","corpslargeur","corpshauteur","corpsfont","corpsattribut","corpstaille","corpsbordure","corpsalign","om_sql","sousetat","se_font","se_margeleft","se_margetop","se_margeright","se_couleurtexte");
//champs select
$sql_om_collectivite="select * from ".DB_PREFIXE."om_collectivite";
?>