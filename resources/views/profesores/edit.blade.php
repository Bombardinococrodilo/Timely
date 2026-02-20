@extends('layouts.app')

@section('titulo_pagina', 'Editar Profesor')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                
                <div class="p-3 text-white d-flex align-items-center justify-content-center gap-3" style="background: linear-gradient(135deg, #1e8449, #166534);">
                    <i class="fas fa-user-edit fa-lg"></i>
                    <h5 class="fw-bold mb-0">Editar Datos del Profesor</h5>
                </div>
                
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('profesores.update', $profesor->id) }}">
                        @csrf 
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Nombre</label>
                                <input type="text" name="nombre" class="form-control border-0 shadow-sm" value="{{ $profesor->nombre }}" required style="background-color: #f8fdf9; border-radius: 10px; padding: 10px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Apellido</label>
                                <input type="text" name="apellido" class="form-control border-0 shadow-sm" value="{{ $profesor->apellido }}" required style="background-color: #f8fdf9; border-radius: 10px; padding: 10px;">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Email</label>
                            <input type="email" name="email" class="form-control border-0 shadow-sm" value="{{ $profesor->email }}" required style="background-color: #f8fdf9; border-radius: 10px; padding: 10px;">
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Especialidad</label>
                            <input type="text" name="especialidad" class="form-control border-0 shadow-sm" value="{{ $profesor->especialidad }}" style="background-color: #f8fdf9; border-radius: 10px; padding: 10px;">
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <a href="{{ route('profesores.index') }}" class="text-muted text-decoration-none fw-bold small">
                                <i class="fas fa-arrow-left me-1"></i> Volver
                            </a>
                            <button type="submit" class="btn px-4 text-white fw-bold shadow-sm" style="background-color: #1e8449; border-radius: 10px;">
                                Actualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection