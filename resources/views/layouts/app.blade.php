<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timely - Sistema Escolar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f6f9; }
        .sidebar { height: 100vh; width: 250px; position: fixed; top: 0; left: 0; background-color: #2c3e50; color: white; padding-top: 20px; }
        .sidebar a { padding: 15px 25px; text-decoration: none; font-size: 1.1rem; color: #bdc3c7; display: block; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background-color: #27ae60; color: white; }
        .sidebar i { margin-right: 10px; width: 25px; text-align: center; }
        .main-content { margin-left: 250px; padding: 30px; }
        .navbar { background-color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 15px 30px; margin-bottom: 30px; border-radius: 10px; }
        .card-stat { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.3s; }
        .card-stat:hover { transform: translateY(-5px); }
        .icon-stat { font-size: 3rem; opacity: 0.3; position: absolute; right: 20px; top: 20px; }
        
        .logout-form button {
            background: none;
            border: none;
            color: #e74c3c;
            width: 100%;
            text-align: left;
            padding: 15px 25px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: 0.3s;
        }
        .logout-form button:hover {
            background-color: #c0392b;
            color: white;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h3 class="text-center mb-4"><i class="fas fa-clock"></i> TIMELY</h3>
        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}"><i class="fas fa-home"></i> Inicio</a>
        <a href="{{ url('/profesores') }}" class="{{ request()->is('profesores*') ? 'active' : '' }}"><i class="fas fa-chalkboard-teacher"></i> Profesores</a>
        <a href="{{ url('/cursos') }}" class="{{ request()->is('cursos*') ? 'active' : '' }}"><i class="fas fa-users"></i> Cursos</a>
        <a href="{{ url('/asignaturas') }}" class="{{ request()->is('asignaturas*') ? 'active' : '' }}"><i class="fas fa-book"></i> Asignaturas</a>
        <a href="{{ url('/espacios') }}" class="{{ request()->is('espacios*') ? 'active' : '' }}"><i class="fas fa-building"></i> Espacios</a>
        <a href="{{ route('notificaciones.index') }}" class="{{ request()->routeIs('notificaciones*') ? 'active' : '' }}">
        <i class="fas fa-envelope"></i> Notificaciones</a>
        <hr style="border-color: gray;">
        <a href="{{ route('horarios.index') }}" class="{{ request()->is('horarios*') ? 'active' : '' }}"><i class="fas fa-calendar-alt"></i> <b>Gestionar Horarios</b></a>
        
        <form method="POST" action="{{ route('logout') }}" class="logout-form mt-5">
            @csrf
            <button type="submit"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</button>
        </form>
    </div>

    <div class="main-content">
        <nav class="navbar d-flex justify-content-between align-items-center">
            <h4 class="m-0 text-secondary">@yield('titulo_pagina', 'Panel de Control')</h4>
            <div class="user-info">
                <span class="fw-bold">{{ Auth::user()->name ?? 'Usuario' }}</span>
                <i class="fas fa-user-circle fa-2x ms-2 text-secondary" style="vertical-align: middle;"></i>
            </div>
        </nav>

        @yield('content')
        
        @if(isset($slot))
            {{ $slot }}
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>