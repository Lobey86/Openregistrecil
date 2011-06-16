<?php
//$Id$ 
//gen openMairie le 17/05/2011 11:46 
require_once (PATH_OPENMAIRIE."formulairedyn.class.php");
require_once (PATH_OPENMAIRIE."dbformdyn.class.php");

class dossier_gen extends dbForm {
	var $table="dossier";
	var $clePrimaire="dossier";
	var $typeCle="N";
	var $retourformulaire;

	function setvalF($val) {
	//affectation valeur formulaire
		$this->valF['dossier'] = $val['dossier'];
		$this->valF['registre'] = $val['registre'];
		$this->valF['fichier'] = $val['fichier'];
	if($val['datedossier']!=""){
		$this->valF['datedossier'] = $this->dateDB($val['datedossier']);
	}
		$this->valF['observation'] = $val['observation'];
		$this->valF['typedossier'] = $val['typedossier'];
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
		if ($this->valF['registre']==""){
			$this->msg= $this->msg.$imgv._('registre')."&nbsp;"._('obligatoire').$f;
			$this->correct=False;
		}
	} // fin verifier [end verify]

	//==========================
	// Formulaire  [form]
	//==========================

	function setType(&$form,$maj) {
		//type
		if ($maj==0){ //ajout
			$form->setType('dossier','hidden');// cle automatique
			if($this->retourformulaire=='registre')
				$form->setType('registre','hiddenstatic');
			else
				$form->setType('registre','select');
			$form->setType('fichier','text');
			if($this->retourformulaire=='')
				$form->setType('datedossier','date');
			else
				$form->setType('datedossier','date2');
			$form->setType('observation','textarea');
			$form->setType('typedossier','text');
		}// fin ajout
		if ($maj==1){ //modifier
			$form->setType('dossier','hiddenstatic');
			if($this->retourformulaire=='registre')
				$form->setType('registre','hiddenstatic');
			else
				$form->setType('registre','select');
			$form->setType('fichier','text');
			if($this->retourformulaire=='')
				$form->setType('datedossier','date');
			else
				$form->setType('datedossier','date2');
			$form->setType('observation','textarea');
			$form->setType('typedossier','text');
		}// fin modifier
		if ($maj==2){ //supprimer
			$form->setType('dossier','hiddenstatic');
			$form->setType('registre','hiddenstatic');
			$form->setType('fichier','hiddenstatic');
			$form->setType('datedossier','hiddenstatic');
			$form->setType('observation','hiddenstatic');
			$form->setType('typedossier','hiddenstatic');
		}//fin supprimer
	}

	function setOnchange(&$form,$maj) {
	//javascript controle client
		$form->setOnchange('dossier','VerifNum(this)');
		$form->setOnchange('registre','VerifNum(this)');
		$form->setOnchange('datedossier','fdate(this)');
	}

	function setTaille(&$form,$maj) {
	//taille des champs affiches (text)
		$form->setTaille('dossier',8);
		$form->setTaille('registre',8);
		$form->setTaille('fichier',40);
		$form->setTaille('datedossier',10);
		$form->setTaille('observation',80);
		$form->setTaille('typedossier',20);
	}

	function setMax(&$form,$maj) {
	//longueur max en saisie (text)
		$form->setMax('dossier',8);
		$form->setMax('registre',8);
		$form->setMax('fichier',40);
		$form->setMax('datedossier',10);
		$form->setMax('observation',6);
		$form->setMax('typedossier',20);
	}

	function setLib(&$form,$maj) {
	//libelle des champs
		$form->setLib('dossier',_('dossier'));
		$form->setLib('registre',_('registre'));
		$form->setLib('fichier',_('fichier'));
		$form->setLib('datedossier',_('datedossier'));
		$form->setLib('observation',_('observation'));
		$form->setLib('typedossier',_('typedossier'));
	}

	function setSelect(&$form, $maj,&$db,$debug) {
		if(file_exists ("../sql/".$db->phptype."/".$this->table.".form.inc"))
			include ("../sql/".$db->phptype."/".$this->table.".form.inc");
		if($maj<2){
			// registre
			$contenu=array();
			$res = $db->query($sql_registre);
			if (database::isError($res))
				die($res->getMessage().$sql_registre);
			else{
				if ($debug == 1)
					echo " la requete ".$sql_registre." est executee<br>";
				$contenu[0][0]='';
				$contenu[1][0]=_('choisir')."&nbsp;"._('registre');
				$k=1;
					while ($row=& $res->fetchRow()){
						$contenu[0][$k]=$row[0];
						$contenu[1][$k]=$row[1];
						$k++;
				}
				$form->setSelect('registre',$contenu);
			}// fin error db
		}// fin maj
	}// fin select

	//==================================
	// sous Formulaire  [subform]
	//==================================

	function setValsousformulaire(&$form,$maj,$validation,$idxformulaire,$retourformulaire,$typeformulaire,&$db,$DEBUG=null){
		$this->retourformulaire = $retourformulaire;
		if($validation==0) {
			if($retourformulaire =='registre')
				$form->setVal('registre', $idxformulaire);
		}// fin validation
	}// fin setValsousformulaire

	//==================================
	// cle secondaire  [secondary key]
	//==================================

}// fin classe
?>