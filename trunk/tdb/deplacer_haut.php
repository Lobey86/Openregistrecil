<?php
(isset($_GET['idx']) ? $idx = $_GET['idx'] : $idx = 0);
(isset($_GET['bloc']) ? $bloc = $_GET['bloc'] : $bloc = '');
(isset($_GET['login']) ? $login = $_GET['login'] : $login = "");
(isset($_GET['position']) ? $position = $_GET['position'] : $position = 0);
require_once "../obj/utils.class.php";
$f = new utils("nohtml");
if($position >1){
    $position_new=$position-1;
    $sql="update  om_tdb set position = ".$position." where login = '".
        $login."' and bloc ='".$bloc."' and position =".$position_new;

    $res1= $f->db->query($sql);
    
    $f->isDatabaseError($res1);
    //echo $sql;
    $sql="update  om_tdb set position = ".$position_new." where om_tdb =".$idx;
    //    echo $sql;
    $res2= $f->db->query($sql);
    $f->isDatabaseError($res2);

}
echo "\n<script type=\"text/javascript\">\n";
echo "\nwindow.opener.location.reload();";
echo "this.close();\n";
echo "</script>\n";
?>
