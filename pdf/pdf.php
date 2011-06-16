<?php
/**
 *
 *
 * @package openmairie_exemple
 * @version SVN : $Id: pdf.php 102 2010-09-13 08:42:59Z fmichon $
 */

require_once "../obj/utils.class.php";
$f = new utils("nohtml");

/**
 *
 */
// Nom de l'objet metier
(isset($_GET['obj']) ? $obj = $_GET['obj'] : $obj = "");
//
$multiplicateur = 1;
//
$collectivite = $f->collectivite;

/**
 * Verification des parametres
 */
if (strpos($obj, "/") !== false
    or !file_exists("../sql/".$f->phptype."/".$obj.".pdf.inc")) {
    $class = "error";
    $message = _("L'objet est invalide.");
    $f->addToMessage($class, $message);
    $f->setFlag(NULL);
    $f->display();
    die();
}

/**
 *
 */
require_once "../sql/".$f->phptype."/".$obj.".pdf.inc";

/**
 *
 */
//
set_time_limit(180);
//
require_once PATH_OPENMAIRIE."db_fpdf.php";
//
$pdf = new PDF($orientation, 'mm', $format);
$pdf->Open();
$pdf->SetMargins($margeleft, $margetop, $margeright);
$pdf->AliasNbPages();
$pdf->SetDisplayMode('real', 'single');
$pdf->SetDrawColor($C1border, $C2border, $C3border);
$pdf->AddPage();
$pdf->Table($sql, $f->db, $height, $border, $align, $fond, $police, $size,
            $multiplicateur, $flag_entete);
//
$pdf->Output();

?>