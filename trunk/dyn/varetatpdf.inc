<?php
// =========================================================================
// Module de parametrage des etats
// $Id: varetatpdf.inc,v 1.21 2009-11-09 09:23:55 fraynaud Exp $
// =========================================================================
// compatibilite
$sql=str_replace("£idx",$_GET['idx'],$sql);
$titre=str_replace("£idx",$_GET['idx'],$titre);
/*
$titre=str_replace("£aujourdhui",date('d/m/Y'),$titre);
$titre=str_replace("£ville",$collectivite['ville'],$titre);
$corps=str_replace("£aujourdhui",date('d/m/Y'),$corps);
$corps=str_replace("£ville",$collectivite['ville'],$corps);
*/
// idx
$sql=str_replace("&idx",$_GET['idx'],$sql);
$sql=str_replace("&DB_PREFIXE",DB_PREFIXE,$sql);
$titre=str_replace("&idx",$_GET['idx'],$titre);
$corps=str_replace("&idx",$_GET['idx'],$corps);
// aujourdhui
$titre=str_replace("&aujourdhui",date('d/m/Y'),$titre);
$corps=str_replace("&aujourdhui",date('d/m/Y'),$corps);
// parametre
if($collectivite!=array()){
    foreach (array_keys($collectivite) as $elem) {
        $temp="&".$elem;
        $titre=str_replace($temp,$collectivite[$elem],$titre);
        $corps=str_replace($temp,$collectivite[$elem],$corps);
        $sql=str_replace($temp,$collectivite[$elem],$sql);
    }
}                                                
?>