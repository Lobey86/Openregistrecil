<?php
/**
 *
 *
 * @package openmairie_exemple
 * @version SVN : $Id: sup.php 316 2010-12-06 12:14:36Z fmichon $
 */

require_once "../obj/utils.class.php";
$f = new utils(NULL, "gen", _("Generateur")." -> "._("Suppression"));

/**
 * Declaration des fonctions d'affichage
 */
function affichecol($col1, $col2, $col3) {
    echo "<tr class=\"tabcolData\">\n";
    echo "\t<td class=\"reqmochecked\">".$col1."</td>\n";
    echo "\t<td class=\"tabDataMouvement\">".$col2."</td>\n";
    echo "\t<td class=\"reqmochecked0\">".$col3."</td>\n";
    echo "</tr>\n";  
}
function affichetitre($titre, $align = "") {
    echo "<tr class=\"tabcol\">\n";
    echo "\t<td colspan=\"3\">";
    if ($align != "") {
        echo "<".$align.">";
    }
    echo $titre;
    if ($align != "") {
        echo "</".$align.">";
    };
    echo "</td>\n";
    echo "</tr>\n";
}
function afficheinfo($col1, $col2){
    echo "<tr class=\"tabcolData\">\n";
    echo "\t<td class=\"reqmochecked0\">".$col1."</td>\n";
    echo "\t<td class=\"reqmochecked0\">".$col2."</td>\n";
    echo "</tr>\n";
}
function automsg($nomfichier){
    $retour = "<br/>"._("Fichier")." \"".$nomfichier."\"";
    $retour .= " => "._("Suppression non souhaitee");
    return $retour;
}

/**
 * Initialisation des variables
 */
//
(isset($_GET["table"]) ? $table = $_GET["table"] : $table = "");
//
$rubriks = array(
    "formulaire" => array("tableincgen", "tableinc", "tableformincgen", "tableforminc", "tableobj", "obj"),
    "edition" => array("editioninc"),
    "reqmo" => array("reqmoinc"),
    "divers" => array("importinc"),
);
//
$params = array(
    "tableincgen" => array(
        "path" => "../gen/sql/".OM_DB_PHPTYPE."/".$table.".inc.php",
        "checked" => true,
                           ),
    "tableinc" => array(
        "path" => "../sql/".OM_DB_PHPTYPE."/".$table.".inc",
        "checked" => false,
                           ),
    "tableformincgen" => array(
        "path" => "../gen/sql/".OM_DB_PHPTYPE."/".$table.".form.inc.php",
        "checked" => true,
                           ),
    "tableforminc" => array(
        "path" => "../sql/".OM_DB_PHPTYPE."/".$table.".form.inc",
        "checked" => false,
                           ),
    "tableobj" => array(
        "path" => "../gen/obj/".$table.".class.php",
        "checked" => true,
                           ),
    "obj" => array(
        "path" => "../obj/".$table.".class.php",
        "checked" => false,
                           ),
    "editioninc" => array(
        "path" => "../sql/".OM_DB_PHPTYPE."/".$table.".pdf.inc",
        "checked" => false,
                           ),
    "reqmoinc" => array(
        "path" => "../sql/".OM_DB_PHPTYPE."/".$table.".reqmo.inc",
        "checked" => false,
                           ),
    "importinc" => array(
        "path" => "../sql/".OM_DB_PHPTYPE."/".$table.".import.inc",
        "checked" => false,
                           ),
);
// Variables POST
foreach ($params as $key => $elem) {
    if (isset($_POST[$key])) {
        ${$key} = 1;
    } else {
        ${$key} = 0;
    }
}

/**
 * Classe gen
 */
require_once (PATH_OPENMAIRIE."gen.class.php");
$g = new gen($table, $f->db, OM_DB_DATABASE, OM_DB_PHPTYPE, "", OM_DB_SCHEMA);

/**
 * Ouverture du conteneur de la page
 */
//
echo "\n<div id=\"generator-delete\">\n";
//
echo "<div id=\"formulaire\">\n\n";
//
echo "<ul>\n";
echo "\t<li><a href=\"#tabs-1\">".$table."</a></li>\n";
echo "</ul>\n";
//
echo "\n<div id=\"tabs-1\">\n";

/**
 *
 */
//
$title = _("Analyse de la base de donnees")." ".OM_DB_PHPTYPE." -> ";
$title .= (OM_DB_SCHEMA == "" ?"":OM_DB_SCHEMA.".").OM_DB_DATABASE;
$f->displaySubTitle($title);
// Ouverture de la balise table
echo "<table cellpadding=\"0\" class=\"formEntete ui-corner-all\">\n";
// tables de la base
$contenu = "";
if (!empty($g->tablebase)) {
    foreach ($g->tablebase as $elem) {
        $contenu .= " [ ".$elem. " ] ";
    }
    $lib = _("Tables de la base de donnees");
    afficheinfo($lib, $contenu);
} 
// table
$contenu = "";
$lib = _("Table :")." <b>".$table."</b>";
$contenu .= "[ "._('cle')." ".$g->typecle." - ";
if ($g->typecle == 'N') { // XXX - Ce test est-il correct ?
    $contenu .= _("cle automatique")." ]";
} else {
    $contenu .= _("cle manuelle")." ]";
}
$contenu .=" [ "._('longueur')." "._("enregistrement")." : ".$g->longueur." ]";
afficheinfo($lib, $contenu); 
// champs
$contenu = "";
$lib = _("Champs");
foreach ($g->info as $elem) {
    $contenu .= "[ ".$elem["name"]." ".$elem["len"]." ".$elem["type"]." ] ";
}
afficheinfo($lib, $contenu); 
// sous formulaire
$contenu = "";
if (!empty($g->sousformulaire)) {
    foreach ($g->sousformulaire as $elem) {
        $contenu .= " [ ".$elem. " ] ";
    }
}
$lib= _("Sous formulaire");
afficheinfo($lib, $contenu);
// cle secondaire
$contenu = ""; 
if (!empty($g->clesecondaire)) {
    foreach ($g->clesecondaire as $elem) {
        $contenu .= " [ ".$elem. " ] ";
        // sous etat / cle secondaire
        if (isset($_POST['sousetatinc_'.$elem])) {
            $sousetatinc[$elem] = 1;
        } else {
            $sousetatinc[$elem] = 0;
        }
        //
        if (isset($_POST['reqmo_'.$elem])) {
            $reqmo[$elem] = 1;
        } else {
            $reqmo[$elem] = 0;
        }
    }
}
$lib = _("Cle secondaire");
afficheinfo($lib, $contenu);
// Fermeture de la balise table
echo "</table>"; 

/**
 * Affichage du formulaire de selection des fichiers a supprimer
 */
//
$title = _("Choix des fichiers a supprimer");
$f->displaySubTitle($title);
// Traitement si validation du formulaire
if (isset($_POST["valid_gen_supprimer"])) {
    //
    foreach ($rubriks as $key => $rubrik) {
        //
        foreach ($rubrik as $param) {
            if (${$param} == 1) {
                $g->supprimerfichier($params[$param]["path"]);
            } else {
                $g->msg .= automsg($params[$param]["path"]);
            }
        }
        //
        if ($key == "reqmo") {
            // sous reqmo
            if (!empty($g->clesecondaire)) {
                foreach ($g->clesecondaire as $elem) {
                    $file = "../sql/".OM_DB_PHPTYPE."/".$table."_".$elem.".reqmo.inc";
                    if ($reqmo[$elem] == 1) {
                        $g->supprimerfichier($file);
                    } else {
                        $g->msg .= automsg($file);
                    }
                }
            }
        }
    }
    // Affichage du message de validation du traitement
    $f->displayMessage("valid", $g->msg);
}
// Ouverture de la balise formulaire
echo "<form method=\"post\" action=\"sup.php?table=".$table."\" name=\"f1\">\n";
// Ouverture de la balise table
echo "<table cellpadding=\"0\" class=\"formEntete ui-corner-all\">\n";
//
foreach ($rubriks as $key => $rubrik) {
    //
    affichetitre("<b>"._($key)."</b>");
    //
    foreach ($rubrik as $param) {
        if (file_exists($params[$param]["path"])) {
            //
            $lib = array_pop(explode("/", $params[$param]["path"]));
            //
            $box = "<input type=\"checkbox\" name=\"".$param."\"";
            $box .= ($params[$param]["checked"] ? " checked=\"checked\"":"");
            $box .= " class=\"champFormulaire\" />";
            //
            $msg = "<a href=\"javascript:aff('".$params[$param]["path"]."')\">";
            $msg .= $params[$param]["path"];
            $msg .= "</a>";
            //
            affichecol($box, $lib, $msg);
        }
    }
    //
    if ($key == "reqmo") {
        // sous reqmo
        if (!empty($g->clesecondaire)) {
            foreach ($g->clesecondaire as $elem) {
                $file = "../sql/".OM_DB_PHPTYPE."/".$table."_".$elem.".reqmo.inc";
                //
                if (file_exists($file)) {
                    //
                    $lib = array_pop(explode("/", $file));
                    //
                    $box = "<input type=\"checkbox\" name=\"reqmo_".$elem."\"";
                    $box .= " class=\"champFormulaire\" />";
                    //
                    $msg = "<a href=\"javascript:aff('".$file."')\">";
                    $msg .= $file;
                    $msg .= "</a>";
                    //
                    affichecol($box,$lib,$msg);
                }
            }
        }
    }
}
// Fermeture de la balise table
echo "</table>\n";
// Affichage des actions de controles du formulaire
echo "<div class=\"formControls\">";
// Bouton de validation du formulaire
echo "<input type=\"submit\" name=\"valid.gen.supprimer\" value=\""._("Supprimer les fichiers de la table :")." '".$table."'\" />";
// Lien retour
echo "<a href=\"gen.php\" class=\"retour\">";
echo _("Retour");
echo "</a>";
// Fermeture du conteneur des actions de controles du formulaire
echo "</div>";
// Fermeture de la balise formulaire
echo "\n</form>\n";

/**
 * Fermeture du conteneur de la page
 */
//
echo "</div>\n";
//
echo "</div>\n";
//
echo "</div>\n";

?>
