//

// global declarations
var num = 0;
var posx;
var posy;
var scrollx;
var scrolly;
var origwidth;
var origheight;
var divimageleft;
var divimagetop;
var camapleft = new Array();
var camaptop = new Array();

function getPositionCurseur(e){
//ie
if(document.all){
  posx = event.clientX;
  posy  = event.clientY;
  scrollx = document.body.scrollLeft;
  scrolly = document.body.scrollTop;
} else if(document.layers) { //netscape 4
  posx  = e.pageX;
  posy  = e.pageY;
  scrollx = document.body.scrollLeft;
  scrolly = document.body.scrollTop;
} else if(document.getElementById) { //mozilla
  posx  = e.clientX;
  posy  = e.clientY;
  scrollx = document.body.scrollLeft;
  scrolly = document.body.scrollTop;
}
}

// initialisation
function init() {
   divimageleft=0;
   divimagetop=0;
   origwidth = document.myimage.width;
   origheight = document.myimage.height;
   i=1;
   while (document.getElementById("camap"+i)) {
      camapleft[i]=parseInt(document.getElementById("camap"+i).style.left);
      camaptop[i]=parseInt(document.getElementById("camap"+i).style.top);
//alert("objet"+i+" L"+camapleft[i]+" T"+camaptop[i]);
      i++;
   }
   document.onmousemove = getPositionCurseur;
}

function changer() {

if (num == 0) {
   num = 1;
   document.myimage.width = origwidth*2;
   document.myimage.height = origheight*2;

   divimageleft = -((posx+scrollx));
   divimagetop = -((posy+scrolly));

   document.getElementById("divimage").style.left=divimageleft;
   document.getElementById("divimage").style.top=divimagetop;

   for(i=1;i<camapleft.length;i++) {
//alert("Objet"+i+" L"+document.getElementById("camap"+i).style.left+" T"+document.getElementById("camap"+i).style.top);
      document.getElementById("camap"+i).style.left=(camapleft[i]*2)+divimageleft;
      document.getElementById("camap"+i).style.top=(camaptop[i]*2)+divimagetop;
      document.images[i].width=parseInt(document.images[i].width)*2;
//pas necessaire car rapport image conserve
//      document.images[i].height=parseInt(document.images[i].height)*2;
   }
} else {
  num = 0;
  for(i=1;i<camapleft.length;i++) {
      document.getElementById("camap"+i).style.left=camapleft[i];
      document.getElementById("camap"+i).style.top=camaptop[i];
      document.images[i].width=parseInt(document.images[i].width)/2;
//pas necessaire car rapport image conserve
//      document.images[i].height=parseInt(document.images[i].height)/2;
//alert("Objet"+i+" L"+document.getElementById("camap"+i).style.left+" T"+document.getElementById("camap"+i).style.top);
  }
  document.myimage.width = origwidth;
  document.myimage.height = origheight
  document.getElementById("divimage").style.left=0;
  document.getElementById("divimage").style.top=0;
}
}

