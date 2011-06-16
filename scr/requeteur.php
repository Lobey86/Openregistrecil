<?php
/**
 *
 *
 * @package openmairie_exemple
 * @version SVN : $Id: requeteur.php 315 2010-12-06 12:13:51Z fmichon $
 */

require_once "../obj/utils.class.php";
$f = new utils("nohtml", "reqmo");

/**
 *
 */
// Nom de l'objet metier
(isset($_GET['obj']) ? $obj = $_GET['obj'] : $obj = "");

/**
 * 
 * Requêteur
 * principe de REQMO (requete memorisée):
 * permet de faire des requetes memorisees
 * la requete est parametree en sql/typedebase/langue/obj.reqmo.inc
 * $reqmo['sql'] = requete parametrable
 * les parametres sont entre crochets
 * type de parametre  = $reqmo['parametre']
 *  checked : case à cocher pour que la zone soit prise en compte
 *  liste : liste de valeur proposé pour parametrer une selection ou un tri
 *  select : liste de valeur proposé pour parametrer une selection ou un tri d apres une requete dans une table
 * $reqmo['libelle'] = libelle de la requete
 * $reqmo['separateur'] = separateur pour fichier csv
 */
 
/**
 * Fichiers requis
 */
    if (file_exists ("../dyn/var.inc"))
        include ("../dyn/var.inc");

/**
 * Paramètres
 */
    set_time_limit(180);
    $DEBUG=0;
    $aff = "requeteur";
    $validation = 0;
    if (isset ($_GET['validation']))
        $validation = $_GET['validation'];
    $idx = "";
    if (isset($_GET['idx']))
        $idx = $_GET['idx'];
    $ent = "reqmo"."->".$obj;
    $ico = "ico_aide.png";
//
$f->setTitle(_("Requetes memorisees")." -> ".$obj);
$f->setFlag(NULL);
$f->display();

         if (file_exists ("../sql/".$f -> phptype."/".$obj.".reqmo.inc"))
           include ("../sql/".$f -> phptype."/".$obj.".reqmo.inc");
    
    if (isset ($_GET ['step']))
        $step = $_GET ['step'];
    else
        $step = 0;
            

/**
 * Ouverture du conteneur de la page
 */
//
echo "\n<div id=\"generator-generate\">\n";
//
echo "<div id=\"formulaire\">\n\n";
//
echo "<ul>\n";
if (isset($reqmo["reqmo_libelle"])) {
    echo "\t<li><a href=\"#tabs-1\">"._("Recherche")." "._($reqmo["reqmo_libelle"])."</a></li>\n";
} elseif (isset($reqmo["libelle"])) {
    echo "\t<li><a href=\"#tabs-1\">"._("Recherche")." "._($reqmo["libelle"])."</a></li>\n";
} else {
    echo "\t<li><a href=\"#tabs-1\">"._("Recherche")." "._($obj)."</a></li>\n";
}
echo "</ul>\n";
//
echo "\n<div id=\"tabs-1\">\n";

/**
 *
 */
if ($step == 0) {
    
    //
    $validation = 1;
    $cptemp = 0;
    $cpts=0;
    $cptsel=0;
    
    /**
     * Ouverture du formulaire
     */
    // Ouverture de la balise formulaire
    echo "<form method=\"post\" action=\"requeteur.php?obj=".$obj."&amp;step=1\" name=\"f1\">\n";
    // Ouverture de la balise table
    echo "<table cellpadding=\"0\" class=\"formEntete ui-corner-all\">\n";
    //
    echo "<tr><td colspan=\"2\">";
    //
    echo "<fieldset class=\"cadre ui-corner-all ui-widget-content\">\n";
    //
    echo "\t<legend class=\"ui-corner-all ui-widget-content ui-state-active\">";
    echo _("Criteres de la requete");
    echo "</legend>\n";
    //
    echo "<table>";
    //
    echo "<tr>";
    // On separe tous les champs entre crochets dans la requête
    $temp = explode ("[", $reqmo ["sql"]);
    //
    for ($i = 1; $i < sizeof($temp); $i++) {
        // On vire le crochet de la fin
        $temp1 = explode("]", $temp[$i]);
        // On check si alias
        $temp4 = explode (" as ", $temp1[0]);
        if (isset($temp4[1])) {
            $temp1[0] = $temp4[1];
        }
        //
        $temp6 = $temp1[0];
        if (!isset($reqmo[$temp1[0]])) {
            // saisie criteres where
            //
            if ($cpts == 0) {
                echo "<tr>\n";
            } elseif ($cpts == 4) {
                echo "</tr>\n<tr>\n";
                $cpts = 0;
            }
            //
            echo "\t<td class=\"tri\">";
            echo "&nbsp;"._($temp6)."&nbsp;<input type=\"text\" name=\"".$temp1[0]."\" value=\"\" size=\"30\" class=\"champFormulaire\" />";
            echo "</td>\n";
            //
            $cpts++;
        } else {
            //
            if ($reqmo[$temp1[0]] == "checked") {
                //
                if ($cptemp == 0) {
                    echo "<tr>\n";
                    echo "\t<td colspan=\"4\"><b>";
                    echo _("Choix des champs a afficher");
                    echo "</b></td>\n";
                    echo "</tr>\n";
                } elseif ($cptemp == 4) {
                    echo "</tr>\n<tr>\n";
                    $cptemp = 0;
                }
                //
                echo "\t<td class='champs'>";
                echo "<input type=\"checkbox\" value=\"Oui\" name=\"".$temp1[0]."\" size=\"40\" class=\"champFormulaire\" checked=\"checked\" />";
                echo "&nbsp;&nbsp;"._($temp6)."&nbsp;";
                echo "</td>\n";
                //
                $cptemp++;
            } else {
                //
                $temp3 = "";
                $temp3 = $reqmo[$temp1[0]];
                if(!is_array($temp3)) {
                    $temp3 = substr($temp3, 0, 6);
                }
                //
                if ($temp3 == "select") {
                    //
                    if ($cptsel == 0) {
                        echo "<tr>\n";
                        echo "\t<td colspan=\"4\"><b>";
                        echo _("Choix des criteres de tri");
                        echo "</b></td>\n";
                        echo "</tr>\n";
                    } elseif ($cptsel == 4) {
                        echo "</tr>\n<tr>\n";
                        $cptsel = 0;
                    }
                    //
                    echo "\t<td class=\"tri\">";
                    echo _($temp6)."&nbsp;";
                    echo "<select name=\"".$temp1[0]."\" class=\"champFormulaire\">";
                    $res1 = $f->db->query($reqmo[$temp1[0]]);
                    $f->isDatabaseError($res);
                    while ($row1 =& $res1->fetchRow()) {
                        echo "<option value=\"".$row1[0]."\">".$row1[1]."</option>";
                    }
                    echo "</select>";
                    echo "</td>\n";
                    //
                    $cptsel++;
                } else {
                    //
                    if ($cptsel == 0) {
                        echo "<tr>\n";
                        echo "\t<td colspan=\"4\"><b>";
                        echo _("Choix des criteres de tri");
                        echo "</b></td>\n";
                        echo "</tr>\n";
                    }  elseif ($cptsel == 4) {
                        echo "</tr>\n<tr>\n";
                        $cptsel = 0;
                    }
                    //
                    echo "\t<td class=\"tri\">";
                    echo _($temp6)."&nbsp;";
                    echo "<select name=\"".$temp1[0]."\" class=\"champFormulaire\">";
                    foreach ($reqmo [$temp1 [0]] as $elem) {
                        echo "<option>".$elem."</option>";
                    }
                    echo "</select>";
                    echo "</td>\n";
                    //
                    $cptsel++;
                }
            }
        }
        // re initialisation
        $temp1[0] = "";
    }
    echo "</tr>";
    echo "</table>";
    //
    echo "</fieldset>\n";
    //
    echo "</td></tr>\n";
    //
    echo "<tr><td colspan=\"2\">";
    //
    echo "<fieldset class=\"cadre ui-corner-all ui-widget-content\">\n";
    //
    echo "\t<legend class=\"ui-corner-all ui-widget-content ui-state-active\">";
    echo _("Parametres de sortie");
    echo "</legend>\n";
    //
    echo "<table>";
    //
    echo "<tr>";
    //
    echo "<td class=\"params\">"._("Choix du format de sortie")."&nbsp;";
    echo "<select name=\"sortie\" class=\"champFormulaire\">";
    echo "<option value=\"tableau\">"._("Tableau - Affichage a l'ecran")."</option>";
    echo "<option value=\"csv\">"._("CSV - Export vers logiciel tableur")."</option>";
    echo "</select>";
    echo "</td>";
    //
    echo "</tr>";
    echo "<tr>";
    //
    echo "<td class=\"params\">"._("Separateur de champs (pour le format CSV)")."&nbsp;";
    echo "<select name=\"separateur\" class=\"champFormulaire\">";
    echo "<option>;</option>";
    echo "<option>|</option>";
    echo "<option>,</option>";
    echo "</select>";
    echo "</td>";
    //
    echo "</tr>";
    echo "<tr>";
    //
    echo "<td class=\"params\" >"._("Nombre limite d'enregistrements a afficher (pour le format Tableau)")."&nbsp;";
    echo "<input type=\"text\" name=\"limite\" value=\"100\" size=\"5\" class=\"champFormulaire\" />";
    echo "</td>";
    echo "</tr>";
    echo "</table>";
    //
    echo "</fieldset>\n";
    //
    echo "</td></tr>\n";
    // Fermeture de la balise table
    echo "</table>\n";
    // Affichage des actions de controles du formulaire
    echo "<div class=\"formControls\">";
    // Bouton de validation du formulaire
    echo "<input type=\"submit\" name=\"valid.reqmo\" value=\""._("Executer la requete memorisee sur :")." '".$obj."'\" />";
    // Lien retour
    echo "<a href=\"reqmo.php\" class=\"retour\">";
    echo _("Retour");
    echo "</a>";
    // Fermeture du conteneur des actions de controles du formulaire
    echo "</div>";
    // Fermeture de la balise formulaire
    echo "\n</form>\n";

} else { // On affiche le csv ou le tableau
        $temp = explode ("[",$reqmo["sql"]);
        for($i = 1; $i < sizeof ($temp); $i++)
        {
            $temp1 = explode ("]", $temp [$i]);
            $temp4 = explode (" as ", $temp1 [0]);
            if (isset ($temp4 [1]))
                $temp5 = $temp4 [1]; // uniquement as
            else
                $temp5 = $temp1 [0]; // en entier
            if (isset ($_POST [$temp5]))
                $temp2 = $_POST [$temp5];
            else
                $temp2 = "";
       // ****
       if(isset($reqmo[$temp5])){
            if($reqmo[$temp5]=="checked")
            {
                if ($temp2 == 'Oui')
                {
                    $reqmo ['sql'] = str_replace ("[".$temp1[0]."]",$temp1[0],$reqmo['sql']);
                }
                else
                {
                    $reqmo['sql']=str_replace("[".$temp1[0]."],",'',$reqmo['sql']);
                    $reqmo['sql']=str_replace(",[".$temp1[0]."]",'',$reqmo['sql']);
                    $reqmo['sql']=str_replace(", [".$temp1[0]."]",'',$reqmo['sql']);
                    $reqmo['sql']=str_replace("[".$temp1[0]."]",'',$reqmo['sql']);
                }
            }
            else
            {
                $reqmo['sql']=str_replace("[".$temp1[0]."]",$temp2,$reqmo['sql']);
            }
        //****
        }else
        {
           $reqmo['sql']=str_replace("[".$temp1[0]."]",$temp2,$reqmo['sql']);
        }//****
            $temp1[0]="";
        }

        $blanc = 0;
        $temp = "";
        for($i=0;$i<strlen($reqmo['sql']);$i++)
        {
            if (substr($reqmo['sql'],$i,1)==chr(13) or substr($reqmo['sql'],$i,1)==chr(10) or substr($reqmo['sql'],$i,1)==chr(32))
            {
                if ($blanc==0)
                    $temp=$temp.chr(32);
                $blanc=1;
            }
            else
            {
                $temp=$temp.substr($reqmo['sql'],$i,1);
                $blanc=0;
            }
        }
        $reqmo['sql']=$temp ;
        $reqmo['sql']=str_replace(',,',',',$reqmo['sql']);
        $reqmo['sql']=str_replace(', ,',',',$reqmo['sql']);
        $reqmo['sql']=str_replace(', from',' from',$reqmo['sql']);
        $reqmo['sql']=str_replace('select ,','select ',$reqmo['sql']);
        // post limite
        if (isset($_POST['limite']))
            $limite = $_POST['limite'];
        else
            $limite = 100;
        // post  sortie
        if (isset ($_POST['sortie']))
            $sortie= $_POST['sortie'];
        else
            $sortie ='tableau';
        // post  separateur de champ (csv)
        if (isset ($_POST['separateur']))
            $separateur= $_POST['separateur'];
        else
            $separateur =';';
        // limite uniquement pour tableau
        if ($sortie =='tableau')
            $reqmo['sql']= $reqmo['sql']." limit ".$limite;
        // execution de la requete
        $res = $f -> db -> query ($reqmo['sql']);
        $f->isDatabaseError($res);
        
            $info = $res -> tableInfo ();
            if ($sortie =='tableau') {
                //
                echo "<table class=\"tab-tab\">\n";
                //
                echo "<tr class=\"ui-tabs-nav ui-accordion ui-state-default tab-title\">";
                foreach($info as $elem) {
                    echo "\t<th class=\"title\"><center>"._($elem['name'])."</center></th>\n";
                }
                echo "</tr>\n";
                //
                $cptenr = 0;
                while ($row=& $res->fetchRow()) {
                    //
                    echo "<tr class=\"tab-data ".($cptenr % 2 == 0 ? "odd" : "even")."\">\n";
                    //
                    $cptenr = $cptenr + 1;
                    $i = 0;
                    foreach ($row as $elem) {
                        if (is_numeric($elem))
                            echo "<td   class='resultrequete' align='right'>";
                        else
                            echo "<td  class='resultrequete'>";
                        $tmp="";
                        $tmp=str_replace(chr(13).chr(10),'<br>', $elem);
                        echo $tmp."</td>";
                        $i++;
                    }
                    echo "</tr>\n";
                }
                //
                echo "</table>\n";
                if ($cptenr==0){
                    echo "<br>"._('aucun')."&nbsp;"._('enregistrement')."<br>";
                }
            }
            else
            {
                $inf="";
                foreach ($info as $elem)
                {
                    //echo $elem['name'].$separateur;
                    $inf=$inf.$elem['name'].$separateur;
                }
                //echo "<br />";
                $inf .= "\n";
                 $cptenr=0;
                while ($row=& $res->fetchRow())
                {
                     $cptenr=$cptenr+1;
                    $i=0;
                    foreach($row as $elem)
                    {
                        //echo $elem.$separateur;
                        //****
                        $tmp="";
                        $tmp=str_replace(chr(13).chr(10),' / ', $elem);
                        $tmp=str_replace(';',' ', $tmp);
                        //*****
                        $inf .= $tmp.$separateur;
                        $i++;
                    }
                    //echo "<br />";
                    $inf .= "\n";
                }
                if ($cptenr==0){
                    $inf .="\n"._('aucun')."&nbsp;"._('enregistrement')."\n";
                }
                $nom_fichier="export_".$obj.".csv";
                $fic = fopen ("../tmp/".$nom_fichier,"w");
                fwrite ($fic, $inf);
                fclose ($fic);
//                $msg = _("voir")."&nbsp;"._("resultat")."&nbsp;"._("recherche")." : ";
//                $msg .= "<a href=\"javascript:traces('".$nom_fichier."');\"><img src=\"../img/voir.png\" style='vertical-align:middle' alt=\""._("voir")."&nbsp;".$nom_fichier."\" title=\""._("voir")."&nbsp;".$nom_fichier."\" /></a><br />";
//                $msg .= _("resultat")."&nbsp;/tmp/".$nom_fichier.".<br />";
//                echo $msg;

                // modification du 25 aout pour acces enregistrement sur clic
                $msg = _("msg1");
                $msg .= "<a href=\"javascript:traces('".$nom_fichier."');\"><img src=\"../img/voir.png\" hspace='5' alt=\"Fichier export\" title=\"Fichier export\" /></a><br />";
                $msg .= _("msg2")."\"".$nom_fichier."\".<br />";
                echo $msg;
            }

        // Affichage des actions de controles du formulaire
        echo "<div class=\"formControls\">";
        // Lien retour
        echo "<a href=\"../scr/requeteur.php?obj=".$obj."&amp;step=0\" class=\"retour\">";
        echo _("Retour");
        echo "</a>";
        // Fermeture du conteneur des actions de controles du formulaire
        echo "</div>";
    }

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