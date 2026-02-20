@extends('layouts.app')

@section('titulo_pagina', 'Nueva Asignatura')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7"> <div class="card border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                
                <div class="p-3 text-white d-flex align-items-center justify-content-center gap-3" style="background: linear-gradient(135deg, var(--timely-dark), var(--timely-medium));">
                    <i class="fas fa-book-medical fa-lg"></i>
                    <h5 class="fw-bold mb-0">Registrar Asignatura</h5>
                </div>
                
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('asignaturas.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Nombre de la Materia</label>
                            <input type="text" name="nombre" class="form-control bg-light border-0" placeholder="Ej: Álgebra Lineal" required style="border-radius: 10px; padding: 10px;">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Descripción</label>
                            <input type="text" name="descripcion" class="form-control bg-light border-0" placeholder="Objetivo de la clase" required style="border-radius: 10px; padding: 10px;">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Profesor</label>
                                <input type="text" name="profesor_asignado" class="form-control bg-light border-0" placeholder="Nombre" required style="border-radius: 10px; padding: 10px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Horas/Semana</label>
                                <input type="number" name="horas_semanales" class="form-control bg-light border-0" placeholder="0" required style="border-radius: 10px; padding: 10px;">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Tipo</label>
                            <select name="tipo_materia" class="form-select bg-light border-0" style="border-radius: 10px; padding: 10px;">
                                <option value="curricular">Curricular</option>
                                <option value="técnica">Técnica</option>
                            </select>   
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-2">
                            <a href="{{ route('asignaturas.index') }}" class="btn btn-link text-muted text-decoration-none fw-bold small">Cancelar</a>
                            <button type="submit" class="btn px-4 text-white fw-bold shadow-sm" style="background-color: var(--timely-medium); border-radius: 10px;">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection