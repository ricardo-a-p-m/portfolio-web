<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Smartwatch Web Simplificado</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>

<div class="smartwatch" role="main" aria-label="Smartwatch web simplificado">

  <div class="top-bar" id="topBar" aria-live="polite">
    <div class="time-climate">
      <span id="battery-text" aria-label="Nivel de batería">🔋 75%</span>
      <div class="battery" aria-hidden="true">
        <div class="battery-level" style="width: 75%;"></div>
      </div>
    </div>
    <div class="weather" aria-label="Clima actual">☀️ 26°C</div>
  </div>

  <div class="time-display" id="time" aria-live="polite" aria-atomic="true">--:--</div>
  <div class="sub-info" id="date">Cargando fecha...</div>

  <div class="content-scroll" tabindex="0" aria-label="Contenido principal con apps y funcionalidades">

    <div class="apps-grid" role="list" aria-label="Aplicaciones principales del smartwatch">
      <div class="app-icon" role="listitem" tabindex="0" data-app="criptos" aria-label="Aplicación criptomonedas Bitcoin">
        <img src="https://img.icons8.com/ios-filled/50/ffffff/bitcoin.png" alt="Bitcoin" />
      </div>
      <div class="app-icon" role="listitem" tabindex="0" data-app="mensajes" aria-label="Aplicación mensajes">
        <img src="https://img.icons8.com/ios-filled/50/ffffff/sms.png" alt="Mensajes" />
      </div>
      <div class="app-icon" role="listitem" tabindex="0" data-app="asistente" aria-label="Aplicación asistente virtual">
        <img src="https://img.icons8.com/ios-filled/50/ffffff/robot-2.png" alt="Asistente" />
      </div>
      <div class="app-icon" role="listitem" tabindex="0" data-app="ajustes" aria-label="Aplicación ajustes">
        <img src="https://img.icons8.com/ios-filled/50/ffffff/settings.png" alt="Ajustes" />
      </div>
      <div class="app-icon" role="listitem" tabindex="0" data-app="wallet" aria-label="Aplicación wallet crypto avanzada">
        <img src="https://img.icons8.com/ios-filled/50/ffffff/wallet--v1.png" alt="Wallet" />
      </div>
      <div class="app-icon" role="listitem" tabindex="0" data-app="sueno" aria-label="Aplicación monitor de sueño">
        <img src="https://img.icons8.com/ios-filled/50/ffffff/sleeping-in-bed.png" alt="Sueño" />
      </div>
    </div>
  </div>

  <!-- Pantallas de apps -->

  <div class="app-screen" id="criptos" aria-label="Pantalla de criptomonedas">
    <div class="app-header">
      Criptomonedas
      <div class="close-btn" tabindex="0" aria-label="Cerrar criptomonedas">&times;</div>
    </div>
    <ul class="crypto-list">
      <li>Bitcoin (BTC): $29,430 <span class="positive">+2.1%</span></li>
      <li>Ethereum (ETH): $1,850 <span class="negative">-1.2%</span></li>
      <li>Cardano (ADA): $0.45 <span class="positive">+0.5%</span></li>
      <li>Solana (SOL): $23.8 <span class="positive">+3.0%</span></li>
    </ul>
  </div>

  <div class="app-screen" id="mensajes" aria-label="Pantalla de mensajes">
    <div class="app-header">
      Mensajes
      <div class="close-btn" tabindex="0" aria-label="Cerrar mensajes">&times;</div>
    </div>
    <div class="messages-container" tabindex="0" aria-live="polite">
      <p><b>Amigo:</b> ¿Listo para la reunión?</p>
      <p><b>Tú:</b> Sí, voy en camino.</p>
      <p><b>Bot:</b> Recuerda traer el cargador.</p>
    </div>
    <input type="text" id="msgInput" placeholder="Escribe un mensaje..." />
    <button id="sendMsg">Enviar</button>
  </div>

  <div class="app-screen" id="asistente" aria-label="Pantalla de asistente virtual">
    <div class="app-header">
      Asistente Virtual
      <div class="close-btn" tabindex="0" aria-label="Cerrar asistente">&times;</div>
    </div>
    <div id="chatArea" tabindex="0" aria-live="polite"></div>
    <input type="text" id="chatInput" placeholder="Escribe aquí..." />
    <button id="sendChat">Enviar</button>
  </div>

  <div class="app-screen" id="ajustes" aria-label="Pantalla de ajustes">
    <div class="app-header">
      Ajustes
      <div class="close-btn" tabindex="0" aria-label="Cerrar ajustes">&times;</div>
    </div>
    <label for="themeSelect">Tema:</label>
    <select id="themeSelect" aria-label="Seleccionar tema">
      <option value="dark">Oscuro</option>
      <option value="light">Claro</option>
      <option value="neon">Neón</option>
    </select>
  </div>

  <div class="app-screen" id="wallet" aria-label="Pantalla de wallet crypto avanzada">
    <div class="app-header">
      Wallet Crypto Avanzada
      <div class="close-btn" tabindex="0" aria-label="Cerrar wallet">&times;</div>
    </div>
    <p>Saldo total: <b>$12,450.32 USD</b></p>
    <ul class="crypto-list">
      <li>Bitcoin (BTC): 0.42 <span class="positive">+1.8%</span></li>
      <li>Ethereum (ETH): 3.1 <span class="negative">-0.8%</span></li>
      <li>Dogecoin (DOGE): 1500 <span class="positive">+4.2%</span></li>
    </ul>
    <button class="send-crypto">Enviar criptomonedas</button>
  </div>

  <div class="app-screen" id="sueno" aria-label="Pantalla de monitor de sueño">
    <div class="app-header">
      Monitor de Sueño
      <div class="close-btn" tabindex="0" aria-label="Cerrar sueño">&times;</div>
    </div>
    <p>Última noche: 7h 32m de sueño profundo</p>
    <p>Calidad: <span class="positive">Excelente</span></p>
    <div class="sleep-bar">
      <div class="sleep-progress"></div>
    </div>
  </div>

</div>

<script src="js/script.js"></script>

</body>
</html>
