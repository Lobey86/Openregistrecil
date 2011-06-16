<?php
//$Id$ 
//gen openMairie le 15/10/2010 15:56 
require_once ("../gen/obj/om_collectivite.class.php");

class om_collectivite extends om_collectivite_gen {
    
    var $maj;
    
    function om_collectivite($id,&$db,$debug) {
        $this->constructeur($id,$db,$debug);
    }// fin constructeur
    
    
    function setType(&$form,$maj) {
    parent::setType($form,$maj);

       if ($maj < 2) {
        $form->setType('niveau', 'select');
       }
    }

    function verifier($val, &$db, $DEBUG) {
        parent::verifier($val, $db, $DEBUG);
        $f="&nbsp!&nbsp;&nbsp;&nbsp;&nbsp;";
        $imgv="<img src='../img/punaise.png' style='vertical-align:middle' hspace='2' border='0'>";
        if ($this->valF['niveau']==""){
            $this->msg= $this->msg.$imgv._('niveau')."&nbsp;"._('obligatoire').$f;
            $this->correct=False;
        }else
            // verification si il y a une autre collectivite multi
            if($this->valF['niveau']==2)
                if($this->maj==0)
                    $this->verifierniveau($db, $DEBUG,']');
                else
                    $this->verifierniveau($db, $DEBUG,$val['om_collectivite']);
    }

    function setSelect(&$form, $maj,$db,$debug) {
        if($maj<2){
        $contenu=array();
        $contenu[0]=array(1,2);
        $contenu[1]=array(_("mono"),_("multi"));
        $form->setSelect("niveau",$contenu);
        }
    }

    /**
     * verification sur existence d une collectivite de niveau 2
     */
    function verifierniveau(&$db, $DEBUG,$id){
        $sql = "select * from ".DB_PREFIXE."om_collectivite where niveau = '2'";
        if($id!=']')
            $sql.=" and om_collectivite !='".$id."'";
        $res = $db->query($sql);
        if($DEBUG==1) echo $sql;
        if (database::isError($res))
           die($res->getMessage(). " => Echec  ".$sql);
        else{
           $nbligne=$res->numrows();
           if ($nbligne>0){
               $this->msg= $this->msg." ".$nbligne." "._("collectivite")." "._("existant").
               " "._("niveau")." 2 ! "._("vous ne pouvez avoir qu une collectivite")." ".
               _("de")."  "._("niveau")." multi ";
               $this->correct=False;
            }
        }
    }

    function setVal(&$form, $maj, $validation, &$db, $DEBUG=null) {
        parent::setVal($form, $maj, $validation, $db, $DEBUG=null);
        $this->maj=$maj;
    }
}// fin classe
?>