<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Video con Texto</title>
    <style>
        body {
            display: flex;
            height: 100vh;
            background: #f0f0f0;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        canvas {
            display: none;
        }

        /* Contenedor derecho (30%) */
        .derecho {
            width: 30%;
            height: 100%;
            background: #000000;
            border: 3px solid #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-sizing: border-box;
            overflow: hidden;
        }

        .derecho #videoGenerado {
            max-width: 90%;
            height: auto;
            margin-bottom: 10px;
        }

        .derecho #downloadButton {
            display: none;
            margin-top: 20px;
            padding: 12px 24px;
            font-size: 18px;
        }

        .derecho .color-picker {
            margin: 15px;
        }

        /* Contenedor izquierdo (25%) */
        .izquierdo {
            width: 70%;
            height: 100%;
            background: #000000;
            border: 3px solid #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .vista_previa {
            width: 1200px;
            height: 70%;
            background: #fff;
            display: flex;
            font-size: 26px;
            font-weight: bold;
            padding: 10px;
            overflow: hidden;
            position: relative;
        }

        .video_mp4 {
            width: 1200px;
            height: 66%;
            background: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .oculto {
            display: none;
        }

        /* Hacer el texto editable */
        #previewText {
            width: 100%;
            height: 100%;
            padding: 0 20px;
            font-size: 35px;
            color: black;
            background-color: transparent;
            outline: none;
            text-align: left;
            position: absolute;
            top: 0;
            left: 0;
        }


        #previewText[contenteditable="true"]:empty:before {
            content: "Escribe aquí y genera el video";
            color: #999;
        }
    </style>
</head>

<body>
    <div class="derecho">

        <div>
            <label for="tamaniotexto">Tamaño de Letra: </label>
            <input type="number" id="tamaniotexto" value="50" min="10" max="100" onchange="actualizarVistaPrevia()">
        </div>
        <div>
            <label for="alineacionTexto">Alineación del Texto: </label>
            <select id="alineacionTexto" onchange="actualizarVistaPrevia()">
                <option value="left">Izquierda</option>
                <option value="center" selected>Centrado</option>
                <option value="right">Derecha</option>
                <option value="justify">Justificado</option>
            </select>
        </div>
        <div>
            <label for="fondoColor" class="color-picker">Color Fondo: </label>
            <input type="color" id="fondoColor" value="#ffffff" onchange="actualizarVistaPrevia()">
        </div>
        <div>
            <label for="textoColor" class="color-picker">Color Texto: </label>
            <input type="color" id="textoColor" value="#000000" onchange="actualizarVistaPrevia()">
        </div>

        <button onclick="generarVideo()">Generar Video</button>
        <button id="downloadButton" onclick="descargarVideo()">Descargar Video</button>
        <canvas id="canvas" width="1280" height="720"></canvas>
    </div>

    <div class="izquierdo">
        <div class="vista_previa" id="contenedorVideo">
            <div id="previewText" contenteditable="true" oninput="actualizarVistaPrevia()">Escribe aquí y genera el video</div>
        </div>
        <video class="video_mp4 oculto" id="videoGenerado" controls></video>
    </div>

    <script>
        function actualizarVistaPrevia() {
            const texto = document.getElementById("previewText").textContent;
            const fondoColor = document.getElementById("fondoColor").value;
            const textoColor = document.getElementById("textoColor").value;
            const tamaniotexto = document.getElementById("tamaniotexto").value;
            const alineacionTexto = document.getElementById("alineacionTexto").value;
            const contenedorVideo = document.getElementById("contenedorVideo");

            document.getElementById("previewText").style.color = textoColor;
            contenedorVideo.style.backgroundColor = fondoColor;
            document.getElementById("previewText").style.fontSize = tamaniotexto + "px";

            // Alineación
            document.getElementById("previewText").style.textAlign = alineacionTexto;
        }

        function generarVideo() {
            document.getElementById("contenedorVideo").classList.add("oculto");
            document.getElementById("videoGenerado").classList.remove("oculto");

            const texto = document.getElementById("previewText").innerHTML;
            const fondoColor = document.getElementById("fondoColor").value;
            const textoColor = document.getElementById("textoColor").value;
            const tamaniotexto = document.getElementById("tamaniotexto").value;
            const alineacionTexto = document.getElementById("alineacionTexto").value;
            const canvas = document.getElementById("canvas");
            const ctx = canvas.getContext("2d");
            const video = document.getElementById("videoGenerado");
            const downloadButton = document.getElementById("downloadButton");

            const duracion = 5;
            const fps = 30;
            const frames = duracion * fps;
            const stream = canvas.captureStream(30);
            const mediaRecorder = new MediaRecorder(stream);
            let chunks = [];

            mediaRecorder.ondataavailable = function(e) {
                chunks.push(e.data);
            };

            mediaRecorder.onstop = function() {
                const blob = new Blob(chunks, {
                    type: "video/webm"
                });
                const url = URL.createObjectURL(blob);
                video.src = url;
                downloadButton.style.display = "block";
                downloadButton.onclick = function() {
                    const link = document.createElement("a");
                    link.href = url;
                    link.download = "video_generado.mp4";
                    link.click();
                };
            };

            mediaRecorder.start();

            let frame = 0;

            function drawFrame() {
                if (frame >= frames) {
                    mediaRecorder.stop();
                    return;
                }
                ctx.fillStyle = fondoColor;
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                ctx.fillStyle = textoColor;
                ctx.font = "bold " + tamaniotexto + "px Arial";
                ctx.textAlign = alineacionTexto; // Usar la alineación seleccionada
                ctx.textBaseline = "middle";

                // Dibujar el texto en la posición centrada
                const divText = document.createElement("div");
                divText.innerHTML = texto;
                ctx.fillText(divText.innerText, canvas.width / 2, canvas.height / 2); // Centrado para ejemplo
                frame++;
                setTimeout(drawFrame, 1000 / fps);
            }
            drawFrame();
        }
    </script>

</body>

</html>