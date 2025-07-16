function GeneraCURP(nom, pat, mat, fecha, genero, edo) {
    nom = nom.toUpperCase();
    pat = pat.toUpperCase();
    mat = mat.toUpperCase();
    genero = genero.toUpperCase();

    var quitar = /^(DE |DEL |LO |LOS |LA |LAS )+/;
    var nombres = /^(MARIA |JOSE )/;

    nom = nom.replace(quitar, '').replace(nombres, '').replace(quitar, '');
    pat = pat.replace(quitar, '');
    mat = mat.replace(quitar, '');
    if (mat === '') mat = 'X';

    var curp = pat.charAt(0) + buscaVocal(pat) + mat.charAt(0) + nom.substring(0, 2);
    curp = cambiaPalabra(curp);
    curp += fecha.substring(8, 10) + fecha.substring(3, 5) + fecha.substring(0, 2);
    curp += (genero === 'M' ? 'H' : 'M') + estado(edo);
    curp += buscaConsonante(pat) + buscaConsonante(mat) + buscaConsonante(nom);
    curp += fecha.substring(6, 8) === '19' ? '0' : 'A';
    curp += ultdig(curp);

    return curp;
}

function buscaVocal(str) {
    for (var i = 1; i < str.length; i++) {
        var c = str.charAt(i);
        if ('AEIOU'.includes(c)) return c;
    }
    return 'X';
}

function buscaConsonante(str) {
    for (var i = 1; i < str.length; i++) {
        var c = str.charAt(i);
        if (!'AEIOU ÑÁÉÍÓÚÜ.'.includes(c)) return c;
    }
    return 'X';
}

function cambiaPalabra(str) {
    var palabrasInapropiadas = /BUEI|BUEY|CACA|CACO|CAGA|CAGO|CAKA|CAKO|COGE|COJA|COJE|COJI|COJO|CULO|FETO|GUEY|JOTO|KACA|KACO|KAGA|KAGO|KOGE|KOJO|KAKA|KULO|LOCA|LOCO|MAME|MAMO|MEAR|MEAS|MEON|MION|MOCO|MULA|PEDA|PEDO|PENE|PUTA|PUTO|QULO|RATA|RUIN/;
    str = str.substring(0, 4);
    if (palabrasInapropiadas.test(str)) {
        return str.charAt(0) + 'X' + str.substring(2, 4);
    }
    return str;
}

function estado(edo) {
    var estados = ['DF', 'AS', 'BC', 'BS', 'CC', 'CL', 'CM', 'CS', 'CH', 'DG', 'GT', 'GR', 'HG', 'JC', 'MC', 'MN',
        'MS', 'NT', 'NL', 'OC', 'PL', 'QT', 'QR', 'SP', 'SL', 'SR', 'TC', 'TS', 'TL', 'VZ', 'YN', 'ZS', 'NE'];
    return estados[edo] || 'NE';
}

function tabla(char, code) {
    if (char >= '0' && char <= '9') return code - 48;
    if (char >= 'A' && char <= 'N') return code - 55;
    if (char >= 'O' && char <= 'Z') return code - 54;
    return 0;
}

function ultdig(curp) {
    var dv = 0;
    for (var i = 0; i < curp.length; i++) {
        dv += tabla(curp.charAt(i), curp.charCodeAt(i)) * (18 - i);
    }
    dv %= 10;
    return dv === 0 ? 0 : 10 - dv;
}
