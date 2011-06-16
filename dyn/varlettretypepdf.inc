<?php
// =========================================================================
// Module de paramétrage des lettres type
// =========================================================================
// compatibilite
$sql=str_replace("£idx",$_GET['idx'],$sql);
$sql=str_replace("£destinataire",$destinataire,$sql);
//
/* old
$titre=str_replace("£aujourdhui",date('d/m/Y'),$titre);
$titre=str_replace("£datecourrier",$datecourrier,$titre);
$titre=str_replace("£complement",$complement,$titre);

$titre=str_replace("£idx",$_GET['idx'],$titre);
$corps=str_replace("£datecourrier",$datecourrier,$corps);
$corps=str_replace("£complement",$complement,$corps);
*/
// specific lettre type
if(isset($datecourrier)) $datecourrier='';
if(isset($complement)) $complement='';

$titre=str_replace("&datecourrier",$datecourrier,$titre);
$titre=str_replace("&complement",$complement,$titre);
$corps=str_replace("&datecourrier",$datecourrier,$corps);
$corps=str_replace("&complement",$complement,$corps);
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