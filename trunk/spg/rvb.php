<?php
/**
 * Ce script permet d'afficher dans une popup un selecteur de couleur RVB.
 *
 * @package openmairie_exemple
 * @version SVN : $Id: rvb.php 278 2010-11-30 07:12:41Z fmichon $
 */

require_once "../obj/utils.class.php";
$f = new utils("nohtml");

/**
 * Initialisation des parametres
 */
//
(isset($_GET['valeur']) ? $valeur = $_GET['valeur'] : $valeur = "");
//
(isset($_GET['retour']) ? $retour = $_GET['retour'] : $retour = "");
//
(isset($_GET['palette']) ? $palette = $_GET['palette'] : $palette = ""); 
//
(isset($_GET['saturation']) ? $saturation = $_GET['saturation'] : $saturation = "");
//
(isset($_GET['form']) ? $form = $_GET['form'] : $form = "f1");

/**
 * Affichage de la structure HTML
 */
//
if ($form == "f1") {
    $f->addHTMLHeadJs("../js/rvb.js");
} else {
    $f->addHTMLHeadJs("../js/rvb2.js");
}
//
$f->setFlag("htmlonly");
$f->display();
//
$f->displayStartContent();
//
$f->setTitle(_("RVB"));
$f->displayTitle();

/**
 * Affichage du selecteur de couleur RVB
 */
echo "<div id=\"rvb\">\n";
//
echo "\n<script type=\"text/javascript\">\n";
echo "afficherPage(\"".$retour."\", \"".$palette."\", \"".$saturation."\");\n";
echo "</script>\n";
//
echo "\n<div class=\"visualClear\">&nbsp;</div>\n";
//
echo "\n</div>\n";

/**
 * Affichage de la structure HTML
 */
//
$f->displayEndContent();

?>
