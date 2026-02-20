@extends('layouts.app')

@section('titulo_pagina', 'Gestión de Espacios')

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
        position: absolute; top: -10px; left: 20px; display: flex; gap: 15px;
    }

    .ring-simple { width: 8px; height: 18px; background: #d1d5db; border-radius: 4px; }

    .card-body-simple { padding: 25px 15px 15px 15px; }

    .btn-circle {
        width: 32px; height: 32px; border-radius: 50%;
        display: inline-flex; align-items: center; justify-content: center;
    }
    
    .status-badge { font-size: 0.7rem; padding: 3px 8px; border-radius: 10px; text-transform: uppercase; font-weight: bold; }
    .status-disponible { background-color: #dcfce7; color: #166534; }
    .status-ocupado { background-color: #fee2e2; color: #991b1b; }
    .status-mantenimiento { background-color: #fef3c7; color: #92400e; }
</style>

<div class="container pb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0" style="color: var(--timely-dark);">Espacios y Aulas</h3>
        <a href="{{ route('espacios.create') }}" class="btn text-white px-4 shadow-sm" style="background-color: var(--timely-medium); border-radius: 20px;">
            <i class="fas fa-plus small me-2"></i> Nuevo Espacio
        </a>
    </div>

    <div class="row">
        @forelse($espacios as $espacio)
            <div class="col-md-4 mb-4">
                <div class="card-notebook">
                    <div class="notebook-rings">
                        <div class="ring-simple"></div>
                        <div class="ring-simple"></div>
                        <div class="ring-simple"></div>
                    </div>

                    <div class="card-body-simple">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="fw-bold mb-0">{{ $espacio->nombre }}</h6>
                            <span class="status-badge status-{{ strtolower($espacio->status ?? $espacio->estado) }}">
                                {{ $espacio->status ?? $espacio->estado }}
                            </span>
                        </div>
                        
                        <p class="text-muted small mb-3">
                            <i class="fas fa-map-marker-alt me-1"></i> {{ $espacio->ubicacion }}<br>
                            <i class="fas fa-tag me-1"></i> {{ $espacio->tipo }}<br>
                            <i class="fas fa-users me-1"></i> Capacidad: {{ $espacio->capacidad }}
                        </p>

                        <div class="d-flex justify-content-end gap-1 border-top pt-2">
                            <a href="{{ route('espacios.edit', $espacio->id) }}" class="btn btn-light btn-circle text-success shadow-sm">
                                <i class="fas fa-edit fa-xs"></i>
                            </a>
                            <form action="{{ route('espacios.destroy', $espacio->id) }}" method="POST" onsubmit="return confirm('¿Eliminar espacio?');">
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
                <p class="text-muted">No hay espacios registrados.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection