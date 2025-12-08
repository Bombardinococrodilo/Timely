<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Cursos</title>
    <style>
        body { margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8fdf9; color: #2c3e50; }
        .container { max-width: 900px; margin: 40px auto; background: white; border-radius: 18px; box-shadow: 0 8px 24px rgba(39, 174, 96, 0.08); padding: 40px 30px 30px 30px; }
        h1 { text-align: center; color: #27ae60; margin-bottom: 30px; }
        .btn { display: inline-block; padding: 12px 25px; background-color: white; color: #27ae60; font-weight: bold; border-radius: 30px; text-decoration: none; margin: 5px 8px 15px 0; transition: 0.3s ease; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: 1px solid #ddd; }
        .btn:hover { background-color: #27ae60; color: white; transform: translateY(-3px); box-shadow: 0 6px 10px rgba(0,0,0,0.15); }
        ul { list-style: none; padding: 0; }
        li { background: #ecfdf5; margin-bottom: 12px; padding: 18px 22px; border-radius: 12px; color: #166534; font-size: 1.08rem; box-shadow: 0 2px 8px rgba(39, 174, 96, 0.05); display: flex; justify-content: space-between; align-items: center; }
        .success { color: #27ae60; text-align: center; margin-bottom: 18px; font-weight: bold; }
        footer { text-align: center; padding: 15px; background-color: #2ecc71; color: white; font-size: 0.9rem; margin-top: 40px; border-radius: 0 0 18px 18px; }
        .actions { display: flex; gap: 8px; }
        .btn-edit { display: inline-block; padding: 8px 15px; background-color: #f0fdf4; color: #16a34a; font-size: 0.9rem; font-weight: bold; border-radius: 20px; text-decoration: none; transition: 0.3s ease; border: 1px solid #bbf7d0; }
        .btn-edit:hover { background-color: #16a34a; color: white; }
        .btn-delete { display: inline-block; padding: 8px 15px; background-color: #fef2f2; color: #dc2626; font-size: 0.9rem; font-weight: bold; border-radius: 20px; text-decoration: none; transition: 0.3s ease; border: 1px solid #fecaca; cursor: pointer; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .btn-delete:hover { background-color: #dc2626; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestión de Cursos</h1>
        <a href="{{ route('cursos.create') }}" class="btn">Nuevo Curso</a>
        <a href="{{ url('/') }}" class="btn">Volver al Inicio</a>

        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <ul>
            @forelse($cursos as $curso)
                <li>
                    <div>
                        <strong>{{ $curso->nombre_completo }}</strong> 
                        <br>
                        <small style="color: #555;">
                            Nivel: {{ $curso->nivel ?? 'No definido' }} | Estudiantes: {{ $curso->cantidad_estudiantes }}
                        </small>
                    </div>
                    <div class="actions">
                        <a href="{{ route('cursos.edit', $curso->id) }}" class="btn-edit">Editar</a>
                        <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este curso?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Eliminar</button>
                        </form>
                    </div>
                </li>
            @empty
                <li>No hay cursos registrados.</li>
            @endforelse
        </ul>
    </div>
    <footer>
        <div>© 2025 Timely. Todos los derechos reservados.</div>
    </footer>
</body>
</html>