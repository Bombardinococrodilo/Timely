<!DOCTYPE html>
<html>
<head>
    <title>Horario Profesor</title>
    <style>
        body { font-family: sans-serif; }
        h1 { text-align: center; color: #333; }
        .info-box { margin-bottom: 20px; padding: 10px; border: 1px solid #ccc; background: #f9f9f9; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; font-size: 12px; }
        th { background-color: #2c3e50; color: white; }
        
        .hora-col { background: #ecf0f1; font-weight: bold; width: 10%; }
        .clase-box { background: #e8f6f3; border-radius: 4px; padding: 2px; }
        .materia { font-weight: bold; display: block; }
        .salon { font-size: 10px; color: #555; }
    </style>
</head>
<body>

    <h1>Horario Académico - {{ date('Y') }}</h1>

    <div class="info-box">
        <strong>Docente:</strong> {{ $profesor->nombre }} {{ $profesor->apellido }}<br>
        <strong>Especialidad:</strong> {{ $profesor->especialidad }}<br>
        <strong>Director de Grupo:</strong> {{ $profesor->cursos->grado ?? 'No asignado' }}
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
                // Definimos las horas académicas (Ajusta esto a tu colegio)
                $bloques = [
                    '07:00 - 08:00', '08:00 - 09:00', '09:00 - 10:00', 
                    '10:30 - 11:30', '11:30 - 12:30' 
                ];
                $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
            @endphp

            @foreach($bloques as $bloque)
                <tr>
                    <td class="hora-col">{{ $bloque }}</td>
                    
                    @foreach($dias as $dia)
                        <td>
                            @php
                                // Filtramos si el profe tiene clase en este DÍA y HORA
                                // Ajusta 'dia' y 'hora_inicio' según los nombres reales en tu BD
                                $clase = $profesor->horarios->where('dia', $dia)
                                                            ->where('hora_inicio', substr($bloque, 0, 5)) // Truco para comparar '07:00'
                                                            ->first();
                            @endphp

                            @if($clase)
                                    <div class="clase-info">
                                    <span class="materia">{{ $clase->asignatura->nombre ?? 'Sin Asignatura' }}</span>
                                <br>
                                    Salón: {{ $clase->espacio->nombre ?? 'N/A' }}
                                <br>
                                  ({{ $clase->curso->nombre_completo ?? 'Grado' }})
                             </div>
                        @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <p style="font-size: 10px; text-align: center; margin-top: 30px;">
        Generado automáticamente por el sistema <strong>TIMELY</strong>
    </p>

</body>
</html>