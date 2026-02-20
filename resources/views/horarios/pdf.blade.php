<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Horario General - TIMELY</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 10px; color: #333; margin: 0; padding: 0; }
        
        /* CABECERA ESTILO ESMERALDA */
        .header { 
            background-color: #27ae60; 
            color: white; 
            padding: 15px; 
            text-align: center; 
            border-bottom: 4px solid #229954; 
        }
        .header h1 { margin: 0; font-size: 18px; text-transform: uppercase; }
        
        .header-info { 
            text-align: center; 
            margin: 10px 0; 
            font-size: 9px; 
            color: #666; 
        }

        /* TABLA DE HORARIO GENERAL */
        table { width: 95%; margin: 0 auto; border-collapse: collapse; text-align: center; table-layout: fixed; }
        th, td { border: 1px solid #bbf7d0; padding: 5px; height: 40px; overflow: hidden; }
        th { background-color: #27ae60; color: white; text-transform: uppercase; font-size: 9px; }
        
        .hora-col { background: #f8fdf9; font-weight: bold; width: 50px; color: #27ae60; border-left: 3px solid #27ae60; }
        
        /* BLOQUE DE CLASE INTERNO */
        .bloque-clase { 
            background-color: #ecfdf5; 
            border-radius: 3px; 
            padding: 3px; 
            border: 1px solid #d1fae5;
        }
        .materia { font-weight: bold; color: #166534; display: block; font-size: 8.5px; line-height: 1; }
        .detalles { font-size: 7.5px; color: #555; margin-top: 2px; line-height: 1.1; }
        .salon { color: #27ae60; font-weight: bold; }

        .footer { position: fixed; bottom: 15px; width: 100%; text-align: center; font-size: 8px; color: #999; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Cronograma Académico General</h1>
    </div>

    <div class="header-info">
        Generado por Sistema <strong>TIMELY</strong> | Fecha de emisión: {{ date('d/m/Y') }}
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 50px;">Hora</th>
                @foreach($dias as $dia)
                    <th>{{ $dia }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($horas as $hora)
            <tr>
                <td class="hora-col">{{ $hora }}</td>
                
                @foreach($dias as $dia)
                    @php
                        // Mantenemos tu lógica original de filtrado
                        $clase = $horarios->filter(function($h) use ($dia, $hora) {
                            return $h->dia == $dia && substr($h->hora_inicio, 0, 5) == $hora;
                        })->first();
                    @endphp

                    <td>
                        @if($clase)
                            <div class="bloque-clase">
                                <span class="materia">{{ $clase->asignatura->nombre }}</span>
                                <div class="detalles">
                                    <strong>{{ $clase->curso->nombre_completo }}</strong><br>
                                    {{ $clase->profesor->nombre }}<br>
                                    <span class="salon">({{ $clase->espacio->nombre ?? 'Aula' }})</span>
                                </div>
                            </div>
                        @endif
                    </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        © {{ date('Y') }} Timely - Gestión Escolar Inteligente. Todos los derechos reservados.
    </div>

</body>
</html>