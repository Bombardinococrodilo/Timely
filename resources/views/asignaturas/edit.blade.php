@extends('layouts.app')

@section('titulo_pagina', 'Editar Asignatura')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                
                <div class="p-3 text-white d-flex align-items-center justify-content-center gap-3" style="background: linear-gradient(135deg, #1e8449, #166534);">
                    <i class="fas fa-edit fa-lg"></i>
                    <h5 class="fw-bold mb-0">Editar Asignatura</h5>
                </div>
                
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('asignaturas.update', $asignatura->id) }}">
                        @csrf 
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Nombre de la Materia</label>
                            <input type="text" name="nombre" class="form-control border-0 shadow-sm" value="{{ $asignatura->nombre }}" required style="background-color: #f8fdf9; border-radius: 10px; padding: 10px;">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Descripción</label>
                            <input type="text" name="descripcion" class="form-control border-0 shadow-sm" value="{{ $asignatura->descripcion }}" required style="background-color: #f8fdf9; border-radius: 10px; padding: 10px;">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Docente a cargo</label>
                                <input type="text" name="profesor_asignado" class="form-control border-0 shadow-sm" value="{{ $asignatura->profesor_asignado }}" required style="background-color: #f8fdf9; border-radius: 10px; padding: 10px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Horas Semanales</label>
                                <input type="number" name="horas_semanales" class="form-control border-0 shadow-sm" value="{{ $asignatura->horas_semanales }}" required style="background-color: #f8fdf9; border-radius: 10px; padding: 10px;">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Tipo de Materia</label>
                            <select name="tipo_materia" class="form-select border-0 shadow-sm" style="background-color: #f8fdf9; border-radius: 10px; padding: 10px;">
                                <option value="curricular" {{ $asignatura->tipo_materia == 'curricular' ? 'selected' : '' }}>Curricular</option>
                                <option value="técnica" {{ $asignatura->tipo_materia == 'técnica' ? 'selected' : '' }}>Técnica</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <a href="{{ route('asignaturas.index') }}" class="text-muted text-decoration-none fw-bold small">
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