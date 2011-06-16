<?php
/**
 * Ce script permet d'afficher un formulaire pour gérer l'upload de fichier
 * dans le dossier trs.
 *
 * @package openmairie_exemple
 * @version SVN : $Id: upload.php 330 2010-12-07 09:00:21Z fmichon $
 */

require_once "../obj/utils.class.php";
$f = new utils("nohtml");

/**
 * Initialisation des parametres
 */
//
(isset($_GET['form']) ? $form = $_GET['form'] : $form = "f1");

/**
 * Declaration de la fonction pArray (XXX - unused)
 */
function pArray($array) {
    print '<pre style="background:#faebd7">';
    print_r($array);
    print '</pre>';
}

/**
 * Affichage de la structure HTML
 */
//
$f->setFlag("htmlonly");
$f->display();
//
$f->displayStartContent();
//
$f->setTitle(_("Upload"));
$f->displayTitle();
//
$description = _("Cliquer sur 'Parcourir' pour selectionner le fichier a ".
                 "telecharger depuis votre poste de travail puis cliquer sur ".
                 "le bouton 'Envoyer' pour valider votre telechargement.");
$f->displayDescription($description);

/**
 * 
 */
//
(defined("PATH_OPENMAIRIE") ? "" : define("PATH_OPENMAIRIE", ""));
require_once PATH_OPENMAIRIE."upload.class.php";
//
$Upload = new Upload();

/**
 * Gestion des erreurs
 */
//
$error = false;
// Verification du post vide
if (isset($_POST['submit']) and $_FILES['userfile']['tmp_name'][0] == "") {
    $error = true;
    $f->displayMessage("error", _("Vous devez selectionner un fichier."));
}

/**
 * Formulaire soumis et valide
 */
if (isset($_POST['submit']) and $error == false) {
    
    // Gestion des extensions de fichier
    $aff_extension="";
    //
    if (isset($_GET['origine'])) {
        $tmp = "";
        $tmp = $_GET['origine'].'_extension';
    }
    if (isset(${$tmp})) {
        $Upload->Extension = ${$tmp};
        $aff_extension = ${$tmp};;
    } else {
        if (isset($f->config['upload_extension'])) {
            $Upload->Extension = $f->config['upload_extension'];
            $aff_extension = $f->config['upload_extension'];
        } else {
            $Upload->Extension = '.gif;.jpg;.jpeg;.png;.txt;.pdf;.csv';
            $aff_extension = ".gif;.jpg;.jpeg;.png;.txt;.pdf;.csv";
        }
    }
    
    // Definition du repertoire de destination
    $Upload->DirUpload = $f->getPathFolderTrs();
    
    // On lance la procedure d'upload
    $Upload->Execute();
    
    // Gestion erreur / succes
    if ($UploadError) {
        $error = true;
        // (XXX - Le foreach est inutile on traite sur un seul champ fichier)
        foreach ($Upload->GetError() as $elem) {
            foreach($elem as $elem1) {
                $f->displayMessage("error", $elem1.". "._("Extension(s) autorisee(s) :")." ".$aff_extension);
            }
        }
    } else {
        // (XXX - Le foreach est inutile on traite sur un seul champ fichier)
        foreach ($Upload->GetSummary() as $elem) {
            $nom = $elem['nom'];
            // Controle de la longueur du nom de fichier
            if (strlen($nom) > 20) {
                $error = true;
                $f->displayMessage("error", $nom." "._("contient trop de caracteres.")." "._("Autorise(s) : 20 caractere(s)."));
                break;
            }
            //
            ?>
            <script type="text/javascript">
                parent.opener.document.<?php echo $form?>.<?php echo $_GET['origine']?>.value='<?php echo $nom?>';
                parent.close();
            </script>
            <?php
        }
    }
}

/**
 * Formulaire non soumis ou non valide
 */
if (!isset($_POST['submit']) or $error == true) {
    // Pour limiter la taille d'un fichier (exprimee en ko)
    $Upload->MaxFilesize = '10000';
    // Pour ajouter des attributs aux champs de type file
    $Upload->FieldOptions = 'class="champFormulaire"';
    // Pour indiquer le nombre de champs desire
    $Upload->Fields = 2;
    // Initialisation du formulaire
    $Upload->InitForm();
    // Ouverture de la balise form
    echo "<form method=\"post\" enctype=\"multipart/form-data\" ";
    echo "name=\"formulaire\" ";//id=\"formulaire\" ";
    echo "action=\"upload.php?origine=".$_GET['origine']."&amp;form=".$form."\" ";
    echo "onsubmit=\"return valider();\">\n";
    // Affichage du champ MAX_FILE_SIZE
    print $Upload->Field[0];
    // Affichage du premier champ de type FILE
    print $Upload->Field[1];
    //
    echo "<br/>\n";
    echo "<br/>\n";
    //
    echo "<input type=\"submit\" value=\""._("Envoyer")."\" name=\"submit\" />\n";
    //
    $f->displayLinkJsCloseWindow();
    // Fermeture de la balise form
    echo "</form>\n";
}

/**
 * Affichage de la structure HTML
 */
//
$f->displayEndContent();

?>
