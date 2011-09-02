<?php
//$Id$ 
//gen openMairie le 02/09/2011 16:50 
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
		$this->valF['position'] = $val['position'];
		$this->valF['om_widget'] = $val['om_widget'];
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
        if ($this->valF['login'] == "") {
            $this->correct = false;
            $this->addToMessage(_("Le champ")." "._("login")." "._("est obligatoire"));
        }
    }


	//==========================
	// Formulaire  [form]
	//==========================

	function setType(&$form,$maj) {
		//type
		if ($maj==0){ //ajout
			$form->setType('om_tdb','hidden');// cle automatique
			$form->setType('login','text');
			$form->setType('bloc','text');
			$form->setType('position','text');
			if($this->retourformulaire=='om_widget')
				$form->setType('om_widget','hiddenstatic');
			else
				$form->setType('om_widget','select');
		}// fin ajout
		if ($maj==1){ //modifier
			$form->setType('om_tdb','hiddenstatic');
			$form->setType('login','text');
			$form->setType('bloc','text');
			$form->setType('position','text');
			if($this->retourformulaire=='om_widget')
				$form->setType('om_widget','hiddenstatic');
			else
				$form->setType('om_widget','select');
		}// fin modifier
		if ($maj==2){ //supprimer
			$form->setType('om_tdb','hiddenstatic');
			$form->setType('login','hiddenstatic');
			$form->setType('bloc','hiddenstatic');
			$form->setType('position','hiddenstatic');
			$form->setType('om_widget','hiddenstatic');
		}//fin supprimer
	}

	function setOnchange(&$form,$maj) {
	//javascript controle client
		$form->setOnchange('om_tdb','VerifNum(this)');
		$form->setOnchange('position','VerifNum(this)');
		$form->setOnchange('om_widget','VerifNum(this)');
	}

	function setTaille(&$form,$maj) {
	//taille des champs affiches (text)
		$form->setTaille('om_tdb',8);
		$form->setTaille('login',40);
		$form->setTaille('bloc',10);
		$form->setTaille('position',8);
		$form->setTaille('om_widget',8);
	}

	function setMax(&$form,$maj) {
	//longueur max en saisie (text)
		$form->setMax('om_tdb',8);
		$form->setMax('login',40);
		$form->setMax('bloc',10);
		$form->setMax('position',8);
		$form->setMax('om_widget',8);
	}

	function setLib(&$form,$maj) {
	//libelle des champs
		$form->setLib('om_tdb',_('om_tdb'));
		$form->setLib('login',_('login'));
		$form->setLib('bloc',_('bloc'));
		$form->setLib('position',_('position'));
		$form->setLib('om_widget',_('om_widget'));
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