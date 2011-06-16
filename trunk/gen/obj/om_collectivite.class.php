<?php
//$Id$ 
//gen openMairie le 06/12/2010 15:57 
require_once (PATH_OPENMAIRIE."formulairedyn.class.php");
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

	function cleSecondaire($id,&$db,$val,$debug) {
		$this->correct=True;
		$f="&nbsp!&nbsp;&nbsp;&nbsp;&nbsp;";
		$imgv="<img src='../img/punaise.png' style='vertical-align:middle' hspace='2' border='0'>";
		// cle secondaire om_etat
		$sql = "select * from om_etat where om_collectivite ='".$id."'";
		$res = $db->query($sql);
		if($debug==1) echo $sql;
		if (database::isError($res))
			die($res->getMessage(). " => Echec  ".$sql);
		else{
			$nbligne=$res->numrows();
			$this->msg = $this->msg.$imgv._('il_y_a')." ".$nbligne." "._('om_etat')." "._('pour')." "._('om_collectivite')." [".$id."]<br>";
			if($nbligne>0)
				$this->correct=false;
		}
		// cle secondaire om_lettretype
		$sql = "select * from om_lettretype where om_collectivite ='".$id."'";
		$res = $db->query($sql);
		if($debug==1) echo $sql;
		if (database::isError($res))
			die($res->getMessage(). " => Echec  ".$sql);
		else{
			$nbligne=$res->numrows();
			$this->msg = $this->msg.$imgv._('il_y_a')." ".$nbligne." "._('om_lettretype')." "._('pour')." "._('om_collectivite')." [".$id."]<br>";
			if($nbligne>0)
				$this->correct=false;
		}
		// cle secondaire om_parametre
		$sql = "select * from om_parametre where om_collectivite ='".$id."'";
		$res = $db->query($sql);
		if($debug==1) echo $sql;
		if (database::isError($res))
			die($res->getMessage(). " => Echec  ".$sql);
		else{
			$nbligne=$res->numrows();
			$this->msg = $this->msg.$imgv._('il_y_a')." ".$nbligne." "._('om_parametre')." "._('pour')." "._('om_collectivite')." [".$id."]<br>";
			if($nbligne>0)
				$this->correct=false;
		}
		// cle secondaire om_sousetat
		$sql = "select * from om_sousetat where om_collectivite ='".$id."'";
		$res = $db->query($sql);
		if($debug==1) echo $sql;
		if (database::isError($res))
			die($res->getMessage(). " => Echec  ".$sql);
		else{
			$nbligne=$res->numrows();
			$this->msg = $this->msg.$imgv._('il_y_a')." ".$nbligne." "._('om_sousetat')." "._('pour')." "._('om_collectivite')." [".$id."]<br>";
			if($nbligne>0)
				$this->correct=false;
		}
		// cle secondaire om_utilisateur
		$sql = "select * from om_utilisateur where om_collectivite ='".$id."'";
		$res = $db->query($sql);
		if($debug==1) echo $sql;
		if (database::isError($res))
			die($res->getMessage(). " => Echec  ".$sql);
		else{
			$nbligne=$res->numrows();
			$this->msg = $this->msg.$imgv._('il_y_a')." ".$nbligne." "._('om_utilisateur')." "._('pour')." "._('om_collectivite')." [".$id."]<br>";
			if($nbligne>0)
				$this->correct=false;
		}
	}// clesecondaire

}// fin classe
?>