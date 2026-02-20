@extends('layouts.app')

@section('titulo_pagina', 'Gestión de Asignaturas')

@section('content')
<style>
    .card-notebook {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background: white;
        position: relative;
        margin-top: 15px;
        border-top: 4px solid var(--timely-medium);
        transition: 0.2s;
    }
    .card-notebook:hover { box-shadow: 0 5px 15px rgba(0,0,0,0.05); }

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
        background: #d1d5db;
        border-radius: 4px;
    }

    .card-body-simple { padding: 25px 15px 15px 15px; }

    .btn-circle {
        width: 32px; height: 32px; border-radius: 50%;
        display: inline-flex; align-items: center; justify-content: center;
    }
    .badge-type { font-size: 0.7rem; padding: 3px 8px; border-radius: 10px; text-transform: uppercase; }
</style>

<div class="container pb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0" style="color: var(--timely-dark);">Asignaturas</h3>
        <a href="{{ route('asignaturas.create') }}" class="btn text-white px-4 shadow-sm" style="background-color: var(--timely-medium); border-radius: 20px;">
            <i class="fas fa-plus small me-2"></i> Nueva Materia
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 small py-2 mb-4" style="background-color: #f0fdf4; color: #166534;">
            <i class="fas fa-check me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @forelse($asignaturas as $asignatura)
            <div class="col-md-4 mb-4">
                <div class="card-notebook">
                    <div class="notebook-rings">
                        <div class="ring-simple"></div>
                        <div class="ring-simple"></div>
                        <div class="ring-simple"></div>
                    </div>

                    <div class="card-body-simple">
                        <div class="mb-2">
                            <span class="badge-type {{ $asignatura->tipo_materia == 'técnica' ? 'bg-warning-subtle text-warning' : 'bg-success-subtle text-success' }}">
                                {{ $asignatura->tipo_materia }}
                            </span>
                        </div>
                        <h6 class="fw-bold mb-1">{{ $asignatura->nombre }}</h6>
                        <p class="text-muted small mb-2 text-truncate">{{ $asignatura->descripcion }}</p>
                        
                        <div class="small mb-3">
                            <i class="fas fa-user-tie me-1 text-secondary"></i> {{ $asignatura->profesor_asignado }}<br>
                            <i class="fas fa-clock me-1 text-secondary"></i> {{ $asignatura->horas_semanales }}h semanales
                        </div>

                        <div class="d-flex justify-content-end gap-1 border-top pt-2">
                            <a href="{{ route('asignaturas.edit', $asignatura->id) }}" class="btn btn-light btn-circle text-success shadow-sm">
                                <i class="fas fa-edit fa-xs"></i>
                            </a>
                            <form action="{{ route('asignaturas.destroy', $asignatura->id) }}" method="POST" onsubmit="return confirm('¿Eliminar asignatura?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-light btn-circle text-danger shadow-sm">
                                    <i class="fas fa-trash fa-xs"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No hay asignaturas registradas.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection