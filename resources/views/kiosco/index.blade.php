<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartelera de Horarios - TIMELY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --timely-green: #27ae60;
            --timely-green-light: #e8f8f5;
            --timely-white: #ffffff;
            --timely-neon: #39ff14;
        }

        body { background-color: #f4f7f6; font-family: 'Segoe UI', sans-serif; overflow-x: hidden; }
        
        /* HEADER ULTRA COMPACTO */
        .kiosco-header { 
            background-color: var(--timely-green);
            color: var(--timely-white); 
            padding: 8px 30px; 
            border-bottom: 3px solid #1e8449;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .header-content { display: flex; align-items: center; justify-content: center; gap: 15px; }
        .logo-timely { width: 45px; height: 55px; display: block; }
        .logo-path { stroke: var(--timely-white); stroke-width: 4; fill: none; }
        .logo-ring { fill: var(--timely-white); }

        /* ANIMACIÓN DE PASO DE HOJA (4 SEGUNDOS) */
        .carousel-inner { perspective: 2000px; overflow: visible; } 
        .carousel-item {
            backface-visibility: hidden;
            transform-origin: top center; 
            transition: transform 4s cubic-bezier(0.45, 0.05, 0.55, 0.95), opacity 4s;
        }
        .carousel-item-start.active, .active.carousel-item-end {
            opacity: 0; transform: rotateX(-110deg) translateY(-50px);
        }
        .carousel-item-next, .carousel-item-prev { opacity: 0; transform: rotateX(110deg); }
        .active { opacity: 1; transform: rotateX(0deg); }

        /* FORMATO CUADERNO */
        .notebook-frame {
            background: var(--timely-white); border-radius: 15px; 
            padding: 35px 15px 10px; position: relative; 
            box-shadow: 0 8px 25px rgba(0,0,0,0.05);
            border: 1px solid var(--timely-green-light);
        }
        .notebook-frame::before {
            content: ""; position: absolute; top: -12px; left: 10%; right: 10%; height: 25px;
            background-image: radial-gradient(circle, var(--timely-green) 5px, transparent 6px);
            background-size: 35px 100%; z-index: 10;
        }

        /* TABLA */
        .table-kiosco th { background-color: var(--timely-green); color: var(--timely-white); padding: 8px; font-size: 0.85rem; border: none; }
        .table-kiosco td { height: 100px; vertical-align: middle; border: 1px solid var(--timely-green-light); }
        .hora-col { background-color: var(--timely-green-light); font-weight: 800; color: var(--timely-green); width: 80px; font-size: 1rem; }
        
        .clase-card { 
            background: var(--timely-white); border-left: 4px solid var(--timely-green);
            padding: 6px 8px; height: 90%; border-radius: 4px; text-align: left;
        }
        .materia-name { font-size: 0.85rem; font-weight: 800; color: var(--timely-green); text-transform: uppercase; display: block; line-height: 1; }
        .materia-sub { font-size: 0.7rem; color: #666; margin-top: 3px; font-weight: 600; line-height: 1.1; }

        /* BOTÓN FLOTANTE */
        .btn-timely { 
            position: fixed; bottom: 30px; right: 30px; width: 65px; height: 65px; 
            border-radius: 50%; background: var(--timely-green); color: white;
            display: flex; align-items: center; justify-content: center; font-size: 24px;
            box-shadow: 0 8px 20px rgba(39, 174, 96, 0.4); z-index: 1000; border: none;
            transition: all 0.3s ease;
        }
        .btn-timely:hover { transform: scale(1.1); background-color: #1e8449; color: white; }
    </style>
</head>
<body>

    <div class="kiosco-header">
        <div class="header-content">
            <svg class="logo-timely" viewBox="0 0 100 120">
                <rect class="logo-ring" x="32" y="4" width="6" height="14" rx="3" />
                <rect class="logo-ring" x="47" y="4" width="6" height="14" rx="3" />
                <rect class="logo-ring" x="62" y="4" width="6" height="14" rx="3" />
                <path class="logo-path" d="M25 14 H75 V52 L50 68 L25 52 Z" />
                <path class="logo-path" d="M50 68 L75 85 V112 H25 V85 Z" />
                <circle cx="50" cy="68" r="4" fill="var(--timely-neon)" />
            </svg>
            <div class="text-start">
                <h1 class="h6 fw-bold mb-0">Horarios Académicos TIMELY</h1>
                <p style="font-size: 0.75rem;" class="mb-0 opacity-90">Institución Educativa - Año Lectivo {{ date('Y') }}</p>
            </div>
        </div>
    </div>

    <div class="container-fluid px-3 py-2">
        @if($cursoBuscado)
            <div class="d-flex justify-content-between align-items-center mb-2 px-2">
                <h2 class="text-success fw-bold h6 mb-0">
                    <i class="fas fa-calendar-check me-1"></i> {{ $cursoBuscado->grado }} - {{ $cursoBuscado->grupo }}
                </h2>
                <div class="d-flex gap-2">
                    <a href="{{ route('kiosco.descargar', $cursoBuscado->id) }}" class="btn btn-danger btn-sm fw-bold">
                        <i class="fas fa-file-pdf"></i> DESCARGAR PDF
                    </a>
                    <a href="{{ route('kiosco.index') }}" class="btn btn-secondary btn-sm fw-bold">
                        <i class="fas fa-sync"></i> VOLVER
                    </a>
                </div>
            </div>
            <div class="notebook-frame">
                @include('kiosco._grilla', ['curso' => $cursoBuscado])
            </div>
        @else
            @php
                $hayDatosReales = $cursosParaCarrusel->count() > 0;
                $cursosAMostrar = $hayDatosReales ? $cursosParaCarrusel : collect([
                    (object)['grado' => '10', 'grupo' => 'A'],
                    (object)['grado' => '11', 'grupo' => 'B']
                ]);
                $seisHoras = ['06:00', '07:00', '08:00', '09:00', '10:00', '11:00'];
                $ejemplos = [['Matemáticas', '201', 'Pérez'], ['Inglés', 'Lab', 'Smith'], ['Física', '302', 'López'], ['Química', 'Lab 2', 'Torres']];
            @endphp

            <div id="horariosCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="8000">
                <div class="carousel-inner">
                    @foreach($cursosAMostrar as $index => $curso)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <p class="text-center text-success fw-bold mb-1" style="font-size: 0.9rem;">CURSO: {{ $curso->grado }} - {{ $curso->grupo }}</p>
                            <div class="notebook-frame">
                                <table class="table table-kiosco table-sm w-100 m-0">
                                    <thead>
                                        <tr>
                                            <th>HORA</th>
                                            @foreach(['LUN','MAR','MIE','JUE','VIE'] as $d) <th>{{$d}}</th> @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($seisHoras as $hIdx => $h)
                                        <tr>
                                            <td class="hora-col">{{ $h }}</td>
                                            @for($i=0; $i<5; $i++)
                                            <td>
                                                @php $ex = $ejemplos[($hIdx + $i) % count($ejemplos)]; @endphp
                                                <div class="clase-card">
                                                    <span class="materia-name">{{ $ex[0] }}</span>
                                                    <div class="materia-sub">{{ $ex[1] }} | {{ $ex[2] }}</div>
                                                </div>
                                            </td>
                                            @endfor
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <button type="button" class="btn btn-timely shadow-lg" data-bs-toggle="modal" data-bs-target="#modalBuscar">
        <i class="fas fa-search"></i>
    </button>

    <div class="modal fade" id="modalBuscar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-success text-white py-2">
                    <h5 class="modal-title h6">Buscar Horario</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('kiosco.index') }}" method="GET">
                        <div class="mb-4">
                            <label class="form-label fw-bold text-success small">SELECCIONA TU GRADO:</label>
                            <select name="curso_id" class="form-select border-success" required>
                                <option value="" selected disabled>-- Ver opciones --</option>
                                @foreach($todosLosCursos as $c)
                                    <option value="{{ $c->id }}">{{ $c->grado }} - {{ $c->grupo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100 fw-bold">MOSTRAR HORARIO</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>