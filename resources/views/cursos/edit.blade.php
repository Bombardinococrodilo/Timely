<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso</title>
    <style>
        body { margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8fdf9; color: #2c3e50; }
        .container { max-width: 900px; margin: 40px auto; background: white; border-radius: 18px; box-shadow: 0 8px 24px rgba(39, 174, 96, 0.08); padding: 40px; }
        h1 { text-align: center; color: #27ae60; margin-bottom: 30px; }
        .btn { display: inline-block; padding: 12px 25px; background-color: white; color: #27ae60; font-weight: bold; border-radius: 30px; text-decoration: none; margin: 10px 8px 0 0; transition: 0.3s ease; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: 1px solid #ddd; cursor: pointer; }
        .btn:hover { background-color: #27ae60; color: white; transform: translateY(-3px); box-shadow: 0 6px 10px rgba(0,0,0,0.15); }
        .btn-primary { background-color: #27ae60; color: white; border: none; }
        .btn-primary:hover { background-color: #229954; }
        form { display: flex; flex-direction: column; gap: 20px; }
        label { font-weight: bold; color: #34495e; }
        input[type="text"], input[type="number"], select { width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ddd; box-sizing: border-box; font-family: inherit; font-size: 1rem; }
        .alert-danger { color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; padding: 15px; border-radius: 8px; list-style: inside; }
        footer { text-align: center; padding: 20px; color: #7f8c8d; font-size: 0.9rem; margin-top: 40px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Curso</h1>

        @if ($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('cursos.update', $curso->id) }}">
            @csrf 
            @method('PUT')
            
            <div>
                <label for="grado">Grado:</label>
                <select name="grado" id="grado" required>
                    <option value="Sexto" {{ $curso->grado == 'Sexto' ? 'selected' : '' }}>Sexto</option>
                    <option value="Séptimo" {{ $curso->grado == 'Séptimo' ? 'selected' : '' }}>Séptimo</option>
                    <option value="Octavo" {{ $curso->grado == 'Octavo' ? 'selected' : '' }}>Octavo</option>
                    <option value="Noveno" {{ $curso->grado == 'Noveno' ? 'selected' : '' }}>Noveno</option>
                    <option value="Décimo" {{ $curso->grado == 'Décimo' ? 'selected' : '' }}>Décimo</option>
                    <option value="Once" {{ $curso->grado == 'Once' ? 'selected' : '' }}>Once</option>
                </select>
            </div>

            <div>
                <label for="grupo">Grupo / Identificador:</label>
                <input type="text" id="grupo" name="grupo" value="{{ $curso->grupo }}" required>
            </div>

            <div>
                <label for="cantidad_estudiantes">Cantidad de Estudiantes:</label>
                <input type="number" id="cantidad_estudiantes" name="cantidad_estudiantes" value="{{ $curso->cantidad_estudiantes }}" min="1" required>
            </div>

            <div>
                <label for="nivel">Nivel (Opcional):</label>
                <select name="nivel" id="nivel">
                    <option value="Bachillerato" {{ $curso->nivel == 'Bachillerato' ? 'selected' : '' }}>Bachillerato</option>
                    <option value="Primaria" {{ $curso->nivel == 'Primaria' ? 'selected' : '' }}>Primaria</option>
                </select>
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">Actualizar Curso</button>
                <a href="{{ route('cursos.index') }}" class="btn">Cancelar</a>
            </div>
        </form>
    </div>
    <footer>
        <div>© 2025 Timely. Todos los derechos reservados.</div>
    </footer>
</body>
</html>