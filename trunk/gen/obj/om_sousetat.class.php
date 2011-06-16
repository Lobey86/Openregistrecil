<?php
//$Id$ 
//gen openMairie le 06/12/2010 15:57 
require_once (PATH_OPENMAIRIE."formulairedyn.class.php");
require_once (PATH_OPENMAIRIE."dbformdyn.class.php");

class om_sousetat_gen extends dbForm {
	var $table="om_sousetat";
	var $clePrimaire="om_sousetat";
	var $typeCle="N";
	var $retourformulaire;

	function setvalF($val) {
	//affectation valeur formulaire
		$this->valF['om_sousetat'] = $val['om_sousetat'];
		$this->valF['om_collectivite'] = $val['om_collectivite'];
		$this->valF['id'] = $val['id'];
		$this->valF['libelle'] = $val['libelle'];
		$this->valF['actif'] = $val['actif'];
		$this->valF['titre'] = $val['titre'];
		$this->valF['titrehauteur'] = $val['titrehauteur'];
		$this->valF['titrefont'] = $val['titrefont'];
		$this->valF['titreattribut'] = $val['titreattribut'];
		$this->valF['titretaille'] = $val['titretaille'];
		$this->valF['titrebordure'] = $val['titrebordure'];
		$this->valF['titrealign'] = $val['titrealign'];
		$this->valF['titrefond'] = $val['titrefond'];
		$this->valF['titrefondcouleur'] = $val['titrefondcouleur'];
		$this->valF['titretextecouleur'] = $val['titretextecouleur'];
		$this->valF['intervalle_debut'] = $val['intervalle_debut'];
		$this->valF['intervalle_fin'] = $val['intervalle_fin'];
		$this->valF['entete_flag'] = $val['entete_flag'];
		$this->valF['entete_fond'] = $val['entete_fond'];
		$this->valF['entete_orientation'] = $val['entete_orientation'];
		$this->valF['entete_hauteur'] = $val['entete_hauteur'];
		$this->valF['entetecolone_bordure'] = $val['entetecolone_bordure'];
		$this->valF['entetecolone_align'] = $val['entetecolone_align'];
		$this->valF['entete_fondcouleur'] = $val['entete_fondcouleur'];
		$this->valF['entete_textecouleur'] = $val['entete_textecouleur'];
		$this->valF['tableau_largeur'] = $val['tableau_largeur'];
		$this->valF['tableau_bordure'] = $val['tableau_bordure'];
		$this->valF['tableau_fontaille'] = $val['tableau_fontaille'];
		$this->valF['bordure_couleur'] = $val['bordure_couleur'];
		$this->valF['se_fond1'] = $val['se_fond1'];
		$this->valF['se_fond2'] = $val['se_fond2'];
		$this->valF['cellule_fond'] = $val['cellule_fond'];
		$this->valF['cellule_hauteur'] = $val['cellule_hauteur'];
		$this->valF['cellule_largeur'] = $val['cellule_largeur'];
		$this->valF['cellule_bordure_un'] = $val['cellule_bordure_un'];
		$this->valF['cellule_bordure'] = $val['cellule_bordure'];
		$this->valF['cellule_align'] = $val['cellule_align'];
		$this->valF['cellule_fond_total'] = $val['cellule_fond_total'];
		$this->valF['cellule_fontaille_total'] = $val['cellule_fontaille_total'];
		$this->valF['cellule_hauteur_total'] = $val['cellule_hauteur_total'];
		$this->valF['cellule_fondcouleur_total'] = $val['cellule_fondcouleur_total'];
		$this->valF['cellule_bordure_total'] = $val['cellule_bordure_total'];
		$this->valF['cellule_align_total'] = $val['cellule_align_total'];
		$this->valF['cellule_fond_moyenne'] = $val['cellule_fond_moyenne'];
		$this->valF['cellule_fontaille_moyenne'] = $val['cellule_fontaille_moyenne'];
		$this->valF['cellule_hauteur_moyenne'] = $val['cellule_hauteur_moyenne'];
		$this->valF['cellule_fondcouleur_moyenne'] = $val['cellule_fondcouleur_moyenne'];
		$this->valF['cellule_bordure_moyenne'] = $val['cellule_bordure_moyenne'];
		$this->valF['cellule_align_moyenne'] = $val['cellule_align_moyenne'];
		$this->valF['cellule_fond_nbr'] = $val['cellule_fond_nbr'];
		$this->valF['cellule_fontaille_nbr'] = $val['cellule_fontaille_nbr'];
		$this->valF['cellule_hauteur_nbr'] = $val['cellule_hauteur_nbr'];
		$this->valF['cellule_fondcouleur_nbr'] = $val['cellule_fondcouleur_nbr'];
		$this->valF['cellule_bordure_nbr'] = $val['cellule_bordure_nbr'];
		$this->valF['cellule_align_nbr'] = $val['cellule_align_nbr'];
		$this->valF['cellule_numerique'] = $val['cellule_numerique'];
		$this->valF['cellule_total'] = $val['cellule_total'];
		$this->valF['cellule_moyenne'] = $val['cellule_moyenne'];
		$this->valF['cellule_compteur'] = $val['cellule_compteur'];
		$this->valF['om_sql'] = $val['om_sql'];
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
			$form->setType('om_sousetat','hidden');// cle automatique
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
			$form->setType('titre','textarea');
			$form->setType('titrehauteur','text');
			$form->setType('titrefont','text');
			$form->setType('titreattribut','text');
			$form->setType('titretaille','text');
			$form->setType('titrebordure','text');
			$form->setType('titrealign','text');
			$form->setType('titrefond','text');
			$form->setType('titrefondcouleur','text');
			$form->setType('titretextecouleur','text');
			$form->setType('intervalle_debut','text');
			$form->setType('intervalle_fin','text');
			$form->setType('entete_flag','text');
			$form->setType('entete_fond','text');
			$form->setType('entete_orientation','text');
			$form->setType('entete_hauteur','text');
			$form->setType('entetecolone_bordure','text');
			$form->setType('entetecolone_align','text');
			$form->setType('entete_fondcouleur','text');
			$form->setType('entete_textecouleur','text');
			$form->setType('tableau_largeur','text');
			$form->setType('tableau_bordure','text');
			$form->setType('tableau_fontaille','text');
			$form->setType('bordure_couleur','text');
			$form->setType('se_fond1','text');
			$form->setType('se_fond2','text');
			$form->setType('cellule_fond','text');
			$form->setType('cellule_hauteur','text');
			$form->setType('cellule_largeur','text');
			$form->setType('cellule_bordure_un','text');
			$form->setType('cellule_bordure','text');
			$form->setType('cellule_align','text');
			$form->setType('cellule_fond_total','text');
			$form->setType('cellule_fontaille_total','text');
			$form->setType('cellule_hauteur_total','text');
			$form->setType('cellule_fondcouleur_total','text');
			$form->setType('cellule_bordure_total','text');
			$form->setType('cellule_align_total','text');
			$form->setType('cellule_fond_moyenne','text');
			$form->setType('cellule_fontaille_moyenne','text');
			$form->setType('cellule_hauteur_moyenne','text');
			$form->setType('cellule_fondcouleur_moyenne','text');
			$form->setType('cellule_bordure_moyenne','text');
			$form->setType('cellule_align_moyenne','text');
			$form->setType('cellule_fond_nbr','text');
			$form->setType('cellule_fontaille_nbr','text');
			$form->setType('cellule_hauteur_nbr','text');
			$form->setType('cellule_fondcouleur_nbr','text');
			$form->setType('cellule_bordure_nbr','text');
			$form->setType('cellule_align_nbr','text');
			$form->setType('cellule_numerique','text');
			$form->setType('cellule_total','text');
			$form->setType('cellule_moyenne','text');
			$form->setType('cellule_compteur','text');
			$form->setType('om_sql','textarea');
		}// fin ajout
		if ($maj==1){ //modifier
			$form->setType('om_sousetat','hiddenstatic');
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
			$form->setType('titre','textarea');
			$form->setType('titrehauteur','text');
			$form->setType('titrefont','text');
			$form->setType('titreattribut','text');
			$form->setType('titretaille','text');
			$form->setType('titrebordure','text');
			$form->setType('titrealign','text');
			$form->setType('titrefond','text');
			$form->setType('titrefondcouleur','text');
			$form->setType('titretextecouleur','text');
			$form->setType('intervalle_debut','text');
			$form->setType('intervalle_fin','text');
			$form->setType('entete_flag','text');
			$form->setType('entete_fond','text');
			$form->setType('entete_orientation','text');
			$form->setType('entete_hauteur','text');
			$form->setType('entetecolone_bordure','text');
			$form->setType('entetecolone_align','text');
			$form->setType('entete_fondcouleur','text');
			$form->setType('entete_textecouleur','text');
			$form->setType('tableau_largeur','text');
			$form->setType('tableau_bordure','text');
			$form->setType('tableau_fontaille','text');
			$form->setType('bordure_couleur','text');
			$form->setType('se_fond1','text');
			$form->setType('se_fond2','text');
			$form->setType('cellule_fond','text');
			$form->setType('cellule_hauteur','text');
			$form->setType('cellule_largeur','text');
			$form->setType('cellule_bordure_un','text');
			$form->setType('cellule_bordure','text');
			$form->setType('cellule_align','text');
			$form->setType('cellule_fond_total','text');
			$form->setType('cellule_fontaille_total','text');
			$form->setType('cellule_hauteur_total','text');
			$form->setType('cellule_fondcouleur_total','text');
			$form->setType('cellule_bordure_total','text');
			$form->setType('cellule_align_total','text');
			$form->setType('cellule_fond_moyenne','text');
			$form->setType('cellule_fontaille_moyenne','text');
			$form->setType('cellule_hauteur_moyenne','text');
			$form->setType('cellule_fondcouleur_moyenne','text');
			$form->setType('cellule_bordure_moyenne','text');
			$form->setType('cellule_align_moyenne','text');
			$form->setType('cellule_fond_nbr','text');
			$form->setType('cellule_fontaille_nbr','text');
			$form->setType('cellule_hauteur_nbr','text');
			$form->setType('cellule_fondcouleur_nbr','text');
			$form->setType('cellule_bordure_nbr','text');
			$form->setType('cellule_align_nbr','text');
			$form->setType('cellule_numerique','text');
			$form->setType('cellule_total','text');
			$form->setType('cellule_moyenne','text');
			$form->setType('cellule_compteur','text');
			$form->setType('om_sql','textarea');
		}// fin modifier
		if ($maj==2){ //supprimer
			$form->setType('om_sousetat','hiddenstatic');
			$form->setType('om_collectivite','hiddenstatic');
			$form->setType('id','hiddenstatic');
			$form->setType('libelle','hiddenstatic');
			$form->setType('actif','hiddenstatic');
			$form->setType('titre','hiddenstatic');
			$form->setType('titrehauteur','hiddenstatic');
			$form->setType('titrefont','hiddenstatic');
			$form->setType('titreattribut','hiddenstatic');
			$form->setType('titretaille','hiddenstatic');
			$form->setType('titrebordure','hiddenstatic');
			$form->setType('titrealign','hiddenstatic');
			$form->setType('titrefond','hiddenstatic');
			$form->setType('titrefondcouleur','hiddenstatic');
			$form->setType('titretextecouleur','hiddenstatic');
			$form->setType('intervalle_debut','hiddenstatic');
			$form->setType('intervalle_fin','hiddenstatic');
			$form->setType('entete_flag','hiddenstatic');
			$form->setType('entete_fond','hiddenstatic');
			$form->setType('entete_orientation','hiddenstatic');
			$form->setType('entete_hauteur','hiddenstatic');
			$form->setType('entetecolone_bordure','hiddenstatic');
			$form->setType('entetecolone_align','hiddenstatic');
			$form->setType('entete_fondcouleur','hiddenstatic');
			$form->setType('entete_textecouleur','hiddenstatic');
			$form->setType('tableau_largeur','hiddenstatic');
			$form->setType('tableau_bordure','hiddenstatic');
			$form->setType('tableau_fontaille','hiddenstatic');
			$form->setType('bordure_couleur','hiddenstatic');
			$form->setType('se_fond1','hiddenstatic');
			$form->setType('se_fond2','hiddenstatic');
			$form->setType('cellule_fond','hiddenstatic');
			$form->setType('cellule_hauteur','hiddenstatic');
			$form->setType('cellule_largeur','hiddenstatic');
			$form->setType('cellule_bordure_un','hiddenstatic');
			$form->setType('cellule_bordure','hiddenstatic');
			$form->setType('cellule_align','hiddenstatic');
			$form->setType('cellule_fond_total','hiddenstatic');
			$form->setType('cellule_fontaille_total','hiddenstatic');
			$form->setType('cellule_hauteur_total','hiddenstatic');
			$form->setType('cellule_fondcouleur_total','hiddenstatic');
			$form->setType('cellule_bordure_total','hiddenstatic');
			$form->setType('cellule_align_total','hiddenstatic');
			$form->setType('cellule_fond_moyenne','hiddenstatic');
			$form->setType('cellule_fontaille_moyenne','hiddenstatic');
			$form->setType('cellule_hauteur_moyenne','hiddenstatic');
			$form->setType('cellule_fondcouleur_moyenne','hiddenstatic');
			$form->setType('cellule_bordure_moyenne','hiddenstatic');
			$form->setType('cellule_align_moyenne','hiddenstatic');
			$form->setType('cellule_fond_nbr','hiddenstatic');
			$form->setType('cellule_fontaille_nbr','hiddenstatic');
			$form->setType('cellule_hauteur_nbr','hiddenstatic');
			$form->setType('cellule_fondcouleur_nbr','hiddenstatic');
			$form->setType('cellule_bordure_nbr','hiddenstatic');
			$form->setType('cellule_align_nbr','hiddenstatic');
			$form->setType('cellule_numerique','hiddenstatic');
			$form->setType('cellule_total','hiddenstatic');
			$form->setType('cellule_moyenne','hiddenstatic');
			$form->setType('cellule_compteur','hiddenstatic');
			$form->setType('om_sql','hiddenstatic');
		}//fin supprimer
	}

	function setOnchange(&$form,$maj) {
	//javascript controle client
		$form->setOnchange('om_sousetat','VerifNum(this)');
		$form->setOnchange('om_collectivite','VerifNum(this)');
		$form->setOnchange('titrehauteur','VerifNum(this)');
		$form->setOnchange('titretaille','VerifNum(this)');
		$form->setOnchange('intervalle_debut','VerifNum(this)');
		$form->setOnchange('intervalle_fin','VerifNum(this)');
		$form->setOnchange('entete_hauteur','VerifNum(this)');
		$form->setOnchange('tableau_largeur','VerifNum(this)');
		$form->setOnchange('tableau_fontaille','VerifNum(this)');
		$form->setOnchange('cellule_hauteur','VerifNum(this)');
		$form->setOnchange('cellule_fontaille_total','VerifNum(this)');
		$form->setOnchange('cellule_hauteur_total','VerifNum(this)');
		$form->setOnchange('cellule_fontaille_moyenne','VerifNum(this)');
		$form->setOnchange('cellule_hauteur_moyenne','VerifNum(this)');
		$form->setOnchange('cellule_fontaille_nbr','VerifNum(this)');
		$form->setOnchange('cellule_hauteur_nbr','VerifNum(this)');
	}

	function setTaille(&$form,$maj) {
	//taille des champs affiches (text)
		$form->setTaille('om_sousetat',11);
		$form->setTaille('om_collectivite',11);
		$form->setTaille('id',50);
		$form->setTaille('libelle',50);
		$form->setTaille('actif',3);
		$form->setTaille('titre',80);
		$form->setTaille('titrehauteur',8);
		$form->setTaille('titrefont',20);
		$form->setTaille('titreattribut',20);
		$form->setTaille('titretaille',8);
		$form->setTaille('titrebordure',20);
		$form->setTaille('titrealign',20);
		$form->setTaille('titrefond',20);
		$form->setTaille('titrefondcouleur',11);
		$form->setTaille('titretextecouleur',11);
		$form->setTaille('intervalle_debut',8);
		$form->setTaille('intervalle_fin',8);
		$form->setTaille('entete_flag',20);
		$form->setTaille('entete_fond',20);
		$form->setTaille('entete_orientation',100);
		$form->setTaille('entete_hauteur',8);
		$form->setTaille('entetecolone_bordure',200);
		$form->setTaille('entetecolone_align',100);
		$form->setTaille('entete_fondcouleur',11);
		$form->setTaille('entete_textecouleur',11);
		$form->setTaille('tableau_largeur',8);
		$form->setTaille('tableau_bordure',20);
		$form->setTaille('tableau_fontaille',8);
		$form->setTaille('bordure_couleur',11);
		$form->setTaille('se_fond1',11);
		$form->setTaille('se_fond2',11);
		$form->setTaille('cellule_fond',20);
		$form->setTaille('cellule_hauteur',8);
		$form->setTaille('cellule_largeur',200);
		$form->setTaille('cellule_bordure_un',200);
		$form->setTaille('cellule_bordure',200);
		$form->setTaille('cellule_align',100);
		$form->setTaille('cellule_fond_total',20);
		$form->setTaille('cellule_fontaille_total',8);
		$form->setTaille('cellule_hauteur_total',8);
		$form->setTaille('cellule_fondcouleur_total',11);
		$form->setTaille('cellule_bordure_total',200);
		$form->setTaille('cellule_align_total',100);
		$form->setTaille('cellule_fond_moyenne',20);
		$form->setTaille('cellule_fontaille_moyenne',8);
		$form->setTaille('cellule_hauteur_moyenne',8);
		$form->setTaille('cellule_fondcouleur_moyenne',11);
		$form->setTaille('cellule_bordure_moyenne',200);
		$form->setTaille('cellule_align_moyenne',100);
		$form->setTaille('cellule_fond_nbr',20);
		$form->setTaille('cellule_fontaille_nbr',8);
		$form->setTaille('cellule_hauteur_nbr',8);
		$form->setTaille('cellule_fondcouleur_nbr',11);
		$form->setTaille('cellule_bordure_nbr',200);
		$form->setTaille('cellule_align_nbr',100);
		$form->setTaille('cellule_numerique',200);
		$form->setTaille('cellule_total',100);
		$form->setTaille('cellule_moyenne',100);
		$form->setTaille('cellule_compteur',100);
		$form->setTaille('om_sql',80);
	}

	function setMax(&$form,$maj) {
	//longueur max en saisie (text)
		$form->setMax('om_sousetat',11);
		$form->setMax('om_collectivite',11);
		$form->setMax('id',50);
		$form->setMax('libelle',50);
		$form->setMax('actif',3);
		$form->setMax('titre',6);
		$form->setMax('titrehauteur',8);
		$form->setMax('titrefont',20);
		$form->setMax('titreattribut',20);
		$form->setMax('titretaille',8);
		$form->setMax('titrebordure',20);
		$form->setMax('titrealign',20);
		$form->setMax('titrefond',20);
		$form->setMax('titrefondcouleur',11);
		$form->setMax('titretextecouleur',11);
		$form->setMax('intervalle_debut',8);
		$form->setMax('intervalle_fin',8);
		$form->setMax('entete_flag',20);
		$form->setMax('entete_fond',20);
		$form->setMax('entete_orientation',100);
		$form->setMax('entete_hauteur',8);
		$form->setMax('entetecolone_bordure',200);
		$form->setMax('entetecolone_align',100);
		$form->setMax('entete_fondcouleur',11);
		$form->setMax('entete_textecouleur',11);
		$form->setMax('tableau_largeur',8);
		$form->setMax('tableau_bordure',20);
		$form->setMax('tableau_fontaille',8);
		$form->setMax('bordure_couleur',11);
		$form->setMax('se_fond1',11);
		$form->setMax('se_fond2',11);
		$form->setMax('cellule_fond',20);
		$form->setMax('cellule_hauteur',8);
		$form->setMax('cellule_largeur',200);
		$form->setMax('cellule_bordure_un',200);
		$form->setMax('cellule_bordure',200);
		$form->setMax('cellule_align',100);
		$form->setMax('cellule_fond_total',20);
		$form->setMax('cellule_fontaille_total',8);
		$form->setMax('cellule_hauteur_total',8);
		$form->setMax('cellule_fondcouleur_total',11);
		$form->setMax('cellule_bordure_total',200);
		$form->setMax('cellule_align_total',100);
		$form->setMax('cellule_fond_moyenne',20);
		$form->setMax('cellule_fontaille_moyenne',8);
		$form->setMax('cellule_hauteur_moyenne',8);
		$form->setMax('cellule_fondcouleur_moyenne',11);
		$form->setMax('cellule_bordure_moyenne',200);
		$form->setMax('cellule_align_moyenne',100);
		$form->setMax('cellule_fond_nbr',20);
		$form->setMax('cellule_fontaille_nbr',8);
		$form->setMax('cellule_hauteur_nbr',8);
		$form->setMax('cellule_fondcouleur_nbr',11);
		$form->setMax('cellule_bordure_nbr',200);
		$form->setMax('cellule_align_nbr',100);
		$form->setMax('cellule_numerique',200);
		$form->setMax('cellule_total',100);
		$form->setMax('cellule_moyenne',100);
		$form->setMax('cellule_compteur',100);
		$form->setMax('om_sql',6);
	}

	function setLib(&$form,$maj) {
	//libelle des champs
		$form->setLib('om_sousetat',_('om_sousetat'));
		$form->setLib('om_collectivite',_('om_collectivite'));
		$form->setLib('id',_('id'));
		$form->setLib('libelle',_('libelle'));
		$form->setLib('actif',_('actif'));
		$form->setLib('titre',_('titre'));
		$form->setLib('titrehauteur',_('titrehauteur'));
		$form->setLib('titrefont',_('titrefont'));
		$form->setLib('titreattribut',_('titreattribut'));
		$form->setLib('titretaille',_('titretaille'));
		$form->setLib('titrebordure',_('titrebordure'));
		$form->setLib('titrealign',_('titrealign'));
		$form->setLib('titrefond',_('titrefond'));
		$form->setLib('titrefondcouleur',_('titrefondcouleur'));
		$form->setLib('titretextecouleur',_('titretextecouleur'));
		$form->setLib('intervalle_debut',_('intervalle_debut'));
		$form->setLib('intervalle_fin',_('intervalle_fin'));
		$form->setLib('entete_flag',_('entete_flag'));
		$form->setLib('entete_fond',_('entete_fond'));
		$form->setLib('entete_orientation',_('entete_orientation'));
		$form->setLib('entete_hauteur',_('entete_hauteur'));
		$form->setLib('entetecolone_bordure',_('entetecolone_bordure'));
		$form->setLib('entetecolone_align',_('entetecolone_align'));
		$form->setLib('entete_fondcouleur',_('entete_fondcouleur'));
		$form->setLib('entete_textecouleur',_('entete_textecouleur'));
		$form->setLib('tableau_largeur',_('tableau_largeur'));
		$form->setLib('tableau_bordure',_('tableau_bordure'));
		$form->setLib('tableau_fontaille',_('tableau_fontaille'));
		$form->setLib('bordure_couleur',_('bordure_couleur'));
		$form->setLib('se_fond1',_('se_fond1'));
		$form->setLib('se_fond2',_('se_fond2'));
		$form->setLib('cellule_fond',_('cellule_fond'));
		$form->setLib('cellule_hauteur',_('cellule_hauteur'));
		$form->setLib('cellule_largeur',_('cellule_largeur'));
		$form->setLib('cellule_bordure_un',_('cellule_bordure_un'));
		$form->setLib('cellule_bordure',_('cellule_bordure'));
		$form->setLib('cellule_align',_('cellule_align'));
		$form->setLib('cellule_fond_total',_('cellule_fond_total'));
		$form->setLib('cellule_fontaille_total',_('cellule_fontaille_total'));
		$form->setLib('cellule_hauteur_total',_('cellule_hauteur_total'));
		$form->setLib('cellule_fondcouleur_total',_('cellule_fondcouleur_total'));
		$form->setLib('cellule_bordure_total',_('cellule_bordure_total'));
		$form->setLib('cellule_align_total',_('cellule_align_total'));
		$form->setLib('cellule_fond_moyenne',_('cellule_fond_moyenne'));
		$form->setLib('cellule_fontaille_moyenne',_('cellule_fontaille_moyenne'));
		$form->setLib('cellule_hauteur_moyenne',_('cellule_hauteur_moyenne'));
		$form->setLib('cellule_fondcouleur_moyenne',_('cellule_fondcouleur_moyenne'));
		$form->setLib('cellule_bordure_moyenne',_('cellule_bordure_moyenne'));
		$form->setLib('cellule_align_moyenne',_('cellule_align_moyenne'));
		$form->setLib('cellule_fond_nbr',_('cellule_fond_nbr'));
		$form->setLib('cellule_fontaille_nbr',_('cellule_fontaille_nbr'));
		$form->setLib('cellule_hauteur_nbr',_('cellule_hauteur_nbr'));
		$form->setLib('cellule_fondcouleur_nbr',_('cellule_fondcouleur_nbr'));
		$form->setLib('cellule_bordure_nbr',_('cellule_bordure_nbr'));
		$form->setLib('cellule_align_nbr',_('cellule_align_nbr'));
		$form->setLib('cellule_numerique',_('cellule_numerique'));
		$form->setLib('cellule_total',_('cellule_total'));
		$form->setLib('cellule_moyenne',_('cellule_moyenne'));
		$form->setLib('cellule_compteur',_('cellule_compteur'));
		$form->setLib('om_sql',_('om_sql'));
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