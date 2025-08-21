<!DOCTYPE html>
<html>
<head>
    <title>Crear Espacio</title>
</head>
<body>
    <h1>Registrar un nuevo espacio</h1>

    <form action="{{ route('spaces.store') }}" method="POST">
        @csrf
        <label>Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label>Tipo:</label>
        <input type="text" name="tipo" required><br>

        <label>Capacidad:</label>
        <input type="number" name="capacidad" required><br>

        <label>Ubicación:</label>
        <input type="text" name="ubicacion"><br>

        <button type="submit">Guardar</button>
    </form>
</body>
</html>
