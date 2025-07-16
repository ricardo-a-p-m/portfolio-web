function leerTexto() {
  var texto = document.getElementById("resultados").textContent;
  var mensaje = new SpeechSynthesisUtterance(texto);
  speechSynthesis.speak(mensaje);
}
