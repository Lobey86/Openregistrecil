<?php
//$Id$ 
//gen openMairie le 02/09/2011 16:50 
require_once (PATH_OPENMAIRIE."dbformdyn.class.php");

class modificatif_gen extends dbForm {
	var $table="modificatif";
	var $clePrimaire="modificatif";
	var $typeCle="N";
	var $retourformulaire;

	function setvalF($val) {
	//affectation valeur formulaire
		$this->valF['modificatif'] = $val['modificatif'];
	if($val['date_modificatif']!=""){
		$this->valF['date_modificatif'] = $this->dateDB($val['date_modificatif']);
	}
		$this->valF['note'] = $val['note'];
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
    /**
     * Methode verifier
     */
    function verifier($val = array(), &$db = NULL, $DEBUG = false) {
        // On appelle la methode de la classe parent
        parent::verifier($val, $db, $DEBUG);
        // On verifie si le champ n'est pas vide
        if ($this->valF['date_modificatif'] == "") {
            $this->correct = false;
            $this->addToMessage(_("Le champ")." "._("date_modificatif")." "._("est obligatoire"));
        }
    }


	//==========================
	// Formulaire  [form]
	//==========================

	function setType(&$form,$maj) {
		//type
		if ($maj==0){ //ajout
			$form->setType('modificatif','hidden');// cle automatique
			if($this->retourformulaire=='')
				$form->setType('date_modificatif','date');
			else
				$form->setType('date_modificatif','date2');
			$form->setType('note','textarea');
			if($this->retourformulaire=='registre')
				$form->setType('registre','hiddenstatic');
			else
				$form->setType('registre','select');
		}// fin ajout
		if ($maj==1){ //modifier
			$form->setType('modificatif','hiddenstatic');
			if($this->retourformulaire=='')
				$form->setType('date_modificatif','date');
			else
				$form->setType('date_modificatif','date2');
			$form->setType('note','textarea');
			if($this->retourformulaire=='registre')
				$form->setType('registre','hiddenstatic');
			else
				$form->setType('registre','select');
		}// fin modifier
		if ($maj==2){ //supprimer
			$form->setType('modificatif','hiddenstatic');
			$form->setType('date_modificatif','hiddenstatic');
			$form->setType('note','hiddenstatic');
			$form->setType('registre','hiddenstatic');
		}//fin supprimer
	}

	function setOnchange(&$form,$maj) {
	//javascript controle client
		$form->setOnchange('modificatif','VerifNum(this)');
		$form->setOnchange('date_modificatif','fdate(this)');
		$form->setOnchange('registre','VerifNum(this)');
	}

	function setTaille(&$form,$maj) {
	//taille des champs affiches (text)
		$form->setTaille('modificatif',8);
		$form->setTaille('date_modificatif',10);
		$form->setTaille('note',80);
		$form->setTaille('registre',8);
	}

	function setMax(&$form,$maj) {
	//longueur max en saisie (text)
		$form->setMax('modificatif',8);
		$form->setMax('date_modificatif',10);
		$form->setMax('note',6);
		$form->setMax('registre',8);
	}

	function setLib(&$form,$maj) {
	//libelle des champs
		$form->setLib('modificatif',_('modificatif'));
		$form->setLib('date_modificatif',_('date_modificatif'));
		$form->setLib('note',_('note'));
		$form->setLib('registre',_('registre'));
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