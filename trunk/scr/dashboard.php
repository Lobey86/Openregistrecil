<?php
/**
 *
 *
 * @package openmairie_exemple
 * @version SVN : $Id: dashboard.php 42 2010-08-26 06:44:41Z fmichon $
 */

require_once "../obj/utils.class.php";
$f = new utils(NULL, NULL, _("Tableau de bord"));

/**
 *
 */
if (file_exists("../dyn/var.inc")) {
    include("../dyn/var.inc");
}

/**
 *
 */
//
(isset($_GET['premier']) ? $premier = $_GET['premier'] : $premier = 0);
//
if (isset($_POST['recherche'])) {
    $recherche = $_POST['recherche'];
    if (get_magic_quotes_gpc()) {
        $recherche1 = StripSlashes($recherche);
    } else {
        $recherche1 = $recherche;
    }
} else {
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
}

/**
 *
 */
if (file_exists("../dyn/tdb.inc")) {
    include("../dyn/tdb.inc");
}

?>