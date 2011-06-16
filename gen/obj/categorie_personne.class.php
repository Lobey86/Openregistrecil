<?php
//$Id$ 
//gen openMairie le 17/05/2011 11:40 
require_once (PATH_OPENMAIRIE."formulairedyn.class.php");
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

	function verifier($val,&$db,$DEBUG) {
	// verifier le 2eme champ si $verifier = 1 dans gen/dyn/form.inc
		$this->correct=True;
		$f="&nbsp!&nbsp;&nbsp;&nbsp;&nbsp;";
		$imgv="<img src='../img/punaise.png' style='vertical-align:middle' hspace='2' border='0'>";
		if ($this->valF['libelle']==""){
			$this->msg= $this->msg.$imgv._('libelle')."&nbsp;"._('obligatoire').$f;
			$this->correct=False;
		}
	} // fin verifier [end verify]

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

	function cleSecondaire($id,&$db,$val,$debug) {
		$this->correct=True;
		$f="&nbsp!&nbsp;&nbsp;&nbsp;&nbsp;";
		$imgv="<img src='../img/punaise.png' style='vertical-align:middle' hspace='2' border='0'>";
		// cle secondaire registre
		$sql = "select * from registre where categorie_personne ='".$id."'";
		$res = $db->query($sql);
		if($debug==1) echo $sql;
		if (database::isError($res))
			die($res->getMessage(). " => Echec  ".$sql);
		else{
			$nbligne=$res->numrows();
			$this->msg = $this->msg.$imgv._('il_y_a')." ".$nbligne." "._('registre')." "._('pour')." "._('categorie_personne')." [".$id."]<br>";
			if($nbligne>0)
				$this->correct=false;
		}
	}// clesecondaire

}// fin classe
?>