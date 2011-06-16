<?php
/**
 * Ce fichier permet de configurer les liens presents dans la barre de
 * raccourcis presente en dessous des actions
 *
 * @package openmairie_exemple
 * @version SVN : $Id: shortlinks.inc.php 102 2010-09-13 08:42:59Z fmichon $
 */

/**
 * $shortlinks est le tableau associatif qui contient tous les liens presents
 * dans les raccourcis en dessous des actions
 *
 * Caracteristiques :
 * --- tableau link
 *     - title [obligatoire]
 *     - description (texte qui s'affiche au survol de l'element)
 *     - href [obligatoire] (contenu du lien href)
 *     - class (classe css qui s'affiche sur l'element)
 *     - right (droit que l'utilisateur doit avoir pour visionner cet element)
 *     - target (pour ouvrir le lien dans une nouvelle fenetre)
 */
$shortlinks = array();

// Template
/*
$link = array(
    "title" => _(""),
    "description" => _(""),
    "href" => "",
    "target" => "",
    "class" => "",
    "right" => "",
);
array_push($shortlinks, $link);
*/

// Tableau de bord
$link = array(
    "title" => _("Tableau de bord"),
    "description" => _("Acceder a la page d'accueil de l'application"),
    "href" => "../scr/dashboard.php",
    "class" => "shortlinks-dashboard",
);
array_push($shortlinks, $link);

?>