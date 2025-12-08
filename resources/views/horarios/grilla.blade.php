@extends('layouts.app')

@section('titulo_pagina', 'Vista de Calendario Semanal')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title text-success"><i class="fas fa-calendar-alt"></i> Horario General</h5>
            <div>
                <a href="{{ route('horarios.pdf') }}" class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i> Descargar PDF</a>
                <a href="{{ route('horarios.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Programar</a>
                <a href="{{ route('horarios.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-list"></i> Ver Lista</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered text-center table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Hora / Día</th>
                        @foreach($dias as $dia)
                            <th>{{ $dia }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($horas as $hora)
                    <tr>
                        <td class="fw-bold bg-light">{{ $hora }}</td>
                        
                        @foreach($dias as $dia)
                            @php
                                // Buscamos si hay una clase en este Día y a esta Hora (aproximada)
                                $clase = $horarios->filter(function($h) use ($dia, $hora) {
                                    // Comparamos si la hora de la fila coincide con el inicio de la clase
                                    // substr corta "07:00:00" a "07:00"
                                    return $h->dia == $dia && substr($h->hora_inicio, 0, 5) == $hora;
                                })->first();
                            @endphp

                            <td style="height: 100px; vertical-align: middle;">
                                @if($clase)
                                    <div class="card border-primary mb-1 shadow-sm">
                                        <div class="card-body p-1">
                                            <strong class="d-block text-primary small">{{ $clase->asignatura->nombre }}</strong>
                                            <span class="badge bg-secondary">{{ $clase->curso->nombre_completo }}</span>
                                            <div class="small text-muted mt-1" style="font-size: 0.75rem;">
                                                <i class="fas fa-user"></i> {{ $clase->profesor->nombre }}<br>
                                                <i class="fas fa-map-marker-alt"></i> {{ $clase->espacio->nombre ?? $clase->ambiente->nombre }}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-muted small">- Libre -</span>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection