<?php
// =========================================================================
// $Id: varpdf.inc,v 1.2 2009-10-26 09:59:38 fraynaud Exp $
// Module de parametrage des etats pdf
// =========================================================================
$sql=str_replace("£idx",$_GET['idx'],$sql);
$titre=str_replace("£aujourdhui",date('d/m/Y'),$titre);
$titre=str_replace("£ville",$collectivite['ville'],$corps,$titre);
$corps=str_replace("£aujourdhui",date('d/m/Y'),$corps);
$corps=str_replace("£ville",$collectivite['ville'],$corps,$corps);
?>