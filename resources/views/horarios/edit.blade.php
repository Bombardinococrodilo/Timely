@extends('layouts.app')

@section('titulo_pagina', 'Editar Clase')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                
                <div class="p-3 text-white d-flex align-items-center justify-content-center gap-3" style="background: linear-gradient(135deg, #1e8449, #166534);">
                    <i class="fas fa-edit fa-lg"></i>
                    <h5 class="fw-bold mb-0">Actualizar Programación</h5>
                </div>
                
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('horarios.update', $horario->id) }}">
                        @csrf 
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-bold text-muted">Día</label>
                                <select name="dia" class="form-select border-0 shadow-sm" required style="border-radius: 10px; background-color: #f8fdf9;">
                                    @foreach(['Lunes','Martes','Miércoles','Jueves','Viernes'] as $d)
                                        <option value="{{ $d }}" {{ $horario->dia == $d ? 'selected' : '' }}>{{ $d }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-bold text-muted">Hora Inicio</label>
                                <input type="time" name="hora_inicio" class="form-control border-0 shadow-sm" value="{{ substr($horario->hora_inicio, 0, 5) }}" required style="border-radius: 10px; background-color: #f8fdf9;">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-bold text-muted">Hora Fin</label>
                                <input type="time" name="hora_fin" class="form-control border-0 shadow-sm" value="{{ substr($horario->hora_fin, 0, 5) }}" required style="border-radius: 10px; background-color: #f8fdf9;">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Asignatura</label>
                                <select name="asignatura_id" class="form-select border-0 shadow-sm" required style="border-radius: 10px; background-color: #f8fdf9;">
                                    @foreach($asignaturas as $asignatura)
                                        <option value="{{ $asignatura->id }}" {{ $horario->asignatura_id == $asignatura->id ? 'selected' : '' }}>
                                            {{ $asignatura->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Curso</label>
                                <select name="curso_id" class="form-select border-0 shadow-sm" required style="border-radius: 10px; background-color: #f8fdf9;">
                                    @foreach($cursos as $curso)
                                        <option value="{{ $curso->id }}" {{ $horario->curso_id == $curso->id ? 'selected' : '' }}>
                                            {{ $curso->nombre_completo }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Profesor</label>
                                <select name="profesor_id" class="form-select border-0 shadow-sm" required style="border-radius: 10px; background-color: #f8fdf9;">
                                    @foreach($profesores as $profe)
                                        <option value="{{ $profe->id }}" {{ $horario->profesor_id == $profe->id ? 'selected' : '' }}>
                                            {{ $profe->nombre }} {{ $profe->apellido }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label small fw-bold text-muted">Ambiente (Salón)</label>
                                <select name="espacio_id" class="form-select border-0 shadow-sm" required style="border-radius: 10px; background-color: #f8fdf9;">
                                    @foreach($espacios as $espacio)
                                        <option value="{{ $espacio->id }}" {{ $horario->espacio_id == $espacio->id ? 'selected' : '' }}>
                                            {{ $espacio->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <a href="{{ route('horarios.index') }}" class="text-muted text-decoration-none fw-bold small">
                                <i class="fas fa-arrow-left me-1"></i> Volver
                            </a>
                            <button type="submit" class="btn px-4 text-white fw-bold shadow-sm" style="background-color: #1e8449; border-radius: 10px;">
                                Actualizar Clase
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection