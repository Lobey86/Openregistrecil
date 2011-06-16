
function ajaxIt(objsf, link) {
    
    // recuperation du terme recherche
    var recherche = document.getElementById("recherchedyn");
    if (recherche != null) {
        link += "&recherche="+recherche.value;
    }else {
        link += "&recherche=";
    }
    
    // execution de la requete en POST
    $.ajax({
        type: "GET",
        url: link,
        cache: false,
        success: function(html){
            $("#sousform-"+objsf).empty();
            $("#sousform-"+objsf).append(html);
            $("button, input:submit, input:reset, input:button, p.linkjsclosewindow").button();
        }
    });
    
}

function recherche(link) {
    
    // recuperation de l'objsf
    var $tabs = $('#formulaire').tabs();
    var selected = $tabs.tabs('option', 'selected');
    $("#formulaire ul a").each(function(i){
        if (i === selected) {
            objsf =  $(this).attr("id");
        }
    }); 
    
    // recuperation du terme recherche
    link += "&obj="+objsf;
    
    //
    ajaxIt(objsf, link);
    
}

function affichersform(objsf, link, formulaire) {
    
    // composition de la chaine data en fonction des elements du formulaire
    var data = ""
    if (formulaire) {
        for (i=0;i<formulaire.elements.length;i++) {
            data+=formulaire.elements[i].name+"="+formulaire.elements[i].value+"&";
        }
    }
    
    // recuperation du terme recherche
    var recherche = document.getElementById("recherchedyn").value;
    link += "&recherche="+recherche;
    
    // execution de la requete en POST
    $.ajax({
        type: "POST",
        url: link,
        cache: false,
        data: data,
        success: function(html){
            $("#sousform-"+objsf).empty();
            $("#sousform-"+objsf).append(html);
            $("button, input:submit, input:reset, input:button, p.linkjsclosewindow").button();
        }
    });
    
}
