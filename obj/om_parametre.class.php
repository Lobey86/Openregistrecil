<?php
//$Id$ 
//gen openMairie le 15/10/2010 15:54 
require_once ("../gen/obj/om_parametre.class.php");

class om_parametre extends om_parametre_gen {

    function om_parametre($id,&$db,$debug) {
        $this->constructeur($id,$db,$debug);
    }// fin constructeur

    function setVal(&$form,$maj){
        if ($maj == 0)
            $form->setVal('om_collectivite', $_SESSION['collectivite']);
    }

}// fin classe
?>