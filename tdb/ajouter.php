<?php
echo "<head>";
//$Id$
?>
<script>
function fermer(){
   window.opener.location.reload();
   window.close();
}
</script>
<?php
echo "</head>";
$DEBUG=0;
(isset($_GET['bloc']) ? $bloc = $_GET['bloc'] : $bloc = 0);
(isset($_GET['login']) ? $login = $_GET['login'] : $login = "");
(isset($_GET['profil']) ? $profil = $_GET['profil'] : $profil = "");
(isset($_GET['validation']) ? $validation = $_GET['validation'] : $validation = 0);
(isset($_POST['widget']) ? $widget = $_POST['widget'] : $widget = 0);
require_once "../obj/utils.class.php";
$f = new utils("nohtml");


If($validation==0){
    $validation =1;
    echo "<b>choisir un widget pour ".$bloc.":</b><br>";
	echo "<form method=\"POST\" action=\"ajouter.php?validation=".
    		$validation."&bloc=".$bloc."&login=".$login."&profil=".$profil."\" name=f1>";
	$sql="select om_widget as widget, libelle from om_widget where om_profil <= '".$profil.
        "' order by libelle";
    $res = $f->db->query($sql);
    $f->isDatabaseError($res);
	echo "<select name='widget'>";
	while ($row=& $res->fetchRow(DB_FETCHMODE_ASSOC)){
	    echo "<option value='".$row['widget']."' >".$row['libelle']."</option>";
	}
	echo "</select>";
	echo "<input type='submit' value='valider&nbsp;' >";	
	echo "</form>";
}else{
      $valF=array();
      $valF['om_tdb']=$f->db->nextId("om_tdb");
      $valF['login']=$login;
      $valF['om_widget']=$widget;
      $valF['bloc']=$bloc;
      $sql= "select max(position) from om_tdb where login = '".
	     $login."' and bloc ='".$bloc."'";
      //echo $sql;
      $position = $f->db->getOne($sql);
      $position=$position+1;
      $valF['position']=$position;
      $res = $f->db->autoExecute("om_tdb",$valF,DB_AUTOQUERY_INSERT);
      $f->isDatabaseError($res);
      echo $widget." ajoute";
      echo "<center><br><br><a href=# onclick='fermer();'>";
      echo "<img src='../img/fermer_fenetre.png' border='0'  alt='fermer_fenetre' align='middle'>"; // enleve lang
      echo "</a></center>";
}
?>
