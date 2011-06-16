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
$f = new utils(NULL, "gen", _("etat"), "ico_import.png",
               "sousetat_script");
/**
 * Description de la page
 */
$description = _("cet assistant vous permet de creer des sous etats ".
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
if (isset($_POST['choice-cle'])){
    $cle=$_POST['choice-cle'];
}else{
    $cle='';
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
echo "<form action=\"../gen/gensousetat.php\" method=\"post\">\n";
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
    echo "<form action=\"../gen/gensousetat.php?obj=".$obj."&validation=1\" method=\"post\" name=\"f1\">\n";
    echo "<fieldset>\n";
    echo "\t<legend>"._("choix des champs")."</legend>";
    
    $sql= "select * from ".DB_PREFIXE.$obj;
    $res2 = $f -> db -> query ($sql);
    $info=$res2->tableInfo();
    echo "<table><tr>";
    echo "Utilisez ctrl key pour choix multiple<br><br>";
    echo "<td><select multiple name=\"choice-field[]\" class=\"champFormulaire\">";
    foreach($info as $elem){
        echo "<option value=\"".$obj."|".$elem['name']."|".$elem['len']."|".$elem['type']."\">".$obj.".".$elem['name']."</option>";
    }
    echo "</select></td>";
    echo "<td>"._("choisir la cle de selection")."</td>";
    echo "<td><select name=\"choice-cle\" class=\"champFormulaire\">";
    foreach($info as $elem){
        echo "<option value=\"".$obj.".".$elem['name']."\">".$obj.".".$elem['name']."</option>";
    }
    echo "</select></td>";
    echo "</tr><tr>";
    echo "<td><br><br><input type=\"submit\" name=\"submit-csv-import\" value=\""._("Import")." ".
            $obj." "._("dans la base")."\" class=\"boutonFormulaire\" />";
    echo "</td></tr></table></div>";
    echo "</fieldset>";
    echo "</form>";
    echo "</div>\n";
}
/**
 *  transfert dans la base
 */
if ($obj != "" and $field!='' and $cle!='') {
    echo "\n<br>&nbsp";
    echo "<fieldset>\n";
    echo "\t<legend> Insertion dans la table sous etat</legend>";
    // sql
    $temp=''; // field
    $temp1=''; // champ requete
    $longueur=0;
    $dernierchamp=0;
    if($field!=array()){
        for ($i = 0; $i < sizeof($field); $i++) {    
            $temp=explode("|",$field[$i]);
            $table=$temp[0];
            $champ=$temp[1];
            $len[$i]=$temp[2];
            $type=$temp[3];
            $temp1.=$table.".".$champ.' as '.$champ.',';
            if($len[$i]!='')
                $len[$i]=40;
            $longueur=$longueur+$len[$i];
            $dernierchamp++;
        }
        $temp1=substr($temp1, 0, strlen($temp1)-1);
    }
    
    // parametre standard / custom
    if (file_exists ("dyn/standard/sousetat.inc"))
        include("dyn/standard/sousetat.inc");
    if (file_exists ("dyn/custom/sousetat.inc"))
        include("dyn/custom/sousetat.inc");
    
    // parametres sousetat
    $sousetat['om_sql']="select ".$temp1." from &DB_PREFIXE".$obj." where ".$cle."='".$variable."idx'";
    // id
    $temp='';
    $temp=explode('.',$cle);
    $sousetat['id']= $obj.'.'.$temp[1];
    $sousetat['libelle']= "gen le ".date('d/m/Y');
    $sousetat['titre']=_("liste")." ".$obj;
    // om_collectivite
    $sousetat['om_collectivite']= $_SESSION['collectivite'];

    // parametre ************************************
    // calcul de la longueur
    echo "<br>Tableau de : ".$longueurtableau." pour ".
         $longueur." caracteres <br><br>";
    $quotient=$longueurtableau/$longueur;
    $temp1="";$temp2="";$temp3="";$temp4="";$temp5="";
    for ($i = 0; $i < sizeof($len); $i++){
        // largeur
        $temp=$len[$i]*$quotient;
        if($i==$dernierchamp-1){
            $temp1.=$temp; // largeur
            $temp2.='C'; // align
            $temp3.='LTBR';// bordure
            $temp4.='0';  // stats
            $temp5.='999'; // total
        }else{
            // separateur ."|"
            $temp1.=$temp."|"; // largeur
            $temp2.="C"."|"; // alihgn
            $temp3.="TLB"."|"; // bordure
            $temp4.="0"."|"; // stats
            $temp5.='999'."|"; // total
        }
    }
    $sousetat['tableau_largeur']=$longueurtableau;
    $sousetat['cellule_largeur']=$temp1;
    $sousetat['entetecolone_align']=$temp2;
    $sousetat['entetecolone_bordure']=$temp3;
    $sousetat['entete_orientation']=$temp4;

    $sousetat['cellule_bordure_un']=$temp3;
    $sousetat['cellule_bordure']=$temp3;
    $sousetat['cellule_align']=$temp2;

    $sousetat['cellule_bordure_total']=$temp3;
    $sousetat['cellule_align_total']=$temp2;

    $sousetat['cellule_bordure_moyenne']=$temp3;
    $sousetat['cellule_align_moyenne']=$temp2;

    $sousetat['cellule_bordure_nbr']=$temp3;
    $sousetat['cellule_align_nbr']=$temp2;
    //*
    $sousetat['cellule_numerique']=$temp5;
    $sousetat['cellule_total']=$temp4;
    $sousetat['cellule_moyenne']=$temp4;
    $sousetat['cellule_compteur']=$temp4;   
 
    $sousetat['actif']=''; // contrainte null pgsql
    
    // next Id
    $sousetat['om_sousetat']=$f-> db -> nextId(DB_PREFIXE.'om_sousetat');
    // enregistrement
    $res= $f-> db -> autoExecute(DB_PREFIXE.'om_sousetat',$sousetat,DB_AUTOQUERY_INSERT);
    if (database::isError($res))
       die($res->getDebugInfo()." => echec requete insertion sousetat");
    else
        echo $obj." "._("enregistre");
    if($DEBUG==1)
        print_r($sousetat);
    echo "</fieldset>";
}
?>