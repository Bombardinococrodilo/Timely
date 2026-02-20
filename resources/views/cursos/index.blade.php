@extends('layouts.app')

@section('titulo_pagina', 'Gestión de Cursos')

@section('content')
<style>
    .card-notebook {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background: white;
        position: relative;
        margin-top: 15px;
        border-top: 4px solid var(--timely-accent); /* Color acento para diferenciar de profesores */
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
</style>

<div class="container pb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0" style="color: var(--timely-dark);">Cursos Activos</h3>
        <a href="{{ route('cursos.create') }}" class="btn text-white px-4 shadow-sm" style="background-color: var(--timely-medium); border-radius: 20px;">
            <i class="fas fa-plus small me-2"></i> Nuevo Curso
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 small py-2 mb-4" style="background-color: #f0fdf4; color: #166534;">
            <i class="fas fa-check me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @forelse($cursos as $curso)
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
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">{{ $curso->nombre_completo }}</h6>
                                <small class="text-muted">{{ $curso->nivel ?? 'No definido' }}</small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center border-top pt-2">
                            <small class="text-muted"><i class="fas fa-user-graduate me-1"></i> {{ $curso->cantidad_estudiantes }} Est.</small>
                            <div class="d-flex gap-1">
                                <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-light btn-circle text-success shadow-sm">
                                    <i class="fas fa-edit fa-xs"></i>
                                </a>
                                <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" onsubmit="return confirm('¿Eliminar curso?');">
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
                <p class="text-muted">No hay cursos registrados.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection