// Actualiza hora y fecha
function updateTime() {
    const now = new Date();
    const h = now.getHours().toString().padStart(2, '0');
    const m = now.getMinutes().toString().padStart(2, '0');
    document.getElementById('time').textContent = `${h}:${m}`;
    const options = { weekday: 'long', day: 'numeric', month: 'long' };
    document.getElementById('date').textContent = now.toLocaleDateString('es-ES', options);
}
setInterval(updateTime, 1000);
updateTime();

// Variables
const apps = document.querySelectorAll('.app-icon');
const screens = document.querySelectorAll('.app-screen');
const topBar = document.getElementById('topBar');
const timeDisplay = document.getElementById('time');
const subInfo = document.getElementById('date');

// Abrir app
function openApp(name) {
    screens.forEach(s => s.classList.remove('active'));
    const screen = document.getElementById(name);
    if (screen) screen.classList.add('active');
    topBar.classList.add('hidden');
    timeDisplay.classList.add('hidden');
    subInfo.classList.add('hidden');
}

// Cerrar app
function closeApp(btn) {
    const screen = btn.closest('.app-screen');
    if (!screen) return;
    screen.classList.remove('active');
    topBar.classList.remove('hidden');
    timeDisplay.classList.remove('hidden');
    subInfo.classList.remove('hidden');
}

// Eventos abrir apps
apps.forEach(app => {
    app.addEventListener('click', () => openApp(app.dataset.app));
    app.addEventListener('keydown', e => {
        if (e.key === 'Enter' || e.key === ' ') openApp(app.dataset.app);
    });
});

// Eventos cerrar apps
document.querySelectorAll('.close-btn').forEach(btn => {
    btn.addEventListener('click', () => closeApp(btn));
    btn.addEventListener('keydown', e => {
        if (e.key === 'Enter' || e.key === ' ') closeApp(btn);
    });
});

// Enviar mensaje (app mensajes)
const msgInput = document.getElementById('msgInput');
const sendMsg = document.getElementById('sendMsg');
const messagesContainer = document.querySelector('.messages-container');

sendMsg.addEventListener('click', sendMessage);
msgInput.addEventListener('keydown', e => {
    if (e.key === 'Enter') sendMessage();
});

function sendMessage() {
    const text = msgInput.value.trim();
    if (!text) return;
    const p = document.createElement('p');
    p.innerHTML = `<b>Tú:</b> ${text}`;
    messagesContainer.appendChild(p);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
    msgInput.value = '';
}

// Asistente virtual simple
const chatInput = document.getElementById('chatInput');
const sendChat = document.getElementById('sendChat');
const chatArea = document.getElementById('chatArea');

sendChat.addEventListener('click', sendChatMessage);
chatInput.addEventListener('keydown', e => {
    if (e.key === 'Enter') sendChatMessage();
});

function sendChatMessage() {
    const text = chatInput.value.trim();
    if (!text) return;
    const userP = document.createElement('p');
    userP.innerHTML = `<b>Tú:</b> ${text}`;
    chatArea.appendChild(userP);

    // Respuesta simple bot
    const botP = document.createElement('p');
    botP.innerHTML = `<b>Bot:</b> No puedo ayudarte ahora, pero pronto seré más inteligente.`;
    chatArea.appendChild(botP);

    chatArea.scrollTop = chatArea.scrollHeight;
    chatInput.value = '';
}

// Cambiar tema y colores hora+contorno
const themeSelect = document.getElementById('themeSelect');
themeSelect.addEventListener('change', () => {
    const val = themeSelect.value;

    const smartwatch = document.querySelector('.smartwatch');
    const contentScroll = document.querySelector('.content-scroll');
    const appIcons = document.querySelectorAll('.app-icon');

    if (val === 'light') {
        document.body.style.background = '#eee';
        smartwatch.style.background = '#fafafa';
        contentScroll.style.background = '#fff';
        timeDisplay.style.background = '#fafafa';
        timeDisplay.style.color = '#222';
        timeDisplay.style.boxShadow = '0 0 12px #555';
        timeDisplay.style.borderColor = '#444';
        subInfo.style.background = '#fafafa';
        subInfo.style.color = '#444';
        appIcons.forEach(el => el.style.background = 'linear-gradient(145deg, #fff, #e0e0e0)');
        topBar.style.background = '#fafafa';

    } else if (val === 'neon') {
        document.body.style.background = '#000';
        smartwatch.style.background = '#111';
        contentScroll.style.background = '#050505';
        timeDisplay.style.background = '#111';
        timeDisplay.style.color = '#00fff7';
        timeDisplay.style.boxShadow = '0 0 20px #00fff7, 0 0 30px #009b94';
        timeDisplay.style.borderColor = '#00fff7';
        subInfo.style.background = '#111';
        subInfo.style.color = '#00fff7';
        appIcons.forEach(el => el.style.background = 'linear-gradient(145deg, #00fff7, #009b94)');
        topBar.style.background = '#111';

    } else { // dark
        document.body.style.background = '#111';
        smartwatch.style.background = 'linear-gradient(145deg, #1e1e1e, #282828)';
        contentScroll.style.background = '#0d0d0d';
        timeDisplay.style.background = '#0d0d0d';
        timeDisplay.style.color = '#eee';
        timeDisplay.style.boxShadow = '0 0 8px #888';
        timeDisplay.style.borderColor = '#eee';
        subInfo.style.background = '#0d0d0d';
        subInfo.style.color = '#aaa';
        appIcons.forEach(el => el.style.background = 'linear-gradient(145deg, #2a2a2a, #1c1c1c)');
        topBar.style.background = '#141414';
    }
});

// Tema inicial
themeSelect.value = 'dark';
themeSelect.dispatchEvent(new Event('change'));
