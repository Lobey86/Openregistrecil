<?php
//$Id$ 
//gen openMairie le 17/05/2011 11:40 
require_once (PATH_OPENMAIRIE."formulairedyn.class.php");
require_once (PATH_OPENMAIRIE."dbformdyn.class.php");

class destinataire_gen extends dbForm {
	var $table="destinataire";
	var $clePrimaire="destinataire";
	var $typeCle="N";
	var $retourformulaire;

	function setvalF($val) {
	//affectation valeur formulaire
		$this->valF['destinataire'] = $val['destinataire'];
		$this->valF['organisme'] = $val['organisme'];
		$this->valF['libelle'] = $val['libelle'];
		$this->valF['categorie_donnee'] = $val['categorie_donnee'];
		$this->valF['registre'] = $val['registre'];
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
		if ($this->valF['organisme']==""){
			$this->msg= $this->msg.$imgv._('organisme')."&nbsp;"._('obligatoire').$f;
			$this->correct=False;
		}
	} // fin verifier [end verify]

	//==========================
	// Formulaire  [form]
	//==========================

	function setType(&$form,$maj) {
		//type
		if ($maj==0){ //ajout
			$form->setType('destinataire','hidden');// cle automatique
			if($this->retourformulaire=='organisme')
				$form->setType('organisme','hiddenstatic');
			else
				$form->setType('organisme','select');
			$form->setType('libelle','text');
			$form->setType('categorie_donnee','textarea');
			if($this->retourformulaire=='registre')
				$form->setType('registre','hiddenstatic');
			else
				$form->setType('registre','select');
		}// fin ajout
		if ($maj==1){ //modifier
			$form->setType('destinataire','hiddenstatic');
			if($this->retourformulaire=='organisme')
				$form->setType('organisme','hiddenstatic');
			else
				$form->setType('organisme','select');
			$form->setType('libelle','text');
			$form->setType('categorie_donnee','textarea');
			if($this->retourformulaire=='registre')
				$form->setType('registre','hiddenstatic');
			else
				$form->setType('registre','select');
		}// fin modifier
		if ($maj==2){ //supprimer
			$form->setType('destinataire','hiddenstatic');
			$form->setType('organisme','hiddenstatic');
			$form->setType('libelle','hiddenstatic');
			$form->setType('categorie_donnee','hiddenstatic');
			$form->setType('registre','hiddenstatic');
		}//fin supprimer
	}

	function setOnchange(&$form,$maj) {
	//javascript controle client
		$form->setOnchange('destinataire','VerifNum(this)');
		$form->setOnchange('registre','VerifNum(this)');
	}

	function setTaille(&$form,$maj) {
	//taille des champs affiches (text)
		$form->setTaille('destinataire',8);
		$form->setTaille('organisme',20);
		$form->setTaille('libelle',60);
		$form->setTaille('categorie_donnee',80);
		$form->setTaille('registre',8);
	}

	function setMax(&$form,$maj) {
	//longueur max en saisie (text)
		$form->setMax('destinataire',8);
		$form->setMax('organisme',20);
		$form->setMax('libelle',60);
		$form->setMax('categorie_donnee',6);
		$form->setMax('registre',8);
	}

	function setLib(&$form,$maj) {
	//libelle des champs
		$form->setLib('destinataire',_('destinataire'));
		$form->setLib('organisme',_('organisme'));
		$form->setLib('libelle',_('libelle'));
		$form->setLib('categorie_donnee',_('categorie_donnee'));
		$form->setLib('registre',_('registre'));
	}

	function setSelect(&$form, $maj,&$db,$debug) {
		if(file_exists ("../sql/".$db->phptype."/".$this->table.".form.inc"))
			include ("../sql/".$db->phptype."/".$this->table.".form.inc");
		if($maj<2){
			// organisme
			$contenu=array();
			$res = $db->query($sql_organisme);
			if (database::isError($res))
				die($res->getMessage().$sql_organisme);
			else{
				if ($debug == 1)
					echo " la requete ".$sql_organisme." est executee<br>";
				$contenu[0][0]='';
				$contenu[1][0]=_('choisir')."&nbsp;"._('organisme');
				$k=1;
					while ($row=& $res->fetchRow()){
						$contenu[0][$k]=$row[0];
						$contenu[1][$k]=$row[1];
						$k++;
				}
				$form->setSelect('organisme',$contenu);
			}// fin error db
			// categorie_donnee
			$contenu=array();
			$res = $db->query($sql_categorie_donnee);
			if (database::isError($res))
				die($res->getMessage().$sql_categorie_donnee);
			else{
				if ($debug == 1)
					echo " la requete ".$sql_categorie_donnee." est executee<br>";
				$contenu[0][0]='';
				$contenu[1][0]=_('choisir')."&nbsp;"._('categorie_donnee');
				$k=1;
					while ($row=& $res->fetchRow()){
						$contenu[0][$k]=$row[0];
						$contenu[1][$k]=$row[1];
						$k++;
				}
				$form->setSelect('categorie_donnee',$contenu);
			}// fin error db
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
			if($retourformulaire =='organisme')
				$form->setVal('organisme', $idxformulaire);
			if($retourformulaire =='categorie_donnee')
				$form->setVal('categorie_donnee', $idxformulaire);
			if($retourformulaire =='registre')
				$form->setVal('registre', $idxformulaire);
		}// fin validation
	}// fin setValsousformulaire

	//==================================
	// cle secondaire  [secondary key]
	//==================================

}// fin classe
?>