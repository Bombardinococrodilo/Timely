<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Horario Académico - TIMELY</title>
    <style>
        body { margin: 0; padding: 0; -webkit-font-smoothing: antialiased; width: 100% !important; background-color: #f4f7f6; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #555; }
        
        .email-wrapper { padding: 20px 0; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; }
        
        .header { background-color: #27ae60; color: #ffffff; padding: 40px 20px; text-align: center; }
        .header h1 { margin: 0; font-size: 32px; font-weight: bold; letter-spacing: 1px; }
        .header p { margin: 8px 0 0; font-size: 16px; opacity: 0.95; }
        
        .content { padding: 30px 40px; line-height: 1.65; font-size: 16px; }
        .content h2 { color: #166534; font-size: 24px; margin-top: 0; margin-bottom: 15px; font-weight: 600; }
        .content p { margin: 0 0 1.2em 0; }
        
        .highlight-box { background-color: #e8f8f5; border-left: 4px solid #27ae60; padding: 20px; margin: 25px 0; border-radius: 0 8px 8px 0; }
        .highlight-box p { margin: 0; font-size: 15px; color: #166534; line-height: 1.6; }
        .highlight-box strong { font-weight: 600; }
        
        .signature { margin-top: 35px; line-height: 1.5; }
        
        .footer { background-color: #f8f9fa; text-align: center; padding: 25px; font-size: 13px; color: #888; border-top: 1px solid #e2e8f0; }
        .footer strong { color: #27ae60; font-weight: 600; }
    </style>
</head>
<body>

    <div class="email-wrapper">
        <div class="container">
            <div class="header">
                <h1>TIMELY</h1>
                <p>Sistema de Gestión de Horarios</p>
            </div>

            <div class="content">
                <h2>¡Hola, {{ $profesor->nombre }}! 🎓</h2>
                
                <p>Te informamos que la Coordinación Académica ha oficializado la programación de clases para el periodo vigente. A continuación, encontrarás los detalles de los archivos adjuntos.</p>
                
                @if($pdfCurso)
                    <div class="highlight-box">
                        <p>
                            <strong>Archivos Adjuntos:</strong><br>
                            1. Tu horario personal detallado (PDF).<br>
                            2. La grilla de horarios de tu curso a cargo: <strong>{{ optional($profesor->cursos)->grado ?? '' }} - {{ optional($profesor->cursos)->grupo ?? 'Tu Grupo' }}</strong> (PDF).
                        </p>
                    </div>
                @else
                    <div class="highlight-box">
                        <p>Adjunto a este correo electrónico encontrarás un documento <strong>PDF</strong> detallado con tu horario personal, incluyendo las asignaturas, horas y ambientes de aprendizaje que te han sido asignados.</p>
                    </div>
                @endif

                <p>Si presentas alguna duda o encuentras alguna inconsistencia en la asignación, por favor comunícate directamente con la coordinación.</p>
                
                <div class="signature">
                    <p>Atentamente,<br>
                    <strong>Equipo Administrativo - SENA Puerto Boyacá</strong></p>
                </div>
            </div>

            <div class="footer">
                Este es un mensaje generado automáticamente por el sistema <strong>TIMELY</strong>. <br>Por favor, no respondas a esta dirección de correo.
            </div>
        </div>
    </div>

</body>
</html>