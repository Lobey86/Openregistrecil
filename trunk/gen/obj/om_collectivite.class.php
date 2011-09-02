<?php
//$Id$ 
//gen openMairie le 02/09/2011 16:50 
require_once (PATH_OPENMAIRIE."dbformdyn.class.php");

class om_collectivite_gen extends dbForm {
	var $table="om_collectivite";
	var $clePrimaire="om_collectivite";
	var $typeCle="N";
	var $retourformulaire;

	function setvalF($val) {
	//affectation valeur formulaire
		$this->valF['om_collectivite'] = $val['om_collectivite'];
		$this->valF['libelle'] = $val['libelle'];
		$this->valF['niveau'] = $val['niveau'];
	}

	//=================================================
	//cle primaire automatique [automatic primary key]
	//==================================================

	function setId(&$db) {
	//numero automatique
		$this->valF[$this->table] = $db->nextId(DB_PREFIXE.$this->table);
	}

	function setValFAjout($val) {
	//numero automatique -> pas de controle ajout cle primaire
	}

	function verifierAjout() {
	//numero automatique -> pas de verfication de cle primaire
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
			$form->setType('om_collectivite','hidden');// cle automatique
			$form->setType('libelle','text');
			$form->setType('niveau','text');
		}// fin ajout
		if ($maj==1){ //modifier
			$form->setType('om_collectivite','hiddenstatic');
			$form->setType('libelle','text');
			$form->setType('niveau','text');
		}// fin modifier
		if ($maj==2){ //supprimer
			$form->setType('om_collectivite','hiddenstatic');
			$form->setType('libelle','hiddenstatic');
			$form->setType('niveau','hiddenstatic');
		}//fin supprimer
	}

	function setOnchange(&$form,$maj) {
	//javascript controle client
		$form->setOnchange('om_collectivite','VerifNum(this)');
	}

	function setTaille(&$form,$maj) {
	//taille des champs affiches (text)
		$form->setTaille('om_collectivite',11);
		$form->setTaille('libelle',100);
		$form->setTaille('niveau',1);
	}

	function setMax(&$form,$maj) {
	//longueur max en saisie (text)
		$form->setMax('om_collectivite',11);
		$form->setMax('libelle',100);
		$form->setMax('niveau',1);
	}

	function setLib(&$form,$maj) {
	//libelle des champs
		$form->setLib('om_collectivite',_('om_collectivite'));
		$form->setLib('libelle',_('libelle'));
		$form->setLib('niveau',_('niveau'));
	}

	function setVal(&$form,$maj,$validation,&$db,$DEBUG=null){
		if($validation==0 and $maj==0 and $_SESSION['niveau']==1) {
			$form->setVal('om_collectivite', $_SESSION['collectivite']);
		}// fin validation
	}// fin setVal

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
        // Verification de la cle secondaire : om_etat
        $this->rechercheTable($db, "om_etat", "om_collectivite", $id);
        // Verification de la cle secondaire : om_lettretype
        $this->rechercheTable($db, "om_lettretype", "om_collectivite", $id);
        // Verification de la cle secondaire : om_parametre
        $this->rechercheTable($db, "om_parametre", "om_collectivite", $id);
        // Verification de la cle secondaire : om_sig_point
        $this->rechercheTable($db, "om_sig_point", "om_collectivite", $id);
        // Verification de la cle secondaire : om_sousetat
        $this->rechercheTable($db, "om_sousetat", "om_collectivite", $id);
        // Verification de la cle secondaire : om_utilisateur
        $this->rechercheTable($db, "om_utilisateur", "om_collectivite", $id);
        // Verification de la cle secondaire : om_widget
        $this->rechercheTable($db, "om_widget", "om_collectivite", $id);
    }


}// fin classe
?>