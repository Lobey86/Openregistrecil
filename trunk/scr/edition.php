<?php
/**
 * Cette page permet de lister les differentes editions pdf presentes dans
 * l'application
 *
 * @package openmairie_exemple
 * @version SVN : $Id: edition.php 311 2010-12-06 11:43:36Z fmichon $
 */

require_once "../obj/utils.class.php";
$f = new utils(NULL, "edition", _("Edition"), "ico_edition.png", "edition");

/**
 * Description de la page
 */
$description = _("Cette page vous permet de visualiser les editions ".
                 "disponibles dans l'application.");
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
    if (strstr($entree, "pdf")) {
        array_push($tab, array('file' => substr($entree, 0, strlen($entree) - 8)));
    }
}
closedir($dossier);
asort($tab);

/**
 * 
 */
//
echo "\n<div id=\"edition\">\n";
//
echo "<fieldset class=\"cadre ui-corner-all ui-widget-content\">\n";
//
echo "\t<legend class=\"ui-corner-all ui-widget-content ui-state-active\">";
echo _("Choix de l'edtion");
echo "</legend>\n";
//
echo "\t<div class=\"list\">\n";
//
foreach ($tab as $elem) {
    echo "<div class=\"choice ui-corner-all ui-widget-content\">";
    echo "<span>";
    //
    echo "<a class=\"prev-icon edition-16\" href=\"../pdf/pdf.php?obj=".$elem['file']."\" target=\"_blank\">";
    echo _($elem['file']);
    echo "</a>";
    //
    echo "</span>";
    echo "</div>\n";
}
//
echo "</div>\n";
//
echo "</fieldset>\n";

echo "</div>\n";

?>