<?php
//$Id$ 
//gen openMairie le 18/10/2010 16:23 
require_once ("../gen/obj/om_etat.class.php");

class om_etat extends om_etat_gen {
    
    var $maj;
    var $retourformulaire;
    
    function om_etat($id,&$db,$debug) {
        $this->constructeur($id,$db,$debug);
    }// fin constructeur
    
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
                    $this->verifieractif($db, $val, $DEBUG,$val['om_etat']);
    }

    /**
     *
     */
    function setType(&$form,$maj) {
    parent :: setType($form,$maj);    
        $form->setType('image', 'hidden');
        if ($maj < 2) { //ajouter et modifier
            $form->setType('actif', 'checkbox');
            $form->setType('orientation', 'select');
            $form->setType('format', 'select');
            $form->setType('titreattribut', 'select');
            $form->setType('corpsattribut', 'select');
            $form->setType('footerattribut', 'select');
            $form->setType('titrefont', 'select');
            $form->setType('corpsfont', 'select');
            $form->setType('footerfont', 'select');
            $form->setType('se_font', 'select');
            $form->setType('titrealign', 'select');
            $form->setType('corpsalign', 'select');
            $form->setType('titrebordure', 'select');
            $form->setType('corpsbordure', 'select');
            $form->setType('titre', 'textarea');
            $form->setType('corps', 'textarea');
            $form->setType('sql', 'textarea');
            $form->setType('om_sousetat', 'select');
            $form->setType('sousetat', 'textareamulti');
            if($this->retourformulaire=='om_collectivite'){
                $form->setType('logotop', 'localisation2');
                $form->setType('titretop', 'localisation2');
                $form->setType('corpstop', 'localisation2');
                $form->setType('se_couleurtexte', 'rvb2');
                $form->setType('logo', 'upload2');
            }else{
                $form->setType('logotop', 'localisation');
                $form->setType('titretop', 'localisation');
                $form->setType('corpstop', 'localisation');
                $form->setType('se_couleurtexte', 'rvb');
                $form->setType('logo', 'upload');                
            }
        }
    }
    
    function setTaille(&$form, $maj) {
    parent ::  setTaille($form, $maj);  
        $form->setTaille('sousetat', 50);
        $form->setTaille('corps', 120);
        $form->setTaille('om_sql', 120);
        $form->setTaille('id', 20);
        $form->setTaille('libelle', 20);
    }

    function setMax(&$form, $maj) {
    parent ::  setMax($form, $maj);  
        $form->setMax('sousetat', 8);
        $form->setMax('corps', 30);
        $form->setMax('om_sql', 5);     
    }

    
    /**
     *
     */
    function setSelect(&$form, $maj, $db, $debug) {
    parent :: setSelect($form, $maj, $db, $debug);    
        //
        $contenu=array();
        $contenu[0]=array('P','L');
        $contenu[1]=array(_("portrait"),_("paysage"));
        $form->setSelect("orientation",$contenu);
        //
        $contenu=array();
        $contenu[0]=array('A4','A3');
        $contenu[1]=array('A4','A3');
        $form->setSelect("format",$contenu);
        //
        $contenu=array();
        $contenu[0]=array('','I','B','U','BI','UI');
        $contenu[1]=array(_("normal"),_("italique"),_("gras"),_("souligne"),_("italique")." "._("gras"),_("souligne")." "._("gras"));
        $form->setSelect("titreattribut",$contenu);
        $form->setSelect("corpsattribut",$contenu);
        $form->setSelect("footerattribut",$contenu);
        //
        $contenu=array();
        $contenu[0]=array('helvetica','times','arial','courier');
        $contenu[1]=array('helvetica','times','arial','courier');
        $form->setSelect("titrefont",$contenu);
        $form->setSelect("corpsfont",$contenu);
        $form->setSelect("footerfont",$contenu);
        $form->setSelect("se_font",$contenu);
        //
        $contenu=array();
        $contenu[0]=array('L','R','J','C');
        $contenu[1]=array(_("gauche"),_("droite"),_("justifie"),_("centre"));
        $form->setSelect("titrealign",$contenu);
        $form->setSelect("corpsalign",$contenu);
        //
        $contenu=array();
        $contenu[0]=array('0','1');
        $contenu[1]=array(_("sans"),_("avec"));
        $form->setSelect("titrebordure",$contenu);
        $form->setSelect("corpsbordure",$contenu);
        // position geographique
        $contenu=array();
        $contenu[0]=array('image','logoleft');
        $form->setSelect("logotop",$contenu);
        $contenu=array();
        $contenu[0]=array('image','titreleft');
        $form->setSelect("titretop",$contenu);
        $contenu=array();
        $contenu[0]=array('image','corpsleft');
        $form->setSelect("corpstop",$contenu);

        // parametre textareamulti
        $contenu=array();
        $contenu[0] ="om_sousetat";
        $form->setSelect("sousetat",$contenu);
        
        // om_sousetat
		if(file_exists ("../sql/".$db->phptype."/".$this->table.".form.inc"))
			include ("../sql/".$db->phptype."/".$this->table.".form.inc");
        $contenu=array();
        $res = $db->query($sql_om_sousetat);
        if (database::isError($res))
            die($res->getMessage().$sql_om_sousetat);
        else{
        if ($debug == 1)
            echo " la requete ".$sql_om_sousetat." est executee<br>";
        $contenu[0][0]='';
        $contenu[1][0]=_('choisir')."&nbsp;"._('om_sousetat');
        $k=1;
            while ($row=& $res->fetchRow()){
                $contenu[0][$k]=$row[0];
                $contenu[1][$k]=$row[1];
                $k++;
            }
        $form->setSelect('om_sousetat',$contenu);
        }
    }
    
    /**
     *
     */
    function setRegroupe(&$form, $maj) {
        
        $form->setRegroupe('om_collectivite','D',_('om_collectivite'), "collapsible");
        $form->setRegroupe('id','G','');
        $form->setRegroupe('libelle','G','');
        $form->setRegroupe('actif','F',''); 
        
        $form->setRegroupe('orientation', 'D', _("Parametres generaux du document"), "startClosed");
        $form->setRegroupe('format','G','');
        $form->setRegroupe('footerfont','G','');
        $form->setRegroupe('footerattribut','G','');
        $form->setRegroupe('footertaille','G','');
        $form->setRegroupe('logo','G','');
        $form->setRegroupe('logoleft','G','');
        $form->setRegroupe('logotop','F','');
        
        $form->setRegroupe('titreleft','D',_("Parametres du titre du document"), "startClosed");
        $form->setRegroupe('titretop','G','');
        $form->setRegroupe('titrelargeur','G','');
        $form->setRegroupe('titrehauteur','G','');
        $form->setRegroupe('titrefont','G','');
        $form->setRegroupe('titreattribut','G','');
        $form->setRegroupe('titretaille','G','');
        $form->setRegroupe('titrebordure','G','');
        $form->setRegroupe('titrealign','F','');
        
        $form->setRegroupe('corpsleft','D',_("Parametres du corps du document"), "startClosed");
        $form->setRegroupe('corpstop','G','');
        $form->setRegroupe('corpslargeur','G','');
        $form->setRegroupe('corpshauteur','G','');
        $form->setRegroupe('corpsfont','G','');
        $form->setRegroupe('corpsattribut','G','');
        $form->setRegroupe('corpstaille','G','');
        $form->setRegroupe('corpsbordure','G','');
        $form->setRegroupe('corpsalign','F','');
        
        $form->setRegroupe('om_sousetat','D', _("Sous etat(s) : selection"), "startClosed");
        $form->setRegroupe('sousetat','F', '');
        
        
        $form->setRegroupe('se_font','D', _("Sous etat(s) : police / marges / couleur"), "startClosed");
        $form->setRegroupe('se_margeleft','G','');
        $form->setRegroupe('se_margetop','G','');
        $form->setRegroupe('se_margeright','G','');
        $form->setRegroupe('se_couleurtexte','F','');
        
    }
    
    /**
     *
     */
    function setGroupe(&$form, $maj) {
 
        $form->setGroupe('om_collectivite','D');
        $form->setGroupe('id','G');
        $form->setGroupe('libelle','G');
        $form->setGroupe('actif','F'); 
        
        $form->setGroupe('orientation','D');
        $form->setGroupe('format','F');
        
        $form->setGroupe('footerfont','D');
        $form->setGroupe('footerattribut','G');
        $form->setGroupe('footertaille','F');
        
        $form->setGroupe('logo','D');
        $form->setGroupe('logoleft','G');
        $form->setGroupe('logotop','F');
        
        $form->setGroupe('titreleft','D');
        $form->setGroupe('titretop','G');
        $form->setGroupe('titrelargeur','G');
        $form->setGroupe('titrehauteur','F');
        
        $form->setGroupe('titrefont','D');
        $form->setGroupe('titreattribut','G');
        $form->setGroupe('titretaille','G');
        $form->setGroupe('titrebordure','G');
        $form->setGroupe('titrealign','F');
        
        $form->setGroupe('corpsleft','D');
        $form->setGroupe('corpstop','G');
        $form->setGroupe('corpslargeur','G');
        $form->setGroupe('corpshauteur','F');
        
        $form->setGroupe('corpsfont','D');
        $form->setGroupe('corpsattribut','G');
        $form->setGroupe('corpstaille','G');
        $form->setGroupe('corpsbordure','G');
        $form->setGroupe('corpsalign','F');
        
        $form->setGroupe('om_sousetat','D');
        $form->setGroupe('sousetat','F');
        
        $form->setGroupe('se_font','D');
        $form->setGroupe('se_margeleft','G');
        $form->setGroupe('se_margetop','G');
        $form->setGroupe('se_margeright','G');
        $form->setGroupe('se_couleurtexte','F');
        
    }
    
    /**
     *
     */
    function setLib(&$form, $maj) {
        
        $form->setLib('footerattribut',_('mise_en_forme')."&nbsp;"._('du')."&nbsp;"._('texte'));
        $form->setLib('titreleft',_('left'));
        $form->setLib('titretop',_('top'));
        $form->setLib('titrelargeur',_('largeur'));
        $form->setLib('titrehauteur',_('hauteur'));
        $form->setLib('titrefont',_('font'));
        $form->setLib('titreattribut',_('mise_en_forme')."&nbsp;"._('du')."&nbsp;"._('texte'));
        $form->setLib('titretaille',_('taille'));
        $form->setLib('titrebordure',_('bordure'));
        $form->setLib('titrealign','');
        
        $form->setLib('titre',_('titre'));
        
        $form->setLib('corps',_('corps'));
        $form->setLib('corpsleft',_('left'));
        $form->setLib('corpstop',_('top'));
        
        $form->setLib('corpslargeur',_('largeur'));
        $form->setLib('corpshauteur',_('hauteur'));
        $form->setLib('corpsfont',_('font'));
        $form->setLib('corpsattribut',_('mise_en_forme')."&nbsp;"._('du')."&nbsp;"._('texte'));
        $form->setLib('corpstaille',_('taille'));
        $form->setLib('corpsbordure',_('bordure'));
        $form->setLib('corpsalign','');
        
        $form->setLib('om_sousetat',_('sous_etat'));
        $form->setLib('sousetat','');
        $form->setLib('se_font',_('font'));
        $form->setLib('se_margeleft',_('marges')."&nbsp;"._('left'));
        $form->setLib('se_margetop',_('marges')."&nbsp;"._('haute'));
        $form->setLib('se_margeright',_('marges')."&nbsp;"._('droite'));
        $form->setLib('se_couleurtexte',_('couleur'));
        
    }
    
    /**
     *
     */
    function setVal(&$form, $maj, $validation, &$db, $DEBUG=null) {
        parent::setVal($form, $maj, $validation, $db, $DEBUG=null);
        $this->maj=$maj;
        if ($validation == 0) {
            if ($maj == 0) {
                // ======================= a rajouter au generateur ===========
                //if($_SESSION['niveau']==1)
                //    $form->setVal('om_collectivite', $_SESSION['collectivite']);
                // =============================================================
                $form->setVal('orientation','P');
                $form->setVal('format','A4');
                $form->setVal('footerfont','helvetica');
                $form->setVal('footerattribut','I');
                $form->setVal('footertaille',8);
                $form->setVal('logo','logopdf.png');
                $form->setVal('logoleft', 10);
                $form->setVal('logotop', 10);
                $form->setVal('titre',_("Texte du titre"));
                $form->setVal('titreleft',109);
                $form->setVal('titretop',16);
                $form->setVal('titrelargeur',0);
                $form->setVal('titrehauteur',10);
                $form->setVal('titrefont','arial');
                $form->setVal('titreattribut','B');
                $form->setVal('titretaille',20);
                $form->setVal('titrebordure',0);
                $form->setVal('titrealign','L');
                $form->setVal('corps',_("Texte du corps"));
                $form->setVal('corpsleft',14);
                $form->setVal('corpstop',66);
                $form->setVal('corpslargeur',110);
                $form->setVal('corpshauteur',5);
                $form->setVal('corpsfont','times');
                $form->setVal('corpsattribut','');
                $form->setVal('corpstaille',10);
                $form->setVal('corpsbordure',0);
                $form->setVal('corpsalign','J');
                $form->setVal('om_sql',' select ... from  ... where ... = &idx');
                $form->setVal('sousetat','');
                $form->setVal('se_font','helvetica');
                $form->setVal('se_margeleft',8);
                $form->setVal('se_margetop',5);
                $form->setVal('se_margeright',5);
                $form->setVal('se_couleurtexte','0-0-0');
            }

        
        
        }
        
    }
    function setValsousformulaire(&$form, $maj, $validation, $idxformulaire, $retourformulaire, $typeformulaire, &$db, $DEBUG=null) {
        $this->maj=$maj;
        $this->retourformulaire=$retourformulaire;
        if ($validation==0) {
          if ($maj == 0){
            $form->setVal($retourformulaire, $idxformulaire);
            $form->setVal('orientation','P');
            $form->setVal('format','A4');
            $form->setVal('footerfont','helvetica');
            $form->setVal('footerattribut','I');
            $form->setVal('footertaille',8);
            $form->setVal('logo','logopdf.png');
            $form->setVal('logoleft', 10);
            $form->setVal('logotop', 10);
            $form->setVal('titre',_("Texte du titre"));
            $form->setVal('titreleft',109);
            $form->setVal('titretop',16);
            $form->setVal('titrelargeur',0);
            $form->setVal('titrehauteur',10);
            $form->setVal('titrefont','arial');
            $form->setVal('titreattribut','B');
            $form->setVal('titretaille',20);
            $form->setVal('titrebordure',0);
            $form->setVal('titrealign','L');
            $form->setVal('corps',_("Texte du corps"));
            $form->setVal('corpsleft',14);
            $form->setVal('corpstop',66);
            $form->setVal('corpslargeur',110);
            $form->setVal('corpshauteur',5);
            $form->setVal('corpsfont','times');
            $form->setVal('corpsattribut','');
            $form->setVal('corpstaille',10);
            $form->setVal('corpsbordure',0);
            $form->setVal('corpsalign','J');
            $form->setVal('om_sql',' select ... from  ... where ... = &idx');
            $form->setVal('sousetat','');
            $form->setVal('se_font','helvetica');
            $form->setVal('se_margeleft',8);
            $form->setVal('se_margetop',5);
            $form->setVal('se_margeright',5);
            $form->setVal('se_couleurtexte','0-0-0');
        }}       
    }    

    /**
     * verification sur existence d un etat deja actif pour la collectivite
     */
    function verifieractif(&$db, $val, $DEBUG,$id){
        $sql = "select om_etat from ".DB_PREFIXE."om_etat where id ='".$val['id']."'";
        $sql.= " and om_collectivite ='".$val['om_collectivite']."'";
        $sql.= " and actif ='Oui'";
        if($id!=']')
            $sql.=" and om_etat !='".$id."'";
        $res = $db->query($sql);
        if($DEBUG==1) echo $sql;
        if (database::isError($res))
           die($res->getMessage(). " => Echec  ".$sql);
        else{
           $nbligne=$res->numrows();
           if ($nbligne>0){
               $this->msg= $this->msg." ".$nbligne." "._("etat")." "._("existant").
               " "._("actif")." ! "._("vous ne pouvez avoir qu un etat")." '".
               $val['id']."' "._("actif")."  "._("par collectivite");
               $this->correct=False;
            }
        }
    }

}// fin classe
?>