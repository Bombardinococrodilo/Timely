<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Clase</title>
    <style>
        body { margin: 0; font-family: 'Segoe UI', sans-serif; background-color: #f8fdf9; }
        .container { max-width: 800px; margin: 40px auto; background: white; padding: 40px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #27ae60; margin-bottom: 30px; }
        form { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .full-width { grid-column: span 2; }
        label { font-weight: bold; display: block; margin-bottom: 5px; color: #34495e; }
        select, input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        .btn { padding: 12px; background-color: #f39c12; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; text-align: center; text-decoration: none; display: block; }
        .btn:hover { background-color: #e67e22; }
        .btn-cancel { background-color: #95a5a6; }
        .alert-error { background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; grid-column: span 2; margin-bottom: 20px; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Clase Existente</h1>

        @if ($errors->any())
            <div class="alert-error">
                <strong>¡No se pudo actualizar!</strong>
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('horarios.update', $horario->id) }}">
            @csrf
            @method('PUT') <div>
                <label>Día de la Semana</label>
                <select name="dia" required>
                    <option value="">Seleccione...</option>
                    @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'] as $dia)
                        <option value="{{ $dia }}" {{ $horario->dia == $dia ? 'selected' : '' }}>
                            {{ $dia }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Curso (Grado y Grupo)</label>
                <select name="curso_id" required>
                    <option value="">Seleccione...</option>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}" {{ $horario->curso_id == $curso->id ? 'selected' : '' }}>
                            {{ $curso->nombre_completo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Hora Inicio</label>
                <input type="time" name="hora_inicio" value="{{ substr($horario->hora_inicio, 0, 5) }}" required>
            </div>
            <div>
                <label>Hora Fin</label>
                <input type="time" name="hora_fin" value="{{ substr($horario->hora_fin, 0, 5) }}" required>
            </div>

            <div>
                <label>Asignatura</label>
                <select name="asignatura_id" required>
                    <option value="">Seleccione...</option>
                    @foreach($asignaturas as $asignatura)
                        <option value="{{ $asignatura->id }}" {{ $horario->asignatura_id == $asignatura->id ? 'selected' : '' }}>
                            {{ $asignatura->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Profesor</label>
                <select name="profesor_id" required>
                    <option value="">Seleccione...</option>
                    @foreach($profesores as $profe)
                        <option value="{{ $profe->id }}" {{ $horario->profesor_id == $profe->id ? 'selected' : '' }}>
                            {{ $profe->nombre }} {{ $profe->apellido }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="full-width">
                <label>Ambiente (Salón/Aula)</label>
                <select name="espacio_id" required>
                    <option value="">Seleccione...</option>
                    @foreach($espacios as $espacio)
                        <option value="{{ $espacio->id }}" {{ $horario->espacio_id == $espacio->id ? 'selected' : '' }}>
                            {{ $espacio->nombre }} ({{ $espacio->tipo }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="full-width" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
                <button type="submit" class="btn">Actualizar Clase</button>
                <a href="{{ route('horarios.index') }}" class="btn btn-cancel">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
