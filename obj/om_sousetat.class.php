<?php
//$Id$ 
//gen openMairie le 18/10/2010 21:29 
require_once ("../gen/obj/om_sousetat.class.php");

class om_sousetat extends om_sousetat_gen {
    
    var $maj;
    var $retourformulaire;

    function om_sousetat($id,&$db,$debug) {
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
                    $this->verifieractif($db, $val, $DEBUG,$val['om_sousetat']);
    }

    
    
    /**
     *
     */
    function setType(&$form,$maj) {
        parent :: setType(&$form,$maj);
        $form->setType('image', 'hidden');
        if ($maj < 2) { //ajouter et modifier
            $form->setType('actif', 'checkbox');
            $form->setType('titreattribut', 'select');
            $form->setType('titrefont', 'select');
            $form->setType('titrealign', 'select');
            $form->setType('titrebordure', 'select');
            $form->setType('titre', 'textarea');          
            $form->setType('titrefond', 'select');
            $form->setType('entete_flag', 'select');
            $form->setType('entete_fond', 'select');
            $form->setType('tableau_bordure', 'select');
            $form->setType('cellule_fond', 'select');
            $form->setType('cellule_fond_total', 'select');
            $form->setType('cellule_fond_moyenne', 'select');
            $form->setType('cellule_fond_nbr', 'select');
            $form->setType('om_sql', 'textarea');
            if($this->retourformulaire=='om_collectivite'){
                $form->setType('titrefondcouleur', 'rvb2');
                $form->setType('titretextecouleur', 'rvb2');
                $form->setType('entete_fondcouleur','rvb2');
                $form->setType('entete_textecouleur','rvb2');
                $form->setType('bordure_couleur','rvb2');
                $form->setType('se_fond1','rvb2');
                $form->setType('se_fond2','rvb2');
                $form->setType('cellule_fondcouleur_total','rvb2');
                $form->setType('cellule_fondcouleur_moyenne','rvb2');
                $form->setType('cellule_fondcouleur_nbr','rvb2');            
            }else{
                $form->setType('titrefondcouleur', 'rvb');
                $form->setType('titretextecouleur', 'rvb');
                $form->setType('entete_fondcouleur','rvb');
                $form->setType('entete_textecouleur','rvb');
                $form->setType('bordure_couleur','rvb');
                $form->setType('se_fond1','rvb');
                $form->setType('se_fond2','rvb');
                $form->setType('cellule_fondcouleur_total','rvb');
                $form->setType('cellule_fondcouleur_moyenne','rvb');
                $form->setType('cellule_fondcouleur_nbr','rvb');                  
            }
            if ($maj == 1) { //modifier
                $form->setType('idx', 'hidden');
            }
        } else { // supprimer
            $form->setType('idx', 'hiddenstatic');
        }
    }
    
    /**
     *
     */
    function setTaille(&$form, $maj) {
        $form->setTaille('id', 30);
        $form->setTaille('libelle', 20);
        
        $form->setTaille('titre', 80);
        $form->setTaille('om_sql', 80);
        
        $form->setTaille('entete_orientation',20);
        $form->setTaille('entetecolone_bordure',40);
        $form->setTaille('entetecolone_align',20);
        
        $form->setTaille('cellule_largeur',40);
        $form->setTaille('cellule_bordure_un',40);
        $form->setTaille('cellule_bordure',40);
        $form->setTaille('cellule_align',20);
        
        $form->setTaille('cellule_bordure_total',40);
        $form->setTaille('cellule_align_total',20);

        $form->setTaille('cellule_bordure_moyenne',40);
        $form->setTaille('cellule_align_moyenne',20);
        
        $form->setTaille('cellule_bordure_nbr',40);
        $form->setTaille('cellule_align_nbr',20);
        
        $form->setTaille('cellule_numerique',40);
        $form->setTaille('cellule_total',20);
        $form->setTaille('cellule_moyenne',20);
        $form->setTaille('cellule_compteur',20);
    }
    
    /**
     *
     */
    function setMax(&$form, $maj) {
        
        $form->setMax('titre', 3);
        $form->setMax('om_sql', 10);       
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
        //
        $contenu=array();
        $contenu[0]=array('helvetica','times','arial','courier');
        $contenu[1]=array('helvetica','times','arial','courier');
        $form->setSelect("titrefont",$contenu);
        //
        $contenu=array();
        $contenu[0]=array('L','R','J','C');
        $contenu[1]=array(_("gauche"),_("droite"),_("justifie"),_("centre"));
        $form->setSelect("titrealign",$contenu);
        //
        $contenu=array();
        $contenu[0]=array('0','1');
        $contenu[1]=array(_("sans"),_("avec"));
        $form->setSelect("titrebordure",$contenu);
        $form->setSelect("entete_flag",$contenu);
        $form->setSelect("tableau_bordure",$contenu);
        // fond
        $contenu[1]=array(_("transparent"),_("fond"));
        $form->setSelect("titrefond",$contenu);
        $form->setSelect("entete_fond",$contenu);
        $form->setSelect("cellule_fond",$contenu);
        $form->setSelect("cellule_fond_total",$contenu);
        $form->setSelect("cellule_fond_moyenne",$contenu);
        $form->setSelect("cellule_fond_nbr",$contenu);
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
    }
    
    
    /**
     *
     */
    function setRegroupe(&$form, $maj) {
        
        $form->setRegroupe('om_collectivite','D',_('om_collectivite'),"collapsible");
        $form->setRegroupe('id','G','');
        $form->setRegroupe('libelle','G','');
        $form->setRegroupe('actif','F',''); 
        
        $form->setRegroupe('titrehauteur','D',_("parametres")."&nbsp;"._("titre"), "startClosed");
        $form->setRegroupe('titrelargeur','G','');
        $form->setRegroupe('titrefont','G','');
        $form->setRegroupe('titreattribut','G','');
        $form->setRegroupe('titretaille','G','');
        $form->setRegroupe('titrebordure','G','');
        $form->setRegroupe('titrealign','G','');
        $form->setRegroupe('titrefond','G','');
        $form->setRegroupe('titrefondcouleur','G','');
        $form->setRegroupe('titretextecouleur','G','');
        $form->setRegroupe('intervalle_debut','G','');
        $form->setRegroupe('intervalle_fin','F','');
        // entete
        $form->setRegroupe('entete_flag','D',_("entete")."&nbsp;"._("du")."&nbsp;"._("tableau"), "startClosed");
        $form->setRegroupe('entete_fond','G','');
        $form->setRegroupe('entete_orientation','G','');
        $form->setRegroupe('entete_hauteur','G','');
        $form->setRegroupe('entetecolone_bordure','G','');
        $form->setRegroupe('entetecolone_align','G','');
        $form->setRegroupe('entete_fondcouleur','G','');
        $form->setRegroupe('entete_textecouleur','F','');
        // data
        $form->setRegroupe('tableau_largeur','D',_("data")."&nbsp;"._("du")."&nbsp;"._("tableau"), "startClosed");
        $form->setRegroupe('tableau_bordure','G','');
        $form->setRegroupe('tableau_fontaille','G','');
        $form->setRegroupe('bordure_couleur','G','');
        $form->setRegroupe('se_fond1','G','');
        $form->setRegroupe('se_fond2','F','');
        // cellule
        $form->setRegroupe('cellule_fond','D',_("cellule")."&nbsp;"._("du")."&nbsp;"._("tableau"), "startClosed");
        $form->setRegroupe('cellule_hauteur','G','');
        $form->setRegroupe('cellule_largeur','G','');
        $form->setRegroupe('cellule_bordure_un','G','');
        $form->setRegroupe('cellule_bordure','G','');
        $form->setRegroupe('cellule_align','F','');
        // total
        $form->setRegroupe('cellule_fond_total','D',_("total")."&nbsp;"._("du")."&nbsp;"._("tableau"), "startClosed");
        $form->setRegroupe('cellule_fontaille_total','G','');
        $form->setRegroupe('cellule_hauteur_total','G','');
        $form->setRegroupe('cellule_fondcouleur_total','G','');
        $form->setRegroupe('cellule_bordure_total','G','');
        $form->setRegroupe('cellule_align_total','F','');
        // moyenne
        $form->setRegroupe('cellule_fond_moyenne','D',_("moyenne")."&nbsp;"._("du")."&nbsp;"._("tableau"), "startClosed");
        $form->setRegroupe('cellule_fontaille_moyenne','G','');
        $form->setRegroupe('cellule_hauteur_moyenne','G','');
        $form->setRegroupe('cellule_fondcouleur_moyenne','G','');
        $form->setRegroupe('cellule_bordure_moyenne','G','');
        $form->setRegroupe('cellule_align_moyenne','F','');
        // nbr
        $form->setRegroupe('cellule_fond_nbr','D',_("nombre")."&nbsp;"._("enregistrement")."&nbsp;"._("du")."&nbsp;"._("tableau"), "startClosed");
        $form->setRegroupe('cellule_fontaille_nbr','G','');
        $form->setRegroupe('cellule_hauteur_nbr','G','');
        $form->setRegroupe('cellule_fondcouleur_nbr','G','');
        $form->setRegroupe('cellule_bordure_nbr','G','');
        $form->setRegroupe('cellule_align_nbr','F','');
        // operations
        $form->setRegroupe('cellule_numerique','D',_("operations")."&nbsp;"._("du")."&nbsp;"._("tableau"), "startClosed");
        $form->setRegroupe('cellule_total','G','');
        $form->setRegroupe('cellule_moyenne','G','');
        $form->setRegroupe('cellule_compteur','F','');
        
    }
    
    /**
     *
     */
    function setGroupe(&$form, $maj) {
        
        $form->setGroupe('om_collectivite','D');
        $form->setGroupe('id','G');
        $form->setGroupe('libelle','G');
        $form->setGroupe('actif','F'); 
        
        $form->setGroupe('titrehauteur','D');
        $form->setGroupe('titrefont','G');
        $form->setGroupe('titreattribut','F');
        
        $form->setGroupe('titretaille','D');
        $form->setGroupe('titrebordure','G');
        $form->setGroupe('titrealign','F');
        
        $form->setGroupe('titrefond','D');
        $form->setGroupe('titrefondcouleur','G');
        $form->setGroupe('titretextecouleur','F');
        
        $form->setGroupe('intervalle_debut','D');
        $form->setGroupe('intervalle_fin','F');
        // entete
        $form->setGroupe('entete_flag','D');
        $form->setGroupe('entete_fond','F');
        $form->setGroupe('entete_orientation','D');
        $form->setGroupe('entete_hauteur','F');
        $form->setGroupe('entetecolone_bordure','D');
        $form->setGroupe('entetecolone_align','F');
        $form->setGroupe('entete_fondcouleur','D');
        $form->setGroupe('entete_textecouleur','F');
        // data
        $form->setGroupe('tableau_largeur','D');
        $form->setGroupe('tableau_bordure','G');
        $form->setGroupe('tableau_fontaille','F');
        
        $form->setGroupe('bordure_couleur','D');
        $form->setGroupe('se_fond1','G');
        $form->setGroupe('se_fond2','F');
        // cellules
        $form->setGroupe('cellule_fond','D');
        $form->setGroupe('cellule_hauteur','F');
        
        $form->setGroupe('cellule_largeur','D');
        $form->setGroupe('cellule_bordure_un','F');
        $form->setGroupe('cellule_bordure','D');
        $form->setGroupe('cellule_align','F');
        // total
        $form->setGroupe('cellule_fond_total','D');
        $form->setGroupe('cellule_fontaille_total','F');
        $form->setGroupe('cellule_hauteur_total','D');
        $form->setGroupe('cellule_fondcouleur_total','F');
        $form->setGroupe('cellule_bordure_total','D');
        $form->setGroupe('cellule_align_total','F');
        // moyenne
        $form->setGroupe('cellule_fond_moyenne','D');
        $form->setGroupe('cellule_fontaille_moyenne','F');
        $form->setGroupe('cellule_hauteur_moyenne','D');
        $form->setGroupe('cellule_fondcouleur_moyenne','F');
        $form->setGroupe('cellule_bordure_moyenne','D');
        $form->setGroupe('cellule_align_moyenne','F');
        // nbr
        $form->setGroupe('cellule_fond_nbr','D');
        $form->setGroupe('cellule_fontaille_nbr','F');
        $form->setGroupe('cellule_hauteur_nbr','D');
        $form->setGroupe('cellule_fondcouleur_nbr','F');
        $form->setGroupe('cellule_bordure_nbr','D');
        $form->setGroupe('cellule_align_nbr','F');
        // operations
        $form->setGroupe('cellule_numerique','D');
        $form->setGroupe('cellule_total','F');
        $form->setGroupe('cellule_moyenne','D');
        $form->setGroupe('cellule_compteur','F');
    
    }
    
    /**
     *
     */
    function setLib(&$form, $maj) {
        
        $form->setLib('titre',_('titre'));
        
        $form->setLib('titrehauteur',_('hauteur'));
        $form->setLib('titrefont',_('font'));
        $form->setLib('titreattribut','');
        $form->setLib('titretaille',_('taille'));
        $form->setLib('titrebordure',_('bordure'));
        $form->setLib('titrealign',_('align'));
        $form->setLib('titrefondcouleur',_('fond'));
        $form->setLib('titretextecouleur',_('texte'));
        $form->setLib('intervalle_debut',_('intervalle')."&nbsp;"._('debut'));
        $form->setLib('intervalle_fin',_('fin'));
        
        $form->setLib('entete_flag',_('flag'));
        $form->setLib('entete_fond',_('fin'));
        $form->setLib('entete_orientation',_('orientation'));
        $form->setLib('entete_hauteur',_('hauteur'));
        
        $form->setLib('entetecolone_bordure',_('bordure'));
        $form->setLib('entetecolone_align',_('align'));
        $form->setLib('entete_fondcouleur',_('fond'));
        $form->setLib('entete_textecouleur',_('couleur'));
        // data
        $form->setLib('tableau_largeur',_('largeur'));
        $form->setLib('tableau_bordure',_('bordure'));
        $form->setLib('tableau_fontaille',_('taille'));
        $form->setLib('bordure_couleur',_('bordure'));
        $form->setLib('se_fond1',_('fond')."&nbsp;"._('un'));
        $form->setLib('se_fond2',_('fond')."&nbsp;"._('deux'));
        // cellule
        $form->setLib('cellule_fond','');
        $form->setLib('cellule_hauteur',_('hauteur'));
        $form->setLib('cellule_largeur',_('largeur'));
        $form->setLib('cellule_bordure_un',_('bordure')."&nbsp;1&nbsp;"._('cellule'));
        $form->setLib('cellule_bordure',_('bordure'));
        $form->setLib('cellule_align',_('align'));
        // total
        $form->setLib('cellule_fond_total',_('fond')."&nbsp;"._('cellule'));
        $form->setLib('cellule_fontaille_total',_('taille'));
        $form->setLib('cellule_hauteur_total',_('hauteur'));
        $form->setLib('cellule_fondcouleur_total',_('fond'));
        $form->setLib('cellule_bordure_total',_('bordure'));
        $form->setLib('cellule_align_total',_('align'));
        // moyenne
        $form->setLib('cellule_fond_moyenne',_('fond')."&nbsp;"._('cellule'));
        $form->setLib('cellule_fontaille_moyenne',_('taille'));
        $form->setLib('cellule_hauteur_moyenne',_('hauteur'));
        $form->setLib('cellule_fondcouleur_moyenne',_('fond'));
        $form->setLib('cellule_bordure_moyenne',_('bordure'));
        $form->setLib('cellule_align_moyenne',_('align'));
        // nbr
        $form->setLib('cellule_fond_nbr',_('fond')."&nbsp;"._('cellule'));
        $form->setLib('cellule_fontaille_nbr',_('taille'));
        $form->setLib('cellule_hauteur_nbr',_('hauteur'));
        $form->setLib('cellule_fondcouleur_nbr',_('fond'));
        $form->setLib('cellule_bordure_nbr',_('bordure'));
        $form->setLib('cellule_align_nbr',_('align'));
        // operations
        $form->setLib('cellule_numerique',_('numerique'));
        $form->setLib('cellule_total',_('total'));
        $form->setLib('cellule_moyenne',_('moyenne'));
        $form->setLib('cellule_compteur',_('nombre'));
        
        $form->setLib('om_sql',_('om_sql'));
        
    }
    
    /**
     *
     */
    function setVal(&$form, $maj, $validation, &$db, $DEBUG=null) {
        parent::setVal($form, $maj, $validation, $db, $DEBUG=null);
        $this->maj=$maj;
        if ($validation == 0) {
            if ($maj == 0) {
                $form->setVal('titre',_('Texte du titre'));
                $form->setVal('titrefont','helvetica');
                $form->setVal('titrehauteur',10);
                $form->setVal('titrefond',0);
                $form->setVal('titreattribut','B');
                $form->setVal('titretaille',12);
                $form->setVal('titrebordure',0);
                $form->setVal('titrealign','L');
                
                $form->setVal('titrefondcouleur','243-246-246');
                $form->setVal('titretextecouleur','0-0-0');
                
                $form->setVal('intervalle_debut',10);
                $form->setVal('intervalle_fin',15);
                
                $form->setVal('entete_flag',1);
                $form->setVal('entete_fond',1);
                $form->setVal('entete_orientation',"0|0|0");
                $form->setVal('entete_hauteur',20);
                $form->setVal('entetecolone_bordure',"TLB|LTB|LTBR");
                $form->setVal('entetecolone_align',"C|C|C");
                $form->setVal('entete_fondcouleur','195-224-169');
                $form->setVal('entete_textecouleur','0-0-0');
                
                $form->setVal('tableau_largeur',195);
                $form->setVal('tableau_bordure',1);
                $form->setVal('tableau_fontaille',10);
                
                $form->setVal('bordure_couleur','0-0-0');
                $form->setVal('se_fond1','243-243-246');
                $form->setVal('se_fond2','255-255-255');
                
                $form->setVal('cellule_fond',1);
                $form->setVal('cellule_hauteur',10);
                $form->setVal('cellule_largeur',"65|65|65");
                $form->setVal('cellule_bordure_un',"LTBR|LTBR|LTBR");
                $form->setVal('cellule_bordure',"LTBR|LTBR|LTBR");
                $form->setVal('cellule_align',"L|L|C");
                
                $form->setVal('cellule_fond_total',1);
                $form->setVal('cellule_fontaille_total',10);
                $form->setVal('cellule_hauteur_total',15);
                $form->setVal('cellule_fondcouleur_total',"196-213-215");
                $form->setVal('cellule_bordure_total',"TBL|TBL|LTBR");
                $form->setVal('cellule_align_total',"L|L|C");
                
                $form->setVal('cellule_fond_moyenne',1);
                $form->setVal('cellule_fontaille_moyenne',10);
                $form->setVal('cellule_hauteur_moyenne',15);
                $form->setVal('cellule_fondcouleur_moyenne',"196-213-215");
                $form->setVal('cellule_bordure_moyenne',"TBL|TBL|LTBR");
                $form->setVal('cellule_align_moyenne',"L|L|C");
                
                $form->setVal('cellule_fond_nbr',1);
                $form->setVal('cellule_fontaille_nbr',10);
                $form->setVal('cellule_hauteur_nbr',15);
                $form->setVal('cellule_fondcouleur_nbr',"196-213-215");
                $form->setVal('cellule_bordure_nbr',"TBL|TBL|LTBR");
                $form->setVal('cellule_align_nbr',"L|L|C");
                
                $form->setVal('cellule_numerique',"999|999|999");
                $form->setVal('cellule_total',"0|0|0");
                $form->setVal('cellule_moyenne',"0|0|0");
                $form->setVal('cellule_compteur',"0|0|1");
                
                $form->setVal('om_sql',"select ... \nfrom ... \nwhere ... = &idx");
            }
        }     
    }
    
    function setValsousformulaire(&$form, $maj, $validation, $idxformulaire, $retourformulaire, $typeformulaire, &$db, $DEBUG=null) {
        $this->maj=$maj;
        $this->retourformulaire=$retourformulaire;
        if ($validation==0) {
          if ($maj == 0){
            $form->setVal('titre',_('Texte du titre'));
            $form->setVal('titrefont','helvetica');
            $form->setVal('titrehauteur',10);
            $form->setVal('titrefond',0);
            $form->setVal('titreattribut','B');
            $form->setVal('titretaille',12);
            $form->setVal('titrebordure',0);
            $form->setVal('titrealign','L');
            
            $form->setVal('titrefondcouleur','243-246-246');
            $form->setVal('titretextecouleur','0-0-0');
            
            $form->setVal('intervalle_debut',10);
            $form->setVal('intervalle_fin',15);
            
            $form->setVal('entete_flag',1);
            $form->setVal('entete_fond',1);
            $form->setVal('entete_orientation',"0|0|0");
            $form->setVal('entete_hauteur',20);
            $form->setVal('entetecolone_bordure',"TLB|LTB|LTBR");
            $form->setVal('entetecolone_align',"C|C|C");
            $form->setVal('entete_fondcouleur','195-224-169');
            $form->setVal('entete_textecouleur','0-0-0');
            
            $form->setVal('tableau_largeur',195);
            $form->setVal('tableau_bordure',1);
            $form->setVal('tableau_fontaille',10);
            
            $form->setVal('bordure_couleur','0-0-0');
            $form->setVal('se_fond1','243-243-246');
            $form->setVal('se_fond2','255-255-255');
            
            $form->setVal('cellule_fond',1);
            $form->setVal('cellule_hauteur',10);
            $form->setVal('cellule_largeur',"65|65|65");
            $form->setVal('cellule_bordure_un',"LTBR|LTBR|LTBR");
            $form->setVal('cellule_bordure',"LTBR|LTBR|LTBR");
            $form->setVal('cellule_align',"L|L|C");
            
            $form->setVal('cellule_fond_total',1);
            $form->setVal('cellule_fontaille_total',10);
            $form->setVal('cellule_hauteur_total',15);
            $form->setVal('cellule_fondcouleur_total',"196-213-215");
            $form->setVal('cellule_bordure_total',"TBL|TBL|LTBR");
            $form->setVal('cellule_align_total',"L|L|C");
            
            $form->setVal('cellule_fond_moyenne',1);
            $form->setVal('cellule_fontaille_moyenne',10);
            $form->setVal('cellule_hauteur_moyenne',15);
            $form->setVal('cellule_fondcouleur_moyenne',"196-213-215");
            $form->setVal('cellule_bordure_moyenne',"TBL|TBL|LTBR");
            $form->setVal('cellule_align_moyenne',"L|L|C");
            
            $form->setVal('cellule_fond_nbr',1);
            $form->setVal('cellule_fontaille_nbr',10);
            $form->setVal('cellule_hauteur_nbr',15);
            $form->setVal('cellule_fondcouleur_nbr',"196-213-215");
            $form->setVal('cellule_bordure_nbr',"TBL|TBL|LTBR");
            $form->setVal('cellule_align_nbr',"L|L|C");
            
            $form->setVal('cellule_numerique',"999|999|999");
            $form->setVal('cellule_total',"0|0|0");
            $form->setVal('cellule_moyenne',"0|0|0");
            $form->setVal('cellule_compteur',"0|0|1");
            
            $form->setVal('om_sql',"select ... \nfrom ... \nwhere ... = &idx");
            $form->setVal($retourformulaire, $idxformulaire);
        }}   
    }
    
    /**
     * verification sur existence d un etat deja actif pour la collectivite
     */
    function verifieractif(&$db, $val, $DEBUG,$id){
        $sql = "select om_sousetat from ".DB_PREFIXE."om_sousetat where id ='".$val['id']."'";
        $sql.= " and om_collectivite ='".$val['om_collectivite']."'";
        $sql.= " and actif ='Oui'";
        if($id!=']')
            $sql.=" and om_sousetat !='".$id."'";
        $res = $db->query($sql);
        if($DEBUG==1) echo $sql;
        if (database::isError($res))
           die($res->getMessage(). " => Echec  ".$sql);
        else{
           $nbligne=$res->numrows();
           if ($nbligne>0){
               $this->msg= $this->msg." ".$nbligne." "._("sousetat")." "._("existant").
               " "._("actif")." ! "._("vous ne pouvez avoir qu un sousetat")." '".
               $val['id']."' "._("actif")."  "._("par collectivite");
               $this->correct=False;
            }
        }
    }
    
}// fin classe
?>