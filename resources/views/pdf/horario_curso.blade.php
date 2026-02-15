<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Horario de Curso</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #0056b3; padding-bottom: 10px; }
        .info-box { background: #e3f2fd; padding: 10px; border: 1px solid #90caf9; margin-bottom: 15px; }
        
        table { width: 100%; border-collapse: collapse; text-align: center; }
        th, td { border: 1px solid #333; padding: 4px; height: 50px; }
        th { background-color: #0056b3; color: white; }
        .hora-col { background: #eee; font-weight: bold; width: 60px; }
        
        .materia { font-weight: bold; color: #000; display: block; }
        .profe { color: #555; font-style: italic; font-size: 9px; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Horario de Clases - Curso {{ $curso->grado }} {{ $curso->grupo }}</h1>
    </div>

    <div class="info-box">
        <strong>Director de Grupo:</strong> {{ $curso->director->nombre }} {{ $curso->director->apellido }}<br>
        <strong>Nivel:</strong> {{ $curso->nivel ?? 'Bachillerato' }}<br>
        <strong>Estudiantes:</strong> {{ $curso->cantidad_estudiantes }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Hora</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miércoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
            </tr>
        </thead>
        <tbody>
            @php
                // Usa las mismas horas que en tu BD
                $bloques = [
                    '07:00' => '07:00 - 08:00',
                    '08:00' => '08:00 - 09:00',
                    '09:00' => '09:00 - 10:00',
                    '10:30' => '10:30 - 11:30', 
                    '11:30' => '11:30 - 12:30'
                ];
                $dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];
            @endphp

            @foreach($bloques as $horaInicio => $etiqueta)
                <tr>
                    <td class="hora-col">{{ $etiqueta }}</td>
                    
                    @foreach($dias as $dia)
                        <td>
                            @php
                                // Buscamos la clase para este curso, día y hora
                                $clase = $curso->horarios->first(function($h) use ($dia, $horaInicio) {
                                    return $h->dia === $dia && str_contains($h->hora_inicio, $horaInicio);
                                });
                            @endphp

                            @if($clase)
                                <div>
                                    <span class="materia">{{ $clase->asignatura->nombre ?? 'Sin Asignatura' }}</span><br>
                                    <span class="profe">Prof. {{ $clase->profesor->apellido ?? 'Asignado' }}</span>
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