<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Espacios</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fdf9;
            color: #2c3e50;
        }
        .container {
            max-width: 900px;
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
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            background: #ecfdf5;
            margin-bottom: 12px;
            padding: 18px 22px;
            border-radius: 12px;
            color: #166534;
            font-size: 1.08rem;
            box-shadow: 0 2px 8px rgba(39, 174, 96, 0.05);
        }
        .success {
            color: #27ae60;
            text-align: center;
            margin-bottom: 18px;
            font-weight: bold;
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
        <h1>Espacios registrados</h1>
        <a href="{{ route('spaces.create') }}" class="btn">Nuevo espacio</a>
        <a href="{{ url('') }}" class="btn">Volver</a>

        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <ul>
            @foreach($spaces as $space)
                <li>
                    {{ $space->nombre }} - {{ $space->tipo }} (Capacidad: {{ $space->capacidad }})
                </li>
            @endforeach
        </ul>
    </div>
    <footer>
        <div>© 2025 Timely. Todos los derechos reservados.</div>
    </footer>
</body>
</html>
