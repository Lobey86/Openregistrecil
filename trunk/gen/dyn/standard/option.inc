<?php
// $Id: option.inc,v 1.1 2009-09-02 10:19:21 fraynaud Exp $
// insertion de texte dans les divers menu 
// auto.php

$modif_edition="echo \"<br><a class='lien' href='../pdf/pdf.php?obj=".$table.
           "'  target='_blank'><img src='../img/ico_pdf.png' align='top' hspace='35' border='0'>".
           $table." </a><br>\";"; 
$modif_menu = "echo \"<li><a href='../scr/tab.php?obj=".$table.
	           "'>&nbsp;\".\_(\"".$table."\").\"&nbsp;</a></li>\";";
$modif_tdb="echo \"\t<div><a href='../scr/tab.php?obj=".$table.
           "'><img src='../img/tb_fleche.png' alt='' title=''  style='vertical-align:middle'/>&nbsp;\".\_(\"".$table."\").\"&nbsp;</a></div>\";";
$modif_import="echo \"<br><a class='lien' href='../rec/import_script.php?obj=".$table.
           "'  target='_blank'><img src='../img/ico_import.png' align='top' hspace='35' border='0'>".
           $table." </a><br>\";";
$modif_documentation_menu= "echo \"<li><a href=javascript:doc('\".\$langue.\"/".$table.".html',650,500)>&nbsp;\"._('".$table."').\"&nbsp;</a></li>\";";
$modif_documentation_tdb=  "echo \"<div id='bouton_tactile'><a href=javascript:doc('\".\$langue.\"/".$table.
             ".html',650,500)><img src='../img/tb_fleche.png' vspace='2' alt='' title=''  style='vertical-align:middle'/>&nbsp;\"._('".$table.
             "').\"</a></div>\";";
?>
