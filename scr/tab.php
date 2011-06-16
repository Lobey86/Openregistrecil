<?php
/**
 *
 *
 * @package openmairie_exemple
 * @version SVN : $Id: tab.php 234 2010-11-18 15:00:55Z fmichon $
 */

require_once "../obj/utils.class.php";
$f = new utils("nohtml");

/**
 * Initialisation des variables
 */
// Nom de l'objet metier
(isset($_GET['obj']) ? $obj = $_GET['obj'] : $obj = "");
// Premier enregistrement a afficher
(isset($_GET['premier']) ? $premier = $_GET['premier'] : $premier = 0);
// Colonne choisie pour le tri
(isset($_GET['tricol']) ? $tricol = $_GET['tricol'] : $tricol = "");
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
// Colonne choisie pour la selection
if (isset($_POST['selectioncol'])) {
	$selectioncol = $_POST['selectioncol'];
} else {
	if (isset($_GET['selectioncol'])) {
    	$selectioncol = $_GET['selectioncol'];
	} else {
    	$selectioncol = "";
	}
}
// ???
$ico = "";
// ???
$hiddenid = 0;

/**
 * Verification des parametres
 */
if (strpos($obj, "/") !== false
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
            "lien" => "form.php?obj=".$obj."&amp;tricol=".$tricol,
            "id" => "",
            "lib" => "<img src=\"../img/ajouter.png\" alt=\""._("Ajouter")."\" title=\""._("Ajouter")."\" />",
        );
        $href[1] = array(
            "lien" => "form.php?obj=".$obj."&amp;tricol=".$tricol."&amp;idx=",
            "id" => "&amp;premier=".$premier."&amp;recherche=".$recherche1."&amp;selectioncol=".$selectioncol,
            "lib" => "<img src=\"../img/modifier.png\" alt=\""._("Modifier")."\" title=\""._("Modifier")."\" />",
        );
        $href[2] = array(
            "lien" => "form.php?obj=".$obj."&amp;tricol=".$tricol."&amp;idx=",
            "id" => "&amp;ids=1&amp;premier=".$premier."&amp;recherche=".$recherche1."&amp;selectioncol=".$selectioncol,
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

/**
 *
 */
//
$f->setRight($obj."_tab");
$f->isAuthorized();
//
$f->setTitle($ent);
$f->setIcon($ico);
$f->setHelp($obj);
//
$f->setFlag(NULL);
$f->display();



/**
 *
 */
//
echo "<div id=\"formulaire\">\n\n";
//
require_once PATH_OPENMAIRIE."om_table.class.php";
//
echo "<ul>\n";
echo "\t<li><a href=\"#tabs-1\">".ucwords(_($obj))."</a></li>\n";
echo "</ul>\n";    
//
echo "\n<div id=\"tabs-1\">\n";
//
if ($edition != "") {
    $edition = "../pdf/pdf.php?obj=".$edition;
}
//
if (!isset($options)) {
    $options = array();
}
//
$tb = new table("../scr/tab.php", $table, $serie, $champAffiche, $champRecherche, $tri, $selection, $edition, $options);
//
$params = array(
    "obj" => $obj,
    "premier" => $premier,
    "recherche" => $recherche,
    "selectioncol" => $selectioncol,
    "tricol" => $tricol,
);
//
$tb->display($params, $href, $f->db, "tab", false);
//
echo "</div>\n";
//
echo "\n</div>\n";

?>