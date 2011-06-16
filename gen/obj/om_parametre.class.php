<?php
//$Id$ 
//gen openMairie le 06/12/2010 15:57 
require_once (PATH_OPENMAIRIE."formulairedyn.class.php");
require_once (PATH_OPENMAIRIE."dbformdyn.class.php");

class om_parametre_gen extends dbForm {
	var $table="om_parametre";
	var $clePrimaire="om_parametre";
	var $typeCle="N";
	var $retourformulaire;

	function setvalF($val) {
	//affectation valeur formulaire
		$this->valF['om_parametre'] = $val['om_parametre'];
		$this->valF['libelle'] = $val['libelle'];
		$this->valF['valeur'] = $val['valeur'];
		$this->valF['om_collectivite'] = $val['om_collectivite'];
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
			$form->setType('om_parametre','hidden');// cle automatique
			$form->setType('libelle','text');
			$form->setType('valeur','text');
			if($this->retourformulaire=='om_collectivite')
				$form->setType('om_collectivite','hiddenstatic');
			else
				if($_SESSION['niveau']==2)
					$form->setType('om_collectivite','select');
				else
					$form->setType('om_collectivite','hiddenstatic');
		}// fin ajout
		if ($maj==1){ //modifier
			$form->setType('om_parametre','hiddenstatic');
			$form->setType('libelle','text');
			$form->setType('valeur','text');
			if($this->retourformulaire=='om_collectivite')
				$form->setType('om_collectivite','hiddenstatic');
			else
				if($_SESSION['niveau']==2)
					$form->setType('om_collectivite','select');
				else
					$form->setType('om_collectivite','hiddenstatic');
		}// fin modifier
		if ($maj==2){ //supprimer
			$form->setType('om_parametre','hiddenstatic');
			$form->setType('libelle','hiddenstatic');
			$form->setType('valeur','hiddenstatic');
			$form->setType('om_collectivite','hiddenstatic');
		}//fin supprimer
	}

	function setOnchange(&$form,$maj) {
	//javascript controle client
		$form->setOnchange('om_parametre','VerifNum(this)');
		$form->setOnchange('om_collectivite','VerifNum(this)');
	}

	function setTaille(&$form,$maj) {
	//taille des champs affiches (text)
		$form->setTaille('om_parametre',11);
		$form->setTaille('libelle',20);
		$form->setTaille('valeur',50);
		$form->setTaille('om_collectivite',11);
	}

	function setMax(&$form,$maj) {
	//longueur max en saisie (text)
		$form->setMax('om_parametre',11);
		$form->setMax('libelle',20);
		$form->setMax('valeur',50);
		$form->setMax('om_collectivite',11);
	}

	function setLib(&$form,$maj) {
	//libelle des champs
		$form->setLib('om_parametre',_('om_parametre'));
		$form->setLib('libelle',_('libelle'));
		$form->setLib('valeur',_('valeur'));
		$form->setLib('om_collectivite',_('om_collectivite'));
	}

	function setSelect(&$form, $maj,&$db,$debug) {
		if(file_exists ("../sql/".$db->phptype."/".$this->table.".form.inc"))
			include ("../sql/".$db->phptype."/".$this->table.".form.inc");
		if($maj<2){
			// om_collectivite
			$contenu=array();
			$res = $db->query($sql_om_collectivite);
			if (database::isError($res))
				die($res->getMessage().$sql_om_collectivite);
			else{
				if ($debug == 1)
					echo " la requete ".$sql_om_collectivite." est executee<br>";
				$contenu[0][0]='';
				$contenu[1][0]=_('choisir')."&nbsp;"._('om_collectivite');
				$k=1;
					while ($row=& $res->fetchRow()){
						$contenu[0][$k]=$row[0];
						$contenu[1][$k]=$row[1];
						$k++;
				}
				$form->setSelect('om_collectivite',$contenu);
			}// fin error db
		}// fin maj
	}// fin select

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
		if($validation==0) {
			if($retourformulaire =='om_collectivite')
				$form->setVal('om_collectivite', $idxformulaire);
		}// fin validation
	}// fin setValsousformulaire

	//==================================
	// cle secondaire  [secondary key]
	//==================================

}// fin classe
?>