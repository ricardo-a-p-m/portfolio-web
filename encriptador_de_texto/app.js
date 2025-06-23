const inputMensaje = document.querySelector("#mensaje");
const inputResultado = document.querySelector("#resultado");
const btnEncriptar = document.querySelector("#encriptar");
const btnDesencriptar = document.querySelector("#desencriptar");
const btnCopiar = document.querySelector("#copiar");
const contenedorErrores = document.querySelector(".contenedor-errores");

function validarMensaje() {
    contenedorErrores.innerHTML = "";
    const mensaje = inputMensaje.value.toLowerCase();
    const letrasValidas = "abcdefghijklmnñopqrstuvwxyz ";
    let errores = [];

    for (const letra of mensaje) {
        if (!letrasValidas.includes(letra)) {
            errores.push(`La letra '${letra}' no es válida`);
        }
    }

    if (errores.length) {
        errores.forEach(err => {
            const p = document.createElement("p");
            p.classList.add("error");
            p.textContent = err;
            contenedorErrores.appendChild(p);
        });
        return false;
    }
    return true;
}

const mapaEncriptacion = {
    "a": "ai",
    "e": "enter",
    "i": "imes",
    "o": "ober",
    "u": "ufat"
};

function encriptar() {
    if (!validarMensaje()) return;
    const mensaje = inputMensaje.value.toLowerCase();
    let resultado = "";

    for (const char of mensaje) {
        resultado += mapaEncriptacion[char] || char;
    }

    inputResultado.value = resultado;
}

function desencriptar() {
    if (!validarMensaje()) return;
    let texto = inputMensaje.value.toLowerCase();
    texto = texto.replace(/ai/g, "a")
                 .replace(/enter/g, "e")
                 .replace(/imes/g, "i")
                 .replace(/ober/g, "o")
                 .replace(/ufat/g, "u");
    inputResultado.value = texto;
}

function copiar() {
    const texto = inputResultado.value;
    navigator.clipboard.writeText(texto);
    inputMensaje.value = "";
    inputMensaje.focus();
}

btnEncriptar.onclick = encriptar;
btnDesencriptar.onclick = desencriptar;
btnCopiar.onclick = copiar;
