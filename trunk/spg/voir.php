<?php
/**
 * Ce script permet de visualiser un fichier pdf ou une image present dans le
 * champs file d'un formulaire
 *
 * @package openmairie_exemple
 * @version SVN : $Id: voir.php 336 2010-12-15 17:26:37Z fraynaud $
 */

require_once "../obj/utils.class.php";
$f = new utils("nohtml");

/**
 * Initialisation des parametres
 */
//
(isset($_GET['fic']) ? $fic = $_GET['fic'] : $fic = "");

/**
 *
 */
$path = $f->getPathFolderTrs();

/**
 * Verification des parametres
 */
if ($fic == ""
    or !file_exists($path.$fic)) {
    $class = "error";
    $message = _("L'objet est invalide.");
    $f->addToMessage($class, $message);
    $f->setFlag(NULL);
    $f->display();
    die();
}

/**
 * On recupere l'extension du fichier, si c'est un pdf on redirige directement
 * vers le fichier
 */
$extension = strrchr($fic, '.');
$extension = substr($extension, 1, (strlen($extension) - 1));
if (strtolower($extension) == "pdf") {
    header("Location:".$path.$fic);
}

/**
 * Affichage de la structure HTML
 */
//
$f->setFlag("htmlonly");
$f->display();
//
$f->displayStartContent();
//
$f->setTitle(_("Voir")." -> [&nbsp;".$path.$fic."&nbsp;]");
$f->displayTitle();

/**
 *
 */
//
echo "<div id=\"voir\">\n";
//
echo "\n<p class=\"center\">";
echo "<img src=\"".$path.$fic."\" alt=\"".$fic."\" />";
echo "</p>\n";
//
echo "\n</div>\n";
//
$f->displayLinkJsCloseWindow();

/**
 *
 */
//
$f->displayEndContent();

?>