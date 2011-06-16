<?php
/* $Id: uploadel.php,v 1.1 2010-05-11 12:52:56 jbastide Exp $
*/
if (file_exists ("../dyn/session.inc"))
    include ("../dyn/session.inc");
//
if (isset ($_GET['idx'])){
   $idx=$_GET['idx'];
}else{
   $idx="";
}
if (isset ($_GET['obj'])){
   $obj=$_GET['obj'];
}else{
   $obj="";
}
require_once "../obj/utils.class.php";
$f = new utils(NULL, "copie", _("copie")." ".$obj, "ajouter.png", "copie");
$description = _("Cette option permet de faire une copie etat, sousetat, lettretype ".
                 "directement dans les tables d openMairie 4 ");
$f->displayDescription($description);
 echo "\n<div id='edition'>\n";
    echo "<fieldset class='choix'>";
    echo _("confirmer")."  "._("ajouter")." : ".$obj."<br>";
    echo "<a href='copie.php?idx=".$idx."&obj=".$obj."'>";
    echo "<img src='../img/ok.gif' alt='"._("copie")."' style='vertical-align:middle'>";
    echo "</a>";
     echo "</fieldset>";
    echo "</div>";
?>