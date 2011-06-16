<?php
//$Id$ 
//gen openMairie le 06/04/2011 08:33 
require_once ("../gen/obj/om_sig_point.class.php");

class om_sig_point extends om_sig_point_gen {
    
    var $maj; // pour verification actif

	function om_sig_point($id,&$db,$debug) {
		$this->constructeur($id,$db,$debug);
	}// fin constructeur

	function setType(&$form,$maj) {
		parent::setType($form,$maj);
		if($maj<2){
			$form->setType('etendue','select');
			$form->setType('projection_externe','select');
			//$form->setType('table_update','select');
            //$form->setType('champ','select');
			$form->setType('layer_info', 'checkbox');
			$form->setType('fond_osm','checkbox');
			$form->setType('fond_bing','checkbox');
			$form->setType('fond_sat','checkbox');
			$form->setType('maj','checkbox');
			$form->setType('actif', 'checkbox');
		}
	}
    
	function verifier($val, &$db, $DEBUG) {
	    parent::verifier($val, $db, $DEBUG);
	    $f="&nbsp!&nbsp;&nbsp;&nbsp;&nbsp;";
	    $imgv="<img src='../img/punaise.png' style='vertical-align:middle' hspace='2' border='0'>";
	    if ($this->valF['id']==""){
		$this->msg= $this->msg.$imgv._('identifiant')."&nbsp;"._('obligatoire').$f;
		$this->correct=False;
	    }else
		// verification si il y a un autre id "actif" pour la collectivite
		if($this->valF['actif']=="Oui")
		    if($this->maj==0)
			$this->verifieractif($db, $val, $DEBUG,']');
		    else
			$this->verifieractif($db, $val, $DEBUG,$val['om_sig_point']);
	}


	function setTaille(&$form,$maj) {
		parent::setTaille($form,$maj);
		//taille des champs affiches (text)
		$form->setTaille('om_sig_point',4);
		$form->setTaille('om_collectivite',4);
		$form->setTaille('id',20);
		$form->setTaille('libelle',50);
		$form->setTaille('zoom',3);
		$form->setTaille('fond_osm',1);
		$form->setTaille('fond_bing',1);
		$form->setTaille('fond_sat',1);
		$form->setTaille('etendue',60);
		$form->setTaille('projection_externe',20);
		$form->setTaille('maj',1);
		$form->setTaille('table_update',30);
		$form->setTaille('champ',30);
		$form->setTaille('retour',50);
	}

	function setMax(&$form,$maj) {
		parent::setMax($form,$maj); 
		$form->setMax('om_sig_point',4);
		$form->setMax('om_collectivite',4);
		$form->setMax('id',50);
		$form->setMax('libelle',50);
		$form->setMax('zoom',3);
		$form->setMax('fond_osm',1);
		$form->setMax('fond_bing',1);
		$form->setMax('fond_sat',1);
		$form->setMax('etendue',60);
		$form->setMax('projection_externe',60);
		$form->setMax('url',2);
		$form->setMax('maj',1);
		$form->setMax('table_update',30);
		$form->setMax('champ',30);
		$form->setMax('retour',50);
	}

	function setOnchange(&$form,$maj) {
		parent::setOnchange($form,$maj);
		$form->setOnchange('zoom','VerifNum(this)');
	}
	
	function setSelect(&$form, $maj,&$db,$debug) {
		parent::setSelect($form, $maj,$db,$debug);
		if($maj<2){
			if(file_exists ("../sig/var_point.inc"))
				include ("../sig/var_point.inc");
			$form->setSelect("etendue",$contenu_etendue);
			$form->setSelect("projection_externe",$contenu_epsg);
			
			if(file_exists ("../sql/".$db->phptype."/".$this->table.".form.inc"))
				include ("../sql/".$db->phptype."/".$this->table.".form.inc");
            //table update
			$contenu=array();
			$res = $db->query($sql_geometry);
			if (database::isError($res))
				die($res->getMessage().$sql_geometry);
			else{
				if ($debug == 1)
					echo " la requete ".$sql_geometry." est executee<br>";
				$contenu[0][0]='';
				$contenu[1][0]=_('choisir')."&nbsp;"._('table');
				$k=1;
                while ($row=& $res->fetchRow()){
                    $contenu[0][$k]=$row[0];
                    $contenu[1][$k]=$row[1];
                    $k++;
                }
		$form->setSelect('table_update',$contenu);
            }    
            // champ
            $contenu=array();                
			$res = $db->query($sql_geometry_champ);
			if (database::isError($res))
				die($res->getMessage().$sql_geometry_champ);
			else{
				if ($debug == 1)
					echo " la requete ".$sql_geometry_champ." est executee<br>";
				$contenu[0][0]='';
				$contenu[1][0]=_('choisir')."&nbsp;"._('champ');
				$k=1;
                while ($row=& $res->fetchRow()){
                    $contenu[0][$k]=$row[0];
                    $contenu[1][$k]=$row[1];
                    $k++;
                }
				$form->setSelect('champ',$contenu);
			}// fin error db
		}// fin maj
	}
	
	function setGroupe (&$form, $maj) {
		
		$form->setGroupe('id','D');
		$form->setGroupe('libelle','G');
		$form->setGroupe('actif','F');
		
		$form->setGroupe('zoom','D');
		$form->setGroupe('fond_osm','G');
		$form->setGroupe('fond_bing','G');
		$form->setGroupe('fond_sat','G');
		$form->setGroupe('layer_info','F');
		
		$form->setGroupe('etendue','D');
		$form->setGroupe('projection_externe','F');
		
		$form->setGroupe('maj','D');
        $form->setGroupe('table_update','G');
		$form->setGroupe('champ','F');
	}

	function setRegroupe (&$form, $maj) {
        
		$form->setRegroupe('zoom','D',' '._('fond').' ', "collapsible");
		$form->setRegroupe('fond_osm','G','');
		$form->setRegroupe('fond_bing','G','');
		$form->setRegroupe('fond_sat','G','');
        $form->setRegroupe('layer_info','F','');
		
		$form->setRegroupe('id','D',' '._('titre').' ', "collapsible");
		$form->setRegroupe('libelle','G','');
        $form->setRegroupe('actif','F','');
		
		$form->setRegroupe('etendue','D',' '._('etendue').' ', "collapsible");
		$form->setRegroupe('projection_externe','F','');
		
		$form->setRegroupe('maj','D',' '._('Mise a jour').' ', "startClosed");
		$form->setRegroupe('table_update','G','');	
        $form->setRegroupe('champ','F','');	

	}
	
	function setLib(&$form,$maj) {
		parent::setLib($form,$maj);
		//libelle des champs
		$form->setLib('fond_osm',_('osm : '));
		$form->setLib('fond_bing',_('bing : '));
		$form->setLib('fond_sat',_('sat : '));
		$form->setLib('etendue',_('etendue'));
		$form->setLib('projection_externe',_('projection'));
		$form->setLib('url',_('url'));
		$form->setLib('om_sql',_('requete sql'));
		$form->setLib('maj',_('maj'));
		$form->setLib('table_update',_(' table :'));
	}
    
    function setVal(&$form, $maj, $validation, &$db, $DEBUG=null) {
        parent::setVal($form, $maj, $validation, $db, $DEBUG=null);
        $this->maj=$maj;
    }
    
    function setValsousformulaire(&$form, $maj, $validation, $idxformulaire, $retourformulaire, $typeformulaire, &$db, $DEBUG=null) {
        parent::setValsousformulaire($form, $maj, $validation, $idxformulaire, $retourformulaire, $typeformulaire, $db, $DEBUG=null);
        $this->maj=$maj;
    }
    
    /**
     * verification sur existence d un etat deja actif pour la collectivite
     */
    function verifieractif(&$db, $val, $DEBUG,$id){
        $sql = "select om_sig_point from ".DB_PREFIXE."om_sig_point where id ='".$val['id']."'";
        $sql.= " and om_collectivite ='".$val['om_collectivite']."'";
        $sql.= " and actif ='Oui'";
        if($id!=']')
            $sql.=" and  om_sig_point !='".$id."'";
        $res = $db->query($sql);
        if($DEBUG==1) echo $sql;
        if (database::isError($res))
           die($res->getMessage(). " => Echec  ".$sql);
        else{
           $nbligne=$res->numrows();
           if ($nbligne>0){
               $this->msg= $this->msg." ".$nbligne." "._("sig_point")." "._("existant").
               " "._("actif")." ! "._("vous ne pouvez avoir qu un sig_point")." '".
               $val['id']."' "._("actif")."  "._("par collectivite");
               $this->correct=False;
            }
        }
    }
    
}// fin classe
?>