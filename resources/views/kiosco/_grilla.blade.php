<div class="table-responsive bg-white p-3 rounded-4 shadow-sm">
    <table class="table table-bordered table-kiosco w-100">
        <thead>
            <tr>
                <th><i class="fas fa-clock"></i> Hora</th>
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
                            $clase = $curso->horarios->first(function($h) use ($dia, $hora) {
                                return $h->dia == $dia && substr($h->hora_inicio, 0, 5) == $hora;
                            });
                        @endphp

                        <td>
                            @if($clase)
                                <div class="clase-card">
                                    <span class="materia-text">{{ $clase->asignatura->nombre ?? 'Asignatura' }}</span>
                                    <span class="salon-text">
                                        <i class="fas fa-map-marker-alt text-danger"></i> {{ $clase->espacio->nombre ?? 'Aula' }}<br>
                                        <i class="fas fa-user text-primary mt-1"></i> Prof. {{ $clase->profesor->apellido ?? 'Asignado' }}
                                    </span>
                                </div>
                            @else
                                <span class="text-muted opacity-50">-</span>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>