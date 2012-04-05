<?php
//$Id$ 
//gen openMairie le 17/05/2011 11:42 
require_once ("../gen/obj/registre.class.php");

class registre extends registre_gen {

	var $nature = "dispense";

	function registre($id,&$db,$debug) {
		$this->constructeur($id,$db,$debug);
	}// fin constructeur

	function verifier($val,&$db,$DEBUG){
	    parent::verifier($val,$db,$DEBUG);
	    $imgv="";
	    $f="&nbsp!&nbsp;&nbsp;&nbsp;&nbsp;";
	    $imgv="<img src='../img/punaise.png' style='vertical-align:middle' hspace='2' border='0'>";
	    if ($this->valF['finalite']==""){
	       $this->correct=false;
	       $this->msg= $this->msg.$imgv._("finalite")."&nbsp;"._("obligatoire");
	    }
	    if($val['date_registre']!="")
		$this->valF['date_registre'] = $this->dateDB($val['date_registre']);
	    if($val['date_maj']!="")
		$this->valF['date_maj'] = $this->dateDB($val['date_maj']);
	}

	function setType(&$form,$maj) {
	   parent::setType($form,$maj);
	   if ($maj < 2) {
             $form->setType('registre', 'hiddenstatic');
	     $form->setType('vide1', 'hiddenstatic');
	     $form->setType('categorie_donnee', 'textareamulti');
	     $form->setType('categorie_personne', 'textareamulti');
	     $form->setType('exclusion', 'textareamulti');
	     $form->setType('table_donnee', 'select');
	     $form->setType('table_donnee2', 'select');
	     $form->setType('table_personne', 'select');
	     $form->setType('nature', 'hidden');
	     $form->setType('avis', 'select');
	     $form->setType('droit_acces', 'select');
		 $form->setType('om_collectivite', 'hiddenstatic');
	   }
	}

	function setSelect(&$form, $maj,&$db,$DEBUG) {
		// pas de parent

		if(file_exists ("../sql/".$db->phptype."/".$this->table.".form.inc"))
			include ("../sql/".$db->phptype."/".$this->table.".form.inc");
		if($maj<2){
		    $res = $db->query($sql_table_donnee);
		    if (DB :: isError($res))
		         die($res->getMessage().$sql_table_donnee);
		    else
		    {
		        if ($DEBUG == 1)
		            echo " la requete ".$sql_table_donnee." est ex&eacute;cut&eacute;e<br>";
		        $contenu[0][0]="";
		        $contenu[1][0]=_("choisir")." "._("donnee");
		        $k=1;
		        while ($row=& $res->fetchRow())
		        {
		            $contenu[0][$k]=$row[0];
		            $contenu[1][$k]=$row[1];
		            $k++;
		        }
		        $form->setSelect("table_donnee",$contenu);
			$form->setSelect("table_donnee2",$contenu);
		    }
		    // service
		    $contenu=array();
		    $res = $db->query($sql_service);
		    if (DB :: isError($res))
		        die($res->getMessage().$sql_service);
		    else
		    {
		        if ($DEBUG == 1)
		           echo " la requete ".$sql_service." est ex&eacute;cut&eacute;e<br>";
		        $contenu[0][0]="";
		        $contenu[1][0]=_("choisir")." "._("service");
		        $k=1;
		        while ($row=& $res->fetchRow())
		        {
		            $contenu[0][$k]=$row[0];
		            $contenu[1][$k]=$row[1];
		            $k++;
		        }
		      $form->setSelect("droit_acces",$contenu);
		      $form->setSelect("service",$contenu);
		     }
		// parametre textareamulti
		    $contenu=array();
		    $contenu[0] ="table_donnee";
		    $form->setSelect("categorie_donnee",$contenu);
		    $res = $db->query($sql_table_donnee);
	       // personne
		    $contenu=array();
		    $res = $db->query($sql_table_personne);
		    if (DB :: isError($res))
		         die($res->getMessage().$sql_table_personne);
		    else
		    {
		        if ($DEBUG == 1)
		            echo " la requete ".$sql_table_personne." est ex&eacute;cut&eacute;e<br>";
		        $contenu[0][0]="";
		        $contenu[1][0]=_("choisir")." "._("personne");
		        $k=1;
		        while ($row=& $res->fetchRow())
		        {
		            $contenu[0][$k]=$row[0];
		            $contenu[1][$k]=$row[1];
		            $k++;
		        }
		        $form->setSelect("table_personne",$contenu);
		    }
          // reference
            $contenu=array();
            $temp= $sql_reference." where nature='".$this->nature. "'";
            $res = $db->query($temp);
            if (DB :: isError($res))
                die($res->getMessage().$temp);
            else
            {
                if ($DEBUG == 1)
                   echo " la requete ".$temp." est ex&eacute;cut&eacute;e<br>";
                $contenu[0][0]="";
                $contenu[1][0]=_("choisir")." "._("reference");
                $k=1;
                while ($row=& $res->fetchRow())
                {
                    $contenu[0][$k]=$row[0];
                    $contenu[1][$k]=$row[1];
                    $k++;
                }
              $form->setSelect("reference",$contenu);
             }
		// avis
		$contenu=array();
		$contenu[0]=array('','Oui',
		                  'Non');
		$contenu[1]=array('',_('Oui'),
		                  _('Non')
		                  );
		$form->setSelect("avis",$contenu);
		// parametre textareamulti
		    $contenu=array();
		    $contenu[0] ="table_personne";
		    $form->setSelect("categorie_personne",$contenu);
		// parametre textareamulti
		    $contenu=array();
		    $contenu[0] ="table_donnee2";
		    $form->setSelect("exclusion",$contenu);
	      }
	}

	function setLib(&$form,$maj) {
	   parent::setLib($form,$maj);
	   $form->setLib('registre',"&nbsp;No&nbsp;");
	   $form->setLib('categorie_personne',"");
	   $form->setLib('table_personne',"");
	   $form->setLib('categorie_donnee',"");
	   $form->setLib('table_donnee',"");
	   $form->setLib('table_donnee2',"");
	   $form->setLib('exclusion',"");
	}

	function setTaille(&$form,$maj){
	  parent::setTaille($form,$maj);
	  $form->setTaille('date_registre', 10);
	  $form->setTaille('categorie_personne', 40);
	  $form->setTaille('categorie_donnee', 40);
	  $form->setTaille('note', 80);
	  $form->setTaille('exclusion', 30);
	  $form->setTaille('conservation', 80);
	  $form->setTaille('finalite', 50);
	}

	function setMax(&$form,$maj){
          parent::setMax($form,$maj);
	  $form->setMax('categorie_personne', 3);
	  $form->setMax('categorie_donnee', 3);
	  $form->setMax('note', 2);
	  $form->setMax('exclusion', 3);
	}
	function setGroupe(&$form, $maj) {
		$form->setGroupe('finalite','D');
		$form->setGroupe('date_registre','G');
		$form->setGroupe('numero_cnil','G');
		$form->setGroupe('registre','F');

		$form->setGroupe('table_donnee','D');
		$form->setGroupe('categorie_donnee','F');
		$form->setGroupe('table_personne','D');
		$form->setGroupe('categorie_personne','F');
		$form->setGroupe('table_donnee2','D');
		$form->setGroupe('exclusion','F');

		$form->setGroupe('service','D');
		$form->setGroupe('droit_acces','F');

		$form->setGroupe('reference','D');
		$form->setGroupe('date_maj','G');
		$form->setGroupe('avis','F');
	}

	function setRegroupe(&$form,$maj){

		$form->setRegroupe('finalite','D',_("finalite"));
		$form->setRegroupe('date_registre','G','');
		$form->setRegroupe('numero_cnil','G','');
		$form->setRegroupe('registre','F','');

		$form->setRegroupe('table_donnee','D',_("categorie  de donnee"), "collapsible");
		$form->setRegroupe('categorie_donnee','F','');
		$form->setRegroupe('table_personne','D',_("categorie de personne"), "collapsible");
		$form->setRegroupe('categorie_personne','F','');
		$form->setRegroupe('table_donnee2','D',_("Donnees exclues"), "startClosed");
		$form->setRegroupe('exclusion','F','');
		$form->setRegroupe('service','D',_("service"), "startClosed");
		$form->setRegroupe('droit_acces','F','');

		$form->setRegroupe('reference','D',_("reference"), "startClosed");
		$form->setRegroupe('date_maj','G','');
		$form->setRegroupe('avis','F','');
	}

	function setVal(&$form,$maj,$validation){
		if ($validation==0) {
			if ($maj == 0){
			    $form->setVal('nature', $this->nature);
			    $form->setVal('avis', 'Oui');
				$form->setVal('om_collectivite', $_SESSION['collectivite']);
			}	
		}
	}


}// fin classe
?>
