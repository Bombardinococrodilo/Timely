<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Asignatura</title>
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
        input[type="text"], input[type="email"] { width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ddd; box-sizing: border-box; }
        .actions { margin-top: 20px; }
        footer { text-align: center; padding: 20px; color: #7f8c8d; font-size: 0.9rem; margin-top: 40px; }
        .estado-group {
            background: #ecfdf5;
            padding: 18px 22px;
            border-radius: 12px;
            margin-bottom: 18px;
            box-shadow: 0 2px 8px rgba(39, 174, 96, 0.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registrar una Nueva Asignatura</h1>

        <form method="POST" action="{{ route('asignaturas.store') }}">
            @csrf
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div>
                <label for="descripcion">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion" required>
            </div>

            <div>
                <label for="profesor_asignado">Profesor Asignado:</label>
                <input type="text" id="profesor_asignado" name="profesor_asignado" required>
            </div>

            <div>
                <label for="horas_semanales">Horas Semanales:</label>
                <input type="text" id="horas_semanales" name="horas_semanales" required>
            </div>

            <div class="estado-group">
                <label for="tipo_materia">Tipo de Materia:</label>
                <select id="tipo_materia" name="tipo_materia" style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ddd; box-sizing: border-box;">
                    <option value="curricular">Curricular</option>
                    <option value="técnica">Técnica</option>
                </select>   
            </div>


            <div class="actions">
                <button type="submit" class="btn btn-primary">Guardar Asignatura</button>
                <a href="{{ route('asignaturas.index') }}" class="btn">Cancelar</a>
            </div>
        </form>
    </div>
    <footer>
        <div>© 2025 Timely. Todos los derechos reservados.</div>
    </footer>
</body>
</html>