<?php
/**
 *
 */
//$Id: var.inc,v 1.66 2010-01-12 11:18:14 fraynaud Exp $
// =========================================================================
// Module de parametrage general
// =========================================================================
// plan utilise en localisation par croquis (spg localisation)
if (isset($_SESSION['coll'])){
  $chemin_plan="../trs/".$_SESSION['coll']."/";
}
// UPLOAD.PHP*******************************************************************
//-----------liste extensions : ".extension;.extension;....."
//extension par defaut
$default_extension=".gif;.jpg;.jpeg;.png;.txt;.pdf";
// extension(s) ciblee(s) possible
// $get_origine."liste extension"
// *****************************************************************************
$verrou=1; // verrou =1 actif 0= inactif (empeche actualisation sur form valide)
?>
