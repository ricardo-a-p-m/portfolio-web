function isNull(cadena) {
    if (cadena == null) return true;
    if (typeof cadena == 'undefined') return true;
    if (cadena == "") return true;
    return false;
}

function trimRight(cadena) {
    var lg, cad, r = "";
    cad = String(cadena);
    if (isNull(cad)) return r;
    lg = cad.length - 1;
    while (lg >= 0 && cad.charAt(lg) == " ") lg--;
    r = cad.substring(0, lg + 1);
    return r;
}

function trimLeft(cadena) {
    var i = 0, lg, cad, r = "";
    cad = String(cadena);
    if (isNull(cad)) return r;
    lg = cad.length;
    while (i < lg && cad.charAt(i) == " ") i++;
    r = cad.substring(i, lg);
    return r;
}

function trim(cadena) {
    return trimLeft(trimRight(cadena));
}

function utrim(cadena) {
    return trim(cadena).toUpperCase().replace('�', 'Ñ');
}

function nuevoAjax() {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
                xmlhttp = new XMLHttpRequest();
            }
        }
    }
    return xmlhttp;
}

function esEntero(cmp) {
    var c, i;
    cmp = trim(cmp);
    if (cmp.length == 0) return false;
    for (i = 0; i < cmp.length; i++) {
        c = cmp.charAt(i);
        if (!(c >= '0' && c <= '9')) return false;
    }
    return true;
}

function esReal(cmp) {
    var p = 0, c, i;
    cmp = trim(cmp);
    if (cmp.length == 0) return false;
    c = cmp.charAt(0);
    if (!(c >= '0' && c <= '9')) return false;
    for (i = 1; i < cmp.length; i++) {
        c = cmp.charAt(i);
        if (!(c >= '0' && c <= '9')) {
            if (c == '.') p++;
            else return false;
        }
    }
    if (p >= 2) return false;
    return true;
}
