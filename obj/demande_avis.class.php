<?php
/*
$Id: demande_avis.class.php,v 1.1 2008-07-10 13:44:39 fraynaud1 Exp $
*/
require_once ("registre.class.php");

class demande_avis extends registre {

    var $table="registre";
    var $clePrimaire= "registre";
    var $typeCle= "N" ;
    var $nature = "demande_avis";


	function demande_avis($id,&$db,$DEBUG) {
		$this->constructeur($id,$db,$DEBUG);
	}

	function setType(&$form,$maj) {
	parent::setType($form, $maj);
	   if ($maj < 2) {
		$form->setType('reference', 'hidden');
	   }
	}

	function setRegroupe(&$form,$maj){
		parent::setRegroupe($form,$maj);
		$form->setRegroupe('date_maj','D',_("reference"));
		$form->setRegroupe('avis','F','');
	}



}
?>
