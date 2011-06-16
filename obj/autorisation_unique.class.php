<?php
/*
$Id: autorisation_unique.class.php,v 1.1 2008-07-10 13:44:39 fraynaud1 Exp $
*/
require_once ("registre.class.php");

class autorisation_unique extends registre {

    var $table="registre";
    var $clePrimaire= "registre";
    var $typeCle= "N" ;
    var $nature = "autorisation_unique";


	function autorisation_unique($id,&$db,$DEBUG) {
		$this->constructeur($id,$db,$DEBUG);
	}

}
?>
