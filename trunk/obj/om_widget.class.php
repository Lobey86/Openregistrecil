<?php
//$Id$ 
//gen openMairie le 07/04/2011 10:23 
require_once ("../gen/obj/om_widget.class.php");

class om_widget extends om_widget_gen {

	function om_widget($id,&$db,$debug) {
		$this->constructeur($id,$db,$debug);
	}// fin constructeur

	function setTaille(&$form,$maj) {
	parent::setTaille($form,$maj);
		$form->setTaille('titre',40);
		$form->setTaille('lien',80);
		$form->setTaille('om_profil',4);
	}

	function setMax(&$form,$maj) {
		parent::setMax($form,$maj);
		$form->setMax('titre',40);
		$form->setMax('lien',80);
		$form->setMax('om_profil',4);
	}


}// fin classe
?>