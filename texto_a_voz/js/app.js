function speak() {
  var text = document.getElementById("textToSpeak").value;
  if ('speechSynthesis' in window) {
    var speech = new SpeechSynthesisUtterance(text);
    speech.lang = 'es-ES';
    window.speechSynthesis.speak(speech);
  } else {
    alert("Tu navegador no admite la síntesis de voz.");
  }
}
