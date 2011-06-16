<?php
//$Id$ 
//gen openMairie le 12/05/2011 19:29 
require_once (PATH_OPENMAIRIE."formulairedyn.class.php");
require_once (PATH_OPENMAIRIE."dbformdyn.class.php");

class om_tdb_gen extends dbForm {
	var $table="om_tdb";
	var $clePrimaire="om_tdb";
	var $typeCle="N";
	var $retourformulaire;

	function setvalF($val) {
	//affectation valeur formulaire
		$this->valF['om_tdb'] = $val['om_tdb'];
		$this->valF['login'] = $val['login'];
		$this->valF['bloc'] = $val['bloc'];
		$this->valF['om_widget'] = $val['om_widget'];
		$this->valF['position'] = $val['position'];
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
		if ($this->valF['login']==""){
			$this->msg= $this->msg.$imgv._('login')."&nbsp;"._('obligatoire').$f;
			$this->correct=False;
		}
	} // fin verifier [end verify]

	//==========================
	// Formulaire  [form]
	//==========================

	function setType(&$form,$maj) {
		//type
		if ($maj==0){ //ajout
			$form->setType('om_tdb','hidden');// cle automatique
			$form->setType('login','text');
			$form->setType('bloc','text');
			if($this->retourformulaire=='om_widget')
				$form->setType('om_widget','hiddenstatic');
			else
				$form->setType('om_widget','select');
			$form->setType('position','text');
		}// fin ajout
		if ($maj==1){ //modifier
			$form->setType('om_tdb','hiddenstatic');
			$form->setType('login','text');
			$form->setType('bloc','text');
			if($this->retourformulaire=='om_widget')
				$form->setType('om_widget','hiddenstatic');
			else
				$form->setType('om_widget','select');
			$form->setType('position','text');
		}// fin modifier
		if ($maj==2){ //supprimer
			$form->setType('om_tdb','hiddenstatic');
			$form->setType('login','hiddenstatic');
			$form->setType('bloc','hiddenstatic');
			$form->setType('om_widget','hiddenstatic');
			$form->setType('position','hiddenstatic');
		}//fin supprimer
	}

	function setOnchange(&$form,$maj) {
	//javascript controle client
		$form->setOnchange('om_tdb','VerifNum(this)');
		$form->setOnchange('om_widget','VerifNum(this)');
		$form->setOnchange('position','VerifNum(this)');
	}

	function setTaille(&$form,$maj) {
	//taille des champs affiches (text)
		$form->setTaille('om_tdb',4);
		$form->setTaille('login',20);
		$form->setTaille('bloc',20);
		$form->setTaille('om_widget',4);
		$form->setTaille('position',4);
	}

	function setMax(&$form,$maj) {
	//longueur max en saisie (text)
		$form->setMax('om_tdb',4);
		$form->setMax('login',20);
		$form->setMax('bloc',20);
		$form->setMax('om_widget',4);
		$form->setMax('position',4);
	}

	function setLib(&$form,$maj) {
	//libelle des champs
		$form->setLib('om_tdb',_('om_tdb'));
		$form->setLib('login',_('login'));
		$form->setLib('bloc',_('bloc'));
		$form->setLib('om_widget',_('om_widget'));
		$form->setLib('position',_('position'));
	}

	function setSelect(&$form, $maj,&$db,$debug) {
		if(file_exists ("../sql/".$db->phptype."/".$this->table.".form.inc"))
			include ("../sql/".$db->phptype."/".$this->table.".form.inc");
		if($maj<2){
			// om_widget
			$contenu=array();
			$res = $db->query($sql_om_widget);
			if (database::isError($res))
				die($res->getMessage().$sql_om_widget);
			else{
				if ($debug == 1)
					echo " la requete ".$sql_om_widget." est executee<br>";
				$contenu[0][0]='';
				$contenu[1][0]=_('choisir')."&nbsp;"._('om_widget');
				$k=1;
					while ($row=& $res->fetchRow()){
						$contenu[0][$k]=$row[0];
						$contenu[1][$k]=$row[1];
						$k++;
				}
				$form->setSelect('om_widget',$contenu);
			}// fin error db
		}// fin maj
	}// fin select

	//==================================
	// sous Formulaire  [subform]
	//==================================

	function setValsousformulaire(&$form,$maj,$validation,$idxformulaire,$retourformulaire,$typeformulaire,&$db,$DEBUG=null){
		$this->retourformulaire = $retourformulaire;
		if($validation==0) {
			if($retourformulaire =='om_widget')
				$form->setVal('om_widget', $idxformulaire);
		}// fin validation
	}// fin setValsousformulaire

	//==================================
	// cle secondaire  [secondary key]
	//==================================

}// fin classe
?>