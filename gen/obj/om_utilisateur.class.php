<?php
//$Id$ 
//gen openMairie le 06/12/2010 15:57 
require_once (PATH_OPENMAIRIE."formulairedyn.class.php");
require_once (PATH_OPENMAIRIE."dbformdyn.class.php");

class om_utilisateur_gen extends dbForm {
	var $table="om_utilisateur";
	var $clePrimaire="om_utilisateur";
	var $typeCle="N";
	var $retourformulaire;

	function setvalF($val) {
	//affectation valeur formulaire
		$this->valF['om_utilisateur'] = $val['om_utilisateur'];
		$this->valF['nom'] = $val['nom'];
		$this->valF['email'] = $val['email'];
		$this->valF['login'] = $val['login'];
		$this->valF['pwd'] = $val['pwd'];
		$this->valF['om_profil'] = $val['om_profil'];
		$this->valF['om_collectivite'] = $val['om_collectivite'];
		$this->valF['om_type'] = $val['om_type'];
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
		if ($this->valF['nom']==""){
			$this->msg= $this->msg.$imgv._('nom')."&nbsp;"._('obligatoire').$f;
			$this->correct=False;
		}
	} // fin verifier [end verify]

	//==========================
	// Formulaire  [form]
	//==========================

	function setType(&$form,$maj) {
		//type
		if ($maj==0){ //ajout
			$form->setType('om_utilisateur','hidden');// cle automatique
			$form->setType('nom','text');
			$form->setType('email','text');
			$form->setType('login','text');
			$form->setType('pwd','text');
			if($this->retourformulaire=='om_profil')
				$form->setType('om_profil','hiddenstatic');
			else
				$form->setType('om_profil','select');
			if($this->retourformulaire=='om_collectivite')
				$form->setType('om_collectivite','hiddenstatic');
			else
				if($_SESSION['niveau']==2)
					$form->setType('om_collectivite','select');
				else
					$form->setType('om_collectivite','hiddenstatic');
			$form->setType('om_type','text');
		}// fin ajout
		if ($maj==1){ //modifier
			$form->setType('om_utilisateur','hiddenstatic');
			$form->setType('nom','text');
			$form->setType('email','text');
			$form->setType('login','text');
			$form->setType('pwd','text');
			if($this->retourformulaire=='om_profil')
				$form->setType('om_profil','hiddenstatic');
			else
				$form->setType('om_profil','select');
			if($this->retourformulaire=='om_collectivite')
				$form->setType('om_collectivite','hiddenstatic');
			else
				if($_SESSION['niveau']==2)
					$form->setType('om_collectivite','select');
				else
					$form->setType('om_collectivite','hiddenstatic');
			$form->setType('om_type','text');
		}// fin modifier
		if ($maj==2){ //supprimer
			$form->setType('om_utilisateur','hiddenstatic');
			$form->setType('nom','hiddenstatic');
			$form->setType('email','hiddenstatic');
			$form->setType('login','hiddenstatic');
			$form->setType('pwd','hiddenstatic');
			$form->setType('om_profil','hiddenstatic');
			$form->setType('om_collectivite','hiddenstatic');
			$form->setType('om_type','hiddenstatic');
		}//fin supprimer
	}

	function setOnchange(&$form,$maj) {
	//javascript controle client
		$form->setOnchange('om_utilisateur','VerifNum(this)');
		$form->setOnchange('om_collectivite','VerifNum(this)');
	}

	function setTaille(&$form,$maj) {
	//taille des champs affiches (text)
		$form->setTaille('om_utilisateur',8);
		$form->setTaille('nom',30);
		$form->setTaille('email',40);
		$form->setTaille('login',30);
		$form->setTaille('pwd',100);
		$form->setTaille('om_profil',2);
		$form->setTaille('om_collectivite',11);
		$form->setTaille('om_type',20);
	}

	function setMax(&$form,$maj) {
	//longueur max en saisie (text)
		$form->setMax('om_utilisateur',8);
		$form->setMax('nom',30);
		$form->setMax('email',40);
		$form->setMax('login',30);
		$form->setMax('pwd',100);
		$form->setMax('om_profil',2);
		$form->setMax('om_collectivite',11);
		$form->setMax('om_type',20);
	}

	function setLib(&$form,$maj) {
	//libelle des champs
		$form->setLib('om_utilisateur',_('om_utilisateur'));
		$form->setLib('nom',_('nom'));
		$form->setLib('email',_('email'));
		$form->setLib('login',_('login'));
		$form->setLib('pwd',_('pwd'));
		$form->setLib('om_profil',_('om_profil'));
		$form->setLib('om_collectivite',_('om_collectivite'));
		$form->setLib('om_type',_('om_type'));
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
			if($retourformulaire =='om_profil')
				$form->setVal('om_profil', $idxformulaire);
			if($retourformulaire =='om_collectivite')
				$form->setVal('om_collectivite', $idxformulaire);
		}// fin validation
	}// fin setValsousformulaire

	//==================================
	// cle secondaire  [secondary key]
	//==================================

}// fin classe
?>