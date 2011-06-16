// global declarations
var offsetX = 0
var offsetY = 0
var selectedObj  // objet selectionne
var states = new Array() // tableau decrivant l'objet
var recupx // variable X recuperer
var recupy // variable Y recuperer

// initialisation
function init() {
    initArray()
    document.onmousemove = release
}
// initialisation du tableau et implementation de l'objet
function initArray() {
    states["ca"] = new state("ca")
}
function state(abbrev) {
    this.abbrev = abbrev
    this.done = false
    // assigne les evenements
    // copier glisser
    assignEvents(this)
}
// assigne les evenements
function assignEvents(layer) {
    var obj
    if (document.layers) {
        obj = document.layers[layer.abbrev + "map"]
        obj.captureEvents(Event.MOUSEDOWN | Event.MOUSEMOVE | Event.MOUSEUP )
    } else if (document.all) {
        obj = document.all(layer.abbrev + "map")
    } else if (document.getElementById) {
        obj = document.getElementById(layer.abbrev + "map")
    }
    if (obj) {
        // clic sur l objet
        obj.onmousedown = engage
        // glisser l objet
        obj.onmousemove = dragIt
        // relacher l objet
        obj.onmouseup = release

    }
}
// clic sur l objet
function engage(evt) {
    evt = (evt) ? evt : event
    setSelectedMap(evt)
    if (selectedObj) {
        if (evt.pageX) {
            offsetX = evt.pageX - ((selectedObj.offsetLeft) ? selectedObj.offsetLeft : selectedObj.left)
            offsetY = evt.pageY - ((selectedObj.offsetTop) ? selectedObj.offsetTop : selectedObj.top)
        } else if (evt.offsetX || evt.offsetY) {
            offsetX = evt.offsetX - ((evt.offsetX < -2) ? 0 : document.body.scrollLeft)
            offsetY = evt.offsetY - ((evt.offsetY < -2) ? 0 : document.body.scrollTop)
        }
        return false
    }
}

// set global reference to map being engaged and dragged
function setSelectedMap(evt) {
    var target = (evt.target) ? evt.target : evt.srcElement
    var abbrev = (target.name && target.src) ? target.name.toLowerCase() : ""
    if (abbrev) {
        if (document.layers) {
            selectedObj = document.layers[abbrev + "map"]
        } else if (document.all) {
            selectedObj = document.all(abbrev + "map")
        } else if (document.getElementById) {
            selectedObj = document.getElementById(abbrev + "map")
        }
        //setZIndex(selectedObj, 100)
        return
    }
    selectedObj = null
    return
}
// move DIV on mousemove
function dragIt(evt) {
    evt = (evt) ? evt : event
    if (selectedObj) {
        if (evt.pageX) {
            shiftTo(selectedObj, (evt.pageX - offsetX), (evt.pageY - offsetY))
        } else if (evt.clientX || evt.clientY) {
            shiftTo(selectedObj, (evt.clientX - offsetX), (evt.clientY - offsetY))
        }
        evt.cancelBubble = true
        return false
    }
}
// position an object at a specific pixel coordinate
function shiftTo(obj, x, y) {
    var theObj = getObject(obj)
    if (theObj.moveTo) {
        theObj.moveTo(x,y)
    } else if (typeof theObj.left != "undefined") {
        theObj.left = x+"px"
        theObj.top = y+"px"
    }
}
//
// convert object name string or object reference
// into a valid object reference ready for style change
function getObject(obj) {
    var theObj
    if (document.layers) {
        if (typeof obj == "string") {
            return document.layers[obj]
        } else {
            return obj
        }
    }
    if (document.all) {
        if (typeof obj == "string") {
            return document.all(obj).style
        } else {
            return obj.style
        }
    }
    if (document.getElementById) {
        if (typeof obj == "string") {
            return document.getElementById(obj).style
        } else {
            return obj.style
        }
    }
    return null
}

// souris non clique
// recuperation de variable recupx et recupy avant d annuler selectedobj

function release(evt) {
    evt = (evt) ? evt : event
    if (selectedObj) {
       recupy= selectedObj.offsetTop
       recupx= selectedObj.offsetLeft
       selectedObj = null
    }
}

function sauvef1(posx, posy) {
    alert("coordonnees x : "+recupx+"\n coordonnees y : "+recupy)
    formulaire = opener.document.f1;
    formulaire.elements[posx].value = recupx;
    formulaire.elements[posy].value = recupy;
    this.close();
}

function sauvef2(posx, posy) {
    alert("coordonnees x : "+recupx+"\n coordonnees y : "+recupy)
    formulaire = opener.document.f2;
    formulaire.elements[posx].value = recupx;
    formulaire.elements[posy].value = recupy;
    this.close();
}