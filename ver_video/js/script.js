const videoInput = document.getElementById('videoInput');
const videoPlayer = document.getElementById('videoPlayer');

videoInput.addEventListener('change', (event) => {
  const files = event.target.files;
  const videoURLs = [];

  for (let i = 0; i < files.length; i++) {
    videoURLs.push(URL.createObjectURL(files[i]));
  }

  playVideos(videoURLs);
});

function playVideos(videoURLs) {
  let currentIndex = 0;

  function playNext() {
    if (currentIndex < videoURLs.length) {
      videoPlayer.src = videoURLs[currentIndex];
      videoPlayer.play();
      currentIndex++;
    } else {
      currentIndex = 0; // Opcional: reinicia la lista o para la reproducción
      // videoPlayer.pause();
    }
  }

  videoPlayer.removeEventListener('ended', playNext); // Evitar listeners múltiples
  videoPlayer.addEventListener('ended', playNext);

  playNext();
}
