<?php
//$Id$ 
//gen openMairie le 02/09/2011 16:50 
require_once (PATH_OPENMAIRIE."dbformdyn.class.php");

class om_profil_gen extends dbForm {
	var $table="om_profil";
	var $clePrimaire="om_profil";
	var $typeCle="A";
	var $retourformulaire;

	function setvalF($val) {
	//affectation valeur formulaire
		$this->valF['om_profil'] = $val['om_profil'];
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
			$form->setType('om_profil','text');
			$form->setType('libelle','text');
		}// fin ajout
		if ($maj==1){ //modifier
			$form->setType('om_profil','hiddenstatic');
			$form->setType('libelle','text');
		}// fin modifier
		if ($maj==2){ //supprimer
			$form->setType('om_profil','hiddenstatic');
			$form->setType('libelle','hiddenstatic');
		}//fin supprimer
	}

	function setOnchange(&$form,$maj) {
	//javascript controle client
	}

	function setTaille(&$form,$maj) {
	//taille des champs affiches (text)
		$form->setTaille('om_profil',2);
		$form->setTaille('libelle',30);
	}

	function setMax(&$form,$maj) {
	//longueur max en saisie (text)
		$form->setMax('om_profil',2);
		$form->setMax('libelle',30);
	}

	function setLib(&$form,$maj) {
	//libelle des champs
		$form->setLib('om_profil',_('om_profil'));
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
        // Verification de la cle secondaire : om_droit
        $this->rechercheTable($db, "om_droit", "om_profil", $id);
        // Verification de la cle secondaire : om_utilisateur
        $this->rechercheTable($db, "om_utilisateur", "om_profil", $id);
        // Verification de la cle secondaire : om_widget
        $this->rechercheTable($db, "om_widget", "om_profil", $id);
    }


}// fin classe
?>