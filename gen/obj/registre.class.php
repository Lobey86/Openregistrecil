<?php
//$Id$ 
//gen openMairie le 02/09/2011 16:50 
require_once (PATH_OPENMAIRIE."dbformdyn.class.php");

class registre_gen extends dbForm {
	var $table="registre";
	var $clePrimaire="registre";
	var $typeCle="N";
	var $retourformulaire;

	function setvalF($val) {
	//affectation valeur formulaire
		$this->valF['registre'] = $val['registre'];
		$this->valF['finalite'] = $val['finalite'];
		$this->valF['numero_cnil'] = $val['numero_cnil'];
		$this->valF['note'] = $val['note'];
	if($val['date_registre']!=""){
		$this->valF['date_registre'] = $this->dateDB($val['date_registre']);
	}
		$this->valF['categorie_personne'] = $val['categorie_personne'];
		$this->valF['categorie_donnee'] = $val['categorie_donnee'];
		$this->valF['conservation'] = $val['conservation'];
		$this->valF['nature'] = $val['nature'];
		$this->valF['service'] = $val['service'];
		$this->valF['droit_acces'] = $val['droit_acces'];
	if($val['date_maj']!=""){
		$this->valF['date_maj'] = $this->dateDB($val['date_maj']);
	}
		$this->valF['reference'] = $val['reference'];
		$this->valF['avis'] = $val['avis'];
		$this->valF['exclusion'] = $val['exclusion'];
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
        if ($this->valF['finalite'] == "") {
            $this->correct = false;
            $this->addToMessage(_("Le champ")." "._("finalite")." "._("est obligatoire"));
        }
    }


	//==========================
	// Formulaire  [form]
	//==========================

	function setType(&$form,$maj) {
		//type
		if ($maj==0){ //ajout
			$form->setType('registre','hidden');// cle automatique
			$form->setType('finalite','text');
			$form->setType('numero_cnil','text');
			$form->setType('note','textarea');
			if($this->retourformulaire=='')
				$form->setType('date_registre','date');
			else
				$form->setType('date_registre','date2');
			$form->setType('categorie_personne','textarea');
			$form->setType('categorie_donnee','textarea');
			$form->setType('conservation','textarea');
			$form->setType('nature','text');
			if($this->retourformulaire=='service')
				$form->setType('service','hiddenstatic');
			else
				$form->setType('service','select');
			$form->setType('droit_acces','text');
			if($this->retourformulaire=='')
				$form->setType('date_maj','date');
			else
				$form->setType('date_maj','date2');
			if($this->retourformulaire=='reference')
				$form->setType('reference','hiddenstatic');
			else
				$form->setType('reference','select');
			$form->setType('avis','text');
			$form->setType('exclusion','textarea');
		}// fin ajout
		if ($maj==1){ //modifier
			$form->setType('registre','hiddenstatic');
			$form->setType('finalite','text');
			$form->setType('numero_cnil','text');
			$form->setType('note','textarea');
			if($this->retourformulaire=='')
				$form->setType('date_registre','date');
			else
				$form->setType('date_registre','date2');
			$form->setType('categorie_personne','textarea');
			$form->setType('categorie_donnee','textarea');
			$form->setType('conservation','textarea');
			$form->setType('nature','text');
			if($this->retourformulaire=='service')
				$form->setType('service','hiddenstatic');
			else
				$form->setType('service','select');
			$form->setType('droit_acces','text');
			if($this->retourformulaire=='')
				$form->setType('date_maj','date');
			else
				$form->setType('date_maj','date2');
			if($this->retourformulaire=='reference')
				$form->setType('reference','hiddenstatic');
			else
				$form->setType('reference','select');
			$form->setType('avis','text');
			$form->setType('exclusion','textarea');
		}// fin modifier
		if ($maj==2){ //supprimer
			$form->setType('registre','hiddenstatic');
			$form->setType('finalite','hiddenstatic');
			$form->setType('numero_cnil','hiddenstatic');
			$form->setType('note','hiddenstatic');
			$form->setType('date_registre','hiddenstatic');
			$form->setType('categorie_personne','hiddenstatic');
			$form->setType('categorie_donnee','hiddenstatic');
			$form->setType('conservation','hiddenstatic');
			$form->setType('nature','hiddenstatic');
			$form->setType('service','hiddenstatic');
			$form->setType('droit_acces','hiddenstatic');
			$form->setType('date_maj','hiddenstatic');
			$form->setType('reference','hiddenstatic');
			$form->setType('avis','hiddenstatic');
			$form->setType('exclusion','hiddenstatic');
		}//fin supprimer
	}

	function setOnchange(&$form,$maj) {
	//javascript controle client
		$form->setOnchange('registre','VerifNum(this)');
		$form->setOnchange('date_registre','fdate(this)');
		$form->setOnchange('date_maj','fdate(this)');
	}

	function setTaille(&$form,$maj) {
	//taille des champs affiches (text)
		$form->setTaille('registre',8);
		$form->setTaille('finalite',80);
		$form->setTaille('numero_cnil',20);
		$form->setTaille('note',80);
		$form->setTaille('date_registre',10);
		$form->setTaille('categorie_personne',80);
		$form->setTaille('categorie_donnee',80);
		$form->setTaille('conservation',80);
		$form->setTaille('nature',30);
		$form->setTaille('service',10);
		$form->setTaille('droit_acces',10);
		$form->setTaille('date_maj',10);
		$form->setTaille('reference',10);
		$form->setTaille('avis',3);
		$form->setTaille('exclusion',80);
	}

	function setMax(&$form,$maj) {
	//longueur max en saisie (text)
		$form->setMax('registre',8);
		$form->setMax('finalite',80);
		$form->setMax('numero_cnil',20);
		$form->setMax('note',6);
		$form->setMax('date_registre',10);
		$form->setMax('categorie_personne',6);
		$form->setMax('categorie_donnee',6);
		$form->setMax('conservation',6);
		$form->setMax('nature',30);
		$form->setMax('service',10);
		$form->setMax('droit_acces',10);
		$form->setMax('date_maj',10);
		$form->setMax('reference',10);
		$form->setMax('avis',3);
		$form->setMax('exclusion',6);
	}

	function setLib(&$form,$maj) {
	//libelle des champs
		$form->setLib('registre',_('registre'));
		$form->setLib('finalite',_('finalite'));
		$form->setLib('numero_cnil',_('numero_cnil'));
		$form->setLib('note',_('note'));
		$form->setLib('date_registre',_('date_registre'));
		$form->setLib('categorie_personne',_('categorie_personne'));
		$form->setLib('categorie_donnee',_('categorie_donnee'));
		$form->setLib('conservation',_('conservation'));
		$form->setLib('nature',_('nature'));
		$form->setLib('service',_('service'));
		$form->setLib('droit_acces',_('droit_acces'));
		$form->setLib('date_maj',_('date_maj'));
		$form->setLib('reference',_('reference'));
		$form->setLib('avis',_('avis'));
		$form->setLib('exclusion',_('exclusion'));
	}

	function setSelect(&$form, $maj,&$db,$debug) {
		if(file_exists ("../sql/".$db->phptype."/".$this->table.".form.inc"))
			include ("../sql/".$db->phptype."/".$this->table.".form.inc");
		if($maj<2){
			// categorie_personne
			$contenu=array();
			$res = $db->query($sql_categorie_personne);
			if (database::isError($res))
				die($res->getMessage().$sql_categorie_personne);
			else{
				if ($debug == 1)
					echo " la requete ".$sql_categorie_personne." est executee<br>";
				$contenu[0][0]='';
				$contenu[1][0]=_('choisir')."&nbsp;"._('categorie_personne');
				$k=1;
					while ($row=& $res->fetchRow()){
						$contenu[0][$k]=$row[0];
						$contenu[1][$k]=$row[1];
						$k++;
				}
				$form->setSelect('categorie_personne',$contenu);
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
			// service
			$contenu=array();
			$res = $db->query($sql_service);
			if (database::isError($res))
				die($res->getMessage().$sql_service);
			else{
				if ($debug == 1)
					echo " la requete ".$sql_service." est executee<br>";
				$contenu[0][0]='';
				$contenu[1][0]=_('choisir')."&nbsp;"._('service');
				$k=1;
					while ($row=& $res->fetchRow()){
						$contenu[0][$k]=$row[0];
						$contenu[1][$k]=$row[1];
						$k++;
				}
				$form->setSelect('service',$contenu);
			}// fin error db
			// reference
			$contenu=array();
			$res = $db->query($sql_reference);
			if (database::isError($res))
				die($res->getMessage().$sql_reference);
			else{
				if ($debug == 1)
					echo " la requete ".$sql_reference." est executee<br>";
				$contenu[0][0]='';
				$contenu[1][0]=_('choisir')."&nbsp;"._('reference');
				$k=1;
					while ($row=& $res->fetchRow()){
						$contenu[0][$k]=$row[0];
						$contenu[1][$k]=$row[1];
						$k++;
				}
				$form->setSelect('reference',$contenu);
			}// fin error db
		}// fin maj
	}// fin select

	//==================================
	// sous Formulaire  [subform]
	//==================================

	function setValsousformulaire(&$form,$maj,$validation,$idxformulaire,$retourformulaire,$typeformulaire,&$db,$DEBUG=null){
		$this->retourformulaire = $retourformulaire;
		if($validation==0) {
			if($retourformulaire =='categorie_personne')
				$form->setVal('categorie_personne', $idxformulaire);
			if($retourformulaire =='categorie_donnee')
				$form->setVal('categorie_donnee', $idxformulaire);
			if($retourformulaire =='service')
				$form->setVal('service', $idxformulaire);
			if($retourformulaire =='reference')
				$form->setVal('reference', $idxformulaire);
		}// fin validation
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
        // Verification de la cle secondaire : destinataire
        $this->rechercheTable($db, "destinataire", "registre", $id);
        // Verification de la cle secondaire : dossier
        $this->rechercheTable($db, "dossier", "registre", $id);
        // Verification de la cle secondaire : modificatif
        $this->rechercheTable($db, "modificatif", "registre", $id);
    }


}// fin classe
?>