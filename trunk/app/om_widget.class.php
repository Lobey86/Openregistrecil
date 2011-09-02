<?php
/**
 * Ce fichier permet de declarer la classe table.
 *
 * @package openmairie
 * @link http://www.openmairie.org/
 * @version SVN : $Id$
 */

/**
 *
 */
require_once PATH_OPENMAIRIE."om_table.class.php";
/**
 * Cette classe permet de 'tabler' les champs suivant une requete
 */
class widget extends table {
    
    /**
     * 
     * 
     * @param array $params
     * @param array $href
     * @param mixed $db
     * @param string $style Prefixe de la classe CSS a utiliser
     * @param boolean $onglet
     * @return void
     */
    function display($params = array(), $href = array(), $db = NULL, $class = "tab", $onglet = false) {
        
        //
        $this->db = $db;
        //
        $this->setParams($params);      
        // Construction de la requete
        $this->composeQuery();
        
        // Calcul du nombre total de resultats de la requete
        $nbligne = $db->getOne($this->sqlC);
        
        // Calcul du nombre total de resultats different si on detecte un
        // group by dans la requete
        if (preg_match("/group by/i", $this->tri) == 1) {
            $res1 = $db->query($this->sqlG);
            $nbligne = $res1->numRows();
        }
        
        // Execution de la requete a partir de l'enregistrement $premier avec 
        // la limite $this->serie 
        $res = $db->limitquery($this->sql, $this->getParam("premier"), $this->serie);
        
        // Verification d'erreur sur le resultat de la requete
        if (database::isError($res)) {
            
            // Appel de la methode de gestion des erreurs
            echo "<pre>";
            echo $res->getDebugInfo()."\n".$res->getMessage();
            echo "</pre>";
            echo "</div></div>";
            die();
            
        } else {
                      
            // Recuperation des infos sur la table
            // ( oracle: recuperation immediate  (en dynamique) )
            $info = $this->getColumnsName($res);

            // Affichage de la table
            echo "<!-- tab-tab -->\n";
            echo "<table class=\"".$class."-tab\">\n";
            
            // Affichage de la ligne d'entete du tableau
            // false car tab non dynamique (pas d'onglet)
            $this->displayHeader($href, $info, $class, $onglet);
            
            // Calcul du nombre de colonnes
            $nbchamp = count($info);
            
            // Gestion d'une classe css differente une ligne sur deux
            $odd = 0;
            
            // Affichage des lignes de tableaux
            echo "\t<!-- tab-data -->\n";
            
            // Si aucun resultat, on affiche une ligne avec un message
            // indiquant qu'il n'y a aucun enregistrement
            if ($nbligne == 0) {
                
                echo "\t<tr class=\"".$class."-data empty\">\n";
                echo "<td colspan=\"".(count($href)+$nbchamp)."\">";
                echo _("Aucun enregistrement.");
                echo "</td>";
                echo "\t</tr>\n";
                
            }
            
            //$countHrefColumns = $this->countHrefColumns($href);
            
            // Boucle sur les resultats de la requete
            while ($row =& $res->fetchRow()) {
                // Gestion des options
                $option_style = "";
                $option_href = false;
                foreach($this->options as $option) {
                    if ($option["type"] == "condition") {
                        foreach($option["case"] as $case) {
                            if (isset($row[$this->getKeyForColumnName($option["field"])])
                                and in_array($row[$this->getKeyForColumnName($option["field"])], $case["values"])) {
                                $option_style .= (isset($case["style"]) ? " ".$case["style"] : "");
                                if (isset($case["href"])) {
                                    $option_href = $case["href"];
                                }
                            }
                        }
                    }
                }
                
                //
                $links = $href;
                if ($option_href != false) {
                    $links = $option_href;
                }
                
                // Affichage d'une ligne de tableau
                echo "\t<tr";
                echo " class=\"";
                echo $class."-data";
                echo $option_style;
                echo " ".($odd % 2 == 0 ? "odd" : "even");
                echo "\">\n";
                
                // Gestion d'une classe css differente une ligne sur deux
                $odd += 1;
                
                //
                if ($countHrefColumns != 0) {
                    echo "\t\t<td class=\"icons\">";
                    echo "&nbsp;";
                }
                
                // Affichage des liens en debut de ligne
                foreach ($links as $key => $elem) {
                    
                    // Les liens a afficher en debut de tableau sont les
                    // valeurs href[2] a [n] donc > 1
                    if ($key > 0
                        and $links[$key]['lien'] != ""
                        and $links[$key]['lien'] != "#"
                        and $links[$key]['lib'] != "") {
                        
                        //
                        echo "<a ";
                        if ($onglet == false or $key > 2) {
                            echo "href=\"".$links[$key]['lien'].urlencode($row[0]).$links[$key]['id']."\"";
                        } else {
                            echo "href=\"";
                            echo "#";
                            echo "\" ";
                            echo " onclick=\"ajaxIt('".$this->getParam("obj")."','";
                            echo $links[$key]['lien'].urlencode($row[0]).$links[$key]['id'];
                            echo "');\"";
                        }
                        echo ">";
                        echo $links[$key]['lib'];
                        echo "</a>";
                        echo "&nbsp;";
                        
                    }
                    
                }
                
                //
                if ($countHrefColumns != 0) {
                    echo "</td>\n";
                }
                
                // Pour chaque colonne du tableau
                foreach ($row as $key => $elem) {
                    
                    // Affichage de la cellule sans lien
                    echo "\t\t<td ";
                    echo "class=\"col-".$key."";
                    if ($key == 0) {
                        echo " firstcol";
                    }
                    if ($key == count($row)-1) {
                        echo " lastcol";
                    }
                    if (is_numeric($elem)) {
                        echo " right";
                    }
                    if (preg_match("/@/", $elem)) {
                        echo " left";
                    }
                    echo "\"";
                    echo ">";
                    
                    // Affichage d'un lien mailto si on detecte un @
                    if (preg_match("/@/", $elem)) {
                        echo "<a href='mailto:".$elem."' ";
                        echo "title=\""._("Envoyer un mail a cette adresse")."\">";
                        echo "<span class=\"ui-icon ui-icon-mail-closed\"></span>";
                        echo "</a>";
                    }
                    
                    //
                    echo $elem;
                    echo "</td>\n";
                    
                }
                    
                
                
                // Fermeture de la balise ligne de tableau
                echo "\t</tr>\n";
                
            }
            
            // Fermeture de la balise table
            echo "</table>\n";
            
            // Libere le resultat de la requete
            $res->free();
            
        }
        
        
    }
    
    /**
     *
     *
     * @param array $href
     * @param array $info
     * @param string $style Prefixe de la classe CSS a utiliser
     * @param boolean $onglet
     * @return void
     */
    function displayHeader($href, $info, $class = "tab", $onglet = false) {
        
        //
        echo "\t<!-- tab-head -->\n";     
        // Ouverture de la ligne
        echo "\t<tr class=\"ui-tabs-nav ui-accordion ui-state-default ".$class."-title\">\n";       
        // Ouverture de la 1ERE cellule

        // Nom des champs en entete de colonne
        foreach ($info as $key => $elem) {
            echo "\t\t<th class=\"title\">";
            echo ucwords($elem['name']);
            echo "</th>\n";           
        }
        echo "\t</tr>\n";
        
    }
}

?>