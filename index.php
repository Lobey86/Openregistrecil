<?php
/**
 * Ce fichier permet de faire une redirection vers la page de login de
 * l'application.
 *
 * @package openmairie_exemple
 * @version SVN : $Id: index.php 95 2010-09-06 14:15:51Z fmichon $
 */

//
$came_from = "";
if (isset($_GET['came_from'])) {
    $came_from = $_GET['came_from'];
}

//
header("Location: scr/login.php?came_from=".urlencode($came_from));

?>