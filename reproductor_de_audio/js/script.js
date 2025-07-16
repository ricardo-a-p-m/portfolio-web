const musicInput = document.getElementById('musicInput');
const musicBtn = document.getElementById('musicBtn');
const musicPlayer = document.getElementById('audio');

musicBtn.addEventListener('click', () => {
  musicInput.click();
});

musicInput.addEventListener('change', (event) => {
  const files = event.target.files;
  const musicURLs = Array.from(files).map(file => URL.createObjectURL(file));
  playMusic(musicURLs);
});

function playMusic(musicURLs) {
  let currentMusicIndex = 0;

  function playNextMusic() {
    if (currentMusicIndex < musicURLs.length) {
      musicPlayer.src = musicURLs[currentMusicIndex];
      musicPlayer.play();
      currentMusicIndex++;
    } else {
      currentMusicIndex = 0; // Reinicia al finalizar toda la lista
    }
  }

  musicPlayer.addEventListener('ended', playNextMusic);
  playNextMusic();
}
