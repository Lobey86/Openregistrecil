<?php
//$Id$ 
//gen openMairie le 19/10/2010 18:45 
require_once ("../gen/obj/om_lettretype.class.php");

class om_lettretype extends om_lettretype_gen {
    
    var $maj;
    var $retourformulaire;

    function om_lettretype($id,&$db,$debug) {
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
                    $this->verifieractif($db, $val, $DEBUG,$val['om_lettretype']);
    }

    

   /**
     *
     */
    function setType(&$form,$maj) {
        parent::setType($form,$maj);
        $form->setType('image', 'hidden');
        if ($maj < 2) { //ajouter et modifier
            $form->setType('actif', 'checkbox');
            $form->setType('orientation', 'select');
            $form->setType('format', 'select');
            $form->setType('titreattribut', 'select');
            $form->setType('corpsattribut', 'select');
            $form->setType('titrefont', 'select');
            $form->setType('corpsfont', 'select');
            $form->setType('titrealign', 'select');
            $form->setType('corpsalign', 'select');
            $form->setType('titrebordure', 'select');
            $form->setType('corpsbordure', 'select');
            $form->setType('titre', 'textarea');
            $form->setType('corps', 'textarea');
            $form->setType('sql', 'textarea');
            if($this->retourformulaire=='om_collectivite'){
                $form->setType('logotop', 'localisation2');
                $form->setType('titretop', 'localisation2');
                $form->setType('corpstop', 'localisation2');
                $form->setType('logo', 'upload2');
            }else{
                $form->setType('logotop', 'localisation');
                $form->setType('titretop', 'localisation');
                $form->setType('corpstop', 'localisation');
                $form->setType('logo', 'upload');                
            }
            if ($maj == 1) { //modifier
                $form->setType('idx', 'hidden');
            }
        } else { // supprimer
            $form->setType('idx', 'hiddenstatic');
        }
        
    }
    
    function setTaille(&$form, $maj) {
    parent ::  setTaille($form, $maj);  
        $form->setTaille('id', 20);
        $form->setTaille('libelle', 20);
    }
    
  
    /**
     *
     */
    function setSelect(&$form, $maj, &$db, $debug) {
        parent :: setSelect($form, $maj, $db, $debug);
    
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
        //
        $contenu=array();
        $contenu[0]=array('helvetica','times','arial','courier');
        $contenu[1]=array('helvetica','times','arial','courier');
        $form->setSelect("titrefont",$contenu);
        $form->setSelect("corpsfont",$contenu);
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
        $form->setSelect("corpstop",$contenu);
    }
    
    
    /**
     *
     */
    function setRegroupe(&$form, $maj) {
        
        $form->setRegroupe('om_collectivite','D',_('om_collectivite'), "collapsible");
        $form->setRegroupe('id','G','');
        $form->setRegroupe('libelle','G','');
        $form->setRegroupe('actif','F',''); 
        
        $form->setRegroupe('orientation','D', _("Parametres generaux du document"), "startClosed");
        $form->setRegroupe('format','G','');
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
        
    }
    
    /**
     *
     */
    function setLib(&$form, $maj) {
        
        $form->setLib('logoleft',_('left'));
        $form->setLib('logotop',_('top'));
        $form->setLib('orientation',_('orientation'));
        $form->setLib('format',_('format'));
        
        $form->setLib('titre',_('titre'));
        
        $form->setLib('titreleft',_('left'));
        $form->setLib('titretop',_('top'));
        $form->setLib('titrelargeur',_('largeur'));
        $form->setLib('titrehauteur',_('Hauteur'));
        $form->setLib('titrefont',_('font'));
        $form->setLib('titreattribut',_('Mise en forme du texte'));
        $form->setLib('titretaille',_('Taille'));
        $form->setLib('titrebordure',_('Bordure'));
        $form->setLib('titrealign',_('align'));
        
        $form->setLib('corps',_('corps'));
        $form->setLib('corpsleft',_('left'));
        $form->setLib('corpstop',_('top'));
        
        $form->setLib('corpslargeur',_('largeur'));
        $form->setLib('corpshauteur',_('hauteur'));
        $form->setLib('corpsfont','font');
        $form->setLib('corpsattribut',_('mise_en_forme')."&nbsp;"._('du')."&nbsp;"._('texte'));
        $form->setLib('corpstaille',_('taille'));
        $form->setLib('corpsbordure',_('bordure'));
        $form->setLib('corpsalign',_('align'));
        
        $form->setLib('om_sql',_('sql'));
        
    }
    
    /**
     *
     */
    function setVal(&$form, $maj, $validation, &$db, $DEBUG=null) {
        parent::setVal($form, $maj, $validation, $db, $DEBUG=null);
        $this->maj=$maj;
        if ($validation == 0) {
            if ($maj == 0) {
                $form->setVal('orientation','P');
                $form->setVal('format','A4');
                $form->setVal('logoleft', 10);
                $form->setVal('logo','logo.png');
                $form->setVal('logotop', 10);
                $form->setVal('titre',_('Texte du titre'));
                $form->setVal('titreleft',109);
                $form->setVal('titretop',16);
                $form->setVal('titrelargeur',0);
                $form->setVal('titrehauteur',10);
                $form->setVal('titrefont','arial');
                $form->setVal('titreattribut','B');
                $form->setVal('titretaille',20);
                $form->setVal('titrebordure',0);
                $form->setVal('titrealign','L');
                $form->setVal('corps',_('Texte du corps'));
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
            }
        }
    }

    function setValsousformulaire(&$form, $maj, $validation, $idxformulaire, $retourformulaire, $typeformulaire, &$db, $DEBUG=null) {
        $this->maj=$maj;
        $this->retourformulaire=$retourformulaire;
        if ($validation==0) {
          if ($maj == 0){
            $form->setVal('orientation','P');
            $form->setVal('format','A4');
            $form->setVal('logoleft', 10);
            $form->setVal('logo','logo.png');
            $form->setVal('logotop', 10);
            $form->setVal('titre',_('Texte du titre'));
            $form->setVal('titreleft',109);
            $form->setVal('titretop',16);
            $form->setVal('titrelargeur',0);
            $form->setVal('titrehauteur',10);
            $form->setVal('titrefont','arial');
            $form->setVal('titreattribut','B');
            $form->setVal('titretaille',20);
            $form->setVal('titrebordure',0);
            $form->setVal('titrealign','L');
            $form->setVal('corps',_('Texte du corps'));
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
            $form->setVal($retourformulaire, $idxformulaire);
        }}
    }
    
    /**
     * verification sur existence d un etat deja actif pour la collectivite
     */
    function verifieractif(&$db, $val, $DEBUG,$id){
        $sql = "select om_lettretype from ".DB_PREFIXE."om_lettretype where id ='".$val['id']."'";
        $sql.= " and om_collectivite ='".$val['om_collectivite']."'";
        $sql.= " and actif ='Oui'";
        if($id!=']')
            $sql.=" and om_lettretype !='".$id."'";
        $res = $db->query($sql);
        if($DEBUG==1) echo $sql;
        if (database::isError($res))
           die($res->getMessage(). " => Echec  ".$sql);
        else{
           $nbligne=$res->numrows();
           if ($nbligne>0){
               $this->msg= $this->msg." ".$nbligne." "._("lettretype")." "._("existant").
               " "._("actif")." ! "._("vous ne pouvez avoir qu une lettretype")." '".
               $val['id']."' "._("actif")."  "._("par collectivite");
               $this->correct=False;
            }
        }
    }
}// fin classe
?>