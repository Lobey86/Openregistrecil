<?php
/**
 *
 *
 * @package openmairie_exemple
 * @version SVN : $Id: recherche.php 50 2010-08-27 09:42:20Z fmichon $
 */

require_once "../obj/utils.class.php";
if (!isset($f)) { $f = new utils("nohtml"); }

if (is_array($soustableau) or isset($soustableau)) {
     echo "<div>";
     if (isset ($idrg)){
        if ($idrg==1){
          echo "<FORM action='../scr/rechercheglobale.php'  method=POST  id='f1' >";
        }else{
           echo "<FORM action='../scr/dashboard.php'  method=POST  id='f1' >";
        }
     }else{
          echo "<FORM action='../scr/dashboard.php'  method=POST  id='f1' >";
     }
     echo "<table  border='0' cellpadding='5'  cellspacing='5'>";
     echo "<tr>";
     echo "<td>";
     echo "<img src='../img/recherche_globale.png'  border='0' alt='"._("recherche")."&nbsp;"._("globale")."'  title='"._("recherche")."&nbsp;"._("globale")."' hspace='4'style='vertical-align:middle'>";
     echo "<input type='text' name='recherche' value='".$recherche."' class='champFormulaire' >";
     echo "<button type='submit' name='s1'>"._("recherche")."</button>";
     echo "<br><br>";
     $ntab=0;
     $nbligne=0;
     foreach($soustableau as $stab) {
        $nat=$sousnature[$ntab];
        if(isset($_GET['obj']))
            $obj=$_GET['obj'];
        else
            $obj="";
        // controle existence fichier *** gen    
        if (file_exists ("../sql/".$f -> phptype."/".$stab.".inc"))    
            include ("../sql/".$f -> phptype."/".$stab.".inc");

        if ($recherche) {
            $sqlw="";
            foreach($champRecherche as $elem) {
                if (substr($elem,0,1)!='*') {
                    if (!get_magic_quotes_gpc()) { // magic_quotes_gpc = Off
                        $sqlw = $sqlw." ".$elem." like '%".AddSlashes($recherche)."%' or ";
                    }else{  // magic_quotes_gpc = On
                        $sqlw = $sqlw." ".$elem." like '%".$recherche."%' or ";
                    }
                }
            }
            $sqlw=substr($sqlw,0,strlen($sqlw)-3).")";
            if ($selection!="")
                $sqlC="select count(*) from ".$table." ".$selection." and (".$sqlw;
            else
                $sqlC="select count(*) from ".$table." where (".$sqlw;
        } else {
            //******
            if (isset($global_flag)){
              if ($global_flag==1){
               if ($selection!="")
                   $sqlC="select count(*) from ".$table." ".$selection;
               else
                   $sqlC="select count(*) from ".$table;
              }
            }
        }
         if ($recherche) {
             $nbligne=$f -> db->getOne($sqlC);
        }else{
             if (isset($global_flag)){
              if ($global_flag==1){
                $nbligne=$f -> db->getOne($sqlC);
              }
             }
        }
        if ($nbligne>0) {
            if ($nat=="") $nat="tab";
            //***
            if (ereg("->",$ent)) {
                    $temp = explode("->",$ent);
                    $temp1="";
                    foreach($temp as $elem){
                      $temp1=$temp1._(trim($elem))."->";
                     }
                    $temp1=substr($temp1,0,strlen($temp1)-2);
                    $ent = str_replace ("->", "&nbsp;<img class=\"fleche_droite\" src=\"../img/fleche_droite.png\" style=\"vertical-align:middle\" alt=\"->\" title=\"->\" />&nbsp;", $temp1);
            }else{
                    $ent =  _($ent);
            }
            //***
            if ($recherche) {
                echo "<div><img src=\"../img/oeil.png\" hspace='10' style=\"vertical-align:middle\" alt=\"->\" title=\"->\" />&nbsp;<a class='lientable' href='../scr/$nat.php?obj=$stab&recherche=$recherche'><img src=../img/$ico alt='' title='' border='0' style='vertical-align:middle'/>&nbsp;$ent : <font id='occurence'>&nbsp;$nbligne&nbsp;</font>&nbsp;"._("resultat")."&nbsp;</a></div>";
            } else {
            //******
               if (isset($global_flag)){
                if ($global_flag==1){
                  echo "<div><img src=\"../img/oeil.png\" hspace='10' style=\"vertical-align:middle\" alt=\"->\" title=\"->\" />&nbsp;<a class='lientable' href='../scr/$nat.php?obj=$stab'><img src=../img/$ico alt='' title='' border='0' style='vertical-align:middle'/> $ent</a> : <font id='occurence'>&nbsp;$nbligne&nbsp;</font>"._("resultat")."&nbsp;"."</div>";
                }
               }
            }
            echo "<br>";
        }else{
          if ($recherche) {
            echo "<img src=../img/punaise.png alt='' title='' border='0' style='vertical-align:middle'/>&nbsp;"._("aucun")."&nbsp;"._("resultat")."&nbsp;->&nbsp: <font id='occurencenon'>&nbsp;".$stab."&nbsp;</font><br><br><br>";
          }else{
             if (isset($global_flag)){
                if ($global_flag==1){
                   echo "<img src=../img/punaise.png alt='' title='' border='0' style='vertical-align:middle'/>&nbsp;<font id='occurencenon'>&nbsp;".$stab."&nbsp;</font>&nbsp;0 "._("resultat")."<br><br>";
                }
             }
          }
        }
        $ntab++;
     }
     echo "</td>";
     echo "</tr>";
     echo "</table>";
     echo "</form>";
     echo "</div>";
}
?>