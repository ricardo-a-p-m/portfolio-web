<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Calculadora Real</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <div class="calculadora">
    <div id="pantalla" class="pantalla">0</div>
    <div class="botones">
      <!-- Fila 1 -->
      <button onclick="memClear()">MRC</button>
      <button onclick="memSubtract()">M-</button>
      <button onclick="memAdd()">M+</button>
      <button onclick="borrar()" class="btn-operador">CE</button>
      <button onclick="borrar()" class="btn-rojo">ON/C</button>
      <!-- Fila 2 -->
      <button onclick="agregar('7')">7</button>
      <button onclick="agregar('8')">8</button>
      <button onclick="agregar('9')">9</button>
      <button onclick="agregar('%')">%</button>
      <button onclick="agregar('√')">√</button>
      <!-- Fila 3 -->
      <button onclick="agregar('4')">4</button>
      <button onclick="agregar('5')">5</button>
      <button onclick="agregar('6')">6</button>
      <button onclick="agregar('*')">*</button>
      <button onclick="agregar('/')">÷</button>
      <!-- Fila 4 -->
      <button onclick="agregar('1')">1</button>
      <button onclick="agregar('2')">2</button>
      <button onclick="agregar('3')">3</button>
      <button onclick="agregar('+')" class="btn-plus">+</button>
      <button onclick="agregar('-')">-</button>
      <!-- Fila 5 -->
      <button onclick="agregar('0')">0</button>
      <button onclick="agregar('.')">.</button>
      <button onclick="cambiarSigno()">+/-</button>
      <!-- Espacio vacío por el + que ocupa dos filas -->
      <button onclick="calcular()">=</button>
    </div>
  </div>
  <script src="js/script.js"></script>
</body>
</html>
