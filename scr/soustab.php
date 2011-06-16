<?php
/**
 *
 *
 * @package openmairie_exemple
 * @version SVN : $Id: soustab.php 294 2010-12-03 08:27:30Z fmichon $
 */
require_once "../obj/utils.class.php";
$f = new utils("nohtml");

/**
 * Definition du charset de la page
 */
header("Content-type: text/html; charset=".CHARSET."");

/**
 * Initialisation des variables
 */
// Nom de l'objet metier du tableau
(isset($_GET['obj']) ? $obj = $_GET['obj'] : $obj = "");
// Premier enregistrement a afficher dans le tableau
(isset($_GET['premier']) ? $premier = $_GET['premier'] : $premier = 0);
// Colonne choisie pour le tri dans le tableau
(isset($_GET['tricol']) ? $tricol = $_GET['tricol'] : $tricol = "");
// Colonne choisie pour la recherche dans le tableau
(isset($_GET['selectioncol']) ? $selectioncol = $_GET['selectioncol'] : $selectioncol = "");
// Objet du formulaire parent (form.php?obj=)
(isset($_GET['retourformulaire']) ? $retourformulaire = $_GET['retourformulaire'] : $retourformulaire = "");
// Identifiant de l'objet du formulaire parent (form.php?idx=)
(isset($_GET['idxformulaire']) ? $idxformulaire = $_GET['idxformulaire'] : $idxformulaire = "");
// Chaine recherchee
if (isset($_POST['recherche'])) {
    $recherche = $_POST['recherche'];
    if (get_magic_quotes_gpc()) {
        $recherche1 = StripSlashes($recherche);
    } else {
        $recherche1 = $recherche;
    }
} else {
    if (isset($_GET['recherche'])) {
        $recherche = $_GET['recherche'];
        if (get_magic_quotes_gpc()) {
            $recherche1 = StripSlashes($recherche);
        } else {
            $recherche1 = $recherche;
        }
    } else {
        $recherche = "";
        $recherche1 = "";
    }
}
// ???
$idx = $idxformulaire;

/**
 * Verification des parametres
 */
if (strpos($obj, "/") !== false
    or $idxformulaire == ""
    or $retourformulaire == ""
    or !file_exists("../sql/".$f->phptype."/".$obj.".inc")) {
    $class = "error";
    $message = _("L'objet est invalide.");
    $f->addToMessage($class, $message);
    $f->setFlag(NULL);
    $f->display();
    die();
}

/**
 *
 */
if ($f->isAccredited($obj)) {
    if (!isset($href) or $href == array()) {
        $href[0] = array(
            "lien" => "sousform.php?obj=".$obj."&amp;tri=".$tricol,
            "id" => "&amp;objsf=".$obj."&amp;premiersf=".$premier."&amp;retourformulaire=".$retourformulaire."&amp;idxformulaire=".$idxformulaire."&amp;trisf=".$tricol,
            "lib" => "<img src=\"../img/ajouter.png\" alt=\""._("Ajouter")."\" title=\""._("Ajouter")."\" />",
        );
        $href[1] = array(
            "lien" => "sousform.php?obj=".$obj."&amp;tri=".$tricol."&amp;idx=",
            "id" => "&amp;premier=".$premier."&amp;recherche=".$recherche1."&amp;objsf=".$obj."&amp;premiersf=".$premier."&amp;retourformulaire=".$retourformulaire."&amp;idxformulaire=".$idxformulaire."&amp;trisf=".$tricol,
            "lib" => "<img src=\"../img/modifier.png\" alt=\""._("Modifier")."\" title=\""._("Modifier")."\" />",
        );
        $href[2] = array(
            "lien" => "sousform.php?obj=".$obj."&amp;tri=".$tricol."&amp;idx=",
            "id" => "&amp;ids=1&amp;premier=".$premier."&amp;recherche=".$recherche1."&amp;objsf=".$obj."&amp;premiersf=".$premier."&amp;retourformulaire=".$retourformulaire."&amp;idxformulaire=".$idxformulaire."&amp;trisf=".$tricol,
            "lib" => "<img src=\"../img/supprimer.png\" alt=\""._("Supprimer")."\" title=\""._("Supprimer")."\" />",
        );
    }
} else {
    $href[0] = array("lien" => "#", "id" => "", "lib" => "", );
    $href[1] = array("lien" => "", "id" => "", "lib" => "", );
    $href[2] = array("lien" => "#", "id" => "", "lib" => "", );
}

/**
 *
 */
require_once "../sql/".$f->phptype."/".$obj.".inc";
//
if (!isset($options)) {
    $options = array();
}

/**
 *
 */
//
echo "<div id=\"sousform-".$obj."\">";
//
require_once PATH_OPENMAIRIE."om_table.class.php";
//
$tb = new table("../scr/soustab.php", $table, $serie, $champAffiche, $champRecherche, $tri, $selection, $edition, $options);
//
$params = array(
    "obj" => $obj,
    "premier" => $premier,
    "recherche" => $recherche,
    "selectioncol" => $selectioncol,
    "tricol" => $tricol,
    "retourformulaire" => $retourformulaire,
    "idxformulaire" => $idxformulaire,
);
$tb->display($params, $href, $f->db, "tab", true);
//
echo "</div>";

?>