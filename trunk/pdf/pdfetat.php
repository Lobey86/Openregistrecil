<?php
/**
 *
 *
 * @package openmairie_exemple
 * @version SVN : $Id: pdfetat.php 278 2010-11-30 07:12:41Z fmichon $
 * parametre etat dans la table om_etat
 */

require_once "../obj/utils.class.php";
$f = new utils("nohtml");

/**
 *
 */
// Nom de l'objet metier
(isset($_GET['obj']) ? $obj = $_GET['obj'] : $obj = "");
//
(isset($_GET['idx']) ? $idx = $_GET['idx'] : $idx = "");
//
$collectivite = $f->collectivite;
$niveau='';
// requete SQL
    $sql= "select * from ".DB_PREFIXE."om_etat where id='".$obj."'"; // select obj
    $sql.= " and actif ='Oui'";
    $sql.= " and om_collectivite ='".$_SESSION['collectivite']."'";
    $res1 = $f->db->query($sql);
    $f->isDatabaseError($res1);

    if ($res1->numrows()==0){
        $sql="select om_collectivite from ".DB_PREFIXE."om_collectivite where niveau ='2'";
        $niveau=$f->db->getOne($sql);
        $res1->free();
        $sql= "select * from ".DB_PREFIXE."om_etat where id='".$obj."'"; // select obj
        $sql.= " and actif ='Oui'";
        $sql.= " and om_collectivite ='".$niveau."'";
        $res1 = $f->db->query($sql);
        $f->isDatabaseError($res1);
    }
    
    if ($res1->numrows()==0){
        $res1->free();
        $sql= "select * from ".DB_PREFIXE."om_etat where id='".$obj."'"; // select obj
        $sql.= " and om_collectivite ='".$niveau."'";
        $res1 = $f->db->query($sql);
        $f->isDatabaseError($res1);
    }
/**
 *
 */
//
set_time_limit(180);
//
require_once PATH_OPENMAIRIE."fpdf_etat.php";
//require_once "fpdf_etat.php"; // remttre le PATH ***
// INSTANCE PDF            =====================================
// orientation P= portrait L=paysage
// unite mm (milimetre)
// format A4 A3
// =============================================================
$unite="mm";
while ($etat =& $res1->fetchRow(DB_FETCHMODE_ASSOC)) {
    // transformation en tableau
    if(trim($etat['sousetat']) !=''){
        $sousetatliste=explode(chr(13).chr(10),$etat['sousetat']);
    }else
        $sousetatliste='';
    $etat['se_couleurtexte']=explode("-", $etat['se_couleurtexte']);
    $pdf=new PDF($etat["orientation"],$unite,$etat["format"]);
    //
    $pdf->footerfont=$etat["footerfont"];
    $pdf->footertaille=$etat["footertaille"];
    $pdf->footerattribut=$etat["footerattribut"];
    $pdf->SetMargins($etat['se_margeleft'],$etat['se_margetop'],$etat['se_margeright']); //marge gauche,haut,droite par defaut 10mm
    $pdf->SetDisplayMode('real','single');
    // methode fpdf calcul nombre de page
    $pdf->AliasNbPages();
    // methode de creation de page
    $pdf->AddPage();
    // police ======================================================
    // setFont 0 = times, arial
    //         1 = I B ou ''
    //         2 = 8 ....
    // affichage image =============================================
    // image     0 = nom
    //           1 = left
    //           2 = top
    //           3 = width 0=calcul auto
    //           4 = hauteur 0=calcul auto
    //           5 = type image  rien=exetension du fichier
    //           6 = lien
    // setXY (left,top) =============================================
    // affichage multicell ==========================================
    // multicell 0 = width   =0 left->droite
    //           1 = hauteur de la cellule
    //           2 = texte
    //           3 = bordure (0 ou 1)
    //           4 = align (L C R J)
    //           5 =     0 fd transparent
    //                   1 couleur (parametre a rajouter)
    // ==============================================================
    
    $temp = $f->getPathFolderTrs().$etat['logo'];
    $pdf->Image($temp,
                $etat["logoleft"],
                $etat["logotop"],
                0,
                0,
                '',
                '');
    
    // variables statiques
    $sql=$etat['om_sql']; // ****
    $titre= $etat["titre"];
    $corps= $etat["corps"];
    include("../dyn/varetatpdf.inc");
    $res = $f->db->query($sql);
    $f->isDatabaseError($res);
    while ($row=& $res->fetchRow(DB_FETCHMODE_ASSOC)){
        //___________________________________________________________________________
        // titre                                                                   //
        //___________________________________________________________________________
        //
        $temp = explode("[",$titre);
        for($i=1;$i<sizeof($temp);$i++){
            $temp1 = explode("]",$temp[$i]);
            $titre=str_replace("[".$temp1[0]."]",$row[$temp1[0]],$titre);
            $temp1[0]="";
        }
        //echo $titre;
        //************************************************
        // traitement attribut affichage <b> dans titre  *
        //              aout 2008                        *
        //************************************************
        
        $pos_t="";
        $pos_t = strpos($titre, "<b>");
        
        if ($pos_t === false) {
        // compatibilite :aucun attribut affichage <b> dans corps
        //***************************************************************************
          
            if(trim($titre)!="") {
                $pdf->SetFont($etat["titrefont"],
                             $etat["titreattribut"],
                             $etat["titretaille"]);
                $pdf->SetXY($etat["titreleft"],
                           $etat["titretop"]);
                $pdf->MultiCell($etat["titrelargeur"],
                               $etat["titrehauteur"],
                               $titre,
                               $etat["titrebordure"],
                               $etat["titrealign"],
                           0);
            }
        //****************************************************************************
        // attribut affichage <b> present  dans titre
        
        }else{
          $pdf->SetY($etat["titretop"]);
          $tmptitre="";
          $tmptitre=explode('<b>', $titre);
          //
            for($y=0;$y<sizeof($tmptitre);$y++){
                $pos1="";
                $pos1 = strpos($tmptitre[$y], "</b>");
                //
                if ($pos1 === false) {
                    if(trim($tmptitre[$y])!="") {
                        $pdf->SetFont($etat["titrefont"],$etat["titreattribut"],$etat["titretaille"]);
                        $pdf->SetX($etat["titreleft"]);
                        $pdf->MultiCell($etat["titrelargeur"],$etat["titrehauteur"],$tmptitre[$y],$etat["titrebordure"],$etat["titrealign"],0);
                    }
                }else{
                    $ctrl_fin_b=0;
                    $ctrl_fin_b=substr_count($tmptitre[$y],"</b>");
                    $etat["titreattribut"] = str_replace("B","",$etat["titreattribut"]);
                    $etat["titreattribut"] = str_replace("b","",$etat["titreattribut"]);
                    if ($ctrl_fin_b>1){
                        // nbr </b> superieur a 1
                        if(trim($tmptitre[$y])!="") {
                           $pdf->SetFont($etat["titrefont"],"B".$etat["titreattribut"],$etat["titretaille"]);
                           $pdf->SetX($etat["titreleft"]);
                           $pdf->MultiCell($etat["titrelargeur"],$etat["titrehauteur"],$tmptitre[$y],$etat["titrebordure"],$etat["titrealign"],0);
                        }
                    }else{
                        $tmptitre1 = explode("</b>",$tmptitre[$y]);
                        //
                        if(trim($tmptitre1[0])!="") {
                             $pdf->SetFont($etat["titrefont"],"B".$etat["titreattribut"],$etat["titretaille"]);
                             $pdf->SetX($etat["titreleft"]);
                            $pdf->MultiCell($etat["titrelargeur"],$etat["titrehauteur"],$tmptitre1[0],$etat["titrebordure"],$etat["titrealign"],0);
                        }
                        if(trim($tmptitre1[1])!=""){
                            $pdf->SetFont($etat["titrefont"],$etat["titreattribut"],$etat["titretaille"]);
                            $pdf->SetX($etat["titreleft"]);
                            $pdf->MultiCell($etat["titrelargeur"],$etat["titrehauteur"],$tmptitre1[1],$etat["titrebordure"],$etat["titrealign"],0);
                        }
                    }
                }
            }
        }
        //
        //____________________________________________________________________________
        // corps                                                                    //
        //____________________________________________________________________________
        $temp = explode("[",$etat["corps"]);
        for($i=1;$i<sizeof($temp);$i++){
            $temp1 = explode("]",$temp[$i]);
            $corps=str_replace("[".$temp1[0]."]",$row[$temp1[0]],$corps);
            $temp1[0]="";
        }
        //************************************************
        // traitement attribut affichage <b> dans corps  *
        //              aout 2008                        *
        //************************************************
        $pos="";
        $pos = strpos($corps, "<b>");
        if ($pos === false) {
       // compatibilite :aucun attribut affichage dans corps
       //***************************************************************************
            if(trim($corps)!="") {
                $pdf->SetFont($etat["corpsfont"],
                              $etat["corpsattribut"],
                              $etat["corpstaille"]);
                $pdf->SetXY($etat["corpsleft"],
                            $etat["corpstop"]);
                $pdf->MultiCell($etat["corpslargeur"],
                                $etat["corpshauteur"] ,
                                $corps,
                                $etat["corpsbordure"],
                                $etat["corpsalign"],
                                0);
            }
      //****************************************************************************
      // attribut affichage <b> present  dans corps
      // echo $corps;
      }else{
            $pdf->SetXY($etat["corpsleft"],$etat["corpstop"]);
            $tmp="";
            $tmp=explode('<b>', $corps);
            //
            for($x=0;$x<sizeof($tmp);$x++){
                $pos1="";
                $pos1 = strpos($tmp[$x], "</b>");
                if ($pos1 === false) {
                  if(trim($tmp[$x])!=""){
                   $pdf->SetFont($etat["corpsfont"],$etat["corpsattribut"],$etat["corpstaille"]);
                   $pdf->write($etat["corpshauteur"],$tmp[$x]);
                  }
                }else{
                    $ctrl_fin_b=0;
                    $ctrl_fin_b=substr_count($tmp[$x],"</b>");
                    $etat["corpsattribut"] = str_replace("B","",$etat["corpsattribut"]);
                    $etat["corpsattribut"] = str_replace("b","",$etat["corpsattribut"]);
                    if ($ctrl_fin_b>1){
                        // nbr </b> superieur a 1
                        if(trim($tmp[$x])!=""){
                            $pdf->SetFont($etat["corpsfont"],"B".$etat["corpsattribut"],$etat["corpstaille"]);
                            $pdf->write($etat["corpshauteur"],$tmp[$x]);
                        }
                    }else{
                        $tmp1 = explode("</b>",$tmp[$x]);
                        //
                        if(trim($tmp1[0])!=""){
                            $nbcar=0;
                            $nbcar=$tmp1[0];
                            if( strlen($nbcar)==1) {
                                // ??????bug fpdf write si affichage 1 seul caractere -> ajout 2 blancs
                                $pdf->SetFont($etat["corpsfont"],"B".$etat["corpsattribut"],$etat["corpstaille"]);
                                $pdf->write($etat["corpshauteur"],"  ".$tmp1[0]."  ");
                            }else{
                                $pdf->SetFont($etat["corpsfont"],"B".$etat["corpsattribut"],$etat["corpstaille"]);
                                $pdf->write($etat["corpshauteur"],$tmp1[0]);
                            }
                        }
                        if(trim($tmp1[1])!=""){
                            $pdf->SetFont($etat["corpsfont"],$etat["corpsattribut"],$etat["corpstaille"]);
                            $pdf->write($etat["corpshauteur"],$tmp1[1]);
                        }
                    }
                }
            }
        }// fin attribut affichage
      //****************************************************************************
       
    }
    
    // affichage des sous etats
    if($sousetatliste!="") {
        foreach($sousetatliste as $elem){
            $sql= "select * from ".DB_PREFIXE."om_sousetat where id='".trim($elem)."'"; 
            $sql.= " and actif ='Oui'";
            $sql.= " and om_collectivite ='".$_SESSION['collectivite']."'";
            $res2 = $f->db->query($sql);
            $f->isDatabaseError($res2);
            
            if ($res2->numrows()==0){
                if($niveau==''){
                    $sql="select om_collectivite from ".DB_PREFIXE."om_collectivite where niveau =2";
                    $niveau=$f->db->getOne($sql);
                }
                $res2->free();
                $sql= "select * from ".DB_PREFIXE."om_sousetat where id='".trim($elem)."'"; 
                $sql.= " and actif ='Oui'";
                $sql.= " and om_collectivite ='".$niveau."'";
                $res2 = $f->db->query($sql);
                $f->isDatabaseError($res2);
            }
            
            if ($res2->numrows()==0){
                $res2->free();
                $sql= "select * from ".DB_PREFIXE."om_sousetat where id='".trim($elem)."'"; // select obj
                $sql.= " and om_collectivite ='".$niveau."'";
                $res2 = $f->db->query($sql);
                $f->isDatabaseError($res1);
            }
   
            // =========================================================================
            // traitementde variables : &
            
            while ($sousetat =& $res2->fetchRow(DB_FETCHMODE_ASSOC)) {
                $sql='';$titre='';
                $sql=$sousetat['om_sql'];
                $titre=$sousetat['titre'];
                include("../dyn/varetatpdf.inc");
                $sousetat['om_sql']=$sql;
                $sousetat['titre']=$titre;;
                //imprime  les colonnes de la requete
                $pdf->sousetatdb($f->db,$etat,$sousetat);
            }
        }
        //
    }
    
    //
    $pdf->Output();
} // fin while 
?>