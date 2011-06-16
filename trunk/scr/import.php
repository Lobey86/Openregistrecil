<?php
/**
 * Ce fichier permet de lister les fichiers de parametrages permettant de
 * realiser les imports csv de donnees dans la base de donnees
 *
 * @package openmairie_exemple
 * @version SVN : $Id: import.php 327 2010-12-06 21:07:19Z fraynaud $
 */

require_once "../obj/utils.class.php";
$f = new utils(NULL, "import_script", _("Import"), "ico_import.png",
               "import_script");

/**
 * Description de la page
 */
$description = _("Cette page vous permet d'importer des donnees au format CSV ".
                 "directement dans la base de donnees.");
$f->displayDescription($description);

/**
 *
 */
//
set_time_limit(3600);
//
if (isset($_POST['choice-import']) and $_POST['choice-import'] != "---") {
    $obj = $_POST['choice-import'];
} elseif(isset($_GET['obj'])) {
    $obj = $_GET['obj'];
} else {
    $obj = "";    
}
//
if ($obj != "") {
    if (file_exists("../sql/".$f->phptype."/".$obj.".import.inc")) {
        include("../sql/".$f->phptype."/".$obj.".import.inc");
    } else {
        //
        $class = "error";
        $message = _("L'objet est invalide.");
        $f->displayMessage($class, $message);
        //
        $obj = "";
    }
}
//
if (isset($_POST['submit-csv-import']) and $_POST['fic1'] == "") {
    //
    $class = "error";
    $message = _("Vous n'avez pas selectionne de fichier a importer.");
    $f->displayMessage($class, $message);
}

/**
 * On liste les tables dans lesquelles l'import est possible
 */
$dir = getcwd();
$dir = substr($dir, 0, strlen($dir) - 4)."/sql/".$f->phptype."/";
$dossier = opendir($dir);
$tab = array();
while ($entree = readdir($dossier)) {
    if (strstr($entree, "import")) {
        array_push($tab, array('file' => substr($entree, 0, strlen($entree) - 11)));
    }
}
closedir($dossier);
asort($tab);

/**
 * Formulaire de choix de la table dans laquelle realiser l'import
 */
//
echo "\n<div id=\"form-choice-import\" class=\"formulaire\">\n";
echo "<form action=\"../scr/import.php\" method=\"post\">\n";
//
echo "<fieldset class=\"cadre ui-corner-all ui-widget-content\">\n";
//
echo "\t<legend class=\"ui-corner-all ui-widget-content ui-state-active\">";
echo _("Choix de la table d'import :");
echo "</legend>\n";
//
echo "\t<div class=\"field\">";
echo "<label>"._("Table")."</label>";
echo "<select onchange=\"submit()\" name=\"choice-import\" class=\"champFormulaire\">";
echo "<option>---</option>";
foreach ($tab as $elem) {
    echo "<option value=\"".$elem['file']."\"";
    if ($obj == $elem['file']) {
        echo " selected=\"selected\" ";
    }
    echo ">".$elem['file']."</option>";
}
echo "</select>";
echo "</div>\n";
//
echo "</fieldset>\n";
echo "</form>\n";
echo "</div>\n";

/**
 * Formulaire d'import du fichier CSV
 */
if ($obj != "") {
    //
    echo "\n<div id=\"form-csv-import\" class=\"formulaire\">\n";
    echo "<form action=\"../scr/import.php?obj=".$obj."\" method=\"post\" name=\"f1\">\n";
    //
    echo "<fieldset class=\"cadre ui-corner-all ui-widget-content\">\n";
    //
    echo "\t<legend class=\"ui-corner-all ui-widget-content ui-state-active\">";
    echo _("Import du fichier CSV :");
    echo "</legend>\n";
    //
    echo "\t<div class=\"field\">";
    echo "<label>"._("Fichier")."</label>";
    echo "<input type=\"text\" name=\"fic1\"  size=\"30\" class=\"champFormulaire\" />";
    echo "<a href=\"javascript:vupload('fic1');\"><img src=\"../img/om_upload.png\" /></a>";
    echo "</div>\n";
    //
    echo "\t<div class=\"field\">";
    echo "<label>"._("Separateur")."</label>";
    echo "<select name=\"separateur\" class=\"champFormulaire\" />";
    echo "<option value=\";\">; "._("(point-virgule)")."</option>";
    echo "<option value=\",\">, "._("(virgule)")."</option>";
    echo "</select>";
    echo "</div>\n";
    //
    echo "\t<div class=\"formControls\">";
    echo "<input type=\"submit\" name=\"submit-csv-import\" value=\""._("Import")." ".$obj."\" class=\"boutonFormulaire\" />";
    echo "</div>";
    echo "</fieldset>";
    echo "</form>";
    echo "</div>\n";
}

/**
 *
 */
//
if (isset($_POST['submit-csv-import']) and $_POST['fic1'] != "") {
    // 
    if (isset ($_POST['fic1']) and file_exists("../trs/".$_SESSION['coll']."/".$_POST['fic1'])) {
        $path = "../trs/".$_SESSION['coll']."/".$_POST['fic1'];
        $fichier = fopen($path, "r");
        //
        $i = 0; // compteur
        $msg = "";
        $rejet = "";
        $cpt = 0;
        //
        $f->db->autoCommit();
        //
        while (!feof($fichier)) {
    
        $i++; // compteur
        $correct=1;
        $contenu = fgetcsv($fichier, 4096, $_POST ['separateur']);
        if(sizeof($contenu)>1 and $contenu[0]!=""){    // enregistrement vide (RC à la fin)
            //
            foreach(array_keys($zone) as $champ) {
                if ($zone[$champ]=='') {// valeur par defaut
                    $valF[$champ] = ""; // eviter le not null value
                    if (!isset($defaut[$champ])) $defaut[$champ]="";
                    $valF[$champ]= $defaut[$champ];
                } else {
                    $valF[$champ]=$contenu[$zone[$champ]];
                }
                if (!isset($obligatoire[$champ])) $obligatoire[$champ]=0;
                if ($obligatoire[$champ]==1 and $valF[$champ]==""){
                   $correct=0;
                   $msg=$msg."Enregistrement: ".$i." ".$champ." ".
                   $valF[$champ]." vide \n";
                }
                if (!isset($exist[$champ])) $exist[$champ]=0;
                if($exist[$champ]==1){  // test existence de champ
                $sql= "$sql_exist[$champ]".$valF[$champ]."'";
                  $temp1=$f->db->getOne($sql);
                  if (!isset($temp1)){
                     $correct=0;
                     $msg=$msg."Enregistrement: ".$i." ".$champ." ".$valF[$champ].
                     " inexistant \n";
                  }
               }
    
            }
            // affichage numero
            $cpt++;
            if($cpt>10){
                 echo "o";
                 $cpt=0;
            }
            // debug
            if ($DEBUG==1){ // affichage du detail du transfert
               echo "<br><b>Enregistrement ".$i."</b><br>";
               foreach(array_keys($valF) as $elem)
               echo " - ".$elem." : ".$valF[$elem]."<br>";
            }
    
            // transfert
            if($verrou==1 and $correct==1){
             if($i!=1 or $ligne1==0){ //1ere ligne *********************************
                if ($id!="")
                      $valF[$id]= $f->db->nextId($table);
              $res= $f->db->autoExecute($table,$valF,DB_AUTOQUERY_INSERT);
              $f->isDatabaseError($res);
             }}
            if ($correct==0){
               // constitution de fichier pour le rejet
               $ligne="";
               foreach($contenu as $elem){
                   $ligne=$ligne.$elem.";";
               }
               $ligne=substr($ligne,0,strlen($ligne)-1); // un ; en trop
               $rejet=$rejet.$ligne."\n";
            }
        } // enregistrement vide
        } // fin de fichier
    
        // Commit de la transaction
        $f->db->commit() ;
        
        // Fermeture du fichier
        fclose($fichier);
    
        // ecriture des fichiers en tmp
        if ($fic_erreur == 1) {
            $fichier = "import_".$obj."_".date("Ymd_Gis")."_erreur.html"; 
            $f->tmp ("../tmp/".$fichier, $msg);
            echo "<a href=\"javascript:traces('".$fichier."');\">Fichier erreur <img src='../img/voir.png' border='0'></a>";
        }
        if ($fic_rejet == 1) {
            $fichier = "import_".$obj."_".date("Ymd_Gis")."_rejet.txt";
            $rejet=substr($rejet,0,strlen($rejet)-1); // un \n en trop
            $f->tmp ("../tmp/".$fichier, $rejet, false);   
            echo "<a href=\"javascript:traces('".$fichier."');\">Fichier rejet <img src='../img/voir.png' border='0'></a>";
        }
    }else
        echo "../trs/".$_SESSION['coll']."/".$_POST['fic1']._('inexistant');
}

?>