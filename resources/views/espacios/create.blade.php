@extends('layouts.app')

@section('titulo_pagina', 'Registrar Espacio')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                
                <div class="p-3 text-white d-flex align-items-center justify-content-center gap-3" style="background: linear-gradient(135deg, var(--timely-dark), var(--timely-medium));">
                    <i class="fas fa-door-open fa-lg"></i>
                    <h5 class="fw-bold mb-0">Registrar Nuevo Espacio</h5>
                </div>
                
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('espacios.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Nombre del Aula</label>
                                <input type="text" name="nombre" class="form-control bg-light border-0" placeholder="Ej: Aula 101" required style="border-radius: 10px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Ubicación</label>
                                <input type="text" name="ubicacion" class="form-control bg-light border-0" placeholder="Ej: Bloque A" required style="border-radius: 10px;">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Tipo de Espacio</label>
                                <input type="text" name="tipo" class="form-control bg-light border-0" placeholder="Ej: Laboratorio" required style="border-radius: 10px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Capacidad Max.</label>
                                <input type="number" name="capacidad" class="form-control bg-light border-0" placeholder="Ej: 30" required style="border-radius: 10px;">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Estado Inicial</label>
                            <select name="estado" class="form-select bg-light border-0" style="border-radius: 10px;">
                                <option value="disponible">Disponible</option>
                                <option value="ocupado">Ocupado</option>
                                <option value="mantenimiento">En mantenimiento</option>
                            </select>   
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-2">
                            <a href="{{ route('espacios.index') }}" class="btn btn-link text-muted text-decoration-none fw-bold small">Cancelar</a>
                            <button type="submit" class="btn px-4 text-white fw-bold shadow-sm" style="background-color: var(--timely-medium); border-radius: 10px;">
                                Guardar Espacio
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection