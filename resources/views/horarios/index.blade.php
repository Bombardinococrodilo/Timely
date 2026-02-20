@extends('layouts.app')

@section('titulo_pagina', 'Gestión de Horarios')

@section('content')
<style>
    .card-notebook {
        border: 1px solid #e0e0e0; border-radius: 8px; background: white;
        position: relative; margin-top: 15px; border-top: 4px solid #1e8449;
    }
    .notebook-rings { position: absolute; top: -10px; left: 20px; display: flex; gap: 15px; }
    .ring-simple { width: 8px; height: 18px; background: #d1d5db; border-radius: 4px; }
    .card-body-simple { padding: 25px 15px 15px 15px; }
    .btn-circle { width: 32px; height: 32px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; }
    .badge-day { background-color: #e8f5e9; color: #1b5e20; font-weight: bold; padding: 4px 10px; border-radius: 8px; font-size: 0.75rem; }
</style>

<div class="container pb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0" style="color: var(--timely-dark);">Cronograma de Clases</h3>
            <p class="text-muted small">Listado detallado de la programación académica</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('horarios.grilla') }}" class="btn btn-outline-success px-3 shadow-sm" style="border-radius: 20px;">
                <i class="fas fa-calendar-alt me-1"></i> Ver Grilla
            </a>
            <a href="{{ route('horarios.create') }}" class="btn text-white px-4 shadow-sm" style="background-color: var(--timely-medium); border-radius: 20px;">
                <i class="fas fa-plus small me-2"></i> Programar Clase
            </a>
        </div>
    </div>

    <div class="row">
        @forelse($horarios as $h)
            <div class="col-md-4 mb-4">
                <div class="card-notebook shadow-sm">
                    <div class="notebook-rings">
                        <div class="ring-simple"></div><div class="ring-simple"></div><div class="ring-simple"></div>
                    </div>
                    <div class="card-body-simple">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="badge-day">{{ $h->dia }}</span>
                            <small class="text-muted fw-bold"><i class="far fa-clock"></i> {{ substr($h->hora_inicio, 0, 5) }} - {{ substr($h->hora_fin, 0, 5) }}</small>
                        </div>
                        <h6 class="fw-bold mb-1 text-primary">{{ $h->asignatura->nombre ?? 'N/A' }}</h6>
                        <div class="small mb-3">
                            <div class="mb-1"><i class="fas fa-users me-2 text-secondary"></i><strong>Curso:</strong> {{ $h->curso->nombre_completo ?? 'N/A' }}</div>
                            <div class="mb-1"><i class="fas fa-user-tie me-2 text-secondary"></i><strong>Prof:</strong> {{ $h->profesor->nombre ?? 'N/A' }}</div>
                            <div><i class="fas fa-map-marker-alt me-2 text-secondary"></i><strong>Aula:</strong> {{ $h->ambiente->nombre ?? 'N/A' }}</div>
                        </div>
                        <div class="d-flex justify-content-end gap-1 border-top pt-2">
                            <a href="{{ route('horarios.edit', $h->id) }}" class="btn btn-light btn-circle text-success shadow-sm"><i class="fas fa-edit fa-xs"></i></a>
                            <form action="{{ route('horarios.destroy', $h->id) }}" method="POST" onsubmit="return confirm('¿Borrar esta clase?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-light btn-circle text-danger shadow-sm"><i class="fas fa-trash fa-xs"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-calendar-times fa-3x text-light mb-3"></i>
                <p class="text-muted">No hay clases programadas.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection