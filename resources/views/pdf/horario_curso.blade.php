<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Horario de Curso - TIMELY</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; color: #333; margin: 0; padding: 0; }
        
        .header { 
            background-color: #27ae60; 
            color: white; 
            padding: 20px; 
            text-align: center; 
            border-bottom: 4px solid #229954; 
        }
        .header h1 { margin: 0; font-size: 20px; text-transform: uppercase; }
        
        .info-box { 
            background: #ecfdf5; 
            padding: 15px; 
            border-left: 5px solid #27ae60; 
            margin: 20px;
            border-radius: 0 8px 8px 0;
        }
        .info-box strong { color: #166534; }
        
        table { width: 92%; margin: 0 auto; border-collapse: collapse; text-align: center; }
        th, td { border: 1px solid #bbf7d0; padding: 8px; height: 45px; }
        th { background-color: #27ae60; color: white; text-transform: uppercase; font-size: 10px; }
        
        .hora-col { background: #f8fdf9; font-weight: bold; width: 80px; color: #27ae60; border-left: 3px solid #27ae60; }
        
        .materia { font-weight: bold; color: #166534; display: block; font-size: 10px; }
        .profe { color: #666; font-style: italic; font-size: 8.5px; margin-top: 2px; display: block; }
        
        .footer { text-align: center; font-size: 9px; color: #999; margin-top: 30px; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Horario de Clases - Curso {{ $curso->grado }} {{ $curso->grupo }}</h1>
        <div style="font-size: 12px; margin-top: 5px; opacity: 0.9;">Institución Educativa - Año Lectivo {{ date('Y') }}</div>
    </div>

    <div class="info-box">
        {{-- CORRECCIÓN DEL ERROR: Usamos el operador ?? para evitar que falle si es null --}}
        <strong>Director de Grupo:</strong> 
        {{ $curso->director ? ($curso->director->nombre . ' ' . $curso->director->apellido) : 'No asignado' }}<br>
        
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
            
                $bloques = [
                    '07:00' => '07:00 - 08:00',
                    '08:00' => '08:00 - 09:00',
                    '09:00' => '09:00 - 10:00',
                    '10:30' => '10:30 - 11:30', 
                    '11:30' => '11:30 - 12:30'
                ];
                $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
            @endphp

            @foreach($bloques as $horaInicio => $etiqueta)
                <tr>
                    <td class="hora-col">{{ $etiqueta }}</td>
                    
                    @foreach($dias as $dia)
                        <td>
                            @php
                                $clase = $curso->horarios->first(function($h) use ($dia, $horaInicio) {
                                    return $h->dia === $dia && str_contains($h->hora_inicio, $horaInicio);
                                });
                            @endphp

                            @if($clase)
                                <span class="materia">{{ $clase->asignatura->nombre ?? 'Sin Asignatura' }}</span>
                                <span class="profe">Prof. {{ $clase->profesor->apellido ?? 'Asignado' }}</span>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Documento generado digitalmente por el sistema <strong>TIMELY</strong>.
    </div>

</body>
</html>