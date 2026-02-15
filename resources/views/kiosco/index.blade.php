<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartelera de Horarios - TIMELY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .kiosco-header { background-color: #1a252f; color: white; padding: 20px 0; text-align: center; border-bottom: 5px solid #27ae60; }
        
        .table-kiosco th { background-color: #2c3e50; color: white; text-align: center; font-size: 1.2rem; padding: 15px; }
        .table-kiosco td { height: 120px; vertical-align: middle; text-align: center; border: 1px solid #dee2e6; }
        .hora-col { background-color: #e9ecef; font-weight: bold; font-size: 1.2rem; width: 10%; }
        
        .clase-card { background-color: #e8f8f5; border: 2px solid #2ecc71; border-radius: 10px; padding: 10px; height: 100%; display: flex; flex-direction: column; justify-content: center; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .materia-text { font-size: 1.1rem; font-weight: bold; color: #16a085; }
        .salon-text { font-size: 0.9rem; color: #7f8c8d; margin-top: 5px; }
        
        .btn-flotante { position: fixed; bottom: 30px; right: 30px; width: 70px; height: 70px; border-radius: 50%; font-size: 24px; box-shadow: 0 4px 15px rgba(0,0,0,0.3); z-index: 1000; display: flex; align-items: center; justify-content: center; }
        
        .carousel-item { transition: transform 0.8s ease-in-out; }
    </style>
</head>
<body>

    <div class="kiosco-header shadow-sm">
        <h1 class="display-5 fw-bold"><i class="fas fa-clock me-3"></i>Horarios Académicos TIMELY</h1>
        <p class="lead mb-0">Institución Educativa - Año Lectivo {{ date('Y') }}</p>
    </div>

    <div class="container-fluid px-5 py-4">

        @if($cursoBuscado)
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-success fw-bold">
                    <i class="fas fa-users me-2"></i> Horario: {{ $cursoBuscado->grado }} - {{ $cursoBuscado->grupo }}
                </h2>
                
                <div>
                    <a href="{{ route('kiosco.descargar', $cursoBuscado->id) }}" class="btn btn-danger btn-lg shadow-sm me-2">
                        <i class="fas fa-file-pdf me-2"></i> Descargar PDF
                    </a>
                    
                    <a href="{{ route('kiosco.index') }}" class="btn btn-secondary btn-lg shadow-sm">
                        <i class="fas fa-arrow-left me-2"></i> Volver a Cartelera General
                    </a>
                </div>
            </div>

            @include('kiosco._grilla', ['curso' => $cursoBuscado])

        @else
            @if($cursosParaCarrusel->count() > 0)
                <div class="text-center mb-3">
                    <span class="badge bg-warning text-dark fs-6"><i class="fas fa-sync fa-spin me-2"></i> Rotación Automática</span>
                </div>

                <div id="horariosCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="7000">
                    <div class="carousel-inner">
                        
                        @foreach($cursosParaCarrusel as $index => $curso)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <h2 class="text-center text-primary fw-bold mb-4">
                                    Curso: {{ $curso->grado }} - {{ $curso->grupo }}
                                </h2>
                                @include('kiosco._grilla', ['curso' => $curso])
                            </div>
                        @endforeach

                    </div>
                </div>
            @else
                <div class="alert alert-info text-center mt-5 fs-4">
                    <i class="fas fa-info-circle mb-3 fa-2x"></i><br>
                    Aún no hay horarios publicados en el sistema.
                </div>
            @endif
        @endif

    </div>

    @if(!$cursoBuscado)
        <button type="button" class="btn btn-success btn-flotante" data-bs-toggle="modal" data-bs-target="#modalBuscar">
            <i class="fas fa-search"></i>
        </button>
    @endif

    <div class="modal fade" id="modalBuscar" tabindex="-1" aria-labelledby="modalBuscarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalBuscarLabel"><i class="fas fa-search me-2"></i> Consultar mi Horario</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('kiosco.index') }}" method="GET">
                        <div class="mb-4">
                            <label for="curso_id" class="form-label fw-bold">Selecciona tu Grado y Grupo:</label>
                            <select name="curso_id" id="curso_id" class="form-select form-select-lg" required>
                                <option value="" selected disabled>-- Despliega la lista --</option>
                                @foreach($todosLosCursos as $cursoLista)
                                    <option value="{{ $cursoLista->id }}">
                                        {{ $cursoLista->grado }} - {{ $cursoLista->grupo }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text mt-2">Solo aparecen los cursos registrados en el sistema.</div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">
                                Ver Horario Ahora <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>