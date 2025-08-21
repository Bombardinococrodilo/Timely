<!DOCTYPE html>
<html>
<head>
    <title>Lista de Espacios</title>
</head>
<body>
    <h1>Espacios registrados</h1>

    <a href="{{ route('spaces.create') }}">➕ Nuevo espacio</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <ul>
        @foreach($spaces as $space)
            <li>
                {{ $space->nombre }} - {{ $space->tipo }} (Capacidad: {{ $space->capacidad }})
            </li>
        @endforeach
    </ul>
</body>
</html>
