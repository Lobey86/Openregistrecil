<?php
/**
 * ce script a pour objet de fabriquer des etats
 * @package openmairie_exemple
 * @version SVN : $Id: import.php 110 2010-09-30 14:00:43Z jbastide $
 */
$DEBUG=0;
//echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
//echo "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"fr\" lang=\"fr\">\n";

require_once "../obj/utils.class.php";
$f = new utils(NULL, "genetat_script", _("lettretype"), "ico_import.png",
               "etat_script");
/**
 * Description de la page
 */
$description = _("cet assistant vous permet de creer des lettres type ".
                 "directement a partir de vos tables ");
$f->displayDescription($description);
/**
 *
 */
set_time_limit(3600);
if (isset($_POST['choice-import']) and $_POST['choice-import'] != "---") {
    $obj = $_POST['choice-import'];
} elseif(isset($_GET['obj'])) {
    $obj = $_GET['obj'];
} else {
    $obj = "";    
}
if(isset($_GET['validation'])) {
    $validation = $_GET['validation'];
} else {
    $validation = 0;    
}
if (isset($_POST['choice-field'])){
    $field=$_POST['choice-field'];
}else{
    $field='';
}
/**
 * On liste les tables
 */
// tab
$tab = array();
if ($f -> phptype == 'mysql') 
    $sql =  "SHOW TABLES FROM ".$f->database[$_SESSION['coll']]["database"];
if($f -> phptype == 'pgsql') //***pgsql
    $sql ="select tablename from pg_tables where schemaname='".$f -> schema."' ";
$res1 = $f -> db -> query ($sql);
if (database::isError($res1))
    $res1->getDebugInfo();	
else{
    $k=0;    
    while ($row=& $res1->fetchRow()){
        if(substr($row[0],-3,3)!= "seq" ){
            $k++;
            array_push($tab, $f->tablebase[$k]= $row[0]);
        }
    }
}// while
asort($tab);
echo "\n<div id=\"form-choice-import\" class=\"formulaire\">\n";
echo "<form action=\"../gen/genlettretype.php\" method=\"post\">\n";
echo "<fieldset>\n";
echo "\t<legend>"._("Choix table :")."</legend>\n";
echo "\t<div class=\"field\">";
echo "<label>"._("fichier")."</label>";
echo "<select onchange=\"submit()\" name=\"choice-import\" class=\"champFormulaire\">";
echo "<option>---</option>";
foreach ($tab as $elem) {
    echo "<option value=\"".$elem."\"";
    if ($obj == $elem) {
        echo " selected=\"selected\" ";
    }
    echo ">".$elem."</option>";
}
echo "</select>";
echo "</div>\n";
echo "</fieldset>\n";
echo "</form>\n";
echo "</div>\n";
/**
 * choix des champs
 */
if ($obj != "" and $field=='') {
    //
    echo "\n<br>&nbsp;<div id=\"form-csv-import\" class=\"formulaire\">\n";
    echo "<form action=\"../gen/genlettretype.php?obj=".$obj."&validation=1\" method=\"post\" name=\"f1\">\n";
    echo "<fieldset>\n";
    echo "\t<legend>"._("choix des champs")."</legend>";
    echo "Utilisez ctrl key pour choix multiple<br><br>";
    $sql= "select * from ".DB_PREFIXE.$obj;
    $res2 = $f -> db -> query ($sql);
    $info=$res2->tableInfo();
    echo "<select multiple name=\"choice-field[]\" class=\"champFormulaire\">";
    foreach($info as $elem){
        echo "<option>".$obj.".".$elem['name']."</option>";
    }
    echo "</select>";
    echo "<br><br>";
    echo "<input type=\"submit\" name=\"submit-csv-import\" value=\""._("Import")." ".
            $obj." "._("dans la base")."\" class=\"boutonFormulaire\" />";
    echo "</div>";
    echo "</fieldset>";
    echo "</form>";
    echo "</div>\n";
}
/**
 *  transfert dans la base
 */
if ($obj != "" and $field!='') {
    echo "\n<br>&nbsp";
    echo "<fieldset>\n";
    echo "\t<legend> Insertion dans la table etat</legend>";
    // sql
    $temp='';
    $temp1='';
    if($field!=array()){
        for ($i = 0; $i < sizeof($field); $i++) {    
            $temp2=explode(".",$field[$i]);
            $temp3=$temp2[1];
            $temp.=$field[$i].' as '.$temp3.',';
            $temp1.="[".$temp3.']'.chr(13).chr(10);
        }
        $temp=substr($temp, 0, strlen($temp)-1);
    }
    if (file_exists ("dyn/standard/lettretype.inc"))
        include("dyn/standard/lettretype.inc");
    if (file_exists ("dyn/custom/lettretype.inc"))
        include("dyn/custom/lettretype.inc");
    
    
    $lettretype['om_sql']="select ".$temp." from &DB_PREFIXE".$obj." where ".$obj.".".$obj."='".$variable."idx'";
    $lettretype['titre']="le ".$variable."aujourdhui";
    $lettretype['corps']=$temp1;
    // id
    $lettretype['id']= $obj;
    $lettretype['libelle']= $obj." gen le ".date('d/m/Y');
    $lettretype['actif']=''; // contrainte null pgsql
    // om_collectivite
    $lettretype['om_collectivite']= $_SESSION['collectivite'];
    // parametre standard / custom

    // next Id
    $lettretype['om_lettretype']=$f-> db -> nextId(DB_PREFIXE.'om_lettretype');
    $res= $f-> db -> autoExecute(DB_PREFIXE.'om_lettretype',$lettretype,DB_AUTOQUERY_INSERT);
    if (database::isError($res))
       die($res->getDebugInfo()." => echec requete insertion lettretype");
    else
        echo $obj." "._("enregistre");
    echo "</fieldset>";
}
?>