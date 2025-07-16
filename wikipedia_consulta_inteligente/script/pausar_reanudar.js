function pausarReanudar() {
  if (speechSynthesis.speaking) {
    if (speechSynthesis.paused) {
      speechSynthesis.resume(); // ✅ Reanuda si está pausado
    } else {
      speechSynthesis.pause();  // ✅ Pausa si está reproduciendo
    }
  }
}
