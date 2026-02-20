@extends('layouts.app')

@section('titulo_pagina', 'Centro de Notificaciones - TIMELY')

@section('content')
<style>
    /* Estilos personalizados para mantener la identidad Esmeralda */
    .card-timely { border-radius: 15px; border: none; box-shadow: 0 8px 24px rgba(39, 174, 96, 0.08); overflow: hidden; }
    .header-timely { background-color: #27ae60; color: white; padding: 20px; }
    .table-timely thead { background-color: #f8fdf9; }
    .table-timely th { color: #27ae60; border-bottom: 2px solid #d1fae5; text-transform: uppercase; font-size: 0.85rem; }
    .badge-director { background-color: #27ae60; color: white; border-radius: 20px; padding: 5px 12px; }
    .badge-docente { background-color: #95a5a6; color: white; border-radius: 20px; padding: 5px 12px; }
    .btn-timely-primary { background-color: #27ae60; color: white; border-radius: 30px; border: none; font-weight: bold; transition: 0.3s; }
    .btn-timely-primary:hover { background-color: #219150; transform: translateY(-2px); color: white; }
    .btn-timely-dark { background-color: #2c3e50; color: white; border-radius: 30px; border: none; font-weight: bold; transition: 0.3s; }
    .btn-timely-dark:hover { background-color: #1a252f; transform: translateY(-2px); color: white; }
    .form-check-input:checked { background-color: #27ae60; border-color: #27ae60; }
</style>

<div class="container py-4">
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert" style="border-left: 5px solid #2ecc71 !important; background: white;">
            <i class="fas fa-check-circle me-2 text-success"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert" style="border-left: 5px solid #e74c3c !important; background: white;">
            <i class="fas fa-exclamation-triangle me-2 text-danger"></i> {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card card-timely">
        <div class="header-timely d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-paper-plane me-2"></i> Panel de Notificaciones</h4>
            <span class="badge bg-white text-success fw-bold">{{ count($profesores) }} Docentes</span>
        </div>
        
        <div class="card-body p-0">
            <form action="{{ route('notificaciones.enviar') }}" method="POST" id="formNotificaciones">
                @csrf

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 table-timely">
                        <thead>
                            <tr>
                                <th style="width: 60px;" class="text-center">
                                    <input type="checkbox" id="checkAll" class="form-check-input" style="cursor: pointer;">
                                </th>
                                <th>Nombre del Docente</th>
                                <th>Correo Electrónico</th>
                                <th class="text-center">Rol</th>
                                <th class="text-center">Adjuntos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($profesores as $profe)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="profesores_ids[]" value="{{ $profe->id }}" class="form-check-input item-check">
                                    </td>
                                    
                                    <td class="fw-bold text-dark">
                                        {{ $profe->apellido }}, {{ $profe->nombre }}
                                    </td>
                                    <td>
                                        @if($profe->email)
                                            <span class="text-muted"><i class="far fa-envelope me-1"></i> {{ $profe->email }}</span>
                                        @else
                                            <span class="text-danger small fw-bold"><i class="fas fa-times-circle me-1"></i> Sin Correo</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($profe->cursos)
                                            <span class="badge badge-director shadow-sm"><i class="fas fa-star me-1"></i> Director {{ $profe->cursos->grado }} - {{ $profe->cursos->grupo }}</span>
                                        @else
                                            <span class="badge-docente">Docente</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($profe->cursos)
                                            <span class="text-success small fw-bold"><i class="fas fa-file-pdf me-1"></i> 2 Archivos</span>
                                        @else
                                            <span class="text-muted small"><i class="fas fa-file-pdf me-1"></i> 1 Archivo</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="bg-light p-4 d-flex justify-content-end gap-3">
                    <button type="submit" name="accion" value="seleccionados" class="btn btn-timely-primary px-4 py-2 shadow-sm" onclick="return confirm('¿Enviar correo solo a los docentes marcados?')">
                        <i class="fas fa-check-square me-2"></i> Enviar Seleccionados
                    </button>

                    <button type="submit" name="accion" value="todos" class="btn btn-timely-dark px-4 py-2 shadow-sm" onclick="return confirm('¡ATENCIÓN!\n\nVas a enviar correos a TODOS los profesores de la lista.\n¿Estás seguro?')">
                        <i class="fas fa-paper-plane me-2"></i> Enviar a Todos
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