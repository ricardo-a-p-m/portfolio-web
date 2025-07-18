const catalogo = document.getElementById('catalogo');
const contador = document.getElementById('contador');

let player;

function crearCatalogo() {
    catalogo.innerHTML = '';
    const canalesAMostrar = canales;

    // Contador con botón de donación
    contador.innerHTML = `
  Canales disponibles: ${canalesAMostrar.length}
  <a href="donaciones.php" rel="noopener noreferrer" id="btn-donar" title="Donar">
    🎁💰🤝
  </a>
`;


    canalesAMostrar.forEach((canal) => {
        const card = document.createElement('div');
        card.className = 'canal-card';

        const img = document.createElement('img');
        img.src = canal.logo && canal.logo.trim() !== "" ? canal.logo : 'logo.png';
        img.alt = canal.name;
        img.className = 'canal-logo';
        img.loading = "lazy";

        const nombre = document.createElement('p');
        nombre.className = 'canal-name';
        nombre.textContent = canal.name;

        card.appendChild(img);
        card.appendChild(nombre);

        card.addEventListener('click', () => {
            if (!player) {
                player = new Clappr.Player({
                    source: canal.url,
                    parentId: '#player',
                    autoPlay: true,
                    mute: false
                });
            } else {
                player.load(canal.url);
            }
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        catalogo.appendChild(card);
    });
}

crearCatalogo();
