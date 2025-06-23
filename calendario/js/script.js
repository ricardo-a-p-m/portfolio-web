
const meses = [
  "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
  "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
];
const dias = ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"];

// Obtener fecha actual local México
const ahora = new Date(new Date().toLocaleString("en-US", { timeZone: "America/Mexico_City" }));
const diaActual = ahora.getDate();
const mesActual = ahora.getMonth();
const anioActual = ahora.getFullYear();

function generarCalendario() {
  const anio = parseInt(document.getElementById('anio').value);
  const contenedor = document.getElementById('calendario');
  contenedor.innerHTML = "";

  for (let mes = 0; mes < 12; mes++) {
    const primerDia = new Date(anio, mes, 1).getDay();
    const diasEnMes = new Date(anio, mes + 1, 0).getDate();

    let html = `<div class="month"><h2>${meses[mes]}</h2><div class="days">`;

    for (let d of dias) {
      html += `<div class="day header">${d}</div>`;
    }

    for (let i = 0; i < primerDia; i++) {
      html += `<div class="day"></div>`;
    }

    for (let dia = 1; dia <= diasEnMes; dia++) {
      const esHoy = dia === diaActual && mes === mesActual && anio === anioActual;
      html += `<div class="day${esHoy ? ' hoy' : ''}">${dia}</div>`;
    }

    html += `</div></div>`;
    contenedor.innerHTML += html;
  }
}

generarCalendario();
