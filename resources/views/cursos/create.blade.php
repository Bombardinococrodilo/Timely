@extends('layouts.app')

@section('titulo_pagina', 'Registrar Curso')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <div class="p-4 text-white text-center" style="background: linear-gradient(135deg, var(--timely-dark), var(--timely-medium));">
                    <i class="fas fa-folder-plus fa-3x mb-3"></i>
                    <h3 class="fw-bold">Nuevo Curso</h3>
                    <p class="mb-0 opacity-75">Configura un nuevo grado y grupo en el sistema.</p>
                </div>
                
                <div class="card-body p-4 p-lg-5">
                    <form method="POST" action="{{ route('cursos.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Grado</label>
                                <select name="grado" class="form-select bg-light border-0 py-2" required style="border-radius: 12px;">
                                    <option value="Sexto">Sexto</option>
                                    <option value="Séptimo">Séptimo</option>
                                    <option value="Octavo">Octavo</option>
                                    <option value="Noveno">Noveno</option>
                                    <option value="Décimo">Décimo</option>
                                    <option value="Once">Once</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Grupo / ID</label>
                                <input type="text" name="grupo" class="form-control bg-light border-0 py-2" placeholder="Ej: A o 101" required style="border-radius: 12px;">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Cant. Estudiantes</label>
                                <input type="number" name="cantidad_estudiantes" class="form-control bg-light border-0 py-2" min="1" required style="border-radius: 12px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nivel</label>
                                <select name="nivel" class="form-select bg-light border-0 py-2" style="border-radius: 12px;">
                                    <option value="Bachillerato">Bachillerato</option>
                                    <option value="Primaria">Primaria</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('cursos.index') }}" class="btn btn-light px-4 fw-bold text-muted" style="border-radius: 12px;">Cancelar</a>
                            <button type="submit" class="btn px-5 text-white fw-bold shadow-sm" style="background-color: var(--timely-medium); border-radius: 12px;">
                                Guardar Curso
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection