<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Horarios</title>
    <style>
        body { margin: 0; font-family: 'Segoe UI', sans-serif; background-color: #f8fdf9; color: #2c3e50; }
        .container { max-width: 1100px; margin: 40px auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #27ae60; }
        .btn { padding: 10px 20px; text-decoration: none; border-radius: 20px; font-weight: bold; color: white; display: inline-block; }
        .btn-new { background-color: #27ae60; }
        .btn-home { background-color: #7f8c8d; margin-left: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #2ecc71; color: white; }
        tr:hover { background-color: #f1f1f1; }
        .actions { display: flex; gap: 5px; }
        .btn-sm { padding: 5px 10px; font-size: 0.8rem; border: none; cursor: pointer; border-radius: 5px; }
        .btn-edit { background-color: #f39c12; color: white; }
        .btn-delete { background-color: #e74c3c; color: white; }
        .badge { padding: 4px 8px; border-radius: 12px; font-size: 0.8rem; background-color: #e8f5e9; color: #27ae60; border: 1px solid #c8e6c9; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Horarios Académicos</h1>
        <div style="margin-bottom: 20px;">
            <a href="{{ route('horarios.create') }}" class="btn btn-new">+ Programar Clase</a>
            <a href="{{ url('/') }}" class="btn btn-home">Volver al Inicio</a>
        </div>

        @if(session('success'))
            <div style="background:#d4edda; color:#155724; padding:10px; border-radius:5px; margin-bottom:15px;">
                {{ session('success') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Día / Hora</th>
                    <th>Curso</th>
                    <th>Asignatura</th>
                    <th>Profesor</th>
                    <th>Ambiente</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($horarios as $h)
                <tr>
                    <td>
                        <strong>{{ $h->dia }}</strong><br>
                        {{ substr($h->hora_inicio, 0, 5) }} - {{ substr($h->hora_fin, 0, 5) }}
                    </td>
                    <td><span class="badge">{{ $h->curso->nombre_completo ?? 'N/A' }}</span></td>
                    <td>{{ $h->asignatura->nombre ?? 'N/A' }}</td>
                    <td>{{ $h->profesor->nombre ?? 'N/A' }} {{ $h->profesor->apellido ?? '' }}</td>
                    <td>{{ $h->ambiente->nombre ?? 'N/A' }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('horarios.edit', $h->id) }}" class="btn-sm btn-edit">Editar</a>
                            <form action="{{ route('horarios.destroy', $h->id) }}" method="POST" onsubmit="return confirm('¿Borrar esta clase?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-delete">X</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;">No hay clases programadas aún.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>