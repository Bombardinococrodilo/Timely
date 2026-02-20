@extends('layouts.app')

@section('titulo_pagina', 'Nuevo Profesor')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                
                <div class="p-3 text-white d-flex align-items-center justify-content-center gap-3" style="background: linear-gradient(135deg, var(--timely-dark), var(--timely-medium));">
                    <i class="fas fa-user-plus fa-lg"></i>
                    <h5 class="fw-bold mb-0">Registrar Nuevo Profesor</h5>
                </div>
                
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('profesores.store') }}">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Nombre</label>
                                <input type="text" name="nombre" class="form-control bg-light border-0" placeholder="Ej: Juan" required style="border-radius: 10px; padding: 10px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Apellido</label>
                                <input type="text" name="apellido" class="form-control bg-light border-0" placeholder="Ej: Pérez" required style="border-radius: 10px; padding: 10px;">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control bg-light border-0" placeholder="juan.perez@colegio.com" required style="border-radius: 10px; padding: 10px;">
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Especialidad</label>
                            <input type="text" name="especialidad" class="form-control bg-light border-0" placeholder="Ej: Matemáticas, Ciencias, etc." style="border-radius: 10px; padding: 10px;">
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-2">
                            <a href="{{ route('profesores.index') }}" class="btn btn-link text-muted text-decoration-none fw-bold small">Cancelar</a>
                            <button type="submit" class="btn px-4 text-white fw-bold shadow-sm" style="background-color: var(--timely-medium); border-radius: 10px;">
                                Guardar Profesor
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection