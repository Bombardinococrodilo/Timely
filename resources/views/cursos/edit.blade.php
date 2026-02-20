@extends('layouts.app')

@section('titulo_pagina', 'Editar Curso')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <div class="p-4 text-white text-center" style="background: linear-gradient(135deg, #1e8449, #166534);">
                    <i class="fas fa-edit fa-3x mb-3"></i>
                    <h3 class="fw-bold">Editar Curso</h3>
                    <p class="mb-0 opacity-75">Actualizando información de: {{ $curso->nombre_completo }}</p>
                </div>
                
                <div class="card-body p-4 p-lg-5">
                    <form method="POST" action="{{ route('cursos.update', $curso->id) }}">
                        @csrf @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-muted">Grado</label>
                                <select name="grado" class="form-select border-0 shadow-sm py-2" required style="background-color: #f8fdf9; border-radius: 12px;">
                                    @foreach(['Sexto','Séptimo','Octavo','Noveno','Décimo','Once'] as $g)
                                        <option value="{{ $g }}" {{ $curso->grado == $g ? 'selected' : '' }}>{{ $g }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-muted">Grupo</label>
                                <input type="text" name="grupo" class="form-control border-0 shadow-sm py-2" value="{{ $curso->grupo }}" required style="background-color: #f8fdf9; border-radius: 12px;">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-muted">Estudiantes</label>
                                <input type="number" name="cantidad_estudiantes" class="form-control border-0 shadow-sm py-2" value="{{ $curso->cantidad_estudiantes }}" required style="background-color: #f8fdf9; border-radius: 12px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-muted">Nivel</label>
                                <select name="nivel" class="form-select border-0 shadow-sm py-2" style="background-color: #f8fdf9; border-radius: 12px;">
                                    <option value="Bachillerato" {{ $curso->nivel == 'Bachillerato' ? 'selected' : '' }}>Bachillerato</option>
                                    <option value="Primaria" {{ $curso->nivel == 'Primaria' ? 'selected' : '' }}>Primaria</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <a href="{{ route('cursos.index') }}" class="text-muted text-decoration-none fw-bold">
                                <i class="fas fa-arrow-left me-1"></i> Volver
                            </a>
                            <button type="submit" class="btn px-5 text-white fw-bold shadow-sm" style="background-color: #1e8449; border-radius: 12px;">
                                Actualizar Curso
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection