<?php
//$Id$ 
//gen openMairie le 17/11/2010 20:20 
$DEBUG=0;
$ico="../img/ico_application.png";
$ent="option->om_lettretype";
$tableSelect=DB_PREFIXE."om_lettretype";
$champs=array("om_lettretype","om_collectivite","id","libelle","actif","orientation","format","logo","logoleft","logotop","titre","titreleft","titretop","titrelargeur","titrehauteur","titrefont","titreattribut","titretaille","titrebordure","titrealign","corps","corpsleft","corpstop","corpslargeur","corpshauteur","corpsfont","corpsattribut","corpstaille","corpsbordure","corpsalign","om_sql");
//champs select
$sql_om_collectivite="select * from ".DB_PREFIXE."om_collectivite";
?>