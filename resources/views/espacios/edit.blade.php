<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Espacio</title>
    <style>
        body { margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8fdf9; color: #2c3e50; }
        .container { max-width: 900px; margin: 40px auto; background: white; border-radius: 18px; box-shadow: 0 8px 24px rgba(39, 174, 96, 0.08); padding: 40px; }
        h1 { text-align: center; color: #27ae60; margin-bottom: 30px; }
        .btn { display: inline-block; padding: 12px 25px; background-color: white; color: #27ae60; font-weight: bold; border-radius: 30px; text-decoration: none; margin: 10px 8px 0 0; transition: 0.3s ease; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: 1px solid #ddd; }
        .btn:hover { background-color: #27ae60; color: white; transform: translateY(-3px); box-shadow: 0 6px 10px rgba(0,0,0,0.15); }
        .btn-primary { background-color: #27ae60; color: white; border: none; }
        .btn-primary:hover { background-color: #229954; }
        form { display: flex; flex-direction: column; gap: 20px; }
        label { font-weight: bold; color: #34495e; }
        input[type="text"], input[type="tipo"] { width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ddd; box-sizing: border-box; }
        .actions { margin-top: 20px; }
        footer { text-align: center; padding: 20px; color: #7f8c8d; font-size: 0.9rem; margin-top: 40px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Información del Espacio</h1>

        <form method="POST" action="{{ route('espacios.update', $espacio->id) }}">
            @csrf @method('PUT') <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ $espacio->nombre }}" required>
            </div>

            <div>
                <label for="ubicacion">Ubicación:</label>
                <input type="text" id="ubicacion" name="ubicacion" value="{{ $espacio->ubicacion }}" required>
            </div>

            <div>
                <label for="tipo">Tipo:</label>
                <input type="tipo" id="tipo" name="tipo" value="{{ $espacio->tipo }}" required>
            </div>

            <div>
                <label for="capacidad">Capacidad:</label>
                <input type="text" id="capacidad" name="capacidad" value="{{ $espacio->capacidad }}" required>
            </div>

            <div>
                <label for="estado">Estado:</label>
                <select id="estado" name="estado" style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ddd; box-sizing: border-box;">
                    <option value="disponible" {{ $espacio->estado == 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="ocupado" {{ $espacio->estado == 'ocupado' ? 'selected' : '' }}>Ocupado</option>
                    <option value="mantenimiento" {{ $espacio->estado == 'mantenimiento' ? 'selected' : '' }}>En mantenimiento</option>
                </select>
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">Actualizar Espacio</button>
                <a href="{{ route('espacios.index') }}" class="btn">Cancelar</a>
            </div>
        </form>
    </div>
    <footer>
        <div>© 2025 Timely. Todos los derechos reservados.</div>
    </footer>
</body>
</html>