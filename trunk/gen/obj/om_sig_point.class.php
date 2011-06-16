<?php
//$Id$ 
//gen openMairie le 12/04/2011 16:10 
require_once (PATH_OPENMAIRIE."formulairedyn.class.php");
require_once (PATH_OPENMAIRIE."dbformdyn.class.php");

class om_sig_point_gen extends dbForm {
	var $table="om_sig_point";
	var $clePrimaire="om_sig_point";
	var $typeCle="N";
	var $retourformulaire;

	function setvalF($val) {
	//affectation valeur formulaire
		$this->valF['om_sig_point'] = $val['om_sig_point'];
		$this->valF['om_collectivite'] = $val['om_collectivite'];
		$this->valF['id'] = $val['id'];
		$this->valF['libelle'] = $val['libelle'];
		$this->valF['actif'] = $val['actif'];
		$this->valF['zoom'] = $val['zoom'];
		$this->valF['fond_osm'] = $val['fond_osm'];
		$this->valF['fond_bing'] = $val['fond_bing'];
		$this->valF['fond_sat'] = $val['fond_sat'];
		$this->valF['layer_info'] = $val['layer_info'];
		$this->valF['etendue'] = $val['etendue'];
		$this->valF['projection_externe'] = $val['projection_externe'];
		$this->valF['url'] = $val['url'];
		$this->valF['om_sql'] = $val['om_sql'];
		$this->valF['maj'] = $val['maj'];
		$this->valF['table_update'] = $val['table_update'];
		$this->valF['champ'] = $val['champ'];
		$this->valF['retour'] = $val['retour'];
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
			$form->setType('om_sig_point','hidden');// cle automatique
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
			$form->setType('zoom','text');
			$form->setType('fond_osm','text');
			$form->setType('fond_bing','text');
			$form->setType('fond_sat','text');
			$form->setType('layer_info','text');
			$form->setType('etendue','text');
			$form->setType('projection_externe','text');
			$form->setType('url','textarea');
			$form->setType('om_sql','textarea');
			$form->setType('maj','text');
			$form->setType('table_update','text');
			$form->setType('champ','text');
			$form->setType('retour','text');
		}// fin ajout
		if ($maj==1){ //modifier
			$form->setType('om_sig_point','hiddenstatic');
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
			$form->setType('zoom','text');
			$form->setType('fond_osm','text');
			$form->setType('fond_bing','text');
			$form->setType('fond_sat','text');
			$form->setType('layer_info','text');
			$form->setType('etendue','text');
			$form->setType('projection_externe','text');
			$form->setType('url','textarea');
			$form->setType('om_sql','textarea');
			$form->setType('maj','text');
			$form->setType('table_update','text');
			$form->setType('champ','text');
			$form->setType('retour','text');
		}// fin modifier
		if ($maj==2){ //supprimer
			$form->setType('om_sig_point','hiddenstatic');
			$form->setType('om_collectivite','hiddenstatic');
			$form->setType('id','hiddenstatic');
			$form->setType('libelle','hiddenstatic');
			$form->setType('actif','hiddenstatic');
			$form->setType('zoom','hiddenstatic');
			$form->setType('fond_osm','hiddenstatic');
			$form->setType('fond_bing','hiddenstatic');
			$form->setType('fond_sat','hiddenstatic');
			$form->setType('layer_info','hiddenstatic');
			$form->setType('etendue','hiddenstatic');
			$form->setType('projection_externe','hiddenstatic');
			$form->setType('url','hiddenstatic');
			$form->setType('om_sql','hiddenstatic');
			$form->setType('maj','hiddenstatic');
			$form->setType('table_update','hiddenstatic');
			$form->setType('champ','hiddenstatic');
			$form->setType('retour','hiddenstatic');
		}//fin supprimer
	}

	function setOnchange(&$form,$maj) {
	//javascript controle client
		$form->setOnchange('om_sig_point','VerifNum(this)');
		$form->setOnchange('om_collectivite','VerifNum(this)');
	}

	function setTaille(&$form,$maj) {
	//taille des champs affiches (text)
		$form->setTaille('om_sig_point',4);
		$form->setTaille('om_collectivite',4);
		$form->setTaille('id',20);
		$form->setTaille('libelle',19);
		$form->setTaille('actif',20);
		$form->setTaille('zoom',20);
		$form->setTaille('fond_osm',20);
		$form->setTaille('fond_bing',20);
		$form->setTaille('fond_sat',20);
		$form->setTaille('layer_info',20);
		$form->setTaille('etendue',29);
		$form->setTaille('projection_externe',10);
		$form->setTaille('url',80);
		$form->setTaille('om_sql',80);
		$form->setTaille('maj',20);
		$form->setTaille('table_update',20);
		$form->setTaille('champ',20);
		$form->setTaille('retour',20);
	}

	function setMax(&$form,$maj) {
	//longueur max en saisie (text)
		$form->setMax('om_sig_point',4);
		$form->setMax('om_collectivite',4);
		$form->setMax('id',20);
		$form->setMax('libelle',19);
		$form->setMax('actif',20);
		$form->setMax('zoom',20);
		$form->setMax('fond_osm',20);
		$form->setMax('fond_bing',20);
		$form->setMax('fond_sat',20);
		$form->setMax('layer_info',20);
		$form->setMax('etendue',29);
		$form->setMax('projection_externe',10);
		$form->setMax('url',6);
		$form->setMax('om_sql',6);
		$form->setMax('maj',20);
		$form->setMax('table_update',20);
		$form->setMax('champ',20);
		$form->setMax('retour',20);
	}

	function setLib(&$form,$maj) {
	//libelle des champs
		$form->setLib('om_sig_point',_('om_sig_point'));
		$form->setLib('om_collectivite',_('om_collectivite'));
		$form->setLib('id',_('id'));
		$form->setLib('libelle',_('libelle'));
		$form->setLib('actif',_('actif'));
		$form->setLib('zoom',_('zoom'));
		$form->setLib('fond_osm',_('fond_osm'));
		$form->setLib('fond_bing',_('fond_bing'));
		$form->setLib('fond_sat',_('fond_sat'));
		$form->setLib('layer_info',_('layer_info'));
		$form->setLib('etendue',_('etendue'));
		$form->setLib('projection_externe',_('projection_externe'));
		$form->setLib('url',_('url'));
		$form->setLib('om_sql',_('om_sql'));
		$form->setLib('maj',_('maj'));
		$form->setLib('table_update',_('table_update'));
		$form->setLib('champ',_('champ'));
		$form->setLib('retour',_('retour'));
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