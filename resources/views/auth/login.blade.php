<x-guest-layout>
    <style>
        /* --- 1. OVERLAY DE CARGA --- */
        #loader-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: #0e4b30;
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            color: white;
        }

        /* --- 2. DISEÑO BASE (Círculos Parallax Originales) --- */
        .min-h-screen > div:first-child > a { display: none !important; }
        
        :root {
            --primary-green: #2ecc71;
            --dark-green: #0e4b30;
            --glass-white: rgba(248, 250, 249, 0.85);
            --fluorescent: #39ff14;
        }

        .min-h-screen {
            background: radial-gradient(circle at center, #2ecc71 0%, #27ae60 100%) !important;
            position: relative; overflow: hidden;
            display: flex; flex-direction: column; justify-content: center; align-items: center;
        }

        .bg-shape { 
            position: absolute; 
            background: rgba(255, 255, 255, 0.1); 
            border-radius: 50%; 
            z-index: 0; 
            pointer-events: none;
            transition: transform 0.2s ease-out;
        }

        /* --- 3. LOGIN CARD Y DESPRENDIMIENTO --- */
        #login-card {
            position: relative; z-index: 1;
            background: var(--glass-white) !important;
            backdrop-filter: blur(15px);
            border-radius: 28px !important;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25) !important;
            padding: 2.5rem !important;
            transform-origin: top;
        }

        .peel-off {
            animation: leafFallAction 1.2s forwards cubic-bezier(0.25, 0.46, 0.45, 0.94) !important;
            pointer-events: none;
        }

        @keyframes leafFallAction {
            0% { transform: translateY(0) rotateX(0); opacity: 1; }
            100% { transform: translateY(100vh) rotateZ(15deg) rotateX(-90deg); opacity: 0; }
        }

        /* --- 4. RELOJ FLUORESCENTE --- */
        .logo-svg { 
            transition: transform 0.7s; 
            cursor: pointer;
            filter: drop-shadow(0 0 8px var(--fluorescent));
        }

        #sand-group {
            transition: transform 0.4s ease-in-out;
            transform-origin: center;
        }

        .flip-sand { transform: scaleY(-1); }

        input { border: 1.5px solid var(--primary-green) !important; border-radius: 12px !important; }
        
        /* Botón más pequeño y centrado */
        .btn-container { display: flex; justify-content: center; margin-top: 1.5rem; }
        button { 
            background-color: var(--dark-green) !important; 
            border-radius: 12px !important; 
            font-weight: 800 !important; 
            width: 60%; /* Tamaño reducido */
            color: white; 
            padding: 10px; 
            cursor: pointer; 
            border: none;
            transition: transform 0.2s;
        }
        button:active { transform: scale(0.95); }
        
        .forgot-link {
            color: var(--dark-green);
            font-size: 0.8rem;
            text-decoration: none;
            font-weight: 600;
        }
        .forgot-link:hover { text-decoration: underline; }
    </style>

    <div id="loader-overlay">
        <p style="font-weight: 800; letter-spacing: 2px;">TIMELY CARGANDO...</p>
    </div>

    <div class="bg-shape" id="shape1" style="width: 600px; height: 600px; top: -200px; left: -150px;"></div>
    <div class="bg-shape" id="shape2" style="width: 400px; height: 400px; bottom: -100px; right: -100px;"></div>

    <div id="login-card" class="w-full sm:max-w-md">
        <div style="display:flex; justify-content:center; margin-bottom:1rem;">
            <svg id="reloj" class="logo-svg" width="85" height="85" viewBox="0 0 24 24" fill="none">
                <path d="M18 2H6V8L10 12L6 16V22H18V16L14 12L18 8V2Z" stroke="#0e4b30" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <g id="sand-group">
                    <path d="M10 16L12 14L14 16" stroke="var(--fluorescent)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </g>
            </svg>
        </div>

        <div class="text-center mb-6">
            <h1 style="font-size: 2.8rem; font-weight: 900; color: var(--dark-green); margin: 0;">Timely</h1>
            <p id="smart-greeting" style="color: var(--dark-green); font-weight: 600;"></p>
        </div>

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
            </div>

            <div class="mt-4" style="position:relative;">
                <div class="flex justify-between items-center mb-1">
                    <x-input-label for="password" :value="__('Password')" />
                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">¿Olvidaste?</a>
                    @endif
                </div>
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                <span id="toggleEye" style="position:absolute; right:15px; top:38px; cursor:pointer; opacity:0.5;">👁️</span>
            </div>

            <div class="flex items-center justify-between mt-6">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember" class="rounded text-[#0e4b30]">
                    <span class="ms-2 text-sm text-[#0e4b30]">Recordarme</span>
                </label>
            </div>

            <div class="btn-container">
                <button type="submit">Entrar</button>
            </div>
        </form>
    </div>

    <script>
        // Restauración del Sistema de Sonido
        const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
        function playSfx(f, d) {
            try {
                const o = audioCtx.createOscillator(); 
                const g = audioCtx.createGain();
                o.type = 'sine'; 
                o.frequency.value = f; 
                g.gain.setValueAtTime(0.05, audioCtx.currentTime);
                g.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + d);
                o.connect(g); 
                g.connect(audioCtx.destination); 
                o.start(); 
                o.stop(audioCtx.currentTime + d);
            } catch(e) { console.log("Audio waiting for user interaction"); }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const hour = new Date().getHours();
            document.getElementById('smart-greeting').innerText = hour < 12 ? "¡Buen día!" : (hour < 18 ? "¡Buenas tardes!" : "¡Buenas noches!");

            let angle = 0;
            const reloj = document.getElementById('reloj');
            const sandGroup = document.getElementById('sand-group');

            reloj.addEventListener('mouseenter', () => {
                angle += 180;
                reloj.style.transform = `rotate(${angle}deg)`;
                sandGroup.classList.toggle('flip-sand');
                playSfx(440, 0.1); // Sonido suave al girar
            });

            document.addEventListener('mousemove', (e) => {
                const x = (e.clientX / window.innerWidth) - 0.5;
                const y = (e.clientY / window.innerHeight) - 0.5;
                document.getElementById('shape1').style.transform = `translate(${x*40}px, ${y*40}px)`;
                document.getElementById('shape2').style.transform = `translate(${x*-60}px, ${y*-60}px)`;
            });

            document.getElementById('toggleEye').onclick = () => {
                const p = document.getElementById('password');
                p.type = p.type === 'password' ? 'text' : 'password';
                playSfx(800, 0.1);
            };

            document.getElementById('loginForm').onsubmit = (e) => {
                e.preventDefault();
                playSfx(523, 0.4); // Sonido de confirmación
                document.getElementById('login-card').classList.add('peel-off');
                setTimeout(() => {
                    document.getElementById('loader-overlay').style.display = 'flex';
                    e.target.submit();
                }, 1000);
            };
        });
    </script>
</x-guest-layout>