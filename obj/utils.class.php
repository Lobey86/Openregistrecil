<?php
/**
 * 
 *
 * @package openmairie_exemple
 * @version SVN : $Id: utils.class.php 383 2011-02-18 10:37:06Z fmichon $
 */

/**
 *
 */
require_once "../dyn/locales.inc.php";

/**
 *
 */
require_once "../dyn/include.inc.php";

/**
 *
 */
require_once "../dyn/debug.inc.php";

/**
 *
 */
(defined("PATH_OPENMAIRIE") ? "" : define("PATH_OPENMAIRIE", ""));

/**
 *
 */
require_once PATH_OPENMAIRIE."om_application.class.php";

/**
 *
 */
class utils extends application {
    
    var $schema; //***
    
    
    /**
     * Cette methode permet de charger les differents fichiers de configs dans
     * des attributs de la classe
     * 
     * @return void
     */
    function setParamsFromFiles() {
        
        //
        if (file_exists("../dyn/config.inc.php")) {
            include_once("../dyn/config.inc.php");
        }
        if (isset($config)) {
            $this->config = $config;
        }
        
        //
        if (file_exists("../dyn/database.inc.php")) {
            include_once("../dyn/database.inc.php");
        }
        
        if (isset($conn)) {
            $this->conn = $conn;
            //
            foreach($this->conn as $key => $conn) {
                $this->database[$key] = array(
                    'title' => $conn[0],
                    'phptype' => $conn[1],
                    'dbsyntax' => $conn[2],
                    'username' => $conn[3],
                    'password' => $conn[4],
                    'protocol' => $conn[5],
                    'hostspec' => $conn[6],
                    'port' => $conn[7],
                    'socket' => $conn[8],
                    'database' => $conn[9],
                    'formatdate' => $conn[10],
                    'schema' => $conn[11], //****
                    'prefixe' => $conn[12], //****
                );
            }
        }
        
        //
        if (file_exists("../dyn/menu.inc.php")) {
            include_once("../dyn/menu.inc.php");
        }
        if (isset($menu)) {
            $this->menu = $menu;
        }
        
        //
        if (file_exists("../dyn/actions.inc.php")) {
            include_once("../dyn/actions.inc.php");
        }
        if (isset($actions)) {
            $this->actions = $actions;
        }
        
        //
        if (file_exists("../dyn/shortlinks.inc.php")) {
            include_once("../dyn/shortlinks.inc.php");
        }
        if (isset($shortlinks)) {
            $this->shortlinks = $shortlinks;
        }
        
        //
        if (file_exists("../dyn/footer.inc.php")) {
            include_once("../dyn/footer.inc.php");
        }
        if (isset($footer)) {
            $this->footer = $footer;
        }
        
        //
        if (file_exists("../dyn/version.inc.php")) {
            include_once("../dyn/version.inc.php");
        }
        if (isset($version)) {
            $this->version = $version;
        }
        
    }
    
    /**
     * Cette methode permet de parametrer les valeurs par defaut pour les
     * fichiers css et javascript a appeler sur toutes les pages
     * 
     * @return void
     */
    function setDefaultValues() {

        $js = array(
            "../js/iepngfix_tilebg.js",
            "../lib/jquery-ui/js/jquery-1.4.4.min.js",
            "../lib/jquery-ui/js/jquery.ui.datepicker-fr.js",
            "../lib/jquery-ui/js/jquery-ui-1.8.9.custom.min.js",
            "../lib/jquery-misc/jquery.collapsible-v.2.1.3.js",
            "../js/script.js",
        );
        $this->setHTMLHeadJs($js);
       

        $css = array(
            "../css/main.css",
            "../lib/jquery-ui/css/".$this->config['theme']."/jquery-ui-1.8.9.custom.css",
            "../css/specific.css",
        );
        if (file_exists("../css/specific_".$this->config['theme'].".css")) {
            array_push($css, "../css/specific_".$this->config['theme'].".css");
        }
        $this->setHTMLHeadCss($css);
        
        $extras = "\t<link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"../css/print.css\" />\n";
        $this->setHTMLHeadExtras($extras);
    // $this->setStyleForHeader("ui-widget-header ui-state-active"); // essai jquery
        
    }
    
    /**
     * Cette methode permet d'affecter des parametres dans un attribut de
     * l'objet. 
     * 
     * @return void
     */
    function setMoreParams() {
        
        //
        if (file_exists("../dyn/var.inc")) {
            include_once("../dyn/var.inc");
        }
        
        //
        if (isset($chemin_plan)) {
            $this->config['chemin_plan'] = $chemin_plan;
        } else {
            $this->config['chemin_plan'] = "../trs/";
        }
        
    }
    

} //fin class
?>