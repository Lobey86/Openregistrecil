<?php
/*
$Id: dispense.class.php,v 1.2 2008-07-07 10:35:14 fraynaud1 Exp $
*/
require_once ("registre.class.php");

class dispense extends registre {

    var $table="registre";
    var $clePrimaire= "registre";
    var $typeCle= "N" ;
    var $nature = "dispense";


	function dispense($id,&$db,$DEBUG) {
		$this->constructeur($id,$db,$DEBUG);
	}

}
?>
