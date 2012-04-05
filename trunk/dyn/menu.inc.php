<?php
/**
 * Ce fichier permet de configurer quelles actions vont etre disponibles
 * dans le menu.
 *
 * 
 *
 * @package openmairie_exemple
 * @version SVN : $Id: menu.inc.php 417 2011-05-16 19:09:07Z fraynaud $
 */

/**
 * $menu est le tableau associatif qui contient tout le menu de
 * l'application, il contient lui meme un tableau par rubrique, puis chaque
 * rubrique contient un tableau par lien
 *
 * Caracteristiques :
 * --- tableau rubrik
 *     - title [obligatoire]
 *     - description (texte qui s'affiche au survol de la rubrique)
 *     - href (contenu du lien href)
 *     - class (classe css qui s'affiche sur la rubrique)
 *     - right (droit que l'utilisateur doit avoir pour visionner cette rubrique)
 *     - links [obligatoire]
 *
 * --- tableau links
 *     - title [obligatoire]
 *     - href [obligatoire] (contenu du lien href)
 *     - class (classe css qui s'affiche sur l'element)
 *     - right (droit que l'utilisateur doit avoir pour visionner cet element)
 *     - target (pour ouvrir le lien dans une nouvelle fenetre)
 */
$menu = array();

// {{{  Rubrique application
// inserer ici vos tables principales

$rubrik = array(
    "title" => _("Application"),
    "class" => "application",
    "right" => "menu_application",
);
$links = array();
// *** APPLICATION ***
// inserez ici les tables de votra application
// ========================================================================
/*
  array_push($links,
    array(
        "href" => "../scr/tab.php?obj=nom_table",
        "class" => "nom_table",
        "title" => _("nom_table"),
        "right" => "nom_table"
    ));
*/
// ========================================================================
 /* 
 array_push($links,
    array(
        "href" => "../scr/tab.php?obj=registre",
        "class" => "registre",
        "title" => _("registre"),
        "right" => "registre"
    ));
  */
  array_push($links,
    array(
        "href" => "../scr/tab.php?obj=dispense",
        "class" => "dispense",
        "title" => _("dispense"),
        "right" => "dispense"
    ));
  array_push($links,
    array(
        "href" => "../scr/tab.php?obj=autorisation_normale",
        "class" => "autorisation_normale",
        "title" => _("autorisation normale"),
        "right" => "autorisation_normale"
    ));
  array_push($links,
    array(
        "href" => "../scr/tab.php?obj=autorisation_unique",
        "class" => "autorisation_unique",
        "title" => _("autorisation unique"),
        "right" => "autorisation_unique"
    ));
  array_push($links,
    array(
        "href" => "../scr/tab.php?obj=demande_avis",
        "class" => "demande_avis",
        "title" => _("demande avis"),
        "right" => "demande_avis"
    ));
  array_push($links,
    array(
        "href" => "../scr/tab.php?obj=norme_simplifiee",
        "class" => "norme_simplifiee",
        "title" => _("norme simplifiee"),
        "right" => "norme_simplifiee"
    ));

    array_push($links,
    array(
        "href" => "../scr/tab.php?obj=registre_visu",
        "class" => "registre_visu",
        "title" => _("registre_visu"),
        "right" => "registre_visu"
    ));

$rubrik['links'] = $links;
array_push($menu, $rubrik);

// {{{ Rubrique EXPORT
$rubrik = array(
    "title" => _("Export"),
    "class" => "edition",
    "right" => "menu_export",
);

$links = array();
array_push($links,
    array(
        "href" => "../scr/edition.php",
        "class" => "edition",
        "title" => _("Edition"),
        "right" => "edition"
    ));
array_push($links,
    array(
        "href" => "../scr/reqmo.php",
        "class" => "reqmo",
        "title" => _("Requetes memorisees"),
        "right" => "reqmo"
    ));
$rubrik['links'] = $links;
array_push($menu, $rubrik);
// }}}

// {{{ Rubrique TRAITEMENT
/*
$rubrik = array(
    "title" => _("Traitement"),
    "class" => "traitement",
    "right" => "menu_traitement",
);
$links = array();
*/
// *** TRAITEMENT ***
// inserez le lien d acces au traitement
// ========================================================================
/*
 array_push($links,
    array(
        "href" => "../trt/nom_du_traitement.php",
        "class" => "traitement",
        "title" => _("Traitement"),
        "right" => "traitement"
    ));
*/
// ========================================================================

//$rubrik['links'] = $links;
//array_push($menu, $rubrik);
// }}}



// {{{  Rubrique parametrage de l'application

$rubrik = array(
    "title" => _("Parametrage"),
    "class" => "parametrage",
    "right" => "menu_parametrage",
);
$links = array();
// *** TABLES DE PARAMETRAGE ***
// inserer ici vos tables de parametres
// ========================================================================
/*
  array_push($links,
    array(
        "href" => "../scr/tab.php?obj=nom_table",
        "class" => "nom_table",
        "title" => _("nom_table"),
        "right" => "nom_table"
    ));
*/
// ========================================================================

  array_push($links,
    array(
        "href" => "../scr/tab.php?obj=categorie_donnee",
        "class" => "categorie_donnee",
        "title" => _("categorie de donnee"),
        "right" => "categorie_donnee"
    ));
  array_push($links,
    array(
        "href" => "../scr/tab.php?obj=categorie_personne",
        "class" => "categorie_personne",
        "title" => _("Personne Concernee"),
        "right" => "categorie_personne"
    ));
  array_push($links,
    array(
        "href" => "../scr/tab.php?obj=reference",
        "class" => "reference",
        "title" => _("reference"),
        "right" => "reference"
    ));
  array_push($links,
    array(
        "href" => "../scr/tab.php?obj=organisme",
        "class" => "organisme",
        "title" => _("organisme"),
        "right" => "organisme"
    ));
  array_push($links,
    array(
        "href" => "../scr/tab.php?obj=service",
        "class" => "service",
        "title" => _("service"),
        "right" => "service"
    ));

$rubrik['links'] = $links;
array_push($menu, $rubrik);





// {{{ Rubrique ADMINISTRATION
//
$rubrik = array(
    "title" => _("Administration"),
    "class" => "administration",
    "right" => "menu_administration",
);
//
$links = array();
array_push($links,
    array(
        "href" => "../scr/tab.php?obj=om_collectivite",
        "class" => "collectivite",
        "title" => _("om_collectivite"),
        "right" => "om_collectivite_tab"
    ));
array_push($links,
    array(
        "href" => "../scr/tab.php?obj=om_parametre",
        "class" => "collectivite",
        "title" => _("om_parametre"),
        "right" => "om_parametre_tab"
    ));


array_push($links,
    array(
        "title" => "<hr/>",
        "right" => array("om_utilisateur_tab", "om_profil_tab", "om_droit_tab")
    ));
array_push($links,
    array(
        "href" => "../scr/tab.php?obj=om_profil",
        "class" => "profil",
        "title" => _("om_profil"),
        "right" => "om_profil_tab"
    ));
array_push($links,
    array(
        "href" => "../scr/tab.php?obj=om_droit",
        "class" => "droit",
        "title" => _("om_droit"),
        "right" => "om_droit_multi"
    ));
array_push($links,
    array(
        "href" => "../scr/tab.php?obj=om_utilisateur",
        "class" => "utilisateur",
        "title" => _("om_utilisateur"),
        "right" => "om_utilisateur_tab"
    ));
array_push($links,
    array(
        "title" => "<hr/>",
        "right" => array("om_etat_tab", "om_sousetat_tab", "om_lettretype_tab"),
    ));
array_push($links,
    array(
        "href" => "../scr/tab.php?obj=om_etat",
        "class" => "etat",
        "title" => _("om_etat"),
        "right" => "om_etat_tab"
    ));
array_push($links,
    array(
        "href" => "../scr/tab.php?obj=om_sousetat",
        "class" => "sousetat",
        "title" => _("om_sousetat"),
        "right" => "om_sousetat_tab"
    ));
array_push($links,
    array(
        "href" => "../scr/tab.php?obj=om_lettretype",
        "class" => "lettretype",
        "title" => _("om_lettretype"),
        "right" => "om_lettretype_tab"
    ));

array_push($links,
    array(
        "href" => "../scr/tab.php?obj=om_widget",
        "class" => "om_widget",
        "title" => _("widget"),
        "right" => "om_widget"
    ));
array_push($links,
    array(
        "title" => "<hr/>",
        "right" => array("import"),
    ));
array_push($links,
    array(
        "href" => "../scr/import.php",
        "class" => "import",
        "title" => _("Import"),
        "right" => "import"
    ));

array_push($links,
    array(
        "title" => "<hr/>",
        "right" => array("gen"),
    ));
array_push($links,
    array(
        "title" => _("Generateur"),
        "href" => "../scr/gen.php",
        "class" => "generator",
        "right" => "gen",
    ));
$rubrik['links'] = $links;
array_push($menu, $rubrik);
// }}}

?>
