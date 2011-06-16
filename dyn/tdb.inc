<?php
// $Id$
$description = _("Bienvenue ").$_SESSION["login"]."&nbsp;";
$description.= _("dans votre tableau de bord ")."<a href='../scr/dashboard.php?edition=1'>"._("parametrable en cliquant ici")."</a>";
$f->displayDescription($description);
include ("../tdb/tdb.php");
?>