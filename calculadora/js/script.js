const pantalla = document.getElementById('pantalla');
let memoria = 0;

function agregar(valor) {
  if (valor === '√') {
    try {
      pantalla.innerText = Math.sqrt(parseFloat(pantalla.innerText)) || '0';
    } catch {
      pantalla.innerText = '0';
    }
  } else if (
    pantalla.innerText === '0' &&
    valor !== '.' &&
    !['+', '*', '/', '-', '%'].includes(valor)
  ) {
    pantalla.innerText = valor;
  } else {
    pantalla.innerText += valor;
  }
}

function borrar() {
  pantalla.innerText = '0';
}

function calcular() {
  try {
    let expresion = pantalla.innerText
      .replace(/√/g, 'Math.sqrt')
      .replace(/÷/g, '/')
      .replace(/%/g, '/100');
    // Evaluar expresión segura
    let resultado = Function('"use strict";return (' + expresion + ')')();
    pantalla.innerText = resultado ?? '0';
  } catch {
    // No mostrar error, mantener lo que haya
  }
}

function cambiarSigno() {
  if (pantalla.innerText !== '0') {
    if (pantalla.innerText.startsWith('-')) {
      pantalla.innerText = pantalla.innerText.substring(1);
    } else {
      pantalla.innerText = '-' + pantalla.innerText;
    }
  }
}

function memClear() {
  memoria = 0;
}

function memAdd() {
  memoria += parseFloat(pantalla.innerText) || 0;
}

function memSubtract() {
  memoria -= parseFloat(pantalla.innerText) || 0;
}
