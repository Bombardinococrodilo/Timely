<!DOCTYPE html>
<html>
<head>
    <title>Horario General - Timely</title>
    <style>
        body { font-family: sans-serif; }
        h1 { text-align: center; color: #2c3e50; }
        .header-info { text-align: center; margin-bottom: 20px; font-size: 0.9rem; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: center; font-size: 0.8rem; }
        th { background-color: #27ae60; color: white; }
        .bloque-clase { background-color: #e8f5e9; padding: 5px; border-radius: 4px; }
        .materia { font-weight: bold; color: #1e8449; display: block; }
        .detalles { font-size: 0.7rem; color: #555; margin-top: 2px; }
    </style>
</head>
<body>
    <h1>Cronograma Académico General</h1>
    <div class="header-info">
        <p>Generado por Sistema Timely | Fecha: {{ date('d/m/Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 10%;">Hora</th>
                @foreach($dias as $dia)
                    <th style="width: 18%;">{{ $dia }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($horas as $hora)
            <tr>
                <td style="background-color: #f2f2f2; font-weight: bold;">{{ $hora }}</td>
                
                @foreach($dias as $dia)
                    @php
                        $clase = $horarios->filter(function($h) use ($dia, $hora) {
                            return $h->dia == $dia && substr($h->hora_inicio, 0, 5) == $hora;
                        })->first();
                    @endphp

                    <td>
                        @if($clase)
                            <div class="bloque-clase">
                                <span class="materia">{{ $clase->asignatura->nombre }}</span>
                                <div class="detalles">
                                    {{ $clase->curso->nombre_completo }}<br>
                                    Prof. {{ $clase->profesor->nombre }}<br>
                                    ({{ $clase->espacio->nombre ?? 'Aula' }})
                                </div>
                            </div>
                        @endif
                    </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
