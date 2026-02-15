@extends('layouts.app')

@section('titulo_pagina', 'Centro de Notificaciones')

@section('content')

<div class="container">
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-secondary"><i class="fas fa-envelope-open-text me-2"></i> Panel de Envíos</h5>
            <small class="text-muted">Selecciona los destinatarios</small>
        </div>
        
        <div class="card-body">
            <form action="{{ route('notificaciones.enviar') }}" method="POST" id="formNotificaciones">
                @csrf

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;" class="text-center">
                                    <input type="checkbox" id="checkAll" class="form-check-input" style="cursor: pointer;">
                                </th>
                                <th>Docente</th>
                                <th>Correo Electrónico</th>
                                <th class="text-center">Rol Detectado</th>
                                <th class="text-center">Archivos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($profesores as $profe)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="profesores_ids[]" value="{{ $profe->id }}" class="form-check-input item-check">
                                    </td>
                                    
                                    <td class="fw-bold text-secondary">
                                        {{ $profe->apellido }}, {{ $profe->nombre }}
                                    </td>
                                    <td>
                                        @if($profe->email)
                                            <span class="text-dark">{{ $profe->email }}</span>
                                        @else
                                            <span class="badge bg-danger">Sin Correo</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($profe->cursos)
                                            <span class="badge bg-primary">Director {{ $profe->cursos->grado }}</span>
                                        @else
                                            <span class="badge bg-secondary">Docente</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($profe->cursos)
                                            <small class="text-success fw-bold">2 Adjuntos</small>
                                        @else
                                            <small class="text-muted">1 Adjunto</small>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <hr>

                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" name="accion" value="seleccionados" class="btn btn-primary px-4 shadow-sm" onclick="return confirm('¿Enviar correo solo a los docentes marcados?')">
                        <i class="fas fa-check-square me-2"></i> Enviar a Seleccionados
                    </button>

                    <button type="submit" name="accion" value="todos" class="btn btn-dark px-4 shadow-sm" onclick="return confirm('¡ATENCIÓN!\n\nVas a enviar correos a TODOS los profesores de la lista.\n¿Estás seguro?')">
                        <i class="fas fa-paper-plane me-2"></i> Enviar a TODOS
                    </button>
                </div>

            </form>
            </div>
    </div>
</div>

<script>
    document.getElementById('checkAll').addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('.item-check');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    });
</script>

@endsection