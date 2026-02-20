@php
    // Mantengo tu lógica de conteo original
    $profesoresCount = \App\Models\Profesor::count();
    $cursosCount = \App\Models\Curso::count();
    $asignaturasCount = \App\Models\Asignaturas::count(); 
    $clasesCount = \App\Models\Horario::count();
@endphp

@extends('layouts.app')

@section('titulo_pagina', 'Panel de Control Principal')

@section('content')
<style>
    /* Estilos para las tarjetas con anillos */
    .card-stat { 
        border: none; 
        border-radius: 12px; 
        box-shadow: 0 4px 12px rgba(0,0,0,0.1); 
        transition: transform 0.3s; 
        position: relative; 
        overflow: hidden;
        padding-top: 15px; /* Espacio para los anillos */
    }
    .card-stat:hover { transform: translateY(-5px); }
    
    /* Los anillos de la libreta */
    .notebook-rings-stat {
        position: absolute;
        top: 8px;
        left: 20px;
        display: flex;
        gap: 12px;
        z-index: 10;
    }
    .ring-stat {
        width: 6px;
        height: 14px;
        background: rgba(255, 255, 255, 0.4);
        border-radius: 3px;
    }
    /* Anillos oscuros para la tarjeta blanca */
    .ring-dark { background: #d1d5db; }

    .icon-stat { font-size: 2.5rem; opacity: 0.2; position: absolute; right: 15px; bottom: 15px; }
</style>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card card-stat text-white h-100" style="background-color: var(--timely-dark);">
            <div class="notebook-rings-stat">
                <div class="ring-stat"></div><div class="ring-stat"></div><div class="ring-stat"></div>
            </div>
            <div class="card-body">
                <h6 class="text-uppercase fw-bold opacity-75 small">Profesores</h6>
                <h2 class="display-5 fw-bold mb-0">{{ $profesoresCount }}</h2>
                <i class="fas fa-chalkboard-teacher icon-stat"></i>
                <div class="mt-3">
                    <a href="{{ url('/profesores') }}" class="text-white text-decoration-none small opacity-75">Ver lista &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card card-stat text-white h-100" style="background-color: var(--timely-medium);">
            <div class="notebook-rings-stat">
                <div class="ring-stat"></div><div class="ring-stat"></div><div class="ring-stat"></div>
            </div>
            <div class="card-body">
                <h6 class="text-uppercase fw-bold opacity-75 small">Cursos Activos</h6>
                <h2 class="display-5 fw-bold mb-0">{{ $cursosCount }}</h2>
                <i class="fas fa-users icon-stat"></i>
                <div class="mt-3">
                    <a href="{{ url('/cursos') }}" class="text-white text-decoration-none small opacity-75">Gestionar &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card card-stat h-100" style="background-color: var(--timely-accent); color: var(--timely-dark);">
            <div class="notebook-rings-stat">
                <div class="ring-stat" style="background: rgba(0,0,0,0.15);"></div>
                <div class="ring-stat" style="background: rgba(0,0,0,0.15);"></div>
                <div class="ring-stat" style="background: rgba(0,0,0,0.15);"></div>
            </div>
            <div class="card-body">
                <h6 class="text-uppercase fw-bold opacity-75 small">Asignaturas</h6>
                <h2 class="display-5 fw-bold mb-0">{{ $asignaturasCount }}</h2>
                <i class="fas fa-book icon-stat"></i>
                <div class="mt-3">
                    <a href="{{ url('/asignaturas') }}" class="text-decoration-none small fw-bold" style="color: var(--timely-dark); opacity: 0.7;">Ver detalles &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card card-stat bg-white h-100 border">
            <div class="notebook-rings-stat">
                <div class="ring-stat ring-dark"></div><div class="ring-stat ring-dark"></div><div class="ring-stat ring-dark"></div>
            </div>
            <div class="card-body">
                <h6 class="text-uppercase fw-bold text-muted small">Clases Hoy</h6>
                <h2 class="display-5 fw-bold mb-0" style="color: var(--timely-dark);">{{ $clasesCount }}</h2>
                <i class="fas fa-calendar-check icon-stat" style="color: var(--timely-medium);"></i>
                <div class="mt-3">
                    <a href="{{ route('horarios.grilla') }}" class="text-decoration-none small fw-bold" style="color: var(--timely-medium);">Ver Grilla &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-8">
        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            <div class="card-header bg-white fw-bold border-0 pt-3">
                <i class="fas fa-info-circle" style="color: var(--timely-medium);"></i> Estado del Sistema
            </div>
            <div class="card-body">
                <p>Bienvenido al sistema <strong>Timely</strong>. Seleccione una opción del menú lateral para comenzar a gestionar la carga académica.</p>
                <div class="alert alert-light border-0 bg-light" style="border-radius: 10px;">
                    <strong>💡 Tip:</strong> Recuerda crear primero los Profesores, Espacios y Asignaturas antes de intentar crear un Horario.
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0 p-2" style="border-radius: 12px;">
            <div class="card-body">
                <h6 class="text-muted mb-3 fw-bold text-uppercase small">Acciones Rápidas</h6>
                
                <a href="{{ route('horarios.grilla') }}" class="btn w-100 mb-2 py-2 fw-bold text-white border-0" style="background-color: var(--timely-accent); border-radius: 8px;">
                    <i class="fas fa-calendar-alt me-2"></i> Calendario General
                </a>

                <a href="{{ route('horarios.create') }}" class="btn w-100 mb-2 py-2 fw-bold text-white border-0" style="background-color: var(--timely-dark); border-radius: 8px;">
                    <i class="fas fa-plus-circle me-2"></i> Nueva Clase
                </a>
                
                <a href="{{ url('/profesores/create') }}" class="btn w-100 py-2 fw-bold" style="border: 2px solid var(--timely-medium); color: var(--timely-medium); border-radius: 8px; background: transparent;">
                    <i class="fas fa-user-plus me-2"></i> Nuevo Profesor
                </a>
            </div>
        </div>
    </div>
</div>
@endsection