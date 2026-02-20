@extends('layouts.app')

@section('titulo_pagina', 'Programar Clase')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                
                <div class="p-3 text-white d-flex align-items-center justify-content-center gap-3" style="background: linear-gradient(135deg, var(--timely-dark), var(--timely-medium));">
                    <i class="fas fa-calendar-plus fa-lg"></i>
                    <h5 class="fw-bold mb-0">Programar Nueva Clase</h5>
                </div>
                
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('horarios.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-bold text-muted">Día</label>
                                <select name="dia" class="form-select bg-light border-0" required style="border-radius: 10px;">
                                    <option value="Lunes">Lunes</option>
                                    <option value="Martes">Martes</option>
                                    <option value="Miércoles">Miércoles</option>
                                    <option value="Jueves">Jueves</option>
                                    <option value="Viernes">Viernes</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-bold text-muted">Hora Inicio</label>
                                <input type="time" name="hora_inicio" class="form-control bg-light border-0" required style="border-radius: 10px;">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-bold text-muted">Hora Fin</label>
                                <input type="time" name="hora_fin" class="form-control bg-light border-0" required style="border-radius: 10px;">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Asignatura</label>
                                <select name="asignatura_id" class="form-select bg-light border-0" required style="border-radius: 10px;">
                                    <option value="">Seleccione...</option>
                                    @foreach($asignaturas as $asignatura)
                                        <option value="{{ $asignatura->id }}">{{ $asignatura->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Curso</label>
                                <select name="curso_id" class="form-select bg-light border-0" required style="border-radius: 10px;">
                                    <option value="">Seleccione...</option>
                                    @foreach($cursos as $curso)
                                        <option value="{{ $curso->id }}">{{ $curso->nombre_completo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Profesor</label>
                                <select name="profesor_id" class="form-select bg-light border-0" required style="border-radius: 10px;">
                                    <option value="">Seleccione...</option>
                                    @foreach($profesores as $profe)
                                        <option value="{{ $profe->id }}">{{ $profe->nombre }} {{ $profe->apellido }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label small fw-bold text-muted">Ambiente (Salón)</label>
                                <select name="espacio_id" class="form-select bg-light border-0" required style="border-radius: 10px;">
                                    <option value="">Seleccione...</option>
                                    @foreach($espacios as $espacio)
                                        <option value="{{ $espacio->id }}">{{ $espacio->nombre }} ({{ $espacio->tipo }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-2">
                            <a href="{{ route('horarios.index') }}" class="btn btn-link text-muted text-decoration-none fw-bold small">Cancelar</a>
                            <button type="submit" class="btn px-4 text-white fw-bold shadow-sm" style="background-color: var(--timely-medium); border-radius: 10px;">
                                Guardar Horario
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection