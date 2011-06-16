<?php
//$Id$ 
//gen openMairie le 06/12/2010 15:57 
$DEBUG=0;
$ico="../img/ico_application.png";
$ent="option->om_sousetat";
$tableSelect=DB_PREFIXE."om_sousetat";
$champs=array("om_sousetat","om_collectivite","id","libelle","actif","titre","titrehauteur","titrefont","titreattribut","titretaille","titrebordure","titrealign","titrefond","titrefondcouleur","titretextecouleur","intervalle_debut","intervalle_fin","entete_flag","entete_fond","entete_orientation","entete_hauteur","entetecolone_bordure","entetecolone_align","entete_fondcouleur","entete_textecouleur","tableau_largeur","tableau_bordure","tableau_fontaille","bordure_couleur","se_fond1","se_fond2","cellule_fond","cellule_hauteur","cellule_largeur","cellule_bordure_un","cellule_bordure","cellule_align","cellule_fond_total","cellule_fontaille_total","cellule_hauteur_total","cellule_fondcouleur_total","cellule_bordure_total","cellule_align_total","cellule_fond_moyenne","cellule_fontaille_moyenne","cellule_hauteur_moyenne","cellule_fondcouleur_moyenne","cellule_bordure_moyenne","cellule_align_moyenne","cellule_fond_nbr","cellule_fontaille_nbr","cellule_hauteur_nbr","cellule_fondcouleur_nbr","cellule_bordure_nbr","cellule_align_nbr","cellule_numerique","cellule_total","cellule_moyenne","cellule_compteur","om_sql");
//champs select
$sql_om_collectivite="select * from ".DB_PREFIXE."om_collectivite";
?>