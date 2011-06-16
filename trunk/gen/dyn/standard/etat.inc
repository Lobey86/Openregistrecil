 <?php   
// $Id: etat.inc,v 1.1 2009-09-02 10:19:21 fraynaud Exp $  
// parametre etat
	// general
    $variable='&'; // nouveau
    // $variable=chr(163); // compatibilite openmairie <4
    // parametres
    $etat['orientation']='P';
	$etat['format']='A4';
	// footer
	$etat['footerfont']='helvetica';
	$etat['footerattribut']='I';
	$etat['footertaille']='8';
	// logo
	$etat['logo']='logopdf.png';
	$etat['logoleft']='58';
	$etat['logotop']='7';
	// titre
	$etat['titreleft']='41';
	$etat['titretop']='36';
	$etat['titrelargeur']='130';
	$etat['titrehauteur']='10';
	$etat['titrefont']='helvetica';
	$etat['titreattribut']='B';
	$etat['titretaille']='15';
	$etat['titrebordure']='0';
	$etat['titrealign']='C'; 
	// corps
	$etat['corpsleft']='7';
	$etat['corpstop']='57';
	$etat['corpslargeur']='195';
	$etat['corpshauteur']='5';
	$etat['corpsfont']='helvetica';
	$etat['corpsattribut']='';
	$etat['corpstaille']='10';
	$etat['corpsbordure']='0';
	$etat['corpsalign']='J';
	// sous etat
	$etat['se_font']='helvetica';
	$etat['se_margeleft']='8';
	$etat['se_margetop']='5';
	$etat['se_margeright']='5';
	$etat['se_couleurtexte']="0-0-0";	
?>