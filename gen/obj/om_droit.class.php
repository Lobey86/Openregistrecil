<?php
//$Id$ 
//gen openMairie le 02/09/2011 16:50 
require_once (PATH_OPENMAIRIE."dbformdyn.class.php");

class om_droit_gen extends dbForm {
	var $table="om_droit";
	var $clePrimaire="om_droit";
	var $typeCle="A";
	var $retourformulaire;

	function setvalF($val) {
	//affectation valeur formulaire
		$this->valF['om_droit'] = $val['om_droit'];
		$this->valF['om_profil'] = $val['om_profil'];
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
        if ($this->valF['om_profil'] == "") {
            $this->correct = false;
            $this->addToMessage(_("Le champ")." "._("om_profil")." "._("est obligatoire"));
        }
    }


	//==========================
	// Formulaire  [form]
	//==========================

	function setType(&$form,$maj) {
		//type
		if ($maj==0){ //ajout
			$form->setType('om_droit','text');
			if($this->retourformulaire=='om_profil')
				$form->setType('om_profil','hiddenstatic');
			else
				$form->setType('om_profil','select');
		}// fin ajout
		if ($maj==1){ //modifier
			$form->setType('om_droit','hiddenstatic');
			if($this->retourformulaire=='om_profil')
				$form->setType('om_profil','hiddenstatic');
			else
				$form->setType('om_profil','select');
		}// fin modifier
		if ($maj==2){ //supprimer
			$form->setType('om_droit','hiddenstatic');
			$form->setType('om_profil','hiddenstatic');
		}//fin supprimer
	}

	function setOnchange(&$form,$maj) {
	//javascript controle client
	}

	function setTaille(&$form,$maj) {
	//taille des champs affiches (text)
		$form->setTaille('om_droit',30);
		$form->setTaille('om_profil',2);
	}

	function setMax(&$form,$maj) {
	//longueur max en saisie (text)
		$form->setMax('om_droit',30);
		$form->setMax('om_profil',2);
	}

	function setLib(&$form,$maj) {
	//libelle des champs
		$form->setLib('om_droit',_('om_droit'));
		$form->setLib('om_profil',_('om_profil'));
	}

	function setSelect(&$form, $maj,&$db,$debug) {
		if(file_exists ("../sql/".$db->phptype."/".$this->table.".form.inc"))
			include ("../sql/".$db->phptype."/".$this->table.".form.inc");
		if($maj<2){
			// om_profil
			$contenu=array();
			$res = $db->query($sql_om_profil);
			if (database::isError($res))
				die($res->getMessage().$sql_om_profil);
			else{
				if ($debug == 1)
					echo " la requete ".$sql_om_profil." est executee<br>";
				$contenu[0][0]='';
				$contenu[1][0]=_('choisir')."&nbsp;"._('om_profil');
				$k=1;
					while ($row=& $res->fetchRow()){
						$contenu[0][$k]=$row[0];
						$contenu[1][$k]=$row[1];
						$k++;
				}
				$form->setSelect('om_profil',$contenu);
			}// fin error db
		}// fin maj
	}// fin select

	//==================================
	// sous Formulaire  [subform]
	//==================================

	function setValsousformulaire(&$form,$maj,$validation,$idxformulaire,$retourformulaire,$typeformulaire,&$db,$DEBUG=null){
		$this->retourformulaire = $retourformulaire;
		if($validation==0) {
			if($retourformulaire =='om_profil')
				$form->setVal('om_profil', $idxformulaire);
		}// fin validation
	}// fin setValsousformulaire

	//==================================
	// cle secondaire  [secondary key]
	//==================================

}// fin classe
?>