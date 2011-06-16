<?php
/**
 *
 *
 * @package openmairie_exemple
 * @version SVN : $Id: reqmo.php 311 2010-12-06 11:43:36Z fmichon $
 */

require_once "../obj/utils.class.php";
$f = new utils(NULL, "reqmo", _("Requetes memorisees"));

/**
 *
 */
$description = _("Les requetes memorisees permettent d'exporter des donnees ".
                 "de la base de donnees pour une utilisattion externe a ".
                 "l'application. Veuillez cliquer sur l'objet a exporter ".
                 "pour atteindre un formulaire vous permettant de choisir les ".
                 "parametres de l'export.");
$f->displayDescription($description);

/**
 *
 */
//
$dir = getcwd();
$dir = substr($dir, 0, strlen($dir) - 4)."/sql/".$f->phptype."/";
$dossier = opendir($dir);
$tab = array();
while ($entree = readdir($dossier)) {
    if (strstr($entree, "reqmo")) {
        array_push($tab, array('file' => substr($entree, 0, strlen($entree) - 10)));
    }
}
closedir($dossier);
asort($tab);

/**
 *
 */
//
echo "\n<div id=\"reqmo\">\n";
//
echo "<fieldset class=\"cadre ui-corner-all ui-widget-content\">\n";
//
echo "\t<legend class=\"ui-corner-all ui-widget-content ui-state-active\">";
echo _("Choix de la requete memorisee");
echo "</legend>\n";
//
echo "\t<div class=\"list\">\n";
if (count($tab) == 0) {
    echo "<p>";
    echo _("Il n'y a aucun element de ce type dans l'application.");
    echo "</p>";
}
foreach ($tab as $elem) {
    //
    echo "<div class=\"choice ui-corner-all ui-widget-content\">\n";
    //
    echo "<span>\n";
    //
    echo "<a class=\"prev-icon reqmo-16\" href=\"../scr/requeteur.php?obj=".$elem['file']."\">";
    echo $elem['file'];
    echo "</a>";
    //
    echo "</span>\n";
    //
    echo "</div>\n";
}
echo "\t</div>\n";
//
echo "</fieldset>\n";
//
echo "</div>\n";

?>