<?php
/**
 *
 *
 * @package openmairie_exemple
 * @version SVN : $Id: auto.php 316 2010-12-06 12:14:36Z fmichon $
 */

require_once "../obj/utils.class.php";
$f = new utils(NULL, "gen", _("Generateur")." -> "._("Generation"));

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
    $retour .= " => "._("Generation non souhaitee");
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
        "method" => "tableincgen",
        "param" => "dyn",
                           ),
    "tableinc" => array(
        "path" => "../sql/".OM_DB_PHPTYPE."/".$table.".inc",
        "checked" => false,
        "method" => "tableinc",
        "param" => OM_DB_DATABASE,
                           ),
    "tableformincgen" => array(
        "path" => "../gen/sql/".OM_DB_PHPTYPE."/".$table.".form.inc.php",
        "checked" => true,
        "method" => "tableformincgen",
        "param" => "dyn",
                           ),
    "tableforminc" => array(
        "path" => "../sql/".OM_DB_PHPTYPE."/".$table.".form.inc",
        "checked" => false,
        "method" => "tableforminc",
        "param" => OM_DB_DATABASE,
                           ),
    "tableobj" => array(
        "path" => "../gen/obj/".$table.".class.php",
        "checked" => true,
        "method" => "tableobj",
        "param" => "dyn",
                           ),
    "obj" => array(
        "path" => "../obj/".$table.".class.php",
        "checked" => false,
        "method" => "obj",
                           ),
    "editioninc" => array(
        "path" => "../sql/".OM_DB_PHPTYPE."/".$table.".pdf.inc",
        "checked" => false,
        "method" => "pdf",
        "param" => "dyn",
                           ),
    "reqmoinc" => array(
        "path" => "../sql/".OM_DB_PHPTYPE."/".$table.".reqmo.inc",
        "checked" => false,
        "method" => "reqmo",
        "param" => "",
                           ),
    "importinc" => array(
        "path" => "../sql/".OM_DB_PHPTYPE."/".$table.".import.inc",
        "checked" => false,
        "method" => "import",
        "param" => "",
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
//
if (isset ($_POST['dyn']))
   $dyn=$_POST['dyn'];
else
   $dyn="standard";

/**
 * Classe gen
 */
require_once (PATH_OPENMAIRIE."gen.class.php");
$g = new gen($table, $f->db, OM_DB_DATABASE, OM_DB_PHPTYPE, $dyn, OM_DB_SCHEMA);

/**
 * Ouverture du conteneur de la page
 */
//
echo "\n<div id=\"generator-generate\">\n";
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
 * Affichage du formulaire de selection des fichiers a generer
 */
//
$title = _("Choix des fichiers a generer");
$f->displaySubTitle($title);
// Traitement si validation du formulaire
if (isset($_POST["valid_gen_generer"])) {
    
    // parametre inc
    if (file_exists("dyn/standard/option.inc")) {
        include "dyn/standard/option.inc";
    }
    //
    if ($dyn != "standard") {
        if (file_exists("dyn/".$dyn."/option.inc")) {
            include ("dyn/".$dyn."/option.inc");
        } else {
            $g->msg .= "<br/>"._("Absence du parametrage dyn/".$dyn);
        }
    }
    // parametrage
    $g->msg .=  "<br/>"._("Parametrage utilise :")." ".$dyn;
    // variables
    $recherche = "obj=".$table;
    //
    foreach ($rubriks as $key => $rubrik) {
        //
        foreach ($rubrik as $param) {
            if ($key == "edition" or $key == "import") {
                $nomfichier = "../gen/inc/".$key.".inc";
            }
            if (${$param} == 1) {
                if (!isset($params[$param]["param"])) {
                    $g->ecrirefichier($params[$param]["path"], $g->{$params[$param]["method"]}());
                } else {
                    $method_param = $params[$param]["param"];
                    if ($method_param == "dyn") {
                        $method_param = $dyn;
                    }
                    $g->ecrirefichier($params[$param]["path"], $g->{$params[$param]["method"]}($method_param));
                }
            } else {
                if ($key == "edition" or $key == "import") {
                    $g->msg .= automsg($nomfichier);
                }
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
                        $g->ecrirefichier($file, $g->reqmo($elem));
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
echo "<form method=\"post\" action=\"auto.php?table=".$table."\" name=\"f1\">\n";
// Ouverture de la balise table
echo "<table cellpadding=\"0\" class=\"formEntete ui-corner-all\">\n";
//
$dir = getcwd();
$dir="dyn/";
$dossier = opendir($dir);
//
affichetitre("<b>"._("Choix du parametrage")."</b>");
//
$field = "<select name=\"dyn\" class=\"champFormulaire\">\n";
while ($entree = readdir($dossier)) {
    if ($entree != "CVS" and $entree != ".." and $entree != "."
        and $entree != ".svn" and $entree != "index.php") {
        if ($entree == "standard") {
            $field .= "\t<option selected=\"selected\">".$entree."</option>\n";
        } else {
            $field .= "\t<option>".$entree."</option>\n";
        }
    }
} 
$field .= "</select>\n";
affichecol("", $field, "");
//
foreach ($rubriks as $key => $rubrik) {
    //
    affichetitre("<b>"._($key)."</b>");
    //
    foreach ($rubrik as $param) {
        //
        $lib = array_pop(explode("/", $params[$param]["path"]));
        //
        $box = "<input type=\"checkbox\" name=\"".$param."\"";
        $box .= ($params[$param]["checked"] ? " checked=\"checked\"":"");
        $box .= " class=\"champFormulaire\" />";
        //
        if (file_exists($params[$param]["path"])) {
            //
            $msg = "<a href=\"javascript:aff('".$params[$param]["path"]."')\">";
            $msg .= $params[$param]["path"];
            $msg .= "</a>";
            $msg .= " <span class=\"text-green\">[ "._("Le fichier existe")." ]</span> ";
        } else {
            //
            $msg = $params[$param]["path"];
            $msg .= " <span class=\"text-red\">[ "._("Le fichier n'existe pas")." ]</span> ";
        }
        //
        affichecol($box, $lib, $msg);
    }
    //
    if ($key == "reqmo") {
        // sous reqmo
        if (!empty($g->clesecondaire)) {
            foreach ($g->clesecondaire as $elem) {
                $file = "../sql/".OM_DB_PHPTYPE."/".$table."_".$elem.".reqmo.inc";
                //
                $lib = array_pop(explode("/", $file));
                //
                $box = "<input type=\"checkbox\" name=\"reqmo_".$elem."\"";
                $box .= " class=\"champFormulaire\" />";
                //
                if (file_exists($file)) {
                    //
                    $msg = "<a href=\"javascript:aff('".$file."')\">";
                    $msg .= $file;
                    $msg .= "</a>";
                    $msg .= " <span class=\"text-green\">[ "._("Le fichier existe")." ]</span> ";
                } else {
                    //
                    $msg = $file;
                    $msg .= " <span class=\"text-red\">[ "._("Le fichier n'existe pas")." ]</span> ";
                }
                //
                affichecol($box,$lib,$msg);
            }
        }
    }
}
// Fermeture de la balise table
echo "</table>\n";
// Affichage des actions de controles du formulaire
echo "<div class=\"formControls\">";
// Bouton de validation du formulaire
echo "<input type=\"submit\" name=\"valid.gen.generer\" value=\""._("Generer les fichiers de la table :")." '".$table."'\" />";
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