<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Generar CURP en Línea</title>
  <link rel="stylesheet" href="css/style.css" media="screen" />
  <script src="js/utils.js"></script>
  <script src="js/GeneraCURP.js"></script>
  <script src="js/curp_validador.js"></script>
</head>
<body>

  <header>
    <h1>Generar CURP en Línea</h1>
    <p class="descripcion">
      Solo ingresa tus datos y obtén tu CURP de 18 caracteres para que lo uses donde lo necesites, sin vueltas ni complicaciones.
    </p>
  </header>

  <div id="wrapper">
    <div id="steps">
        <form name="frm" id="frm" method="post">
          <p>
            <label for="Nombre">Nombre:</label>
            <input name="Nombre" id="Nombre" type="text" />
          </p>
          <p>
            <label for="ApPaterno">Apellido Paterno:</label>
            <input name="ApPaterno" id="ApPaterno" type="text" />
          </p>
          <p>
            <label for="ApMaterno">Apellido Materno:</label>
            <input name="ApMaterno" id="ApMaterno" type="text" />
          </p>
          <p>
            <label for="FechaNacimiento">Fecha de nacimiento:</label>
            <span id="btFechaNacimiento" style="cursor:pointer;">
              <input name="FechaNacimiento" id="FechaNacimiento" type="text" placeholder="dd/mm/aaaa" readonly />
            </span>
          </p>
          <p>
            <label for="ConfirmarFecha">Confirma tu fecha:</label>
            <span id="btConfirmarFecha" style="cursor:pointer;">
              <input name="ConfirmarFecha" id="ConfirmarFecha" type="text" placeholder="dd/mm/aaaa" readonly />
            </span>
          </p>
          <p>
            <label for="Genero">Género:</label>
            <select name="Genero" id="Genero">
              <option value="x">SELECCIONA</option>
              <option value="F">FEMENINO</option>
              <option value="M">MASCULINO</option>
            </select>
          </p>
          <p>
            <label for="Nacionalidad">Nacionalidad:</label>
            <select name="Nacionalidad" id="Nacionalidad">
              <option value="">Cargando países...</option>
            </select>
          </p>
          <p>
            <label for="EntidadNacimiento">Entidad de nacimiento:</label>
            <select name="EntidadNacimiento" id="EntidadNacimiento">
              <option value="">Cargando estados...</option>
            </select>
          </p>
          <p>
            <label for="Curp">CURP:</label>
            <input type="button" value="Generar CURP" onclick="btGenCurp(this.form, '3');" />
            <br /><br />
            <input name="Curp" id="Curp" type="text" readonly />
          </p>
        </form>
    </div>
  </div>

  <script>
    async function cargarDatos() {
      try {
        const paisRes = await fetch('json/paises.json');
        const paises = await paisRes.json();
        const nacionSelect = document.getElementById('Nacionalidad');
        nacionSelect.innerHTML = '';
        paises.forEach(pais => {
          const option = document.createElement('option');
          option.value = pais.id;
          option.textContent = pais.nombre;
          nacionSelect.appendChild(option);
        });

        const estadoRes = await fetch('json/entidades.json');
        const estados = await estadoRes.json();
        const entNacSelect = document.getElementById('EntidadNacimiento');
        entNacSelect.innerHTML = '<option value="x">Elige un estado</option>';
        estados.forEach(estado => {
          const option = document.createElement('option');
          option.value = estado.id;
          option.textContent = estado.nombre;
          entNacSelect.appendChild(option);
        });
      } catch (error) {
        console.error('Error cargando JSON:', error);
      }
    }
    cargarDatos();
  </script>

  <script src="js/calendario.js"></script>

</body>
</html>
