<?php
//$Id$ 
//gen openMairie le 17/05/2011 11:41 
require_once ("../gen/obj/modificatif.class.php");

class modificatif extends modificatif_gen {

	function modificatif($id,&$db,$debug) {
		$this->constructeur($id,$db,$debug);
	}// fin constructeur

	function setValsousformulaire(&$form,$maj,$validation,$idxformulaire,$retourformulaire,$typeformulaire,&$db,$DEBUG=null){
	        parent::setValsousformulaire($form,$maj,$validation,$idxformulaire,$retourformulaire,$typeformulaire,$db,$DEBUG=null);
		if($validation==0) {
			if($retourformulaire =='dispense'){
				$form->setVal('registre', $idxformulaire);
			}
			if($retourformulaire =='norme_simplifiee')
				$form->setVal('registre', $idxformulaire);
			if($retourformulaire =='demande_avis')
				$form->setVal('registre', $idxformulaire);
			if($retourformulaire =='autorisation_unique')
				$form->setVal('registre', $idxformulaire);
			if($retourformulaire =='autorisation_normale')
				$form->setVal('registre', $idxformulaire);
			
		}// fin validation
	}// fin setValsousformulaire

	function setType(&$form,$maj) {
		parent::setType($form,$maj);
		if($this->retourformulaire != "")
			$form->setType("registre","hiddenstatic");
		
	}	

}// fin classe
?>
