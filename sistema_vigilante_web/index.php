<?php
session_start();
date_default_timezone_set('America/Mexico_City');

function contarVisita() {
    $archivo = "contador.txt";
    $visitas = file_exists($archivo) ? (int)file_get_contents($archivo) : 0;
    if (!isset($_SESSION['visitado'])) {
        $_SESSION['visitado'] = true;
        $visitas++;
        file_put_contents($archivo, $visitas);
    }
    return $visitas;
}

function obtenerDatosServidor() {
    return [
        'IP' => $_SERVER['REMOTE_ADDR'] ?? 'Desconocida',
        'AgenteUsuario' => $_SERVER['HTTP_USER_AGENT'] ?? 'Desconocido',
        'Idioma' => $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'Desconocido',
        'Referente' => $_SERVER['HTTP_REFERER'] ?? 'Directo',
        'Sistema' => php_uname(),
        'Fecha' => date("Y-m-d"),
        'Hora' => date("H:i:s"),
    ];
}

function guardarLog($datos) {
    $archivo = 'log.txt';
    $registro = "==== Registro: " . date('Y-m-d H:i:s') . " ====" . PHP_EOL;
    foreach ($datos as $clave => $valor) {
        $registro .= "$clave: $valor" . PHP_EOL;
    }
    $registro .= PHP_EOL;
    file_put_contents($archivo, $registro, FILE_APPEND);
}

$datosServidor = obtenerDatosServidor();
$visitas = contarVisita();

guardarLog($datosServidor); // Guardar datos servidor al cargar

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Vigilante Digital</title>
   <link rel="stylesheet" href="css/style.css" />

</head>
<body>
  <div class="container">
    <h1>Acceso detectado ⚠️</h1>
    <p>Fecha: <strong><?php echo $datosServidor['Fecha']; ?></strong></p>
    <p>Hora: <strong><?php echo $datosServidor['Hora']; ?></strong></p>
    <p>Visitas totales: <strong><?php echo $visitas; ?></strong></p>

    <h2>Datos del servidor:</h2>
    <ul>
      <li>IP: <code><?php echo $datosServidor['IP']; ?></code></li>
      <li>Agente Usuario: <code><?php echo $datosServidor['AgenteUsuario']; ?></code></li>
      <li>Idioma: <code><?php echo $datosServidor['Idioma']; ?></code></li>
      <li>Referente: <code><?php echo $datosServidor['Referente']; ?></code></li>
      <li>Sistema: <code><?php echo $datosServidor['Sistema']; ?></code></li>
    </ul>

    <h2>Datos del dispositivo:</h2>
    <ul id="datos-cliente"></ul>
    <div id="ubicacion" class="latlong">Ubicación: <code>Cargando...</code></div>
  </div>

  <script>
    const datosCliente = {
      "Navegador": navigator.userAgent,
      "Idioma": navigator.language,
      "Plataforma": navigator.platform,
      "Resolución de pantalla": `${screen.width}x${screen.height}`,
      "Profundidad de color": `${screen.colorDepth} bits`,
      "Tiempo de carga": `${performance.now().toFixed(1)} ms`,
      "Fecha de visita": new Date().toLocaleString(),
      "Estado Online": navigator.onLine ? "Sí" : "No",
      "Procesadores": navigator.hardwareConcurrency || "Desconocido",
      "RAM estimada": navigator.deviceMemory ? navigator.deviceMemory + " GB" : "Desconocida",
      "Historial de páginas": history.length,
      "Lenguajes aceptados": navigator.languages ? navigator.languages.join(', ') : "Desconocidos",
      "Touch activado": ('ontouchstart' in window),
      "Profundidad Max Scroll": window.screen.availHeight,
      "Alto disponible": window.screen.availHeight,
      "Ancho disponible": window.screen.availWidth,
      "Orientación": screen.orientation?.type || 'No detectado',
      "Modo de ahorro de datos": navigator.connection?.saveData ? 'Activado' : 'Desactivado',
      "Tipo de conexión": navigator.connection?.effectiveType || 'Desconocido',
      "Velocidad estimada": navigator.connection?.downlink ? navigator.connection.downlink + ' Mbps' : 'No disponible'
    };

    const lista = document.getElementById('datos-cliente');
    for (const clave in datosCliente) {
      const li = document.createElement('li');
      li.innerHTML = `<strong>${clave}:</strong> <code>${datosCliente[clave]}</code>`;
      lista.appendChild(li);
    }

    // Batería
    if (navigator.getBattery) {
      navigator.getBattery().then(battery => {
        const nivel = (battery.level * 100).toFixed(0) + "%";
        const li = document.createElement('li');
        li.innerHTML = `<strong>Batería:</strong> <code>${nivel}</code>`;
        lista.appendChild(li);
        datosCliente["Batería"] = nivel;
        guardarDatosCliente();
      });
    } else {
      guardarDatosCliente();
    }

    // Disco
    if (navigator.storage && navigator.storage.estimate) {
      navigator.storage.estimate().then(estimate => {
        const libre = (estimate.quota - estimate.usage) / (1024 * 1024 * 1024);
        const total = estimate.quota / (1024 * 1024 * 1024);
        const li = document.createElement('li');
        li.innerHTML = `<strong>Espacio libre:</strong> <code>${libre.toFixed(2)} GB / ${total.toFixed(2)} GB</code>`;
        lista.appendChild(li);
        datosCliente["Espacio libre"] = `${libre.toFixed(2)} GB / ${total.toFixed(2)} GB`;
        guardarDatosCliente();
      });
    }

    // Geolocalización
    const ubicacion = document.getElementById('ubicacion');
    function mostrarCoordenadas(lat, lon) {
      ubicacion.innerHTML = `Ubicación: <code>${lat.toFixed(4)}, ${lon.toFixed(4)}</code>`;
      datosCliente["Latitud"] = lat;
      datosCliente["Longitud"] = lon;
      guardarDatosCliente();
    }

    function guardarDatosCliente() {
      fetch('log_client.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(datosCliente)
      }).catch(e => console.warn('Error al guardar datos cliente:', e));
    }

    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        pos => mostrarCoordenadas(pos.coords.latitude, pos.coords.longitude),
        err => {
          fetch('https://ipapi.co/json/')
            .then(res => res.json())
            .then(data => mostrarCoordenadas(data.latitude, data.longitude))
            .catch(() => ubicacion.innerHTML = "<code>No disponible</code>");
        }, { enableHighAccuracy: true, timeout: 5000 }
      );
    } else {
      ubicacion.innerHTML = "<code>Geolocalización no soportada</code>";
      guardarDatosCliente();
    }
  </script>
</body>
</html>
