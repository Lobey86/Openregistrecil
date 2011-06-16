<?php
//$Id$ 
//gen openMairie le 17/05/2011 11:42 
require_once ("../gen/obj/reference.class.php");

class reference extends reference_gen {

	function reference($id,&$db,$debug) {
		$this->constructeur($id,$db,$debug);
	}// fin constructeur

	function verifier($val,&$db,$DEBUG){
	    parent::verifier($val,$db,$DEBUG);	
	    $imgv="";
	    $f="&nbsp!&nbsp;&nbsp;&nbsp;&nbsp;";
	    $imgv="<img src='../img/punaise.png' style='vertical-align:middle' hspace='2' border='0'>";
	    if ($this->valF['nature']==""){
	       $this->correct=false;
	       $this->msg= $this->msg.$imgv._("nature")."&nbsp;"._("obligatoire").$f;
	    }
	}

	function setType(&$form,$maj) {
           parent::setType($form,$maj);
	   if ($maj < 2) {
	     $form->setType('nature', 'select');     
	     if ($maj==1)
		$form->setType('cnil', 'http');
	     else
                $form->setType('cnil', 'hidden');
	   }
	}

	function setSelect(&$form, $maj,&$db,$debug) {
		parent::setSelect($form, $maj,&$db,$debug);
		if($maj<2){
			$contenu=array();
			$contenu[0]=array('dispense',
					  'norme_simplifiee',
					  'autorisation_unique',
					  'autorisation_normale',
					  'demande_avis');
			$contenu[1]=array(_('dispense'),
					  _('norme_simplifiee'),
					  _('autorisation_unique'),
					  _('autorisation_normale'),
					  _('demande_avis')
					  );
			$form->setSelect("nature",$contenu);
			// lien
			$contenu=array();
			$contenu[0]=" <img src='../img/cnil.gif' border ='0'> ";
			$form->setSelect("cnil",$contenu);
		}
	}

}// fin classe
?>
