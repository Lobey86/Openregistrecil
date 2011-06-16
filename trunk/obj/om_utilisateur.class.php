<?php
//$Id$ 
//gen openMairie le 15/10/2010 15:55 
require_once ("../gen/obj/om_utilisateur.class.php");

class om_utilisateur extends om_utilisateur_gen {

    function om_utilisateur($id,&$db,$debug) {
		$this->constructeur($id,$db,$debug);
    }// fin constructeur

    /**
     * Cette methode permet de remplir le tableau associatif valF attribut de
     * l'objet en vue de l'insertion des donnees dans la base.
     * 
     * @param array $val Tableau associatif representant les valeurs du
     *                   formulaire
     * 
     * @return void
     */

    function setvalF($val) {
        // version utilisateur.class liee a setVal et setValFormulaire
        parent::setvalF($val);
        if ($val['pwd']!="*****")
            $this->valF['pwd'] = md5($val['pwd']); 
        else
            unset ($this->valF['pwd']);
        /* version openelec    
        if ($val['pwd'] == "")
            $this->valF['pwd'] = "";
        elseif ($val['pwd'] == $this->val[3])
            $this->valF['pwd'] = $this->val[3];
        else
            $this->valF['pwd'] = md5 ($val['pwd']);
        */
    }

    /**
     * Cette methode est appelee lors de l'ajout d'un objet, elle permet
     * d'effectuer des tests d'integrite sur la cle primaire pour verifier
     * si la cle a bien ete saisie dans le formulaire et si l'objet ajoute
     * n'existe pas deja dans la table pour en empecher l'ajout.
     * 
     * @param array $val Tableau associatif representant les valeurs du
     *                   formulaire
     * @param object $db Objet Base de donnees
     * 
     * @return void
     */
    function verifierAjout($val, &$db) {
        // Si le login est vide alors on rejette l'enregistrement
        if (trim($this->valF["login"]) == "") {
            $this->correct = false;
            $this->msg .= $this->form->lib["login"];
            $this->msg .= _(" est obligatoire")."<br />";
        }
        // Si le test precedent a ete reussi alors on teste si le login
        // n'existe pas deja dans la table
        if ($this->correct == true) {
            // Construction de la requete
            $sql = "select count(*) from ".$this->table." ";
            $sql .= "where login='".$val["login"]."'";
            // Execution de la requete
            $nb = $db->getone($sql);
            if (database::isError($nb)) {
                // Appel de la methode qui gere les erreurs
                $this->erreur_db($res->getDebugInfo(), $res->getMessage(), '');
            } else {
                // Si le resultat de la requete renvoit un ou plusieurs
                // enregistrements
                if ($nb > 0) {
                    // On rejette l'enregistrement
                    $this->correct = false;
                    $this->msg .= _("Il existe deja un enregistrement avec cet identifiant, vous devez en choisir un autre")."<br />";
                }
            }
        }
    }

    /**
     * Cette methode est appelee lors de l'ajout ou de la modification d'un
     * objet, elle permet d'effectuer des tests d'integrite sur les valeurs
     * saisies dans le formulaire pour en empecher l'enregistrement.
     * 
     * @return void
     */
    function verifier($val,&$db,$DEBUG) {
        // Initialisation de l'attribut correct a true
        $this->correct = true;
        // Si la valeur est vide alors on rejette l'enregistrement
        // *** liste
        $field_required = array("om_profil", "login", "nom", "om_collectivite");
        foreach($field_required as $field) {
            if (trim($this->valF[$field]) == "") {
                $this->correct = false;
                $this->msg .= $this->form->lib[$field]." ";
                $this->msg .= _("est obligatoire")."<br />";
            }
        }
        // pwd en maj pas de valF si pas de modification du pwd
        if ($val['pwd']==""){
            $this->correct=false;
            $this->msg= $this->msg._("pwd")."&nbsp;"._("est obligatoire")."<br />";
        }
    }
    /**
     * Cette methode est appelee lors de la suppression d'un objet, elle permet
     * d'effectuer des tests pour verifier si l'objet supprime n'est pas cle
     * secondaire dans une autre table pour en empecher la suppression.
     * 
     * @param string $id Identifiant (cle primaire) de l'objet dans la base
     * @param object $db Objet Base de donnees
     * @param array $val Tableau associatif representant les valeurs du
     *                   formulaire
     * @param integer $DEBUG Mode debug :
     *                       - 0 => Pas de Mode debug
     *                       - 1 => Mode debug
     * 
     * @return void
     */
    function cleSecondaire($id, &$db, $val, $DEBUG) {
        // Initialisation de l'attribut correct a true
        $this->correct = true;
        //
        $this->rechercheLogin($id, $db, $DEBUG);
        // Si la suppression n'est pas possible, on ajoute un message clair
        // pour l'utilisateur
        if ($this->correct == false) {
            $this->msg .= _("SUPPRESSION IMPOSSIBLE")."<br />";
        }
    }
    
    /**
     * Recherche si le login a supprimer est identique au login de
     * l'utilisateur connecte
     *
     * @return void
     */
    function rechercheLogin($id, &$db, $DEBUG) {
        //
        $sql = "select * from om_utilisateur where om_utilisateur='".$id."'";
        $res = $db->query($sql);
        if (database::isError($res)) {
            $this->erreur_db($res->getDebugInfo(), $res->getMessage(), "");
        } else {
            //
            $row =& $res->fetchRow(DB_FETCHMODE_ASSOC);
            if ($row['login'] == $_SESSION ['login']) {
                $this->msg .= _("Vous ne pouvez pas supprimer votre utilisateur.")."<br/>";
                $this->correct = false;
            }
        }
    }

    /**
     * Parametrage du formulaire - Type des entrees de formulaire
     * 
     * @param object $form Objet formulaire
     * @param integer $maj Mode de mise a jour :
     *                     - 0 => ajout
     *                     - 1 => modification
     *                     - 2 => suppression
     * 
     * @return void
     */
    function setType(&$form, $maj) {
    parent:: setType($form, $maj);
        $form->setType("om_type", "hidden");
        if ($maj < 2) { // ajouter et modifier
            $form->setType("pwd", "password");
            $form->setType("om_utilisateur", "hidden");
        }
    }
    
    function setTaille(&$form,$maj) {
    parent::setTaille($form,$maj);	
        $form->setTaille('pwd',20);
    }

    function setOnchange(&$form,$maj){
    // * mise en majuscule
    // * Put in capital letter
    parent::setOnchange($form,$maj);
        $form->setOnchange("nom","this.value=this.value.toUpperCase()");
    }
    
    // si hors openelec
    function setVal(&$form, $maj, $validation, &$db, $DEBUG=null){
        if ($maj == 1)
            $form->setVal('pwd', "*****");
        if ($validation==0) {
            if ($maj == 0){
                $form->setVal("om_type", "db");
            }
        }
    }
     
    function setValsousformulaire(&$form,$maj,$validation,$idxformulaire,$retourformulaire,$typeformulaire){
    parent::setValsousformulaire($form,$maj,$validation,$idxformulaire,$retourformulaire,$typeformulaire,$db,$DEBUG=null);
        if ($validation==0) {
            if ($maj == 0){
              $form->setVal($retourformulaire, $idxformulaire);
              $form->setVal("om_type", "db");
            }else{
              $form->setVal('pwd', "*****");
            }
        }
    }
    
    function setGroupe(&$form,$maj){
        $form->setGroupe('nom','D');
        $form->setGroupe('email','F');
        $form->setGroupe('login','D');
        $form->setGroupe('pwd','F');
    }
    
    function setRegroupe(&$form,$maj){
        $form->setRegroupe('nom','D'," "._("nom")." ");
        $form->setRegroupe('email','G','');
        $form->setRegroupe('login','G','');
        $form->setRegroupe('pwd','F','');
    }

}// fin classe
?>