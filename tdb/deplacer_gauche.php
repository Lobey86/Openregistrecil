<?php
(isset($_GET['idx']) ? $idx = $_GET['idx'] : $idx = 0);
(isset($_GET['login']) ? $login = $_GET['login'] : $login = "");
(isset($_GET['bloc']) ? $bloc_origine = $_GET['bloc'] : $bloc_origine = "");
require_once "../obj/utils.class.php";
$f = new utils("nohtml");
if($bloc_origine=='C3') 
   $bloc = 'C2';
else
   if($bloc_origine=='C2') 
         $bloc = 'C1';
// position
$sql= "select count(position) from om_tdb where login = '".
	     $login."' and bloc ='".$bloc."'";
$position = $f->db->getOne($sql);
if(!is_numeric($position))
    $position=0;
$position=$position+1;
// update position et colone
$sql="update om_tdb set bloc='".
     $bloc."',position = ".
     $position." where om_tdb =".$idx;
$res2= $f->db->query($sql);
$f->isDatabaseError($res2);
// update colone origine
$sql="select om_tdb,position from om_tdb where login = '".
$login."' and bloc ='".$bloc_origine."' order by position";
//        echo $sql;
$res1= $f->db->query($sql);
$f->isDatabaseError($res1);
$i=0;
while ($row1=& $res1->fetchRow(DB_FETCHMODE_ASSOC)){
    $i++;
    $sql="update om_tdb set position = ".$i." where om_tdb = ".
    $row1['om_tdb'];
    $res2= $f->db->query($sql);
    $f->isDatabaseError($res2);
}  
echo "\n<script type=\"text/javascript\">\n";
echo "\nwindow.opener.location.reload();";
echo "this.close();\n";
echo "</script>\n";
?>
