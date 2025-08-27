<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Espacio</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fdf9;
            color: #2c3e50;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            border-radius: 18px;
            box-shadow: 0 8px 24px rgba(39, 174, 96, 0.08);
            padding: 40px 30px 30px 30px;
        }
        h1 {
            text-align: center;
            color: #27ae60;
            margin-bottom: 30px;
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: white;
            color: #27ae60;
            font-weight: bold;
            border-radius: 30px;
            text-decoration: none;
            margin: 5px 8px 15px 0;
            transition: 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .btn:hover {
            background-color: #27ae60;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 6px 10px rgba(0,0,0,0.15);
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }
        label {
            font-weight: bold;
            color: #166534;
        }
        input, select {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #A7F3D0;
            font-size: 1rem;
        }
        .actions {
            text-align: center;
            margin-top: 18px;
        }
        footer {
            text-align: center;
            padding: 15px;
            background-color: #2ecc71;
            color: white;
            font-size: 0.9rem;
            margin-top: 40px;
            border-radius: 0 0 18px 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Crear Espacio</h1>
        <form method="POST" action="{{ route('spaces.store') }}">
            @csrf
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo" required>
                <option value="">Selecciona un tipo</option>
                <option value="Aula">Aula</option>
                <option value="Laboratorio">Laboratorio</option>
                <option value="Sala">Sala</option>
            </select>

            <label for="capacidad">Capacidad:</label>
            <input type="number" id="capacidad" name="capacidad" min="1" required>

            <div class="actions">
                <button type="submit" class="btn">Guardar</button>
                <a href="{{ route('spaces.index') }}" class="btn">Volver a espacios</a>
                <a href="{{ url('') }}" class="btn">Volver al inicio</a>
            </div>
        </form>
    </div>
    <footer>
        <div>© 2025 Timely. Todos los derechos reservados.</div>
    </footer>
</body>
</html>
