<?php
/**
 *
 *
 * @package openmairie_exemple
 * @version SVN : $Id: pdfetiquette.php 72 2010-09-01 17:52:25Z fmichon $
 */

require_once "../obj/utils.class.php";
$f = new utils("nohtml");

/**
 *
 */
// Nom de l'objet metier
(isset($_GET['obj']) ? $obj = $_GET['obj'] : $obj = "");

/**
 * Verification des parametres
 */
if (strpos($obj, "/") !== false
    or !file_exists("../sql/".$f->phptype."/".$obj.".pdfetiquette.inc")) {
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
require_once "../sql/".$f->phptype."/".$obj.".pdfetiquette.inc";

/**
 *
 */
//
set_time_limit(180);
//
require_once PATH_OPENMAIRIE."fpdf_etiquette.php";
//
$collectivite = $f->collectivite;
//
$pdf = new PDF($orientation, 'mm', $format);
//
$pdf->SetFont($police,$gras,$size);
$pdf->SetTextColor($C1,$C2,$C3);
$pdf->SetMargins(0,0);
$pdf->SetAutoPageBreak(false);
$pdf->Open();
$pdf->AddPage();
$pdf->SetDisplayMode('real','single');
//--------------------------------------------------------------------------//
// param:                                                                   //
//--------------------------------------------------------------------------//
// (0) $_Margin_Left = 5; Marge de gauche de l'étiquette                    //
// (1) $_Margin_Top = 11; marge en haut de la page avant la première étiquette
// (2) $_X_Space  = 12;   Espace horizontal entre 2 bandes d'étiquettes     //
// (3) $_Y_Space = 10;    Espace vertical entre 2 bandes d'étiquettes       //
// (4) $_X_Number = 2;    Nombre d'étiquettes sur la largeur de la page     //
// (5) $_Y_Number =5;     Nombre d'étiquettes sur la hauteur de la page     //
// (6) $_Width = 95;      Largeur de chaque étiquette                       //
// (7) $_Height = 30;     Hauteur de chaque étiquette                       //
// (8) $_Char_Size = 5;   Hauteur des caractères                            //
// (9) $_Line_Height = 4; Hauteur par défaut  interligne                    //
// (10) $_cptx=0;                                                           //
// (11) $_cpty=0;                                                           //
// (12) size police                                                         //
// (13) CADRE CHAMPS DATA,TXETE,COMPTEUR 1 OU 0                             //
// (14) CADRE ZONE REPETEE avec tous les champs1 OU 0                       //
//--------------------------------------------------------------------------//
// imprimante marges minimale g 6.01,d 6.18,h 4.23,b 4.23 ?????
$param=array();
$param=array($_margin_left,$_margin_top,$_x_space,$_y_space,$_x_number,$_y_number,$_width,$_height,$_char_size,$_line_height,0,0,$size,$cadrechamps,$cadre);
//--------------------------------------------------------------------------//
//    champs compteur      $champs_compteur=array();                        //
//--------------------------------------------------------------------------//
// (0) 1 -> affichage compteur ou 0 ->pas d'affichage                       //
// (1) x                                                                    //
// (2) y                                                                    //
// (3) width                                                                //
// (4) bold 1 ou 0                                                          //
// (5) size ou 0                                                            //
// par rapport a la dimension du pré-imprimer                               //
// exemple  $champs_compteur=array(1,20,5,25,0,0);                          //
//--------------------------------------------------------------------------//
//
//--------------------------------------------------------------------------//
//    champs image(s)       $img=array();                                   //
//--------------------------------------------------------------------------//
// (0) file Nom du fichier contenant l'image.                               //
// (1) x Abscisse du coin supérieur gauche.                                 //
// (2) y Ordonnée du coin supérieur gauche.                                 //
// (3) w Largeur de l'image dans la page. Si elle n'est pas indiquée ou vaut//
//       zéro, elle est calculée automatiquement.                           //
// (4) h Hauteur de l'image dans la page.Si elle n'est pas indiquée ou vaut //
//      zéro, elle est calculée automatiquement.                            //
// (5) type Format de l'image. Les valeurs possibles sont                   //
//     (indépendamment de la casse) : JPG, JPEG, PNG. S'il n'est pas précisé,/
//     le type est déduit de l'extension du fichier.                        //
// exemple :                                                                //
// $img=array(array('../img/arles.png',1,1,17.6,12.6,'png')                 //
// array('../img/arles.png',40,1,17.6,12.6,'png')                           //
// array('../img/arles.png',25,1,120,86,'png')                              //
// );                                                                       //
//--------------------------------------------------------------------------//
//
//--------------------------------------------------------------------------//
//    champs texte (s)       $texte=array();                                //
//--------------------------------------------------------------------------//
// (0) texte                                                                //
// (1) x                                                                    //
// (2) y                                                                    //
// (3) width                                                                //
// (4) bold 1 ou 0                                                          //
// (5) size ou 0                                                            //
// par rapport a la dimension du pré-imprimer                               //
//--------------------------------------------------------------------------//
//
//--------------------------------------------------------------------------//
//    champs data  $champs=array()                                          //
//--------------------------------------------------------------------------//
// (0) affichage avant data                                                 //
// (1) affichage apres data                                                 //
// (2) tableau X Y Width bold(0 ou 1),size ou 0                             //
// par rapport a la dimension du pré-imprimer                               //
// (3) 1 = number_format(champs,0) : 0002->2  /  ou 0                       //
//--------------------------------------------------------------------------//
//
$pdf->Table_position($sql,$f->db,$param,$champs,$texte,$champs_compteur,$img);
//
$pdf->Output();

?>