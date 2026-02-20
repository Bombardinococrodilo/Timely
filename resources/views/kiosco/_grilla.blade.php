<table class="table table-kiosco w-100 m-0 border-0">
    <thead>
        <tr>
            <th>HORA</th>
            @foreach($dias as $dia)
                <th>{{ $dia }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($horas as $hora)
            <tr>
                <td class="hora-col">{{ substr($hora, 0, 5) }}</td>
                @foreach($dias as $dia)
                    @php
                        $clase = $curso->horarios->first(function($h) use ($dia, $hora) {
                            return $h->dia == $dia && substr($h->hora_inicio, 0, 5) == substr($hora, 0, 5);
                        });
                    @endphp
                    <td>
                        @if($clase)
                            <div class="clase-card">
                                <span class="materia-name">{{ $clase->asignatura->nombre ?? 'Materia' }}</span>
                                <div class="materia-sub text-muted">
                                    <i class="fas fa-map-marker-alt"></i> {{ $clase->espacio->nombre ?? '---' }}<br>
                                    <i class="fas fa-user-tie"></i> {{ $clase->profesor->apellido ?? '---' }}
                                </div>
                            </div>
                        @else
                            <div class="text-muted opacity-25">---</div>
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>