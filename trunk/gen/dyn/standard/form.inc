 <?php   
// $Id: form.inc,v 1.4 2009-09-10 14:25:34 fraynaud Exp $
// parametre de sql/ .../nomtable.inc et nomtable.form.inc   
    $serie = 15; // nombre d'enregistrement par page'
	$ico = "../img/ico_application.png"; // icone de l'application
	// blob
	$max=6; // nb de ligne blob
	$taille=80; // taille du blob
	// pgsql
	$pgsql_taille_defaut = 20; // taille du champ par defaut si retour pg_field_prtlen =0
    $pgsql_taille_minimum = 10; // taille minimum d affichage d un champ
    $pgsql_longueur_date=12; // taille d'affichage de la date '
    // methode vérifier sur le 2eme champ
    $verifier=1; 

?>