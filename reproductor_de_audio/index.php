<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Reproductor de Música</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <h1>Reproductor de Música</h1>
  <p>Disfruta tus canciones en secuencia y a toda pantalla, sin complicaciones.</p>

  <input type="file" id="musicInput" accept="audio/*" multiple hidden />
  <button id="musicBtn">Seleccionar Canciones</button>

  <div id="musicPlayer">
    <audio id="audio" controls>
      Tu navegador no admite la reproducción de audio.
    </audio>
  </div>

  <script src="js/script.js"></script>
</body>
</html>
