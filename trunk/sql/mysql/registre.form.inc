<?php
//$Id$ 
//gen openMairie le 17/05/2011 11:42 
include('../gen/sql/mysql/registre.form.inc.php');
$champs=array("finalite",
              "date_registre",
              "numero_cnil",
              "registre",
              "'' as table_personne",
              "categorie_personne",
              "'' as table_donnee",
              "categorie_donnee",
             // "' ' as vide1",
              "'' as table_donnee2",
              "exclusion",
              "service",
              "droit_acces",
              "reference",
              "date_maj",
              "avis",
              "nature",
              "note","conservation",
              "om_collectivite");
$sql_table_donnee="select
                   concat(categorie_donnee,' ', libelle) as cle,
                   concat(categorie_donnee,' ', libelle) as lib
                   from categorie_donnee order by categorie_donnee";
$sql_table_personne="select
                   concat(categorie_personne,' ', libelle) as cle,
                   concat(categorie_personne,' ', libelle) as lib
                   from categorie_personne order by categorie_personne";
?>
