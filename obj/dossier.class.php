<?php
//$Id$ 
//gen openMairie le 17/05/2011 11:46 
require_once ("../gen/obj/dossier.class.php");

class dossier extends dossier_gen {

	function dossier($id,&$db,$debug) {
		$this->constructeur($id,$db,$debug);
	}// fin constructeur

	function setType(&$form,$maj) {
		parent::setType($form,$maj);
		if ($maj < 2) {
	  		$form->setType('fichier','upload2');
  			//$form->setType('archive_fichier','hiddenstatic');
			$form->setType('typedossier','select');
			if($this->retourformulaire != "")
				$form->setType("registre","hiddenstatic");
		}
	}

	function setSelect(&$form, $maj,&$db,$debug) {
		parent::setSelect($form, $maj,$db,$debug);
		if($maj<2){
		    $contenu=array();
		    $contenu[0]=array('lettre','avis');
		    $contenu[1]=array(_('lettre'),_('avis'));
		    $form->setSelect("typedossier",$contenu);
		}
	}

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


}// fin classe
?>
