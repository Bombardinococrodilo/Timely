<!DOCTYPE html>
<html>
<head>
    <title>Horario Académico</title>
</head>
<body>
    <h1>¡Hola, {{ $profesor->nombre }}!</h1>
    
    <p>Adjunto encontrarás tu horario académico para este periodo.</p>
    
    @if($pdfCurso)
        <p><strong>Nota:</strong> Como eres director de grupo, también hemos adjuntado el horario de tu curso: 
            <strong>{{ $profesor->cursos->grado ?? 'Tu Grupo' }}</strong>.
        </p>
    @endif

    <p>Atentamente,<br>
    Equipo Administrativo - Timely</p>
</body>
</html>