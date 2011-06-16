<?php
/**
 * Ce script permet d'effectuer une correlation entre deux champs d'apres la
 * saisie d'une valeur dans un champ d'origine correle au travers d'une table
 * un autre champ
 *
 * @package openmairie_exemple
 * @version SVN : $Id: combo.php 298 2010-12-03 08:45:19Z fmichon $
 */

require_once "../obj/utils.class.php";
$f = new utils("nohtml");

/**
 * Affichage de la structure HTML
 */
//
$f->setFlag("htmlonly");
$f->display();
//
$f->displayStartContent();

/**
 * Parametres
 */
//
$DEBUG = 0;
//
$nbligne = 0;
// debut = 0 recherche sur la chaine / debut = 1 recherche sur le debut de la chaine
$debut = 0 ;
//
$longueurRecherche = 1;
//
$sql = "";
$z='';
// table sur laquelle se fait la correlation / table sur lequel s effectue la recherche
(isset($_GET['table']) ? $table = $_GET['table'] : $table = "");
// zone d'origine de la correlation / champ de recherche sur la table
(isset($_GET['zorigine']) ? $zoneOrigine = $_GET['zorigine'] : $zoneOrigine = "");
// zone qui sera mise à jour par la correlation / champ en relation
(isset($_GET['zcorrel']) ? $zoneCorrel = $_GET['zcorrel'] : $zoneCorrel = "");
// caracteres saisis dans la zone d'origine / valeur du champ origine a rechercher
(isset($_GET['recherche']) ? $recherche = $_GET['recherche'] : $recherche = "");
// valeur affectée à la zone d'origine / champ d origine => affectation de la valeur validee
(isset($_GET['origine']) ? $champOrigine = $_GET['origine'] : $champOrigine = "");
// valeur affectée à la zone correllée / champ a affecter la valeur validee
(isset($_GET['correl']) ? $champCorrel = $_GET['correl'] : $champCorrel = "");
// parametres de selection / champ de selection (clause where)
(isset($_GET['correl2']) ? $champCorrel2 = $_GET['correl2'] : $champCorrel2 = "");
// parametres de selection / valeur du champ de selection (clause where)
(isset($_GET['zcorrel2']) ? $zoneCorrel2 = $_GET['zcorrel2'] : $zoneCorrel2 = "");
//
(isset($_GET['form']) ? $form = $_GET['form'] : $form = "f1");

// parametrage de $sql = requete de recherche specifique
// $longueurRecherche  = longueur autorise en recherche
// $debut = rrecherche au debut de zone ou compris dans la zone
include "../dyn/comboparametre.inc.php";

if ($DEBUG == 1) {
    echo "champOrigine =>".$champOrigine."<br />";
    echo "recherche =>".$recherche."<br />";
    echo "table =>".$table."<br />";
    echo "zoneOrigine =>".$zoneOrigine."<br />";
    echo "zoneCorrel =>".$zoneCorrel."<br />";
    echo "champCorrel =>".$champCorrel."<br />";
    echo "zoneCorrel2 =>".$zoneCorrel2."<br />";
    echo "champCorrel2 =>".$champCorrel2."<br />";
}

/**
 *
 */
//
echo "<form name=\"f3\" method=\"post\" action=\"../spg/combo.php\">";
//
if (strlen($recherche) > $longueurRecherche) {  
    /**
     * Construction de la requete
     */
    //
    if ($sql == "") {
        if ($debut == 0) {
            $sql = "select * from ".$table." where ".$zoneOrigine." like '%".$recherche."%'";
        } else {
            $sql = "select * from ".$table." where ".$zoneOrigine." like '".$recherche."%'";
        }
    }
    // 
    if ($zoneCorrel2 != "") {
        $sql .= " and ".$champCorrel2." like '".$zoneCorrel2."'";
    }
    //
    if ($DEBUG == 1) {
        echo $sql;
    }
    
    /**
     * Execution de la requete
     */
    //
    $res = $f->db->query($sql);
    $f->isDatabaseError($res);
    //
    $nbligne = $res->numrows();
    //
    switch($nbligne) {
        case 0 : 
            //
            $message = _("Votre saisie ne donne aucune correspondance");
            $f->displayMessage("error", $message);
            //
            break;
        case 1 :
            //
            while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
                // dans la zone correllee
                $x = $row[$zoneCorrel];
                // dans la zone d'origine
                $y = $row[$zoneOrigine];
                // parametrage des retour dans les champs $x et $y
                include "../dyn/comboretour.inc.php";
            }
            // Envoi des donnees dans le formulaire de la fenetre parent
            echo "\n<script type=\"text/javascript\">\n";
            echo "opener.document.".$form.".".$champCorrel.".value = \"".$x."\";\n";
            echo "opener.document.".$form.".".$champOrigine.".value = \"".$y."\";\n";
            if($champCorrel2!='')
              echo "opener.document.".$form.".".$champCorrel2.".value = \"".$z."\";\n";
            echo "this.close();\n";
            echo "</script>\n";
            //
            break;
        default :
            //
            echo "\n<div class=\"instructions\">\n";
            echo "<p>\n";
            echo _("Selectionner dans la liste ci-dessous la correspondance avec ".
                   "votre recherche")." ".$champOrigine.". ";
            echo _("Puis valider votre choix en cliquant sur le bouton : \"Valider\".");
            echo "</p>\n";
            echo "</div>\n";
            //
            echo "<select size=\"1\" name=\"".$champOrigine."\" class=\"champFormulaire\">\n";
            while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
                // dans la zone correllee
                $x = $row[$zoneCorrel];
                // dans la zone d'origine
                $y = $row[$zoneOrigine];
                // affichage
                $aff = $row[$zoneCorrel]." - ".$row[$zoneOrigine];
                // defintion du retour  unique d apres la table select = $retourUnique
                // definition affichage en table = $aff
                include "../dyn/comboaffichage.inc.php";
                //
                $opt = "<option value=\"".$x."£".$y."£".$z."\">";
                $opt .= $aff;
                $opt .= "</option>\n";
                //
                echo $opt;
            }
            echo "</select>\n";
            // Envoi des donnees dans le formulaire de la fenetre parent
            echo "\n<script type=\"text/javascript\">\n";
            echo "function recup()\n{\n";
            echo "var s = document.f3.".$champOrigine.".value;\n";
            echo "var x = s.split( \"£\" );\n";
            echo "opener.document.".$form.".".$champOrigine.".value = x[1];\n";
            echo "opener.document.".$form.".".$champCorrel.".value = x[0];\n";
            if($champCorrel2!='')
              echo "opener.document.".$form.".".$champCorrel2.".value = x[2];\n";
            echo "this.close();\n}\n";
            echo "</script>\n";
            //
            echo "<div class=\"formControls\">\n";
            echo "<input type=\"submit\" tabindex=\"70\" value=\""._("Valider")."\" onclick=\"javascript:recup();\" class=\"boutonFormulaire\" />\n";
            break;
    }
    
} else {
    
    //
    $message = _("Vous devez saisir une valeur d'au moins");
    $message .= " ".($longueurRecherche+1)." ";
    $message .= _("caracteres dans le champ");
    $message .= " ".$champOrigine.".";
    $f->displayMessage("error", $message);
    
}
//
if ($nbligne < 1) {
    echo "<div class=\"formControls\">\n";
}
$f->displayLinkJsCloseWindow();
echo "</div>\n";
//
echo "</form>";

/**
 *
 */
//
$f->displayEndContent();

?>
