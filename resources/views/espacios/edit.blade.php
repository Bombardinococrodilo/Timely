@extends('layouts.app')

@section('titulo_pagina', 'Editar Espacio')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                
                <div class="p-3 text-white d-flex align-items-center justify-content-center gap-3" style="background: linear-gradient(135deg, #1e8449, #166534);">
                    <i class="fas fa-edit fa-lg"></i>
                    <h5 class="fw-bold mb-0">Editar Espacio</h5>
                </div>
                
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('espacios.update', $espacio->id) }}">
                        @csrf @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Nombre</label>
                                <input type="text" name="nombre" class="form-control border-0 shadow-sm" value="{{ $espacio->nombre }}" required style="background-color: #f8fdf9; border-radius: 10px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Ubicación</label>
                                <input type="text" name="ubicacion" class="form-control border-0 shadow-sm" value="{{ $espacio->ubicacion }}" required style="background-color: #f8fdf9; border-radius: 10px;">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Tipo</label>
                                <input type="text" name="tipo" class="form-control border-0 shadow-sm" value="{{ $espacio->tipo }}" required style="background-color: #f8fdf9; border-radius: 10px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Capacidad</label>
                                <input type="number" name="capacidad" class="form-control border-0 shadow-sm" value="{{ $espacio->capacidad }}" required style="background-color: #f8fdf9; border-radius: 10px;">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Estado Actual</label>
                            <select name="estado" class="form-select border-0 shadow-sm" style="background-color: #f8fdf9; border-radius: 10px;">
                                <option value="disponible" {{ $espacio->estado == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="ocupado" {{ $espacio->estado == 'ocupado' ? 'selected' : '' }}>Ocupado</option>
                                <option value="mantenimiento" {{ $espacio->estado == 'mantenimiento' ? 'selected' : '' }}>En mantenimiento</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <a href="{{ route('espacios.index') }}" class="text-muted text-decoration-none fw-bold small">
                                <i class="fas fa-arrow-left me-1"></i> Volver
                            </a>
                            <button type="submit" class="btn px-4 text-white fw-bold shadow-sm" style="background-color: #1e8449; border-radius: 10px;">
                                Actualizar Datos
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection