<?php
/**
 *
 *
 * @package openmairie_exemple
 * @version SVN : $Id: sousform.php 263 2010-11-29 09:24:11Z fmichon $
 */

require_once "../obj/utils.class.php";
$f = new utils("nohtml");

/**
 * Definition du charset de la page
 */
header("Content-type: text/html; charset=".CHARSET."");

//
$f->displayScriptJsCall("../js/script.js");

/**
 * Initialisation des variables
 */
// Nom de l'objet metier du formulaire
(isset($_GET['obj']) ? $obj = $_GET['obj'] : $obj = "");
// Identifiant de l'objet du formulaire et mode d'ajout
if (isset($_GET['idx']) and $_GET['idx'] != "") {
    $idx = $_GET['idx'];
    (isset($_GET['ids']) ? $maj = 2 : $maj = 1);
} else {
    $maj = 0;
    $idx = "]";
}
// Flag de validation du formulaire
(isset($_GET['validation']) ? $validation = $_GET['validation'] : $validation = 0);
// Premier enregistrement a afficher sur le tableau de la page precedente (soustab.php?premier=)
(isset($_GET['premiersf']) ? $premiersf = $_GET['premiersf'] : $premiersf = 0);
// Colonne choisie pour le tri sur le tableau de la page precedente (soustab.php?tricol=)
(isset($_GET['trisf']) ? $tricolsf = $_GET['trisf'] : $tricolsf = "");
// Objet du formulaire parent (form.php?obj=)
(isset($_GET['retourformulaire']) ? $retourformulaire = $_GET['retourformulaire'] : $retourformulaire = 0);
// Identifiant de l'objet du formulaire parent (form.php?idx=)
(isset($_GET['idxformulaire']) ? $idxformulaire = $_GET['idxformulaire'] : $idxformulaire = "");
// ???
$typeformulaire = "";

/**
 * Verification des parametres
 */
if (strpos($obj, "/") !== false
    or !file_exists("../sql/".$f->phptype."/".$obj.".inc")) {
    $class = "error";
    $message = _("L'objet est invalide.");
    $f->displayMessage($class, $message);
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
$f->displaySubTitle($ent);

/**
 *
 */
//
echo "\n<div id=\"sformulaire\">\n";
//
require_once "../obj/".$obj.".class.php";
//
$enr = new $obj($idx, $f->db, 0);
//
$validation++;
//
$decodedPost = array();
foreach ($_POST as $key => $value) {
    $decodedPost[$key] = utf8_decode($value);
}
$enr->sousformulaire("", $validation, $maj, $f->db, $decodedPost, $premiersf,
                     0, $idx, $idxformulaire, $retourformulaire,
                     $typeformulaire, $obj, $tricolsf);
//
echo "</div>";

?>