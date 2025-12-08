@php
    // Contamos los registros para las estadísticas
    // Asegúrate de usar el nombre correcto de tus modelos (singular o plural según como quedaron)
    $profesoresCount = \App\Models\Profesor::count();
    $cursosCount = \App\Models\Curso::count();
    
    // Ajusta si tu modelo se llama Asignatura o Asignaturas
    $asignaturasCount = \App\Models\Asignaturas::count(); 
    
    $clasesCount = \App\Models\Horario::count();
@endphp

@extends('layouts.app')

@section('titulo_pagina', 'Panel de Control Principal')

@section('content')
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card card-stat bg-primary text-white p-3 h-100">
            <div class="card-body">
                <h5 class="card-title">Profesores</h5>
                <h2 class="display-4 fw-bold">{{ $profesoresCount }}</h2>
                <i class="fas fa-chalkboard-teacher icon-stat"></i>
                <a href="{{ url('/profesores') }}" class="text-white text-decoration-none small">Ver lista &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card card-stat bg-success text-white p-3 h-100">
            <div class="card-body">
                <h5 class="card-title">Cursos Activos</h5>
                <h2 class="display-4 fw-bold">{{ $cursosCount }}</h2>
                <i class="fas fa-users icon-stat"></i>
                <a href="{{ url('/cursos') }}" class="text-white text-decoration-none small">Gestionar &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card card-stat bg-warning text-dark p-3 h-100">
            <div class="card-body">
                <h5 class="card-title">Asignaturas</h5>
                <h2 class="display-4 fw-bold">{{ $asignaturasCount }}</h2>
                <i class="fas fa-book icon-stat"></i>
                <a href="{{ url('/asignaturas') }}" class="text-dark text-decoration-none small">Ver detalles &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card card-stat bg-info text-white p-3 h-100">
            <div class="card-body">
                <h5 class="card-title">Clases Programadas</h5>
                <h2 class="display-4 fw-bold">{{ $clasesCount }}</h2>
                <i class="fas fa-calendar-check icon-stat"></i>
                {{-- Aquí cambiamos el enlace para que vaya a lo visual primero --}}
                <a href="{{ route('horarios.grilla') }}" class="text-white text-decoration-none small fw-bold">Ver Calendario &rarr;</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">
                <i class="fas fa-info-circle text-primary"></i> Estado del Sistema
            </div>
            <div class="card-body">
                <p>Bienvenido al sistema <strong>Timely</strong>. Seleccione una opción del menú lateral para comenzar a gestionar la carga académica.</p>
                <div class="alert alert-light border">
                    <strong>💡 Tip:</strong> Recuerda crear primero los Profesores, Espacios y Asignaturas antes de intentar crear un Horario.
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm text-center">
            <div class="card-body">
                <h5 class="text-muted mb-3">Acciones Rápidas</h5>
                
                {{-- BOTÓN NUEVO: Ver Grilla de Horarios --}}
                <a href="{{ route('horarios.grilla') }}" class="btn btn-info text-white w-100 mb-2">
                    <i class="fas fa-calendar-alt"></i> Ver Calendario General
                </a>

                <a href="{{ route('horarios.create') }}" class="btn btn-outline-primary w-100 mb-2">
                    <i class="fas fa-plus-circle"></i> Nueva Clase
                </a>
                
                <a href="{{ url('/profesores/create') }}" class="btn btn-outline-success w-100">
                    <i class="fas fa-user-plus"></i> Nuevo Profesor
                </a>
            </div>
        </div>
    </div>
</div>
@endsection