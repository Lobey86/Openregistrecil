<?php
/**
 *
 *
 * @package openmairie_exemple
 * @version SVN : $Id: form.php 339 2010-12-15 20:32:27Z fmichon $
 */

require_once "../obj/utils.class.php";
$f = new utils("nohtml");

/**
 *
 */
//
$display_tabs = true;
//
$display_accordion = false;

/**
 * Initialisation des variables
 */
// Nom de l'objet metier du formulaire
(isset($_GET['obj']) ? $obj = $_GET['obj'] : $obj = "");
// Identifiant de l'objet metier du formulaire et mode d'ajout
if (isset($_GET['idx']) and $_GET['idx'] != "") {
    $idx = $_GET['idx'];
    (isset($_GET['ids']) ? $maj = 2 : $maj = 1);
} else {
    $maj = 0;
    $idx = "]";
}
// Flag de validation du formulaire
(isset($_GET['validation']) ? $validation = $_GET['validation'] : $validation = 0);
// Libelle de l'enregistement du formulaire
(isset($_GET['idz']) ? $idz = $_GET['idz'] : $idz = "");
// Premier enregistrement a afficher sur le tableau de la page precedente (tab.php?premier=)
(isset($_GET['premier']) ? $premier = $_GET['premier'] : $premier = 0);
// Colonne choisie pour le tri sur le tableau de la page precedente (tab.php?tricol=)
(isset($_GET['tricol']) ? $tricol = $_GET['tricol'] : $tricol = "");
// Colonne choisie pour la selection sur le tableau de la page precedente (tab.php?selectioncol=)
(isset($_GET['selectioncol']) ? $selectioncol = $_GET['selectioncol'] : $selectioncol = "");
// Chaine recherchee
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
// ???
$table = "";

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
require_once "../sql/".$f->phptype."/".$obj.".inc";

/**
 *
 */
//
$f->setRight($obj);
$f->isAuthorized();
//
$f->addHTMLHeadJs(array("../js/formulairedyn.js", "../js/onglet.js"));
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
// Ouverture du conteneur d'onglets
echo "<div id=\"formulaire\">\n\n";

// Inclusion de la classe objet
require_once "../obj/".$obj.".class.php";
// Instanciation de l'objet metier
$enr = new $obj($idx, $f->db, 0);
// Incrementation du compteur de validation du formulaire
$validation++;
// Enclenchement de la tamporisation de sortie
ob_start();
// Appel de la methode formulaire
$enr->formulaire("", $validation, $maj, $f->db, $_POST, $obj, 0, $idx,
                 $premier, $recherche, $tricol, $idz, $selectioncol);
// Affecte le contenu courant du tampon de sortie a $return puis l'efface
$return = ob_get_clean();
// Si formulaire en mode ajout et formulaire valide et enregistrement correct
// alors on recupere $idx pour le passer aux sous formulaires
if ($maj == 0 and $validation>1 and $enr->correct==1 and $idx ==']') {
    $idx = $enr->valF[$enr->clePrimaire];
}

// Ouverture de la liste des onglets
echo "\t<ul>\n";
// Affichage du premier onglet
echo "\t\t<li><a id=\"main\" href=\"#tabs-1\">".ucwords(_($obj))."</a></li>\n";
// Affichage des sous formulaires en onglets
$tabs = array();
if (isset($sousformulaire) and $display_tabs) {
    foreach ($sousformulaire as $elem) {
        array_push($tabs, $elem);
        echo "\t\t<li>";
        echo "<a id=\"".$elem."\"";
        echo " href=\"../scr/soustab.php?obj=".$elem."&amp;retourformulaire=".$obj."&amp;idxformulaire=".$idx."\">";
        echo ucwords(_($elem));
        echo "</a>";
        echo "</li>\n";
    }
}
// Affichage de la recherche pour les sous formulaires
echo "\t\t<li>\n";
echo "\t\t\t<span id=\"recherche_onglet\" style=\"display:none;\">\n";
echo "\t\t\t\t";
$link = "soustab.php?retourformulaire=".$obj."&amp;idxformulaire=".$idx;
echo "<input type=\"text\" name=\"recherchedyn\" id=\"recherchedyn\" ";
echo "value=\"\" class=\"champFormulaire\" ";
echo "onkeyup=\"recherche('".$link."');\" />";
echo "\n";
echo "\t\t\t</span>\n";
echo "\t\t</li>\n";
// Fermeture de la liste des onglets
echo "\t</ul>\n\n";

// Ouverture du premier onglet
echo "\t<div id=\"tabs-1\">\n\n";

// Affichage du retour de la methode formulaire
echo $return;

// Javascript pour la desactivation des onglets lorsque necessaire
if ($maj == 0 and $enr->correct == false or $maj == 2 ) {
    echo "<script type=\"text/javascript\">";
    echo "$(function() {";
    echo "$(\"#formulaire\").tabs(\"option\", \"disabled\", [";
    foreach($tabs as $key => $tab) {
        echo ($key+1);
        if (count($tabs) > $key + 1 ) {
            echo ",";
        }
    }
    echo "]);";
    echo "});";
    echo "</script>";
}

// Affichage des sous formulaires en accordeon sous le formulaire
if ($display_accordion) {
    if ($maj == 1 or ($maj == 0 and $validation>1 and $enr->correct==1 and $idx ==']')){
        if (isset ($sousformulaire)) {
            echo "<div class=\"visualClear\"><!-- --></div>";
            echo "<div id=\"accordion\">";
            foreach ($sousformulaire as $elem) {
                echo "<h3>";
                echo "<a onclick=\"ajaxIt('".$elem."', 'soustab.php?obj=".$elem."&retourformulaire=".$obj."&idxformulaire=".$idx."');\"";
                echo " href=\"#\">";
                echo ucwords(_($elem));
                echo "</a>";
                echo "</h3>";
                echo "<div id=\"sousform-$elem\">";
                
                echo "</div>";
            }
            echo "</div>";
        }
    }
}

// Fermeture du premier onglet
echo "\n\t</div>\n";

// Fermeture du conteneur d'onglets
echo "</div>\n";

?>
