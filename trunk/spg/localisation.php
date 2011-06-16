<?php
/**
 *
 *
 * @package openmairie_exemple
 * @version SVN : $Id: localisation.php 278 2010-11-30 07:12:41Z fmichon $
 */

require_once "../obj/utils.class.php";
$f = new utils("nohtml");

/**
 * Initialisation des parametres
 */
//
(isset($_GET['plan']) ? $plan = $_GET['plan'] : $plan = "");
//
(isset($_GET['positionx']) ? $positionx = $_GET['positionx'] : $positionx = "");
//
(isset($_GET['positiony']) ? $positiony = $_GET['positiony'] : $positiony = ""); 
//
(isset($_GET['x']) ? $x = $_GET['x'] : $x = 0);
//
(isset($_GET['y']) ? $y = $_GET['y'] : $y = 0);
//
(isset($_GET['form']) ? $form = $_GET['form'] : $form = 'f1');

/**
 *
 */
$path = $f->getPathFolderTrs();

/**
 * Verification des parametres
 */
if (strpos($plan, "/") !== false
    or $plan == ""
    or $positionx == ""
    or $positiony == ""
    or !file_exists($path.$plan)) {
    $class = "error";
    $message = _("L'objet est invalide.");
    $f->addToMessage($class, $message);
    $f->setFlag(NULL);
    $f->display();
    die();
}


/**
 * Affichage de la structure HTML
 */
//
$f->addHTMLHeadJs("../js/localisation.js");
$f->setHTMLBody("<body id=\"localisation\" onload=\"init()\">\n");
$f->setFlag("htmlonly");
$f->display();

/**
 *
 */
$objetplan = "<img name=\"CA\" src=\"../img/zoneobligatoire.gif\" />";

/**
 *
 */
//
echo "<div style=\"position:absolute;left:0px;top:0px\">\n";
//
echo "\n<img src=\"".$path.$plan."\" />\n";
//
$f->displayLinkJsCloseWindow();
//
echo "\n</div>\n";
// form f1 et f2
echo "\n<div id=\"camap\" ";
echo "style=\"position:absolute;left:".$x."px;top:".$y."px;width:1px\" ";
echo "ondblclick=\"sauve".$form."('".$positionx."', '".$positiony."');\">\n";
echo "\n";
echo $objetplan;
echo "\n";
echo "\n</div>\n";
?>