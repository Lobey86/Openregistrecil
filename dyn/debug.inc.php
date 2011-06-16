<?php
/**
 * Ce fichier contient le parametrage pour le mode debug
 *
 * @package openmairie_exemple
 * @version SVN: $Id: debug.inc.php 413 2011-05-15 21:04:38Z fraynaud $
 */

/**
 *
 */
(defined("PATH_OPENMAIRIE") ? "" : define("PATH_OPENMAIRIE", ""));
require_once PATH_OPENMAIRIE."om_debug.inc.php";

/**
 *
 */
//define('DEBUG', VERBOSE_MODE);
define('DEBUG', DEBUG_MODE);
//define('DEBUG', PRODUCTION_MODE);

?>