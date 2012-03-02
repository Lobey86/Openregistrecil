<?php
/**
 * Ce fichier permet le parametrage de la connexion a labase de donnees,
 * chaque entree du tableau correspond a une base differente. Attention
 * l'index du tableau conn represente l'identifiant du dossier dans lequel
 * seront stockes les fichiers propres a cette base dans l'application
 * 
 * @package openmairie_exemple
 * @version SVN : $Id: database.inc.php 416 2011-05-16 15:12:38Z fraynaud $
 */

// MySQL
$conn[1] = array(
    "Openmairie Exemple MySQL",
    "mysql",
    "",
    "root",
    "root",
    "",
    "localhost",
    "",
    "",
    "openregistrecil",
    "AAAA-MM-JJ",
    "",
    ""
);

?>
