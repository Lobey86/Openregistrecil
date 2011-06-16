var pfenetre;
var fenetreouverte = false;
// espagnol
var lang_calendrier = "calendar";
var lang_numerique = "vous devez saisir que des nombres";

// Parametrage du calendrier jquery ui
var currDate = new Date ();
var currYear = currDate.getFullYear();
var maxYear = currYear + 20;
var minYear = currYear - 120;
var dateFormat = 'dd/mm/yy';

$(function() {
    // Affichage du menu
	$("#menu-list").accordion({
		autoHeight: false,
		collapsible: true,
		active : false
	});
    // Skin en bouton
    $("button, input:submit, input:reset, input:button, p.linkjsclosewindow").button();
    //
    var $tabs = $("#formulaire").tabs({
        select: function(event, ui) {
            // Suppression du contenu de l'onglet precedemment selectionne
            // #ui-tabs-X correspond uniquement aux ids des onglets charges
            // dynamiquement
            selectedTabIndex = $tabs.tabs('option', 'selected');
            $("#ui-tabs-"+selectedTabIndex).empty();
            // Gestion de la recherche
            // Si le nouvel onglet clique est un onglet qui charge dynamiquement
            // son contenu
            var url = $.data(ui.tab, 'load.tabs');
            if (url) {
                // On affiche la recherche
                var recherche = document.getElementById("recherchedyn").value;
                url += "&recherche="+recherche;
                $("#recherche_onglet").removeAttr("style");
                $tabs.tabs("url", ui.index, url);
            } else {
                // On cache la recherche
                $("#recherche_onglet").attr("style", "display:none;")
            }
            return true;
        },
        ajaxOptions: {
            error: function(xhr, status, index, anchor) {
                $(anchor.hash).html("Couldn't load this tab. We'll try to fix this as soon as possible. If this wouldn't be a demo.");
            }
        }
    });
    //
	$(".datepicker").datepicker({
		dateFormat: dateFormat,
		changeMonth: true,
		changeYear: true,
		yearRange: minYear+':'+maxYear,
		showOn: 'button',
		buttonImage: '../img/calendar.png',
		buttonImageOnly: true,
		constrainInput: true
	});
    //
	$("#accordion").accordion({
		autoHeight: false,
		collapsible: true,
		active : false
    });
    //
    $("fieldset.collapsible").collapse();
    $("fieldset.startClosed").collapse( { closed: true } );
});

function aide (obj)
{
    if (fenetreouverte == true)
        pfenetre.close ();
    pfenetre = window.open ("../doc/"+obj+".html", "Aide", "toolbar=no, scrollbars=yes, status=no, width=600, height=400, top=120, left=120");
    fenetreouverte = true;
}

function traces (fichier)
{
    if (fenetreouverte == true)
        pfenetre.close ();
    pfenetre = window.open ("../tmp/"+fichier, "Traces", "toolbar=no, scrollbars=yes, status=no, width=600, height=400, top=120, left=120");
    fenetreouverte = true;
}

function vdate (origine)
{
    if (fenetreouverte == true)
        pfenetre.close ();
    pfenetre = window.open ("../spg/calendrier.php?origine="+origine, "Calendrier", "width=310, height=230, top=120, left=120");
    fenetreouverte = true;
}

function fdate (champ)
{
    var flag = 0;
    var jour = "";
    var mois = "";
    var annee = "";

    if (champ.value.lastIndexOf("/") == -1 && (champ.value.length == 6 || champ.value.length == 8))
    {
        jour = champ.value.substring(0,2);
        mois = champ.value.substring(2,4);
        if (champ.value.length == 6)
            annee = "20"+champ.value.substring(4,6);
        if (champ.value.length == 8)
            annee = champ.value.substring(4,8);
    }
    
    if (champ.value.lastIndexOf("/") != -1 && (champ.value.length == 8 || champ.value.length == 10))
    {
        jour = champ.value.substring(0,2);
        mois = champ.value.substring(3,5);
        if (champ.value.length == 8)
            annee = "20"+champ.value.substring(6,8);
        if (champ.value.length == 10)
            annee = champ.value.substring(6,10);
    }

    if (isNaN (jour) || isNaN (mois) || isNaN (annee))
    {   
        flag = 1;
    }

    if (jour < '01' || jour > '31' || mois < '01' || mois > '12' || annee < '0000' || annee > '9999')
    {
        flag = 1;
    }

    if (flag == 0)
    {
        champ.value = jour+"/"+mois+"/"+annee;
    }
    else
    {
        champ.value = "";
        alert("La date n'est pas valide!")
        return;
    }
}

function ftime (champ)
{
    var flag = 0;
    var heure = "";
    var minute = "";
    var seconde = "";

    if (champ.value.lastIndexOf(":") == -1 && (champ.value.length == 2 || champ.value.length == 4 || champ.value.length == 6))
    {
        heure = champ.value.substring(0,2);
        if (champ.value.length == 2)
        {
            minute = "00";
            seconde = "00";
        }
        if (champ.value.length == 4)
        {
            minute = champ.value.substring(2,4);
            seconde = "00";
        }
        if (champ.value.length == 6)
        {
            minute = champ.value.substring(2,4);
            seconde = champ.value.substring(4,6);
        }
    }
    
    if (champ.value.lastIndexOf(":") != -1 && (champ.value.length == 5 || champ.value.length == 8))
    {
        heure = champ.value.substring(0,2);
        if (champ.value.length == 5)
        {
            minute = champ.value.substring(3,5);
            seconde = "00";
        }
        if (champ.value.length == 8)
        {
            minute = champ.value.substring(3,5);
            seconde = champ.value.substring(6,8);
        }
    }

    if (isNaN (heure) || isNaN (minute) || isNaN (seconde))
    {   
        flag = 1;
    }

    if (heure < '00' || heure > '23' || minute < '00' || minute > '59' || seconde < '00' || seconde > '59')
    {
        flag = 1;
    }

    if (flag == 0)
    {
        champ.value = heure+":"+minute+":"+seconde;
    }
    else
    {
        champ.value = "";
        alert("L'heure n'est pas valide!")
        return;
    }
}


function vupload (origine)
{
    if (fenetreouverte == true)
        pfenetre.close ();
    pfenetre=window.open("../spg/upload.php?origine="+origine,"Upload","width=300,height=200,top=120,left=120");
    fenetreouverte=true;
}





function VerifNum (champ)
{
    if  (isNaN (champ.value))
    {
        alert (lang_numerique);
        champ.value = "";
        return;
    }
    champ.value = champ.value.replace (".", "");
}

function aff(file) {
    if (fenetreouverte == true) {
        pfenetre.close();
    }
    pfenetre = window.open("../gen/aff.php?file="+file, "fichier", "width=600,height=400,top=120,left=120,scrollbars=yes");
    fenetreouverte = true;
}

function adresse_postale(form,libelle_voie,numero_voie)
{
if(fenetreouverte==true)
       pfenetre.close();
pfenetre=window.open("../sig/adresse_postale.php?form="+form+"&libelle_voie="+libelle_voie.replace('\'','\\\'')+"&numero_voie="+numero_voie,"adresse_postale","width=400,height=400,top=120,left=120");
fenetreouverte=true;
}

function adresse_postale_google(form,libelle_voie,numero_voie)
{
if(fenetreouverte==true)
       pfenetre.close();
pfenetre=window.open("../sig/adresse_postale_google.php?form="+form+"&libelle_voie="+libelle_voie.replace('\'','\\\'')+"&numero_voie="+numero_voie,"adresse_postale","width=400,height=400,top=120,left=120");
fenetreouverte=true;
}

function ajouter (bloc,login,profil)
{
    if (fenetreouverte == true)
        pfenetre.close ();
    pfenetre=window.open("../tdb/ajouter.php?bloc="+bloc+"&login="+login+"&profil="+profil,"Ajouter","width=300,height=100,top=120,left=120");
    fenetreouverte=true;
}
function supprimer (id,bloc,login)
{
    if (fenetreouverte == true)
        pfenetre.close ();
    pfenetre=window.open("../tdb/supprimer.php?idx="+id+"&bloc="+bloc+"&login="+login,"Supprimer","width=300,height=100,top=120,left=120");
    fenetreouverte=true;
}

function deplacer_gauche (id,bloc,login)
{
    if (fenetreouverte == true)
        pfenetre.close ();
    pfenetre=window.open("../tdb/deplacer_gauche.php?idx="+id+"&bloc="+bloc+"&login="+login,"Deplacer","width=300,height=100,top=120,left=120");
    fenetreouverte=true;
}

function deplacer_droite (id,bloc,login)
{
    if (fenetreouverte == true)
        pfenetre.close ();
    pfenetre=window.open("../tdb/deplacer_droite.php?idx="+id+"&bloc="+bloc+"&login="+login,"Deplacer","width=300,height=100,top=120,left=120");
    fenetreouverte=true;
}
function deplacer_haut (id,bloc,login,position)
{
    if (fenetreouverte == true)
        pfenetre.close ();
    pfenetre=window.open("../tdb/deplacer_haut.php?idx="+id+"&bloc="+bloc+"&login="+login+"&position="+position,"Deplacer","width=300,height=100,top=120,left=120");
    fenetreouverte=true;
}

function deplacer_bas (id,bloc,login,position)
{
    if (fenetreouverte == true)
        pfenetre.close ();
    pfenetre=window.open("../tdb/deplacer_bas.php?idx="+id+"&bloc="+bloc+"&login="+login+"&position="+position,"Deplacer","width=300,height=100,top=120,left=120");
    fenetreouverte=true;
}


