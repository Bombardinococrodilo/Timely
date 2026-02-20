<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timely - Sistema Escolar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Variables Monocromáticas */
        :root {
            --timely-dark: #0e4b30;
            --timely-medium: #1e8449;
            --timely-accent: #2ecc71;
            --timely-fluorescent: #39ff14;
            --timely-bg: #f4f6f9;
        }

        body { font-family: 'Segoe UI', sans-serif; background-color: var(--timely-bg); }
        
        /* Sidebar con colores Timely */
        .sidebar { height: 100vh; width: 250px; position: fixed; top: 0; left: 0; background-color: var(--timely-dark); color: white; padding-top: 20px; transition: 0.3s; z-index: 1000; }
        .sidebar a { padding: 15px 25px; text-decoration: none; font-size: 1.1rem; color: rgba(255,255,255,0.7); display: block; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background-color: var(--timely-medium); color: white; border-left: 5px solid var(--timely-accent); }
        .sidebar i { margin-right: 10px; width: 25px; text-align: center; }
        
        .main-content { margin-left: 250px; padding: 30px; }
        .navbar { background-color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 15px 30px; margin-bottom: 30px; border-radius: 10px; }
        
        /* Logo Animado */
        .logo-svg { filter: drop-shadow(0 0 5px var(--timely-fluorescent)); transition: transform 0.7s; cursor: pointer; }

        /* Estilo del botón de cerrar sesión corregido */
        .logout-form button {
            background: none; 
            border: none; 
            color: #ff7675; 
            width: 100%; 
            text-align: left; 
            padding: 15px 25px; 
            font-size: 1.1rem; 
            cursor: pointer; 
            transition: 0.3s;
            display: flex;
            align-items: center;
        }
        .logout-form button:hover { background-color: #c0392b; color: white; }
        .logout-form button i { margin-right: 10px; width: 25px; text-align: center; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="text-center mb-4">
            <svg id="reloj" class="logo-svg" width="50" height="50" viewBox="0 0 24 24" fill="none">
                <path d="M18 2H6V8L10 12L6 16V22H18V16L14 12L18 8V2Z" stroke="var(--timely-accent)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <g id="sand-group" style="transition: transform 0.4s; transform-origin: center;">
                    <path d="M10 16L12 14L14 16" stroke="var(--timely-fluorescent)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </g>
            </svg>
            <h3 class="mt-2" style="font-weight: 800; letter-spacing: 1px;">TIMELY</h3>
        </div>

        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}"><i class="fas fa-home"></i> Inicio</a>
        <a href="{{ url('/profesores') }}" class="{{ request()->is('profesores*') ? 'active' : '' }}"><i class="fas fa-chalkboard-teacher"></i> Profesores</a>
        <a href="{{ url('/cursos') }}" class="{{ request()->is('cursos*') ? 'active' : '' }}"><i class="fas fa-users"></i> Cursos</a>
        <a href="{{ url('/asignaturas') }}" class="{{ request()->is('asignaturas*') ? 'active' : '' }}"><i class="fas fa-book"></i> Asignaturas</a>
        <a href="{{ url('/espacios') }}" class="{{ request()->is('espacios*') ? 'active' : '' }}"><i class="fas fa-building"></i> Espacios</a>
        <a href="{{ route('notificaciones.index') }}" class="{{ request()->routeIs('notificaciones*') ? 'active' : '' }}">
            <i class="fas fa-envelope"></i> Notificaciones
        </a>
        <hr style="border-color: rgba(255,255,255,0.1);">
        <a href="{{ route('horarios.index') }}" class="{{ request()->is('horarios*') ? 'active' : '' }}"><i class="fas fa-calendar-alt"></i> <b>Gestionar Horarios</b></a>
        
        <form method="POST" action="{{ route('logout') }}" class="logout-form mt-5">
            @csrf
            <button type="submit">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </button>
        </form>
    </div>

    <div class="main-content">
        <nav class="navbar d-flex justify-content-between align-items-center">
            <h4 class="m-0 text-secondary">@yield('titulo_pagina', 'Panel de Control')</h4>
            <div class="user-info d-flex align-items-center">
                <span class="fw-bold me-2">{{ Auth::user()->name ?? 'Usuario' }}</span>
                <i class="fas fa-user-circle fa-2x text-secondary"></i>
            </div>
        </nav>

        @yield('content')
        
        @if(isset($slot))
            {{ $slot }}
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animación del reloj (Sandglass)
        const reloj = document.getElementById('reloj');
        const sand = document.getElementById('sand-group');
        let angle = 0;
        reloj.addEventListener('mouseenter', () => {
            angle += 180;
            reloj.style.transform = `rotate(${angle}deg)`;
            sand.style.transform = sand.style.transform === 'scaleY(-1)' ? 'scaleY(1)' : 'scaleY(-1)';
        });
    </script>
</body>
</html>