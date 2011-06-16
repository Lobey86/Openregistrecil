<?php
//$Id$
$DEBUG=0;// position
$login = $_SESSION['login'];
$profil = $_SESSION['profil'];
// version edition si ==1
(isset($_GET['edition']) ? $edition = $_GET['edition'] : $edition = 0);

function lien($libelle,$lien,$texte,$id,$col,$login,$position,$dernier,$edition)
{
	echo "<div class=\"choice ui-corner-all ui-widget-content\">";
    if($edition==1)
        echo "<img src='../img/supprimer.png' align=right onclick='supprimer(\"".$id."\",\"C".$col."\",\"".$login."\")'>";
	echo "<h3>";
	if($position>1 and $edition==1)
	    echo "<img src='../img/clehaut.png' align=left onclick='deplacer_haut(\"".$id."\",\"C".$col."\",\"".$login."\",\"".$position."\")'>";
	echo "<center>";
	if($col>1 and $edition==1)
	    echo "<img src='../img/gauche.png' onclick='deplacer_gauche(\"".$id."\",\"C".$col."\",\"".$login."\")'>";
	echo "".$libelle."";
	if($col<3 and $edition==1)
	    echo "<img src='../img/droite.png' onclick='deplacer_droite(\"".$id."\",\"C".$col."\",\"".$login."\")'>";
	echo "";
	echo "</center>";

	echo "</h3><br>".$texte;
	if($lien!="#")

		echo "<br><br><a href='".$lien."' >"._("Acceder au lien")."</a><br>";
	if($position!=$dernier and $edition==1)
	    echo "<img src='../img/clebas.png' onclick='deplacer_bas(\"".$id."\",\"C".$col."\",\"".$login."\",\"".$position."\")'>";	
	echo "</div>";
}

echo "<table width=100% >";
// 1 ***
echo "<tr><td valign=top width=33%>";
if($edition==1)
    echo "<img src='../img/ajouter.png' onclick='ajouter(\"C1\",\"".$login."\",\"".$profil."\")'>";
$sql="select om_tdb, om_widget.om_widget as widget, om_widget.libelle as libelle, om_widget.lien as lien, om_widget.texte as texte,position from om_tdb 
      inner join om_widget on om_widget.om_widget=om_tdb.om_widget where bloc ='C1' and login = '".
      $login."' order by position";
$res = $f->db->query($sql);
$f->isDatabaseError($res);
$dernier=$res->numRows(); 
while ($row=& $res->fetchRow(DB_FETCHMODE_ASSOC)){
    lien($row['libelle'],$row['lien'],$row['texte'],$row['om_tdb'],1,$login,$row['position'],$dernier,$edition);
    if($DEBUG==1)
        echo $row['position']." ";
}
echo "</td>";
// 2 ***
echo "<td valign=top width=33%>";
//echo "&nbsp;&nbsp";
if($edition==1)
    echo "<img src='../img/ajouter.png' onclick='ajouter(\"C2\",\"".$login."\",\"".$profil."\")'>";
$sql="select om_tdb, om_widget.om_widget as widget, om_widget.libelle as libelle, om_widget.lien as lien, om_widget.texte as texte,position from om_tdb 
      inner join om_widget on om_widget.om_widget=om_tdb.om_widget where bloc ='C2' and login = '".
      $login."' order by position";
$res = $f->db->query($sql);
$f->isDatabaseError($res);
$dernier=$res->numRows(); 
while ($row=& $res->fetchRow(DB_FETCHMODE_ASSOC)){
    lien($row['libelle'],$row['lien'],$row['texte'],$row['om_tdb'],2,$login,$row['position'],$dernier,$edition);
    if($DEBUG==1)
        echo $row['position']." ";
}

// 3 ***
echo "</td><td valign=top width=33%>";
//echo "&nbsp;&nbsp";
if($edition==1)
    echo "<img src='../img/ajouter.png' onclick='ajouter(\"C3\",\"".$login."\",\"".$profil."\")'>";
$sql="select om_tdb, om_widget.om_widget as widget, om_widget.libelle as libelle, om_widget.lien as lien, om_widget.texte as texte,position from om_tdb 
      inner join om_widget on om_widget.om_widget=om_tdb.om_widget where bloc ='C3' and login = '".
      $login."' order by position";
$res = $f->db->query($sql);
$f->isDatabaseError($res);
$dernier=$res->numRows(); 
while ($row=& $res->fetchRow(DB_FETCHMODE_ASSOC)){
    lien($row['libelle'],$row['lien'],$row['texte'],$row['om_tdb'],3,$login,$row['position'],$dernier,$edition);
    if($DEBUG==1)
        echo $row['position']." ";
}
//echo "</fieldset>";
echo "</td>";
echo "</tr></table>";
?>
