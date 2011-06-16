//
var pfenetre;
var fenetreouverte = false;

////////////////////////////////////////////////////////////////////////////////
// VOIR
////////////////////////////////////////////////////////////////////////////////
//
function voir(champ) {
    //
    if (fenetreouverte == true) {
        pfenetre.close();
    }
    //
    var fichier = document.f1.elements[champ].value;
    //
    if (fichier == "") {
        alert("zone vide");
    }
    // 
    pfenetre = window.open("../spg/voir.php?fic="+fichier,"Visualisation","width=630,height=530,top=50,left=150,scrollbars=yes,resizable = yes");
    //
    fenetreouverte = true;
}
//
function voir2(champ) {
    //
    if (fenetreouverte == true) {
        pfenetre.close();
    }
    //
    var fichier = document.f2.elements[champ].value;
    //
    if (fichier == "") {
        alert("zone vide");
    }
    //
    pfenetre = window.open("../spg/voir.php?fic="+fichier,"Visualisation","width=630,height=530,top=50,left=150,scrollbars=yes,resizable = yes");
    //
    fenetreouverte = true;
}

////////////////////////////////////////////////////////////////////////////////
// LOCALISATION
////////////////////////////////////////////////////////////////////////////////
//
function localisation(champ, chplan, positionx) {
    //
    if (fenetreouverte == true) {
        pfenetre.close();
    }
    //
    var plan = document.f1.elements[chplan].value;
    var x = document.f1.elements[positionx].value;
    var y = document.f1.elements[champ].value;
    //
    pfenetre = window.open("../spg/localisation.php?positiony="+champ+"&positionx="+positionx+"&plan="+plan+"&form=f1"+"&x="+x+"&y="+y,"localisation","toolbar=no,scrollbars=yes,width=800,height=600,top=10,left=10");
    //
    fenetreouverte = true;
}

function localisation2(champ, chplan, positionx) {
    //
    if (fenetreouverte == true) {
        pfenetre.close();
    }
    //
    var plan = document.f2.elements[chplan].value;
    var x = document.f2.elements[positionx].value;
    var y = document.f2.elements[champ].value;
    //
    pfenetre = window.open("../spg/localisation.php?positiony="+champ+"&positionx="+positionx+"&plan="+plan+"&form=f2"+"&x="+x+"&y="+y,"localisation","toolbar=no,scrollbars=yes,width=800,height=600,top=10,left=10");
    //
    fenetreouverte = true;
}

////////////////////////////////////////////////////////////////////////////////
// RVB
////////////////////////////////////////////////////////////////////////////////
//
function rvb(champ) {
    //
    if (fenetreouverte == true) {
        pfenetre.close();
    }
    //
    var valeur = document.f1.elements[champ].value;
    //
    pfenetre = window.open("../spg/rvb.php?retour="+champ+"&valeur="+valeur+"&form=f1","rvb","width=450,height=450,resizable=1");
    //
    fenetreouverte = true;
}

function rvb2(champ) {
    //
    if (fenetreouverte == true) {
        pfenetre.close();
    }
    //
    var valeur = document.f2.elements[champ].value;
    //
    pfenetre = window.open("../spg/rvb.php?retour="+champ+"&valeur="+valeur+"&form=f2","rvb","width=450,height=450,resizable=1");
    //
    fenetreouverte = true;
}

////////////////////////////////////////////////////////////////////////////////
// UPLOAD
////////////////////////////////////////////////////////////////////////////////
//
function vupload(champ) {
    //
    if (fenetreouverte == true) {
        pfenetre.close();
    }
    //
    pfenetre = window.open("../spg/upload.php?origine="+champ+"&form=f1","upload","width=400,height=300,top=120,left=120");
    //
    fenetreouverte = true;
}
//
function vupload2(champ) {
    //
    if (fenetreouverte == true) {
        pfenetre.close();
    }
    //
    pfenetre = window.open("../spg/upload.php?origine="+champ+"&form=f2","upload","width=400,height=300,top=120,left=120");
    //pfenetre = window.open("../spg/upload2.php?origine="+champ,"upload2","width=300,height=100,top=120,left=120");
    //
    fenetreouverte = true;
}

////////////////////////////////////////////////////////////////////////////////
// CORREL
////////////////////////////////////////////////////////////////////////////////
// comboG comboD
function vcorrel(champ, zcorrel2, params) {
    //
    if (fenetreouverte == true) {
        pfenetre.close();
    }
    //
    var rec = document.f1.elements[champ].value;
    var temp = zcorrel2;
    //
    if (temp == "s1") {
        zcorrel2 = "";
        temp = "s1";
    } else {
        zcorrel2 = document.f1.elements[zcorrel2].value;
    }
    //
    pfenetre = window.open("../spg/combo.php?origine="+champ+"&recherche="+rec+params+"&zcorrel2="+zcorrel2+"&form=f1","Correspondance","width=600,height=300,top=120,left=120");
    //
    fenetreouverte = true;
}
// comboG2 et comboD2
function vcorrel2(champ, zcorrel2, params) {
    //
    if (fenetreouverte == true) {
        pfenetre.close();
    }
    //
    var rec = document.f2.elements[champ].value;
    var temp = zcorrel2;
    //
    if (temp == "s1") {
        zcorrel2 = "";
        temp = "s1";
    } else {
        zcorrel2 = document.f2.elements[zcorrel2].value;
    }
    //
    pfenetre = window.open("../spg/combo.php?origine="+champ+"&recherche="+rec+params+"&zcorrel2="+zcorrel2+"&form=f2","Correspondance","width=600,height=300,top=120,left=120");
    //
    fenetreouverte = true;
}
// comboC
function vcorrel3(champ) {
    //
    if (fenetreouverte == true) {
        pfenetre.close();
    }
    //
    var val = document.f1.elements[champ].value;
    //
    pfenetre = window.open("../spg/combobba.php?table="+champ+"&val="+val,champ,"width=500,height=150,top=120,left=120");
    //
    fenetreouverte = true;
}

////////////////////////////////////////////////////////////////////////////////
// CHECKBOX
////////////////////////////////////////////////////////////////////////////////
//
function changevaluecheckbox(object) {
    if (object.value == "Oui") {
        object.value = "";
    } else {
        object.value = "Oui";
    }
}
//
function changevaluecheckboxnum(object) {
    if (object.value == 1) {
        object.value = "0";
    } else {
        object.value = 1;
    }
}

////////////////////////////////////////////////////////////////////////////////
// 
////////////////////////////////////////////////////////////////////////////////
//

//textmultiarea
function selectauto(champ,selection)
{
if(document.f1.elements[champ].value=="")
   document.f1.elements[champ].value=document.f1.elements[selection].value;
else
   document.f1.elements[champ].value=document.f1.elements[champ].value+"\n"+document.f1.elements[selection].value;
   
document.f1.elements[selection].value="";
}
//selectlistemulti
function refresh_ids(champ,champ3) {
 var tids=document.f1.elements[champ3];
 var lids=document.f1.elements[champ];
 tids.value="";
 if (lids.options.length>0) {
    for (i=0;i<lids.options.length;i++) 
      if (lids.options[i].value) tids.value+=lids.options[i].value+",";
    tids.value=tids.value.substring(0,tids.value.length-1);
 }
}
function addlist(champ,champ2,champ3) {
  var linst=document.f1.elements[champ2];
  var lids=document.f1.elements[champ];
  if (linst.selectedIndex>=0) {
    lids.options[lids.options.length]=new Option(linst.options[linst.selectedIndex].text,linst.options[linst.selectedIndex].value);  
    refresh_ids(champ,champ3);
  }
}
function removelist(champ,champ3) {
  var lids=document.f1.elements[champ];
  if (lids.selectedIndex>=0) {
    lids.remove(lids.selectedIndex);  
    refresh_ids(champ,champ3);
  }                    
}
function removealllist(champ,champ3) {
  var lids=document.f1.elements[champ];
  lids.options.length=0;
  refresh_ids(champ,champ3);
  document.f1.elements["_unselect+champ"].disabled=false;
  document.f1.elements["_select+champ"].disabled=false;
}
