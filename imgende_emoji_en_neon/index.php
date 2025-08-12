<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Emoji desde emojis.json</title>
    <style>
    body {
        font-family: sans-serif;
        text-align: center;
        background: #f0f0f0;
        color: #222;
    }

    canvas {
        border: 1px dashed #aaa;
        margin-top: 20px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        background: transparent;
        /* quitamos filtro para glow para manejarlo con sombra en canvas */
    }

    button {
        margin: 10px;
        padding: 10px 20px;
        font-size: 16px;
        background: #ddd;
        color: #222;
        border: none;
        cursor: pointer;
        border-radius: 6px;
        transition: background 0.3s;
    }

    button:hover {
        background: #bbb;
    }

    input[type="text"] {
        font-size: 20px;
        padding: 5px 10px;
        width: 200px;
        text-align: center;
        border-radius: 6px;
        border: 1px solid #aaa;
        margin-top: 10px;
    }
    </style>
</head>

<body>
    <h2>Emoji PNG desde emojis.json (1080x1920)</h2>
    <canvas id="canvas" width="1080" height="1920"></canvas>
    <div>
        <input type="text" id="emojiInput" placeholder="Pega un emoji aquí" maxlength="3" />
        <button id="dibujarBtn" disabled>🖌️ Dibujar Emoji</button>
        <button id="generarBtn" disabled>🎲 Generar Emoji Random</button>
        <button onclick="descargarImagen()">⬇️ Descargar PNG</button>
    </div>

    <script>
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');
    let emojis = [];

    // Cargar emojis.json
    fetch('emojis.json')
        .then(response => response.json())
        .then(data => {
            emojis = data;
            document.getElementById('generarBtn').disabled = false;
            document.getElementById('dibujarBtn').disabled = false;
            generarEmoji(); // generar uno por defecto
        })
        .catch(err => {
            alert("Error al cargar emojis.json");
            console.error(err);
        });

    function dibujarEmoji(texto) {
        if (!texto) return;

        ctx.clearRect(0, 0, canvas.width, canvas.height);

        ctx.font = '800px serif';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';

        // Sombra para glow neón
        ctx.shadowColor = '#39FF14'; // verde neón
        ctx.shadowBlur = 40;
        ctx.shadowOffsetX = 0;
        ctx.shadowOffsetY = 0;

        // Dibuja el emoji en negro para máscara
        ctx.fillStyle = 'black';
        ctx.fillText(texto, canvas.width / 2, canvas.height / 2);

        ctx.globalCompositeOperation = 'source-in';

        // Gradiente neón morado-verde
        const grad = ctx.createLinearGradient(canvas.width / 4, 0, (canvas.width * 3) / 4, 0);

        grad.addColorStop(0, '#0AFF99'); // turquesa neón
        grad.addColorStop(0.3, '#000000'); // negro inicio
        grad.addColorStop(0.6, '#000000'); // negro fin
        grad.addColorStop(1, '#39FF14'); // verde neón

        ctx.fillStyle = grad;
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        ctx.globalCompositeOperation = 'source-over';
        ctx.shadowBlur = 0;
    }

    function generarEmoji() {
        if (emojis.length === 0) return;

        const emoji = emojis[Math.floor(Math.random() * emojis.length)].emoji;
        document.getElementById('emojiInput').value = emoji;
        dibujarEmoji(emoji);
    }

    function descargarImagen() {
        const imagen = canvas.toDataURL('image/png');
        const enlace = document.createElement('a');
        enlace.href = imagen;
        enlace.download = 'emoji_transparente.png';
        enlace.click();
    }

    document.getElementById('generarBtn').addEventListener('click', generarEmoji);
    document.getElementById('dibujarBtn').addEventListener('click', () => {
        const texto = document.getElementById('emojiInput').value.trim();
        if (texto) dibujarEmoji(texto);
    });
    </script>
</body>

</html>