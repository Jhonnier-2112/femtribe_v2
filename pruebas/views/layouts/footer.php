</main>

<footer class="minimal-footer">
  <!-- Main footer content -->
  <div class="footer-content">
    <div class="container">
      <!-- Centered Logo and Slogan -->
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 text-center">
          <div class="footer-brand-center">
            <div class="logo-container">
              <img src="/assets/img/femtribe_verde.png" alt="Femtribe Logo" class="footer-logo" onerror="this.src='/assets/img/logoverde.png'; this.onerror=null;">
            </div>
            <h2 class="brand-slogan">CUERPO FUERTE, MENTE LIBRE, ALMA EN TRIBU</h2>
          </div>
        </div>
      </div>  
      

      
      <!-- Texto Síguenos -->
      <div class="row justify-content-center mt-4">
        <div class="col-auto">
          <h3 class="siguenos-text">SÍGUENOS</h3>
        </div>
      </div>
      
      <!-- Social Media Icons -->
      <div class="row justify-content-center mt-4">
        <div class="col-auto">
          <div class="social-icons-center">
            <a href="https://www.facebook.com/share/17Jx3KEvf1/" target="_blank" aria-label="Facebook">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://www.instagram.com/fem_tribe?utm_source=ig_web_button_share_sheet&igsh=eHczOGNiZmFjcW93" target="_blank" aria-label="Instagram">
              <i class="fab fa-instagram"></i>
            </a>
            <!-- <a href="#" aria-label="TikTok">
              <i class="fab fa-tiktok"></i>
            </a> -->

            <a href="https://strava.app.link/dSrxQ3c7aXb" aria-label="Strava">
              <i class="fab fa-strava"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bottom Bar -->
  <div class="footer-bottom">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-12 text-center">
          <div class="d-flex flex-wrap justify-content-center gap-3 mb-2 small text-light text-opacity-75">
            <a href="/terminos" class="text-light text-decoration-none hover-underline">Términos y condiciones</a>
            <span class="d-none d-sm-inline">•</span>
            <a href="/politica-privacidad" class="text-light text-decoration-none hover-underline">Política de datos</a>
            <span class="d-none d-sm-inline">•</span>
            <a href="/autorizacion-datos" class="text-light text-decoration-none hover-underline">Exoneración de responsabilidad</a>
          </div>
          <p class="copyright-text mb-0">
            &copy; <?php echo date('Y'); ?> Femtribe. Todos los derechos reservados.
          </p>
        </div>
      </div>
    </div>
  </div>
</footer>

<style>
/* Minimal Footer Styles */
.minimal-footer {
  background: #2c2c2c;
  color: #ffffff;
  border-top: 1px solid #404040;
}

/* Footer Content */
.footer-content {
  padding: 30px 0 20px;
}

/* Centered Brand Section */
.footer-brand-center {
  margin-bottom: 15px;
  margin-top: -30px;
}

.logo-container {
  margin-bottom: 10px;
  position: relative;
}

.footer-logo {
  height: 100px;
  width: auto;
  transition: all 0.3s ease;
}

.footer-logo:hover {
  transform: scale(1.05);
}

.brand-slogan {
  font-size: 1.1rem;
  font-weight: 300;
  font-family: 'Piazzolla', serif;
  color: #ffffff;
  margin: 0;
  letter-spacing: 2px;
  line-height: 1.4;
  position: relative;
  text-transform: uppercase;
}

.brand-slogan::after {
  content: '';
  position: absolute;
  bottom: -15px;
  left: 50%;
  transform: translateX(-50%);
  width: 60px;
  height: 3px;
  background: linear-gradient(90deg, transparent, #87CC3E, transparent);
  border-radius: 2px;
}

/* Texto Síguenos */
.siguenos-text {
  color: #87CC3E;
  font-size: 1.1rem;
  font-weight: 600;
  text-align: center;
  margin: 0;
  letter-spacing: 2px;
  text-transform: uppercase;
  font-family: 'Piazzolla', serif;
}

/* Contact Row */
.contact-row {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 40px;
  flex-wrap: wrap;
  padding: 20px 0;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 15px;
  backdrop-filter: blur(10px);
  border: 1px solid rgba(135, 204, 62, 0.1);
}

.contact-item {
  display: flex;
  align-items: center;
  gap: 15px;
  transition: all 0.3s ease;
}

.contact-item:hover {
  transform: translateY(-3px);
}

.contact-icon {
  width: 50px;
  height: 50px;
  background: linear-gradient(135deg, rgba(135, 204, 62, 0.3), rgba(135, 204, 62, 0.4));
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 2px 8px rgba(135, 204, 62, 0.15);
  transition: all 0.3s ease;
}

.contact-icon:hover {
  transform: scale(1.05);
  box-shadow: 0 4px 12px rgba(135, 204, 62, 0.25);
}

.contact-icon i {
  color: #ffffff;
  font-size: 1.2rem;
}

.contact-text {
  display: flex;
  flex-direction: column;
}

.contact-label {
  color: #87CC3E;
  font-size: 0.85rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-bottom: 2px;
}

.contact-value {
  color: #ffffff;
  font-size: 1rem;
  font-weight: 500;
}

/* Social Icons Center */
.social-icons-center {
  display: flex;
  gap: 20px;
  justify-content: center;
  flex-wrap: wrap;
}

.social-icons-center a {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 50px;
  height: 50px;
  background: rgba(255, 255, 255, 0.1);
  border: 2px solid rgba(135, 204, 62, 0.3);
  border-radius: 50%;
  color: #cccccc;
  text-decoration: none;
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
  position: relative;
  overflow: hidden;
}

.social-icons-center a::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(135, 204, 62, 0.2), transparent);
  transition: left 0.5s ease;
}

.social-icons-center a:hover::before {
  left: 100%;
}

.social-icons-center a:hover {
  transform: translateY(-5px) scale(1.1);
  border-color: #87CC3E;
  color: #87CC3E;
  box-shadow: 0 8px 25px rgba(135, 204, 62, 0.4);
}

.social-icons-center a i {
  font-size: 1.2rem;
  z-index: 1;
  position: relative;
}

/* Footer Bottom */
.footer-bottom {
  background: #2c2c2c;
  padding: 10px 0;
  border-top: 1px solid #404040;
}

.copyright-text {
  color: #cccccc;
  margin: 0;
  font-size: 0.9rem;
  font-weight: 300;
}

/* Responsive Design */
@media (max-width: 768px) {
  .footer-content {
    padding: 25px 0 15px;
  }
  
  .footer-logo {
    height: 75px;
  }
  
  .brand-slogan {
    font-size: 1rem;
  }
  
  .contact-row {
    gap: 25px;
    padding: 15px;
  }
  
  .contact-item {
    flex-direction: column;
    text-align: center;
    gap: 10px;
  }
  
  .social-icons-center {
    gap: 15px;
  }
  
  .social-icons-center a {
    width: 45px;
    height: 45px;
  }
}

@media (max-width: 576px) {
  .brand-slogan {
    font-size: 0.85rem !important;
    letter-spacing: 1px !important;
    line-height: 1.3 !important;
    padding: 0 10px;
  }
  
  .contact-row {
    flex-direction: column;
    gap: 20px;
  }
  
  .footer-logo {
    height: 65px;
  }
}

/* Animation for logo */
@keyframes logoGlow {
  0%, 100% { 
    transform: scale(1);
  }
  50% { 
    transform: scale(1.02);
  }
}

.footer-logo {
  animation: logoGlow 3s ease-in-out infinite;
}
</style>

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

<!-- AOS Animation Library -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true
  });
  
  // Navbar scroll effect
  window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (navbar && navbar.classList) {
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    }
  });
</script>

<!-- Tu JavaScript -->
<!-- <script src="assets/js/app.js"></script> -->

<!-- ════════════════════════════════════════════════════════════
     🤖 CHATBOT WIDGET — FEMTRIBE Assistant
     ════════════════════════════════════════════════════════════ -->
<style>
/* ── Botón flotante ────────────────────────────────────────── */
#ft-chat-btn {
  position: fixed; bottom: 24px; right: 24px; z-index: 9999;
  width: 62px; height: 62px; border-radius: 50%;
  background: linear-gradient(135deg, #87CC3E, #5fa82d);
  border: none; cursor: pointer; box-shadow: 0 4px 20px rgba(135,204,62,.5);
  display: flex; align-items: center; justify-content: center;
  transition: transform .3s, box-shadow .3s;
  animation: ft-pulse 2.5s ease-in-out infinite;
}
#ft-chat-btn:hover { transform: scale(1.1); box-shadow: 0 6px 28px rgba(135,204,62,.7); animation: none; }
#ft-chat-btn svg  { width: 28px; height: 28px; fill: #fff; transition: opacity .2s; }
#ft-chat-btn .ft-icon-close { display: none; }

#ft-chat-btn.open .ft-icon-chat  { display: none; }
#ft-chat-btn.open .ft-icon-close { display: block; }

@keyframes ft-pulse {
  0%,100% { box-shadow: 0 4px 20px rgba(135,204,62,.5); }
  50%      { box-shadow: 0 4px 32px rgba(135,204,62,.8), 0 0 0 10px rgba(135,204,62,.1); }
}

/* ── Notificación de burbuja ───────────────────────────────── */
#ft-chat-badge {
  position: absolute; top: -4px; right: -4px;
  background: #e63946; color: #fff; font-size: 10px; font-weight: 700;
  border-radius: 50%; width: 20px; height: 20px;
  display: flex; align-items: center; justify-content: center;
  animation: ft-bounce .8s ease-in-out infinite alternate;
  font-family: sans-serif;
}
@keyframes ft-bounce { from { transform: translateY(0); } to { transform: translateY(-4px); } }

/* ── Ventana principal del chat ────────────────────────────── */
#ft-chat-window {
  position: fixed; bottom: 98px; right: 24px; z-index: 9998;
  width: 360px; max-height: 560px;
  background: rgba(15,15,26,.95);
  backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(18px);
  border: 1px solid rgba(135,204,62,.3);
  border-radius: 20px; overflow: hidden;
  box-shadow: 0 20px 60px rgba(0,0,0,.6);
  display: none; flex-direction: column;
  font-family: 'Inter', 'Segoe UI', sans-serif;
  transform: scale(.85) translateY(20px); opacity: 0;
  transition: transform .3s cubic-bezier(.34,1.56,.64,1), opacity .3s ease;
}
#ft-chat-window.open {
  display: flex;
  transform: scale(1) translateY(0);
  opacity: 1;
}
@media (max-width: 420px) {
  #ft-chat-window { width: calc(100vw - 32px); right: 16px; bottom: 90px; }
  #ft-chat-btn    { bottom: 16px; right: 16px; }
}

/* ── Header del chat ───────────────────────────────────────── */
#ft-chat-header {
  background: linear-gradient(135deg, rgba(135,204,62,.25), rgba(95,168,45,.15));
  border-bottom: 1px solid rgba(135,204,62,.2);
  padding: 14px 16px; display: flex; align-items: center; gap: 12px;
}
.ft-avatar {
  width: 40px; height: 40px; border-radius: 50%;
  background: linear-gradient(135deg,#87CC3E,#5fa82d);
  display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;
}
.ft-header-info h4 { margin:0; color:#fff; font-size:.95rem; font-weight:700; }
.ft-header-info p  { margin:0; color:#87CC3E; font-size:.75rem; display:flex; align-items:center; gap:5px; }
.ft-status-dot { width:7px; height:7px; background:#87CC3E; border-radius:50%; animation:ft-blink 1.5s infinite; }
@keyframes ft-blink { 0%,100%{ opacity:1; } 50%{ opacity:.3; } }
.ft-close-btn {
  margin-left:auto; background:none; border:none; color:rgba(255,255,255,.5);
  font-size:1.3rem; cursor:pointer; line-height:1; padding:4px; border-radius:4px;
  transition: color .2s;
}
.ft-close-btn:hover { color:#fff; }

/* ── Área de mensajes ──────────────────────────────────────── */
#ft-chat-messages {
  flex: 1; overflow-y: auto; padding: 16px;
  display: flex; flex-direction: column; gap: 10px;
  max-height: 320px; min-height: 160px;
  scrollbar-width: thin; scrollbar-color: rgba(135,204,62,.3) transparent;
}
#ft-chat-messages::-webkit-scrollbar { width: 4px; }
#ft-chat-messages::-webkit-scrollbar-thumb { background: rgba(135,204,62,.3); border-radius: 4px; }

/* ── Burbuja de mensaje ────────────────────────────────────── */
.ft-msg { display: flex; gap: 8px; align-items: flex-end; animation: ft-fadein .3s ease; }
@keyframes ft-fadein { from { opacity:0; transform:translateY(8px); } to { opacity:1; transform:translateY(0); } }
.ft-msg.bot { flex-direction: row; }
.ft-msg.user { flex-direction: row-reverse; }

.ft-bubble {
  max-width: 80%; padding: 10px 13px; border-radius: 16px;
  font-size: .85rem; line-height: 1.5; white-space: pre-wrap; word-break: break-word;
}
.ft-msg.bot  .ft-bubble {
  background: rgba(255,255,255,.07); color: #e0e0e0;
  border-bottom-left-radius: 4px; border: 1px solid rgba(255,255,255,.08);
}
.ft-msg.user .ft-bubble {
  background: linear-gradient(135deg,#87CC3E,#5fa82d); color: #fff;
  border-bottom-right-radius: 4px;
}
/* Markdown básico en respuestas */
.ft-bubble strong { color: #87CC3E; font-weight: 700; }
.ft-msg.user .ft-bubble strong { color: #fff; }
.ft-bubble em { opacity: .8; font-style: italic; }

/* ── Botón de acción en respuesta ──────────────────────────── */
.ft-action-btn {
  display: inline-block; margin-top: 8px;
  background: linear-gradient(135deg,#87CC3E,#5fa82d); color:#fff;
  border: none; border-radius: 8px; padding: 7px 14px;
  font-size: .8rem; font-weight: 600; cursor: pointer; text-decoration: none;
  transition: opacity .2s, transform .15s;
}
.ft-action-btn:hover { opacity: .9; transform: translateY(-1px); color: #fff; }

/* ── Typing indicator ──────────────────────────────────────── */
.ft-typing { display: flex; align-items: center; gap: 4px; padding: 10px 13px; }
.ft-typing span {
  width: 7px; height: 7px; background: rgba(135,204,62,.6);
  border-radius: 50%; animation: ft-typing-dot 1.2s infinite;
}
.ft-typing span:nth-child(2) { animation-delay: .2s; }
.ft-typing span:nth-child(3) { animation-delay: .4s; }
@keyframes ft-typing-dot { 0%,60%,100%{ transform:translateY(0); } 30%{ transform:translateY(-6px); } }

/* ── Sugerencias rápidas ───────────────────────────────────── */
#ft-suggestions {
  padding: 8px 12px; display: flex; flex-wrap: wrap; gap: 6px;
  border-top: 1px solid rgba(255,255,255,.06);
  background: rgba(255,255,255,.03);
}
.ft-sug-btn {
  background: rgba(135,204,62,.12); color: #87CC3E;
  border: 1px solid rgba(135,204,62,.3); border-radius: 20px;
  padding: 5px 11px; font-size: .75rem; cursor: pointer;
  transition: all .2s; white-space: nowrap;
}
.ft-sug-btn:hover { background: rgba(135,204,62,.25); border-color: #87CC3E; transform: translateY(-1px); }

/* ── Input area ────────────────────────────────────────────── */
#ft-chat-input-area {
  padding: 12px 14px; border-top: 1px solid rgba(255,255,255,.08);
  display: flex; gap: 8px; align-items: center;
  background: rgba(255,255,255,.03);
}
#ft-chat-input {
  flex: 1; background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.12);
  border-radius: 22px; padding: 9px 16px; color: #e0e0e0; font-size: .85rem;
  outline: none; transition: border-color .2s;
  font-family: inherit;
}
#ft-chat-input:focus { border-color: rgba(135,204,62,.5); }
#ft-chat-input::placeholder { color: rgba(255,255,255,.3); }

#ft-chat-send {
  width: 38px; height: 38px; border-radius: 50%; flex-shrink: 0;
  background: linear-gradient(135deg,#87CC3E,#5fa82d);
  border: none; cursor: pointer; display: flex; align-items: center; justify-content: center;
  transition: transform .2s, box-shadow .2s;
}
#ft-chat-send:hover { transform: scale(1.08); box-shadow: 0 2px 10px rgba(135,204,62,.4); }
#ft-chat-send svg { width: 16px; height: 16px; fill: #fff; }
</style>

<!-- HTML del Widget -->
<div id="ft-chat-btn" aria-label="Abrir asistente FEMTRIBE" role="button" tabindex="0">
  <span id="ft-chat-badge">1</span>
  <!-- Ícono chat -->
  <svg class="ft-icon-chat" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path d="M20 2H4C2.9 2 2 2.9 2 4v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 10H6V10h12v2zm0-3H6V7h12v2z"/>
  </svg>
  <!-- Ícono cerrar -->
  <svg class="ft-icon-close" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
  </svg>
</div>

<div id="ft-chat-window" role="dialog" aria-label="Asistente FEMTRIBE" aria-modal="true">
  <!-- Header -->
  <div id="ft-chat-header">
    <div class="ft-avatar">🏃‍♀️</div>
    <div class="ft-header-info">
      <h4>Asistente FEMTRIBE</h4>
      <p><span class="ft-status-dot"></span> En línea · Respuesta inmediata</p>
    </div>
    <button class="ft-close-btn" id="ft-chat-close" aria-label="Cerrar chat">✕</button>
  </div>

  <!-- Mensajes -->
  <div id="ft-chat-messages" role="log" aria-live="polite"></div>

  <!-- Sugerencias -->
  <div id="ft-suggestions"></div>

  <!-- Input -->
  <div id="ft-chat-input-area">
    <input id="ft-chat-input" type="text" placeholder="Escribe tu pregunta..." maxlength="300" autocomplete="off">
    <button id="ft-chat-send" aria-label="Enviar mensaje">
      <svg viewBox="0 0 24 24"><path d="M2 21l21-9L2 3v7l15 2-15 2z"/></svg>
    </button>
  </div>
</div>

<script>
(function () {
  'use strict';

  const btn      = document.getElementById('ft-chat-btn');
  const win      = document.getElementById('ft-chat-window');
  const msgs     = document.getElementById('ft-chat-messages');
  const input    = document.getElementById('ft-chat-input');
  const sendBtn  = document.getElementById('ft-chat-send');
  const closeBtn = document.getElementById('ft-chat-close');
  const sugBox   = document.getElementById('ft-suggestions');
  const badge    = document.getElementById('ft-chat-badge');

  let isOpen   = false;
  let isWaiting = false;

  // ── Abrir / cerrar ────────────────────────────────────────────
  function toggleChat() {
    isOpen = !isOpen;
    btn.classList.toggle('open', isOpen);
    if (isOpen) {
      win.style.display = 'flex';
      // Pequeño delay para que el display flex se aplique antes del CSS transition
      requestAnimationFrame(() => {
        requestAnimationFrame(() => { win.classList.add('open'); });
      });
      badge.style.display = 'none';
      if (msgs.children.length === 0) sendGreeting();
      input.focus();
    } else {
      win.classList.remove('open');
      setTimeout(() => { if (!isOpen) win.style.display = 'none'; }, 300);
    }
  }

  btn.addEventListener('click', toggleChat);
  btn.addEventListener('keydown', e => { if (e.key === 'Enter' || e.key === ' ') toggleChat(); });
  closeBtn.addEventListener('click', toggleChat);

  // ── Saludo inicial automático ─────────────────────────────────
  function sendGreeting() {
    const greetings = [
      '¿Cuánto cuesta?', '¿Cuándo es la carrera?', '¿Cómo me inscribo?', '¿Cuántos cupos quedan?'
    ];
    addBotMessage(
      '👋 ¡Hola! Soy el asistente de **FEMTRIBE**.\n¿En qué te puedo ayudar hoy? Tengo información sobre precios, fechas, inscripciones y más. 🏃‍♀️',
      greetings
    );
  }

  // ── Agregar mensaje del bot ───────────────────────────────────
  function addBotMessage(text, suggestions = [], action = null) {
    const wrap = document.createElement('div');
    wrap.className = 'ft-msg bot';

    const bubble = document.createElement('div');
    bubble.className = 'ft-bubble';
    bubble.innerHTML = renderMarkdown(text);

    if (action && action.url && action.label) {
      const a = document.createElement('a');
      a.href = action.url;
      a.className = 'ft-action-btn';
      a.textContent = action.label;
      if (action.url.startsWith('http')) a.target = '_blank';
      bubble.appendChild(document.createElement('br'));
      bubble.appendChild(a);
    }

    wrap.appendChild(bubble);
    msgs.appendChild(wrap);
    scrollToBottom();
    setSuggestions(suggestions);
  }

  // ── Agregar mensaje del usuario ───────────────────────────────
  function addUserMessage(text) {
    const wrap = document.createElement('div');
    wrap.className = 'ft-msg user';
    const bubble = document.createElement('div');
    bubble.className = 'ft-bubble';
    bubble.textContent = text;
    wrap.appendChild(bubble);
    msgs.appendChild(wrap);
    scrollToBottom();
    setSuggestions([]);
  }

  // ── Typing indicator ──────────────────────────────────────────
  function showTyping() {
    const wrap = document.createElement('div');
    wrap.className = 'ft-msg bot'; wrap.id = 'ft-typing-indicator';
    const bubble = document.createElement('div');
    bubble.className = 'ft-bubble ft-typing';
    bubble.innerHTML = '<span></span><span></span><span></span>';
    wrap.appendChild(bubble);
    msgs.appendChild(wrap);
    scrollToBottom();
  }
  function hideTyping() {
    const el = document.getElementById('ft-typing-indicator');
    if (el) el.remove();
  }

  // ── Enviar mensaje ────────────────────────────────────────────
  function sendMessage(text) {
    text = (text || input.value || '').trim();
    if (!text || isWaiting) return;
    input.value = '';
    isWaiting = true;

    addUserMessage(text);
    showTyping();

    fetch('/api/chatbot', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ message: text })
    })
    .then(r => r.json())
    .then(data => {
      hideTyping();
      addBotMessage(
        data.reply || 'No pude procesar tu pregunta.',
        data.suggestions || [],
        data.action || null
      );
    })
    .catch(() => {
      hideTyping();
      addBotMessage(
        '😕 Tuve un problema de conexión. Por favor intenta de nuevo.',
        ['Reintentar', 'Contacto WhatsApp']
      );
    })
    .finally(() => { isWaiting = false; });
  }

  // ── Sugerencias rápidas ───────────────────────────────────────
  function setSuggestions(list) {
    sugBox.innerHTML = '';
    (list || []).forEach(sug => {
      const b = document.createElement('button');
      b.className = 'ft-sug-btn';
      b.textContent = sug;
      b.addEventListener('click', () => sendMessage(sug));
      sugBox.appendChild(b);
    });
  }

  // ── Eventos de envío ──────────────────────────────────────────
  sendBtn.addEventListener('click', () => sendMessage());
  input.addEventListener('keydown', e => {
    if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
  });

  // ── Render markdown básico ────────────────────────────────────
  function renderMarkdown(text) {
    return text
      .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
      .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
      .replace(/~~(.+?)~~/g, '<del>$1</del>')
      .replace(/_(.+?)_/g, '<em>$1</em>')
      .replace(/\n/g, '<br>');
  }

  // ── Scroll al fondo ───────────────────────────────────────────
  function scrollToBottom() {
    requestAnimationFrame(() => { msgs.scrollTop = msgs.scrollHeight; });
  }

  // ── Esc para cerrar ───────────────────────────────────────────
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape' && isOpen) toggleChat();
  });

})();
</script>
<!-- ════════════════════ FIN CHATBOT ════════════════════ -->

</body>
</html>
