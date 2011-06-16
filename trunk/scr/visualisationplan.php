<?php
/**
 *
 *
 * @package openmairie_exemple
 * @version SVN : $Id: visualisationplan.php 28 2010-08-23 08:44:33Z fmichon $
 */

require_once "../obj/utils.class.php";
$f = new utils("nohtml");

/**
 *
 */
if (isset($_GET['plan'])) {
    $plan = $_GET['plan'];
} else {
    $plan = "";
}

/**
 * Verification des parametres
 */
if (strpos($plan, "/") !== false
    or $plan == ""
    or !file_exists($f->config["chemin_plan"].$plan)) {
    $class = "error";
    $message = _("L'objet est invalide.");
    $f->addToMessage($class, $message);
    $f->setFlag(NULL);
    $f->display();
    die();
}

//
$f->setHTMLHeadJs("../js/visualisationplan.js");
$f->setHTMLBody("<body onload=\"init()\">\n");
$f->setFlag("htmlonly");
$f->display();

/**
 *
 */
$imageplan = $f->config["chemin_plan"].$plan;

/**
 *
 */
list($width, $height, $type, $attr) = getimagesize($imageplan);
//
echo "<DIV style='position:absolute;left:0;top:0;height:".$height."px;width:".$width."px;overflow:hidden;'>\n";
//
echo "\t<div id='divimage' style='position:absolute; left:0;top:0'>\n";
echo "\t\t<img name='myimage' onClick='changer()' src='".$imageplan."' border=1>\n";
echo "\t</div>\n";
//
$sql = "select * from emplacement where plans='".$plan."'";
$res = $f->db->query($sql);
$f->isDatabaseError($res);
//
$i = 0;
while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
    $i++;
    echo "\t<div id='camap$i' style='position:absolute;left:".$row['positionx'].";top:".$row['positiony']."'>\n";
    if ($row['libre'] == 'Oui') {
        echo "\t\t<a href='form.php?obj=".$row['nature']."&idx=".$row['emplacement']."'>\n";
        echo "\t\t\t<img name='image$i' src='../img/libre.png' alt='".$row['famille']."' border=0 >\n";
        echo "\t\t</a>\n";
    } else {
        if ($row['terme'] == 'temporaire') {
            echo "\t\t<a href='form.php?obj=".$row['nature']."&idx=".$row['emplacement']."'>\n";
            echo "\t\t\t<img name='image$i' src='../img/temporaire.png' alt='".$row['famille']."' border=0 >\n";
            echo "\t\t</a>\n";
        } else {
            echo "\t\t<a href='form.php?obj=".$row['nature']."&idx=".$row['emplacement']."'>\n";
            echo "\t\t\t<img name='image$i' src='../img/perpetuite.png' alt='".$row['famille']."' border=0 >\n";
            echo "\t\t</a>\n";
        }
    }
    echo "\t</div>\n";
}
//
echo "</div>\n";

?>