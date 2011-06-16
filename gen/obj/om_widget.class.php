<?php
//$Id$ 
//gen openMairie le 12/05/2011 19:30 
require_once (PATH_OPENMAIRIE."formulairedyn.class.php");
require_once (PATH_OPENMAIRIE."dbformdyn.class.php");

class om_widget_gen extends dbForm {
	var $table="om_widget";
	var $clePrimaire="om_widget";
	var $typeCle="N";
	var $retourformulaire;

	function setvalF($val) {
	//affectation valeur formulaire
		$this->valF['om_widget'] = $val['om_widget'];
		$this->valF['om_collectivite'] = $val['om_collectivite'];
		$this->valF['libelle'] = $val['libelle'];
		$this->valF['lien'] = $val['lien'];
		$this->valF['texte'] = $val['texte'];
		$this->valF['om_profil'] = $val['om_profil'];
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
		if ($this->valF['om_collectivite']==""){
			$this->msg= $this->msg.$imgv._('om_collectivite')."&nbsp;"._('obligatoire').$f;
			$this->correct=False;
		}
	} // fin verifier [end verify]

	//==========================
	// Formulaire  [form]
	//==========================

	function setType(&$form,$maj) {
		//type
		if ($maj==0){ //ajout
			$form->setType('om_widget','hidden');// cle automatique
			if($this->retourformulaire=='om_collectivite')
				$form->setType('om_collectivite','hiddenstatic');
			else
				if($_SESSION['niveau']==2)
					$form->setType('om_collectivite','select');
				else
					$form->setType('om_collectivite','hiddenstatic');
			$form->setType('libelle','text');
			$form->setType('lien','text');
			$form->setType('texte','textarea');
			if($this->retourformulaire=='om_profil')
				$form->setType('om_profil','hiddenstatic');
			else
				$form->setType('om_profil','select');
		}// fin ajout
		if ($maj==1){ //modifier
			$form->setType('om_widget','hiddenstatic');
			if($this->retourformulaire=='om_collectivite')
				$form->setType('om_collectivite','hiddenstatic');
			else
				if($_SESSION['niveau']==2)
					$form->setType('om_collectivite','select');
				else
					$form->setType('om_collectivite','hiddenstatic');
			$form->setType('libelle','text');
			$form->setType('lien','text');
			$form->setType('texte','textarea');
			if($this->retourformulaire=='om_profil')
				$form->setType('om_profil','hiddenstatic');
			else
				$form->setType('om_profil','select');
		}// fin modifier
		if ($maj==2){ //supprimer
			$form->setType('om_widget','hiddenstatic');
			$form->setType('om_collectivite','hiddenstatic');
			$form->setType('libelle','hiddenstatic');
			$form->setType('lien','hiddenstatic');
			$form->setType('texte','hiddenstatic');
			$form->setType('om_profil','hiddenstatic');
		}//fin supprimer
	}

	function setOnchange(&$form,$maj) {
	//javascript controle client
		$form->setOnchange('om_widget','VerifNum(this)');
		$form->setOnchange('om_collectivite','VerifNum(this)');
	}

	function setTaille(&$form,$maj) {
	//taille des champs affiches (text)
		$form->setTaille('om_widget',4);
		$form->setTaille('om_collectivite',4);
		$form->setTaille('libelle',20);
		$form->setTaille('lien',20);
		$form->setTaille('texte',80);
		$form->setTaille('om_profil',20);
	}

	function setMax(&$form,$maj) {
	//longueur max en saisie (text)
		$form->setMax('om_widget',4);
		$form->setMax('om_collectivite',4);
		$form->setMax('libelle',20);
		$form->setMax('lien',20);
		$form->setMax('texte',6);
		$form->setMax('om_profil',20);
	}

	function setLib(&$form,$maj) {
	//libelle des champs
		$form->setLib('om_widget',_('om_widget'));
		$form->setLib('om_collectivite',_('om_collectivite'));
		$form->setLib('libelle',_('libelle'));
		$form->setLib('lien',_('lien'));
		$form->setLib('texte',_('texte'));
		$form->setLib('om_profil',_('om_profil'));
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
			if($retourformulaire =='om_profil')
				$form->setVal('om_profil', $idxformulaire);
		}// fin validation
	}// fin setValsousformulaire

	//==================================
	// cle secondaire  [secondary key]
	//==================================

	function cleSecondaire($id,&$db,$val,$debug) {
		$this->correct=True;
		$f="&nbsp!&nbsp;&nbsp;&nbsp;&nbsp;";
		$imgv="<img src='../img/punaise.png' style='vertical-align:middle' hspace='2' border='0'>";
		// cle secondaire om_tdb
		$sql = "select * from public.om_tdb where om_widget ='".$id."'";
		$res = $db->query($sql);
		if($debug==1) echo $sql;
		if (database::isError($res))
			die($res->getMessage(). " => Echec  ".$sql);
		else{
			$nbligne=$res->numrows();
			$this->msg = $this->msg.$imgv._('il_y_a')." ".$nbligne." "._('om_tdb')." "._('pour')." "._('om_widget')." [".$id."]<br>";
			if($nbligne>0)
				$this->correct=false;
		}
	}// clesecondaire

}// fin classe
?>