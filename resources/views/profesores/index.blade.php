@extends('layouts.app')

@section('titulo_pagina', 'Gestión de Docentes')

@section('content')
<style>
    /* Tarjeta tipo Hoja de Libreta */
    .card-notebook {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background: white;
        position: relative;
        margin-top: 15px;
        border-top: 4px solid var(--timely-medium); /* Franja de color Timely */
        transition: 0.2s;
    }
    
    .card-notebook:hover { box-shadow: 0 5px 15px rgba(0,0,0,0.05); }

    /* Anillos simplificados (solo 3 por tarjeta) */
    .notebook-rings {
        position: absolute;
        top: -10px;
        left: 20px;
        display: flex;
        gap: 15px;
    }

    .ring-simple {
        width: 8px;
        height: 18px;
        background: #d1d5db; /* Gris neutro */
        border-radius: 4px;
    }

    .card-body-simple {
        padding: 25px 15px 15px 15px;
    }

    .btn-circle {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }
</style>

<div class="container pb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0" style="color: var(--timely-dark);">Profesores</h3>
        <a href="{{ route('profesores.create') }}" class="btn text-white px-4 shadow-sm" style="background-color: var(--timely-medium); border-radius: 20px;">
            <i class="fas fa-plus small me-2"></i> Nuevo
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 small py-2 mb-4" style="background-color: #f0fdf4; color: #166534;">
            <i class="fas fa-check me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @forelse($profesores as $profesor)
            <div class="col-md-4 mb-4">
                <div class="card-notebook">
                    <div class="notebook-rings">
                        <div class="ring-simple"></div>
                        <div class="ring-simple"></div>
                        <div class="ring-simple"></div>
                    </div>

                    <div class="card-body-simple">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; color: var(--timely-medium);">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">{{ $profesor->nombre }} {{ $profesor->apellido }}</h6>
                                <small class="text-muted">{{ $profesor->especialidad ?? 'Docente' }}</small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center border-top pt-2">
                            <small class="text-muted" style="font-size: 0.75rem;">{{ $profesor->email }}</small>
                            <div class="d-flex gap-1">
                                <a href="{{ route('profesores.edit', $profesor->id) }}" class="btn btn-light btn-circle text-success shadow-sm">
                                    <i class="fas fa-edit fa-xs"></i>
                                </a>
                                <form action="{{ route('profesores.destroy', $profesor->id) }}" method="POST" onsubmit="return confirm('¿Eliminar?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-light btn-circle text-danger shadow-sm">
                                        <i class="fas fa-trash fa-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Lista vacía.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection