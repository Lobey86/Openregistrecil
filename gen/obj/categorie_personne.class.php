<?php
//$Id$ 
//gen openMairie le 02/09/2011 16:50 
require_once (PATH_OPENMAIRIE."dbformdyn.class.php");

class categorie_personne_gen extends dbForm {
	var $table="categorie_personne";
	var $clePrimaire="categorie_personne";
	var $typeCle="A";
	var $retourformulaire;

	function setvalF($val) {
	//affectation valeur formulaire
		$this->valF['categorie_personne'] = $val['categorie_personne'];
		$this->valF['libelle'] = $val['libelle'];
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
			$form->setType('categorie_personne','text');
			$form->setType('libelle','text');
		}// fin ajout
		if ($maj==1){ //modifier
			$form->setType('categorie_personne','hiddenstatic');
			$form->setType('libelle','text');
		}// fin modifier
		if ($maj==2){ //supprimer
			$form->setType('categorie_personne','hiddenstatic');
			$form->setType('libelle','hiddenstatic');
		}//fin supprimer
	}

	function setOnchange(&$form,$maj) {
	//javascript controle client
	}

	function setTaille(&$form,$maj) {
	//taille des champs affiches (text)
		$form->setTaille('categorie_personne',3);
		$form->setTaille('libelle',80);
	}

	function setMax(&$form,$maj) {
	//longueur max en saisie (text)
		$form->setMax('categorie_personne',3);
		$form->setMax('libelle',80);
	}

	function setLib(&$form,$maj) {
	//libelle des champs
		$form->setLib('categorie_personne',_('categorie_personne'));
		$form->setLib('libelle',_('libelle'));
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
        $this->rechercheTable($db, "registre", "categorie_personne", $id);
    }


}// fin classe
?>