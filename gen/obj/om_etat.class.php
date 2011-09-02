<?php
//$Id$ 
//gen openMairie le 02/09/2011 16:50 
require_once (PATH_OPENMAIRIE."dbformdyn.class.php");

class om_etat_gen extends dbForm {
	var $table="om_etat";
	var $clePrimaire="om_etat";
	var $typeCle="N";
	var $retourformulaire;

	function setvalF($val) {
	//affectation valeur formulaire
		$this->valF['om_etat'] = $val['om_etat'];
		$this->valF['om_collectivite'] = $val['om_collectivite'];
		$this->valF['id'] = $val['id'];
		$this->valF['libelle'] = $val['libelle'];
		$this->valF['actif'] = $val['actif'];
		$this->valF['orientation'] = $val['orientation'];
		$this->valF['format'] = $val['format'];
		$this->valF['footerfont'] = $val['footerfont'];
		$this->valF['footerattribut'] = $val['footerattribut'];
		$this->valF['footertaille'] = $val['footertaille'];
		$this->valF['logo'] = $val['logo'];
		$this->valF['logoleft'] = $val['logoleft'];
		$this->valF['logotop'] = $val['logotop'];
		$this->valF['titre'] = $val['titre'];
		$this->valF['titreleft'] = $val['titreleft'];
		$this->valF['titretop'] = $val['titretop'];
		$this->valF['titrelargeur'] = $val['titrelargeur'];
		$this->valF['titrehauteur'] = $val['titrehauteur'];
		$this->valF['titrefont'] = $val['titrefont'];
		$this->valF['titreattribut'] = $val['titreattribut'];
		$this->valF['titretaille'] = $val['titretaille'];
		$this->valF['titrebordure'] = $val['titrebordure'];
		$this->valF['titrealign'] = $val['titrealign'];
		$this->valF['corps'] = $val['corps'];
		$this->valF['corpsleft'] = $val['corpsleft'];
		$this->valF['corpstop'] = $val['corpstop'];
		$this->valF['corpslargeur'] = $val['corpslargeur'];
		$this->valF['corpshauteur'] = $val['corpshauteur'];
		$this->valF['corpsfont'] = $val['corpsfont'];
		$this->valF['corpsattribut'] = $val['corpsattribut'];
		$this->valF['corpstaille'] = $val['corpstaille'];
		$this->valF['corpsbordure'] = $val['corpsbordure'];
		$this->valF['corpsalign'] = $val['corpsalign'];
		$this->valF['om_sql'] = $val['om_sql'];
		$this->valF['sousetat'] = $val['sousetat'];
		$this->valF['se_font'] = $val['se_font'];
		$this->valF['se_margeleft'] = $val['se_margeleft'];
		$this->valF['se_margetop'] = $val['se_margetop'];
		$this->valF['se_margeright'] = $val['se_margeright'];
		$this->valF['se_couleurtexte'] = $val['se_couleurtexte'];
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
        if ($this->valF['om_collectivite'] == "") {
            $this->correct = false;
            $this->addToMessage(_("Le champ")." "._("om_collectivite")." "._("est obligatoire"));
        }
    }


	//==========================
	// Formulaire  [form]
	//==========================

	function setType(&$form,$maj) {
		//type
		if ($maj==0){ //ajout
			$form->setType('om_etat','hidden');// cle automatique
			if($this->retourformulaire=='om_collectivite')
				$form->setType('om_collectivite','hiddenstatic');
			else
				if($_SESSION['niveau']==2)
					$form->setType('om_collectivite','select');
				else
					$form->setType('om_collectivite','hiddenstatic');
			$form->setType('id','text');
			$form->setType('libelle','text');
			$form->setType('actif','text');
			$form->setType('orientation','text');
			$form->setType('format','text');
			$form->setType('footerfont','text');
			$form->setType('footerattribut','text');
			$form->setType('footertaille','text');
			$form->setType('logo','text');
			$form->setType('logoleft','text');
			$form->setType('logotop','text');
			$form->setType('titre','textarea');
			$form->setType('titreleft','text');
			$form->setType('titretop','text');
			$form->setType('titrelargeur','text');
			$form->setType('titrehauteur','text');
			$form->setType('titrefont','text');
			$form->setType('titreattribut','text');
			$form->setType('titretaille','text');
			$form->setType('titrebordure','text');
			$form->setType('titrealign','text');
			$form->setType('corps','textarea');
			$form->setType('corpsleft','text');
			$form->setType('corpstop','text');
			$form->setType('corpslargeur','text');
			$form->setType('corpshauteur','text');
			$form->setType('corpsfont','text');
			$form->setType('corpsattribut','text');
			$form->setType('corpstaille','text');
			$form->setType('corpsbordure','text');
			$form->setType('corpsalign','text');
			$form->setType('om_sql','textarea');
			$form->setType('sousetat','textarea');
			$form->setType('se_font','text');
			$form->setType('se_margeleft','text');
			$form->setType('se_margetop','text');
			$form->setType('se_margeright','text');
			$form->setType('se_couleurtexte','text');
		}// fin ajout
		if ($maj==1){ //modifier
			$form->setType('om_etat','hiddenstatic');
			if($this->retourformulaire=='om_collectivite')
				$form->setType('om_collectivite','hiddenstatic');
			else
				if($_SESSION['niveau']==2)
					$form->setType('om_collectivite','select');
				else
					$form->setType('om_collectivite','hiddenstatic');
			$form->setType('id','text');
			$form->setType('libelle','text');
			$form->setType('actif','text');
			$form->setType('orientation','text');
			$form->setType('format','text');
			$form->setType('footerfont','text');
			$form->setType('footerattribut','text');
			$form->setType('footertaille','text');
			$form->setType('logo','text');
			$form->setType('logoleft','text');
			$form->setType('logotop','text');
			$form->setType('titre','textarea');
			$form->setType('titreleft','text');
			$form->setType('titretop','text');
			$form->setType('titrelargeur','text');
			$form->setType('titrehauteur','text');
			$form->setType('titrefont','text');
			$form->setType('titreattribut','text');
			$form->setType('titretaille','text');
			$form->setType('titrebordure','text');
			$form->setType('titrealign','text');
			$form->setType('corps','textarea');
			$form->setType('corpsleft','text');
			$form->setType('corpstop','text');
			$form->setType('corpslargeur','text');
			$form->setType('corpshauteur','text');
			$form->setType('corpsfont','text');
			$form->setType('corpsattribut','text');
			$form->setType('corpstaille','text');
			$form->setType('corpsbordure','text');
			$form->setType('corpsalign','text');
			$form->setType('om_sql','textarea');
			$form->setType('sousetat','textarea');
			$form->setType('se_font','text');
			$form->setType('se_margeleft','text');
			$form->setType('se_margetop','text');
			$form->setType('se_margeright','text');
			$form->setType('se_couleurtexte','text');
		}// fin modifier
		if ($maj==2){ //supprimer
			$form->setType('om_etat','hiddenstatic');
			$form->setType('om_collectivite','hiddenstatic');
			$form->setType('id','hiddenstatic');
			$form->setType('libelle','hiddenstatic');
			$form->setType('actif','hiddenstatic');
			$form->setType('orientation','hiddenstatic');
			$form->setType('format','hiddenstatic');
			$form->setType('footerfont','hiddenstatic');
			$form->setType('footerattribut','hiddenstatic');
			$form->setType('footertaille','hiddenstatic');
			$form->setType('logo','hiddenstatic');
			$form->setType('logoleft','hiddenstatic');
			$form->setType('logotop','hiddenstatic');
			$form->setType('titre','hiddenstatic');
			$form->setType('titreleft','hiddenstatic');
			$form->setType('titretop','hiddenstatic');
			$form->setType('titrelargeur','hiddenstatic');
			$form->setType('titrehauteur','hiddenstatic');
			$form->setType('titrefont','hiddenstatic');
			$form->setType('titreattribut','hiddenstatic');
			$form->setType('titretaille','hiddenstatic');
			$form->setType('titrebordure','hiddenstatic');
			$form->setType('titrealign','hiddenstatic');
			$form->setType('corps','hiddenstatic');
			$form->setType('corpsleft','hiddenstatic');
			$form->setType('corpstop','hiddenstatic');
			$form->setType('corpslargeur','hiddenstatic');
			$form->setType('corpshauteur','hiddenstatic');
			$form->setType('corpsfont','hiddenstatic');
			$form->setType('corpsattribut','hiddenstatic');
			$form->setType('corpstaille','hiddenstatic');
			$form->setType('corpsbordure','hiddenstatic');
			$form->setType('corpsalign','hiddenstatic');
			$form->setType('om_sql','hiddenstatic');
			$form->setType('sousetat','hiddenstatic');
			$form->setType('se_font','hiddenstatic');
			$form->setType('se_margeleft','hiddenstatic');
			$form->setType('se_margetop','hiddenstatic');
			$form->setType('se_margeright','hiddenstatic');
			$form->setType('se_couleurtexte','hiddenstatic');
		}//fin supprimer
	}

	function setOnchange(&$form,$maj) {
	//javascript controle client
		$form->setOnchange('om_etat','VerifNum(this)');
		$form->setOnchange('om_collectivite','VerifNum(this)');
		$form->setOnchange('footertaille','VerifNum(this)');
		$form->setOnchange('logoleft','VerifNum(this)');
		$form->setOnchange('logotop','VerifNum(this)');
		$form->setOnchange('titreleft','VerifNum(this)');
		$form->setOnchange('titretop','VerifNum(this)');
		$form->setOnchange('titrelargeur','VerifNum(this)');
		$form->setOnchange('titrehauteur','VerifNum(this)');
		$form->setOnchange('titretaille','VerifNum(this)');
		$form->setOnchange('corpsleft','VerifNum(this)');
		$form->setOnchange('corpstop','VerifNum(this)');
		$form->setOnchange('corpslargeur','VerifNum(this)');
		$form->setOnchange('corpshauteur','VerifNum(this)');
		$form->setOnchange('corpstaille','VerifNum(this)');
		$form->setOnchange('se_margeleft','VerifNum(this)');
		$form->setOnchange('se_margetop','VerifNum(this)');
		$form->setOnchange('se_margeright','VerifNum(this)');
	}

	function setTaille(&$form,$maj) {
	//taille des champs affiches (text)
		$form->setTaille('om_etat',11);
		$form->setTaille('om_collectivite',11);
		$form->setTaille('id',50);
		$form->setTaille('libelle',50);
		$form->setTaille('actif',3);
		$form->setTaille('orientation',2);
		$form->setTaille('format',5);
		$form->setTaille('footerfont',20);
		$form->setTaille('footerattribut',20);
		$form->setTaille('footertaille',8);
		$form->setTaille('logo',30);
		$form->setTaille('logoleft',8);
		$form->setTaille('logotop',8);
		$form->setTaille('titre',80);
		$form->setTaille('titreleft',8);
		$form->setTaille('titretop',8);
		$form->setTaille('titrelargeur',20);
		$form->setTaille('titrehauteur',8);
		$form->setTaille('titrefont',20);
		$form->setTaille('titreattribut',20);
		$form->setTaille('titretaille',8);
		$form->setTaille('titrebordure',20);
		$form->setTaille('titrealign',20);
		$form->setTaille('corps',80);
		$form->setTaille('corpsleft',8);
		$form->setTaille('corpstop',8);
		$form->setTaille('corpslargeur',8);
		$form->setTaille('corpshauteur',8);
		$form->setTaille('corpsfont',20);
		$form->setTaille('corpsattribut',20);
		$form->setTaille('corpstaille',8);
		$form->setTaille('corpsbordure',20);
		$form->setTaille('corpsalign',20);
		$form->setTaille('om_sql',80);
		$form->setTaille('sousetat',80);
		$form->setTaille('se_font',20);
		$form->setTaille('se_margeleft',8);
		$form->setTaille('se_margetop',8);
		$form->setTaille('se_margeright',8);
		$form->setTaille('se_couleurtexte',11);
	}

	function setMax(&$form,$maj) {
	//longueur max en saisie (text)
		$form->setMax('om_etat',11);
		$form->setMax('om_collectivite',11);
		$form->setMax('id',50);
		$form->setMax('libelle',50);
		$form->setMax('actif',3);
		$form->setMax('orientation',2);
		$form->setMax('format',5);
		$form->setMax('footerfont',20);
		$form->setMax('footerattribut',20);
		$form->setMax('footertaille',8);
		$form->setMax('logo',30);
		$form->setMax('logoleft',8);
		$form->setMax('logotop',8);
		$form->setMax('titre',6);
		$form->setMax('titreleft',8);
		$form->setMax('titretop',8);
		$form->setMax('titrelargeur',20);
		$form->setMax('titrehauteur',8);
		$form->setMax('titrefont',20);
		$form->setMax('titreattribut',20);
		$form->setMax('titretaille',8);
		$form->setMax('titrebordure',20);
		$form->setMax('titrealign',20);
		$form->setMax('corps',6);
		$form->setMax('corpsleft',8);
		$form->setMax('corpstop',8);
		$form->setMax('corpslargeur',8);
		$form->setMax('corpshauteur',8);
		$form->setMax('corpsfont',20);
		$form->setMax('corpsattribut',20);
		$form->setMax('corpstaille',8);
		$form->setMax('corpsbordure',20);
		$form->setMax('corpsalign',20);
		$form->setMax('om_sql',6);
		$form->setMax('sousetat',6);
		$form->setMax('se_font',20);
		$form->setMax('se_margeleft',8);
		$form->setMax('se_margetop',8);
		$form->setMax('se_margeright',8);
		$form->setMax('se_couleurtexte',11);
	}

	function setLib(&$form,$maj) {
	//libelle des champs
		$form->setLib('om_etat',_('om_etat'));
		$form->setLib('om_collectivite',_('om_collectivite'));
		$form->setLib('id',_('id'));
		$form->setLib('libelle',_('libelle'));
		$form->setLib('actif',_('actif'));
		$form->setLib('orientation',_('orientation'));
		$form->setLib('format',_('format'));
		$form->setLib('footerfont',_('footerfont'));
		$form->setLib('footerattribut',_('footerattribut'));
		$form->setLib('footertaille',_('footertaille'));
		$form->setLib('logo',_('logo'));
		$form->setLib('logoleft',_('logoleft'));
		$form->setLib('logotop',_('logotop'));
		$form->setLib('titre',_('titre'));
		$form->setLib('titreleft',_('titreleft'));
		$form->setLib('titretop',_('titretop'));
		$form->setLib('titrelargeur',_('titrelargeur'));
		$form->setLib('titrehauteur',_('titrehauteur'));
		$form->setLib('titrefont',_('titrefont'));
		$form->setLib('titreattribut',_('titreattribut'));
		$form->setLib('titretaille',_('titretaille'));
		$form->setLib('titrebordure',_('titrebordure'));
		$form->setLib('titrealign',_('titrealign'));
		$form->setLib('corps',_('corps'));
		$form->setLib('corpsleft',_('corpsleft'));
		$form->setLib('corpstop',_('corpstop'));
		$form->setLib('corpslargeur',_('corpslargeur'));
		$form->setLib('corpshauteur',_('corpshauteur'));
		$form->setLib('corpsfont',_('corpsfont'));
		$form->setLib('corpsattribut',_('corpsattribut'));
		$form->setLib('corpstaille',_('corpstaille'));
		$form->setLib('corpsbordure',_('corpsbordure'));
		$form->setLib('corpsalign',_('corpsalign'));
		$form->setLib('om_sql',_('om_sql'));
		$form->setLib('sousetat',_('sousetat'));
		$form->setLib('se_font',_('se_font'));
		$form->setLib('se_margeleft',_('se_margeleft'));
		$form->setLib('se_margetop',_('se_margetop'));
		$form->setLib('se_margeright',_('se_margeright'));
		$form->setLib('se_couleurtexte',_('se_couleurtexte'));
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