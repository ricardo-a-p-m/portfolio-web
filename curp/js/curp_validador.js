// Genera y coloca CURP en el campo correspondiente
function btGenCurp(frm, tipoAsp) {
    if (!validaNombrePaternoMaterno(frm, tipoAsp)) return;
    if (!validaFechaGeneroEstado(frm, tipoAsp)) return;

    var curp = GeneraCURP(
        frm.Nombre.value,
        frm.ApPaterno.value,
        frm.ApMaterno.value,
        frm.FechaNacimiento.value,
        frm.Genero.value,
        frm.EntidadNacimiento.value
    );
    if (curp !== 'x') frm.Curp.value = curp;
}

// Valida, genera y envía formulario de CURP
function botonIdentificar(frm, tipoAsp) {
    if (!validaNombrePaternoMaterno(frm, tipoAsp)) return;
    if (!validaFechaGeneroEstado(frm, tipoAsp)) return;

    var curp1 = utrim(frm.Curp.value);
    frm.Curp.value = curp1;
    if (curp1.length !== 18) return;

    var curp2 = GeneraCURP(
        frm.Nombre.value,
        frm.ApPaterno.value,
        frm.ApMaterno.value,
        frm.FechaNacimiento.value,
        frm.Genero.value,
        frm.EntidadNacimiento.value
    );

    if (curp1.substring(0, 10) !== curp2.substring(0, 10)) return;

    frm.submit();
}

// Valida nombre, apellido paterno y materno
function validaNombrePaternoMaterno(frm, tipoAsp) {
    frm.Nombre.value = utrim(frm.Nombre.value);
    frm.ApPaterno.value = utrim(frm.ApPaterno.value);
    frm.ApMaterno.value = utrim(frm.ApMaterno.value);

    if (tipoAsp !== '3') return true;
    if (!validaNombre(frm.Nombre.value)) return false;
    if (!validaNombre(frm.ApPaterno.value)) return false;
    if (!validaNombre(frm.ApMaterno.value) && frm.ApMaterno.value !== '') return false;
    return true;
}

// Valida fecha, género y entidad de nacimiento
function validaFechaGeneroEstado(frm, tipoAsp) {
    frm.FechaNacimiento.value = trim(frm.FechaNacimiento.value);
    if (frm.FechaNacimiento.value === '') return false;

    if (tipoAsp === '3') {
        frm.ConfirmarFecha.value = trim(frm.ConfirmarFecha.value);
        if (frm.ConfirmarFecha.value === '') return false;
        if (frm.ConfirmarFecha.value !== frm.FechaNacimiento.value) return false;
    }

    if (frm.Genero.selectedIndex === 0) return false;
    if (frm.EntidadNacimiento.selectedIndex === 0) return false;

    return true;
}

// Valida que el nombre solo contenga letras mayúsculas, espacios y puntos
function validaNombre(cmp) {
    cmp = trim(cmp);
    if (cmp.length === 0) return false;
    for (var i = 0; i < cmp.length; i++) {
        var c = cmp.charAt(i);
        if (!('A' <= c && c <= 'Z') && c !== 'Ñ' && c !== '.' && c !== ' ') {
            return false;
        }
    }
    return true;
}
