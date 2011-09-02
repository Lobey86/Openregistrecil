<?php
//$Id$ 
//gen openMairie le 02/09/2011 16:50 
$DEBUG=0;
$serie=15;
$ico="../img/ico_application.png";
$ent = _("option")." -> "._("om_sousetat");
if(!isset($premier)) $premier='';
if(!isset($recherche1)) $recherche1='';
if(!isset($tricolsf)) $tricolsf='';
if(!isset($premiersf)) $premiersf='';
if(!isset($selection)) $selection='';
if(!isset($retourformulaire)) $retourformulaire='';
if(isset($idx)){
	if($idx != ']')
	if (trim($idx!=''))
		$ent = $ent."-><font id='idz1'>&nbsp;".$idx."&nbsp;</font>";
	}
	if(isset($idz) ){
	if (trim($idz!=''))
		$ent = $ent."&nbsp;<font id='idz1'>&nbsp;".strtoupper($idz)."&nbsp;</font>";
}
$table=DB_PREFIXE."om_sousetat";
$champAffiche=array('om_sousetat','om_collectivite','id','libelle','actif','titrehauteur','titrefont','titreattribut','titretaille','titrebordure','titrealign','titrefond','titrefondcouleur','titretextecouleur','intervalle_debut','intervalle_fin','entete_flag','entete_fond','entete_orientation','entete_hauteur','entetecolone_bordure','entetecolone_align','entete_fondcouleur','entete_textecouleur','tableau_largeur','tableau_bordure','tableau_fontaille','bordure_couleur','se_fond1','se_fond2','cellule_fond','cellule_hauteur','cellule_largeur','cellule_bordure_un','cellule_bordure','cellule_align','cellule_fond_total','cellule_fontaille_total','cellule_hauteur_total','cellule_fondcouleur_total','cellule_bordure_total','cellule_align_total','cellule_fond_moyenne','cellule_fontaille_moyenne','cellule_hauteur_moyenne','cellule_fondcouleur_moyenne','cellule_bordure_moyenne','cellule_align_moyenne','cellule_fond_nbr','cellule_fontaille_nbr','cellule_hauteur_nbr','cellule_fondcouleur_nbr','cellule_bordure_nbr','cellule_align_nbr','cellule_numerique','cellule_total','cellule_moyenne','cellule_compteur');
$champRecherche=array('id','libelle','actif','titrefont','titreattribut','titrebordure','titrealign','titrefond','titrefondcouleur','titretextecouleur','entete_flag','entete_fond','entete_orientation','entetecolone_bordure','entetecolone_align','entete_fondcouleur','entete_textecouleur','tableau_bordure','bordure_couleur','se_fond1','se_fond2','cellule_fond','cellule_largeur','cellule_bordure_un','cellule_bordure','cellule_align','cellule_fond_total','cellule_fondcouleur_total','cellule_bordure_total','cellule_align_total','cellule_fond_moyenne','cellule_fondcouleur_moyenne','cellule_bordure_moyenne','cellule_align_moyenne','cellule_fond_nbr','cellule_fondcouleur_nbr','cellule_bordure_nbr','cellule_align_nbr','cellule_numerique','cellule_total','cellule_moyenne','cellule_compteur');
$tri="";
$edition="om_sousetat";
if ($_SESSION['niveau']== '2')
	$selection='';
else
	$selection=" where om_sousetat.om_collectivite = '".$_SESSION['collectivite']."'";
if ($retourformulaire== 'om_collectivite')
	if ($_SESSION['niveau']== '2'){
		$selection=" where om_sousetat.om_collectivite ='".$idx."'";
	}else{
		$selection=" where om_sousetat.om_collectivite ='".$idx."' and om_sousetat.om_collectivite = '".$_SESSION['collectivite']."'";
	}
?>