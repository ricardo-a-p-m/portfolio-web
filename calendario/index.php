<!DOCTYPE html>
<html lang="es">

<head>
         <meta charset="UTF-8">
         <title>Calendario Anual</title>
         <link rel="stylesheet" href="css/style.css" />
</head>

<body>
         <h1>Calendario Anual</h1>
         <form onsubmit="event.preventDefault(); generarCalendario();">
                  <label for="anio">Año:</label>
                  <input type="number" id="anio" value="2025" min="1900" max="2100">
                  <button type="submit">Actualizar</button>
         </form>
         <div id="calendario" class="calendar-grid"></div>
         <script src="js/script.js"></script>
</body>

</html>