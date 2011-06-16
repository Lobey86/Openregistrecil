<?php
/**
 * ce script a pour objet de recuperer
 *  les etats
 *  les sous etats
 *  les lettres type
 *  depuis les versions anterieures a openMairie 4
 * @package openmairie_exemple
 * @version SVN : $Id: import.php 110 2010-09-30 14:00:43Z jbastide $
 */
$DEBUG=1;
require_once "../obj/utils.class.php";
if (isset($_GET['obj'])) {
    $obj = $_GET['obj'];
} else {
    $obj = "";    
}
if(isset($_GET['idx'])) {
    $idx = $_GET['idx'];
} else {
    $idx = 0;    
}
$f = new utils(NULL, "copie", _("copie"), "copie.png",
               $obj);

echo "\n<br>&nbsp";
echo "<fieldset>\n";
echo "\t<legend>"._("Copie ")."</legend>";
$f->setRight($obj);
$f->isAuthorized();
$sql="select * from ".DB_PREFIXE.$obj." where ".$obj."=".$idx;
// clone
$res = $f->db->query($sql);
$f->isDatabaseError($res);
while ($row=& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
    $valF=$row;
}
// valeurs non clonees
$valF['libelle']= 'copie du '.date('d/m/Y');
$valF['actif']='';
$valF['om_collectivite']= $_SESSION['collectivite'];
$valF[$obj]=$f-> db -> nextId(DB_PREFIXE.$obj);
$res1= $f-> db -> autoExecute(DB_PREFIXE.$obj,$valF,DB_AUTOQUERY_INSERT);
$f->isDatabaseError($res1);
echo $obj." "._("importe")." no ".$idx." : ".$valF['id'];
echo "</fieldset>";
?>