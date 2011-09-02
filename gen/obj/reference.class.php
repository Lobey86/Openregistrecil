<?php
//$Id$ 
//gen openMairie le 02/09/2011 16:50 
require_once (PATH_OPENMAIRIE."dbformdyn.class.php");

class reference_gen extends dbForm {
	var $table="reference";
	var $clePrimaire="reference";
	var $typeCle="A";
	var $retourformulaire;

	function setvalF($val) {
	//affectation valeur formulaire
		$this->valF['reference'] = $val['reference'];
		$this->valF['libelle'] = $val['libelle'];
		$this->valF['nature'] = $val['nature'];
	}

	//====================================
	// verifier avant validation [verify]
	//=====================================
    /**
     * Methode verifier
     */
    function verifier($val = array(), &$db = NULL, $DEBUG = false) {
        // On appelle la methode de la classe parent
        parent::verifier($val, $db, $DEBUG);
        // On verifie si le champ n'est pas vide
        if ($this->valF['libelle'] == "") {
            $this->correct = false;
            $this->addToMessage(_("Le champ")." "._("libelle")." "._("est obligatoire"));
        }
    }


	//==========================
	// Formulaire  [form]
	//==========================

	function setType(&$form,$maj) {
		//type
		if ($maj==0){ //ajout
			$form->setType('reference','text');
			$form->setType('libelle','text');
			$form->setType('nature','text');
		}// fin ajout
		if ($maj==1){ //modifier
			$form->setType('reference','hiddenstatic');
			$form->setType('libelle','text');
			$form->setType('nature','text');
		}// fin modifier
		if ($maj==2){ //supprimer
			$form->setType('reference','hiddenstatic');
			$form->setType('libelle','hiddenstatic');
			$form->setType('nature','hiddenstatic');
		}//fin supprimer
	}

	function setOnchange(&$form,$maj) {
	//javascript controle client
	}

	function setTaille(&$form,$maj) {
	//taille des champs affiches (text)
		$form->setTaille('reference',10);
		$form->setTaille('libelle',80);
		$form->setTaille('nature',30);
	}

	function setMax(&$form,$maj) {
	//longueur max en saisie (text)
		$form->setMax('reference',10);
		$form->setMax('libelle',80);
		$form->setMax('nature',30);
	}

	function setLib(&$form,$maj) {
	//libelle des champs
		$form->setLib('reference',_('reference'));
		$form->setLib('libelle',_('libelle'));
		$form->setLib('nature',_('nature'));
	}

	//==================================
	// sous Formulaire  [subform]
	//==================================

	function setValsousformulaire(&$form,$maj,$validation,$idxformulaire,$retourformulaire,$typeformulaire,&$db,$DEBUG=null){
		$this->retourformulaire = $retourformulaire;
	}// fin setValsousformulaire

	//==================================
	// cle secondaire  [secondary key]
	//==================================
    /**
     * Methode clesecondaire
     */
    function cleSecondaire($id, &$db = NULL, $val = array(), $DEBUG = false) {
        // On appelle la methode de la classe parent
        parent::cleSecondaire($id, $db, $val, $DEBUG);
        // Verification de la cle secondaire : registre
        $this->rechercheTable($db, "registre", "reference", $id);
    }


}// fin classe
?>