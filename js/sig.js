function selected (evt) {
    // fonction de test evenement suite select objet
    alert(evt.feature.id + " selected on " + this.name);
}

// ouverture du popup couche json
function ouvre_popup(page) {
   if (fenetreouverte == true)
       pfenetre.close ();
   pfenetre=window.open(page,"nom_popup","resizable=no, location=no, width=700, height=500, menubar=no, status=no, scrollbars=yes, menubar=no, top=100,left=100");
   fenetreouverte=true;
}

// fermeture du popup avec la croix rouge
function onPopupClose(evt) {
         select_json.unselectAll();
}
 
// selection de point json -> popup
function onFeatureSelect(event) {
   var feature, contenuHtml, popup;
   feature = event.feature;
   var contenuHtml =  "<div  style='font-size:"+fontsize_popup+";margin:1em 1em 1em 1em;width:"+width_popup+"px'><font  style='color:"+couleurtitre_popup+";font-weight:"+weightitre_popup+";'>" + feature.attributes.titre + "<br></font>";
   contenuHtml = contenuHtml + feature.attributes.description + "</div>";      
   popup = new OpenLayers.Popup.Anchored("featurePopup",
	       feature.geometry.getBounds().getCenterLonLat(),
	       new OpenLayers.Size(200, 200),
	       contenuHtml,
	       {size: new OpenLayers.Size(0, 0), offset: new OpenLayers.Pixel(0, 0)},
	       true,
	       onPopupClose);
   popup.setBackgroundColor(fond_popup);
   popup.setBorder(cadre_popup+"px solid "+couleurcadre_popup);    
   popup.autoSize = true;
   feature.popup = popup;
   popup.feature = feature;
   popup.setOpacity(opacity_popup);
   map.addPopup(popup);
}

// deselection de point json -> fermeture popup
function onFeatureUnselect(event) {
   var feature = event.feature;
   if(feature.popup) {
      map.removePopup(feature.popup);
      feature.popup.destroy();
      delete feature.popup;
   }
}

// a la fin du chargement de la couche wkt
// si il y a un identifiant idx, zoom sur idx
// a voir : eviter de faire un center sur un bound alors qu on a le pt de centrage
function onLayerLoaded(evt) {
    if (idx!='') {
        map.setCenter(vectors.features[0].geometry.getBounds().getCenterLonLat());       
    } 
}

// en selection du pt wkt : saisie du point selectionne
function onSaisieSelect(evt){
    //ne pas faire la transformation sur la couche mais sur un clone
    geom = evt.feature.geometry.clone()
    geom.transform(mercator, projection_externe);
    if(fenetreouverte==true)
        pfenetre.close();
    //compatibilite IE -> mettre des ' au lieu de "
    pfenetre=window.open("form_sig_point.php?obj="+obj+"&idx="+idx+"&geom="+geom+"&table="+table+"&champ="+champ, 'saisie_geometrie', 'width=400,height=300,top=120,left=120' );
    fenetreouverte=true;
}

// deselection du pt wkt
function onSaisieUnselect(evt){
    if(fenetreouverte==true)
        pfenetre.close();
}

// le panneau de controle est active suivant les etats
function panneau_controle(element) {
    // gestion des controles
    if(element.value == 'Dessiner') {
        controls['point'].activate();
        controls['select'].deactivate();
        controls['modify'].deactivate();
        controls['drag'].deactivate();
        select_json.deactivate(); 
    }
    if(element.value == 'Deplacer') {
         controls['drag'].activate();
         controls['select'].activate();
         select_json.deactivate(); 
    }
    if(element.value == 'Enregistrer') {
        controls['select'].activate();
        controls['modify'].activate();
        controls['point'].deactivate();
        controls['drag'].deactivate();
        select_json.deactivate(); 
    }   
    if(element.value == 'Data') {
        select_json.activate();
        controls['select'].deactivate();
        controls['modify'].deactivate();
        controls['point'].deactivate();
        controls['drag'].deactivate();
    }
}

//restrictedextend
function toggleRestrictedExtent() {
    if(map.restrictedExtent == null) {
        map.setOptions({restrictedExtent: extent});
    } else {
        map.setOptions({restrictedExtent: null});
    }
}

// Indicateur de l etat de l interface
function msg(a) {
  document.getElementById("indication").innerHTML=a;
}

