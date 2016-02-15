// ---------
// Paths
// ---------

function Path(route_id, points, stroke_dasharray, longueur, couleur, svg_tagname) {
    this.route_id = route_id;
    this.longueur = longueur;
    this.couleur = couleur;
    this.ui = document.createElementNS('http://www.w3.org/2000/svg', svg_tagname);
    this.ui.model = this;
    this.ui.setAttribute('id', route_id);
    this.ui.setAttribute('class', 'path ' + 'path_' + this.couleur);
    this.ui.setAttribute('stroke-dasharray', stroke_dasharray);
}

function BezierPath(route_id, points, stroke_dasharray, longueur, couleur) {
    // copying existing arguments list
    var newArgs = Array.prototype.slice.call(arguments);

    // and adding new elem
    newArgs.push('path');

    // call to parent constructor
    Path.apply(this, newArgs);

    // path_d = 'M62,171 Q179,189 265,392'	
    this.ui.setAttribute('d', points);

}

function PolylinePath(route_id, points, stroke_dasharray, longueur, couleur) {

    // copying existing arguments list
    var newArgs = Array.prototype.slice.call(arguments);

    // and adding new elem
    newArgs.push('polyline');

    // call to parent constructor	
    Path.apply(this, newArgs);

    // path_d = '164,412 130,418 115,454'
    this.ui.setAttribute('points', points);
}

// ---------
// Utils
// ---------	
function toggleClassOfSVGElement(elem, className) {
    if (elem.classList.contains(className))
        elem.classList.remove(className);
    else
        elem.classList.add(className);
}



