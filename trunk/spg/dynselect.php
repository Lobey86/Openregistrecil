<?php
/**
 *
 *
 * @package openmairie_exemple
 * @version SVN : $Id: dynselect.php 28 2010-08-23 08:44:33Z fmichon $
 */

require_once "../obj/utils.class.php";
$f = new utils("nohtml");

/**
 *
 */
header('Content-type: text/html; charset=iso-8859-1');

/**
 *
 */
$tab = $_POST["tab"];
$parent = $_POST["parent"];
$key = $_POST["key"];

/**
 *
 */
//
$sql = "SELECT * FROM ".$tab." WHERE ".$parent."=".$key;
//
$res = $f->db->query($sql);
$f->isDatabaseError($res);
//
echo 'var o = null;';
echo 'var s = document.getElementById("'.$tab.'");';
echo 's.options.length = 0;';
if ($res->numRows() == 0) {
    echo 's.options[s.options.length] = new Option("Aucun(e) '.$tab.'","");';
} else {
    echo 's.options[s.options.length] = new Option("Choisir '.$tab.'","");';
    while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
        echo 's.options[s.options.length] = new Option("'.$row[$tab.'lib'].'","'.$row[$tab].'");';
    }
}
//
$res->free();

?>