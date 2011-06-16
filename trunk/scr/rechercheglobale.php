<?php
/**
 *
 *
 * @package openmairie_exemple
 * @version SVN : $Id: rechercheglobale.php 28 2010-08-23 08:44:33Z fmichon $
 */

require_once "../obj/utils.class.php";
$f = new utils(NULL, NULL, _("Recherche globale"));
 
/**
 * Fichiers requis
 */
    if (file_exists ("../dyn/var.inc"))
        include ("../dyn/var.inc");

/**
 * Chaine recherchee
 * @var string
 */
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
 * Premier enregistrement a afficher
 * @var integer
 */
if (isset($_GET['premier'])) {
    $premier = $_GET['premier'];
} else {
    $premier = 0;
}

/**
 *
 */
if (file_exists("../dyn/recherche.inc")) {
    //
    echo "<div class='db'>";
    //
    include "../dyn/recherche.inc";
    //
    $idrg = 1;
    //
    include "../scr/recherche.php";
    //
    echo "</div>";
}

?>