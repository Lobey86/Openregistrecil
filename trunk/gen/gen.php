<?php
/**
 * Ce fichier permet d'afficher les actions possibles avec le generateur.
 *
 * @package openmairie_exemple
 * @version SVN : $Id: gen.php 316 2010-12-06 12:14:36Z fmichon $
 */

require_once "../obj/utils.class.php";
$f = new utils(NULL, "gen", _("Generateur"));

/**
 * Description de la page
 */
$description = _("Le generateur openMairie permet de construire une ".
                 "application sur la base de l'anayse des informations du ".
                 "SGBD. Cet ecran vous presente une liste des tables ".
                 "presentes dans votre base de donnees pour l'utilisation du ".
                 "generateur et une serie d'assistants vous permettant des ".
                 "operations de migration et de creation d'etats.");
$description .= " ";
$description .= _("Pour pouvoir utiliser pleinement le generateur, merci de ".
                  "consulter la documentation presente ici :");
$description .= " ";
$description .= "<a href=\"http://www.openmairie.org/telechargement/gen.pdf/view\" target=\"_blank\">";
$description .= _("documentation d'utilisation du generateur");
$description .= "</a>.";
$f->displayDescription($description);

/**
 * XXX - parametrage
 * - les tables .seq ne sont pas affichees (mysql)
 * - on ne peut pas detruire les tables de base openexemple
 * - utilisateur.class est surcharge
 */

/**
 * 
 */
//
echo "\n<div id=\"generator\">\n";

/**
 * Tables presentes dans la base de donnees
 */
// Requete en fonction du type de base de donnees
if (OM_DB_PHPTYPE == "mysql") {
    $sql = "SHOW TABLES FROM ".OM_DB_SCHEMA.OM_DB_DATABASE;
} elseif (OM_DB_PHPTYPE == "pgsql") {
    $sql = "select tablename from pg_tables where schemaname='".OM_DB_SCHEMA."'";
} else {
    $message = _("Le generateur ne prend pas en charge le type de base de donnees que vous utilisez :");
    $mesage .= " ".OM_DB_PHPTYPE;
    $f->displayMessage("error", $message);
    die();
}
// Execution de la requete
$res = $f->db->query($sql);
$f->isDatabaseError($res);
// 
echo "<fieldset class=\"cadre ui-corner-all ui-widget-content collapsible\">\n";
//
echo "\t<legend class=\"ui-corner-all ui-widget-content ui-state-active\">";
echo _("Generation")." "._("objet")." : ".OM_DB_DATABASE." ( ".OM_DB_PHPTYPE." ) ";
echo "</legend>\n";
//
echo "\t<div class=\"list\">\n";
//
while ($row =& $res->fetchRow()) {
    // les tables .seq ne sont pas affichees (mysql)
    if (substr($row[0],-3,3) != "seq") {
        echo "<div class=\"choice ui-corner-all ui-widget-content\">";
        echo "<span>";
        //
        echo "<a title=\""._("Supprimer")."\" ";
        echo "href=\"sup.php?table=".$row[0]."\">";
        echo "<span class=\"om-icon om-icon-25 gen-supprimer\">";
        echo _("Supprimer");
        echo "</span>";
        echo "</a>";
        //
        echo "&nbsp;";
        //
        echo "<a title=\""._("Generer")."\" ";
        echo "href=\"auto.php?table=".$row[0]."\">";
        echo "<span class=\"om-icon om-icon-25 gen-generer\">";
        echo _("Generer");
        echo "</span>";
        echo "</a>";
        //
        echo "&nbsp;";
        //
        echo $row[0];
        //
        echo "</span>";
        echo "</div>\n";
    }
}
//
echo "</div>\n";
//
echo "</fieldset>\n";

/**
 * Assistants permettant la creation d'etats, sous etats, lettres types ou
 * l'import de ces memes elements depuis des anciennes versions d'openMairie
 */
//
$assistants = array(
    0 => array("href" => "import.php", "title" => _("Migration etat, sous etat, lettre type < v4")),
    1 => array("href" => "genetat.php", "title" => _("Creation etat")),
    2 => array("href" => "gensousetat.php", "title" => _("Creation sous etat")),
    3 => array("href" => "genlettretype.php", "title" => _("Creation lettre type")),
);
//
echo "<fieldset class=\"cadre ui-corner-all ui-widget-content startClosed\">\n";
//
echo "\t<legend class=\"ui-corner-all ui-widget-content ui-state-active\">";
echo _("Assistants")." : ".OM_DB_DATABASE." ( ".OM_DB_PHPTYPE." ) ";
echo "</legend>\n";
//
echo "\t<div class=\"list\">\n";
//
foreach ($assistants as $assistant) {
    echo "<div class=\"choice ui-corner-all ui-widget-content\">";
    echo "<span>";
    //
    echo "<a class=\"prev-icon generator-16\" href=\"".$assistant["href"]."\">";
    echo $assistant["title"];
    echo "</a>";
    //
    echo "</span>";
    echo "</div>\n";
}
//
echo "</div>\n";
//
echo "</fieldset>\n";

/**
 * Fermeture
 */
//
echo "</div>\n";

?>
