<?php
/*
$Id: norme_simplifiee.class.php,v 1.1 2008-07-10 13:44:39 fraynaud1 Exp $
*/
require_once ("registre.class.php");

class norme_simplifiee extends registre {

    var $table="registre";
    var $clePrimaire= "registre";
    var $typeCle= "N" ;
    var $nature = "norme_simplifiee";


function norme_simplifiee($id,&$db,$DEBUG) {
$this->constructeur($id,$db,$DEBUG);
}


}
?>
