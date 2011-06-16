<?php
//$Id$ 
//gen openMairie le 17/05/2011 11:42 
include('../gen/sql/mysql/reference.form.inc.php');
$champs=array("reference",
            "concat('http://www.cnil.fr/fileadmin/f_dynamiques/scripts_php/declaration/nouv/popup.php?norme=',reference) as cnil",
            "libelle",
            "nature");
?>
