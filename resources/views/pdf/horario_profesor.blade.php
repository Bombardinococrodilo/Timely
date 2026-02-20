<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Horario del Docente - TIMELY</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; color: #333; margin: 0; padding: 0; }
        
        /* CABECERA ESTILO ESMERALDA */
        .header { 
            background-color: #27ae60; 
            color: white; 
            padding: 20px; 
            text-align: center; 
            border-bottom: 4px solid #229954; 
        }
        .header h1 { margin: 0; font-size: 20px; text-transform: uppercase; }
        
        /* CAJA DE INFO PERSONALIZADA */
        .info-box { 
            background: #ecfdf5; 
            padding: 15px; 
            border-left: 5px solid #27ae60; 
            margin: 20px;
            border-radius: 0 8px 8px 0;
        }
        .info-box strong { color: #166534; }
        
        /* TABLA DE HORARIO */
        table { width: 92%; margin: 0 auto; border-collapse: collapse; text-align: center; }
        th, td { border: 1px solid #bbf7d0; padding: 8px; height: 45px; }
        th { background-color: #27ae60; color: white; text-transform: uppercase; font-size: 10px; }
        
        .hora-col { background: #f8fdf9; font-weight: bold; width: 85px; color: #27ae60; border-left: 3px solid #27ae60; }
        
        .clase-info { background: #ffffff; border-radius: 4px; padding: 4px; }
        .materia { font-weight: bold; color: #166534; display: block; font-size: 10px; }
        .sub-text { font-size: 8.5px; color: #666; display: block; margin-top: 2px; }
        .curso-badge { color: #27ae60; font-weight: bold; font-size: 9px; }

        .footer { text-align: center; font-size: 9px; color: #999; margin-top: 30px; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Horario Académico - Docente</h1>
        <div style="font-size: 12px; margin-top: 5px; opacity: 0.9;">Año Lectivo {{ date('Y') }}</div>
    </div>

    <div class="info-box">
        <strong>Docente:</strong> {{ $profesor->nombre }} {{ $profesor->apellido }}<br>
        <strong>Especialidad:</strong> {{ $profesor->especialidad ?? 'General' }}<br>
        <strong>Director de Grupo:</strong> 
        {{-- Validación para el grado del que es director --}}
        {{ $profesor->cursos->grado ?? 'No asignado' }} {{ $profesor->cursos->grupo ?? '' }}
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
                // Bloques de tiempo estándar (Ajusta según tu necesidad)
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
                                // Filtramos la clase del profesor por día y hora
                                $clase = $profesor->horarios->where('dia', $dia)
                                    ->filter(function($h) use ($horaInicio) {
                                        return str_contains($h->hora_inicio, $horaInicio);
                                    })->first();
                            @endphp

                            @if($clase)
                                <div class="clase-info">
                                    <span class="materia">{{ $clase->asignatura->nombre ?? 'Sin Asignatura' }}</span>
                                    <span class="sub-text">
                                        Salón: {{ $clase->espacio->nombre ?? 'N/A' }}
                                    </span>
                                    <span class="curso-badge">
                                        ({{ $clase->curso->grado ?? '' }} {{ $clase->curso->grupo ?? '' }})
                                    </span>
                                </div>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Este documento es propiedad de la Institución Educativa. Generado por <strong>TIMELY</strong>.
    </div>

</body>
</html>