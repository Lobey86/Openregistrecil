<?php
/**
 * Ce fichier permet de configurer divers parametres de l'application
 *
 * @package openmairie_exemple
 * @version SVN: $Id: config.inc.php 330 2010-12-07 09:00:21Z fmichon $
 */

/**
 * 
 */
$config = array();

//
$config['application'] = _("openRegistreCIL");

//
$config['title'] = ":: "._("openMairie")." :: "._("openRegistreCIL - Framework");

//
$config['session_name'] = "openregistrecil";
//$config['session_name'] = "1bb484de79f96a7d0b00ff463c18fcbf";

/**
 * Mode demonstration de l'application
 * Permet de pre-remplir le formulaire de login avec l'identifiant 'demo' et le 
 * mot de passe 'demo'
 * Default : $config['demo'] = false;
 */
$config['demo'] = true;

/**
 * Configuration des extensions autorisees dans le module upload.php
 * Pour ajouter votre configuration, decommenter la ligne et modifier les extensions
 * avec des ; comme separateur
 * Default : $config['upload_extension'] = ".gif;.jpg;.jpeg;.png;.txt;.pdf;.csv;"
 */
//$config['upload_extension'] = ".gif;.jpg;.jpeg;.png;.txt;.pdf;.csv;"

/**
 * Theme de l'application - les differents choix possibles se trouvent dans le
 * dossier : ../lib/jquery-ui/css/
 * Default : $config['theme'] = "om_overcast";
 */
//$config['theme'] = "om_overcast";
$config['theme'] = "om_sunny";
//$config['theme'] = "om_ui-darkness";

?>
