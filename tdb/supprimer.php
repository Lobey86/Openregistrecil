<?php
(isset($_GET['idx']) ? $idx = $_GET['idx'] : $idx = 0);
(isset($_GET['login']) ? $login = $_GET['login'] : $login = "");
(isset($_GET['bloc']) ? $bloc = $_GET['bloc'] : $bloc = 0);
require_once "../obj/utils.class.php";
$f = new utils("nohtml");
// destruction dans le tableau de bord
$sql="delete from om_tdb where om_tdb =".$idx;
$res= $f->db->query($sql);
$f->isDatabaseError($res);
// mise a jour des positions
$sql="select om_tdb,position from om_tdb where login = '".
    $login."' and bloc ='".$bloc."' order by position";
  //echo $sql;
$res1= $f->db->query($sql);
$f->isDatabaseError($res1);
$i=0;
while ($row=& $res1->fetchRow(DB_FETCHMODE_ASSOC)){
    $i++;
    $sql="update om_tdb set position = ".$i." where om_tdb = ".
    $row['om_tdb'];
    $res2= $f->db->query($sql);
    $f->isDatabaseError($res2);
}            
echo "\n<script type=\"text/javascript\">\n";
echo "\nwindow.opener.location.reload();";
echo "this.close();\n";
echo "</script>\n";
?>
