<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros | Timely</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fdf9;
            color: #2c3e50;
        }
        .hero {
            text-align: center;
            padding: 80px 20px;
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
        }
        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            text-shadow: 1px 1px 5px rgba(0,0,0,0.2);
        }
        .hero p {
            font-size: 1.15rem;
            margin-bottom: 30px;
            line-height: 1.5;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: white;
            color: #27ae60;
            font-weight: bold;
            border-radius: 30px;
            text-decoration: none;
            transition: 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .btn:hover {
            background-color: #27ae60;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 6px 10px rgba(0,0,0,0.15);
        }
        footer {
            text-align: center;
            padding: 15px;
            background-color: #2ecc71;
            color: white;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <section class="hero">
        <h1>Sobre Nosotros</h1>
        <p>En Timely, creemos en la organización y la eficiencia como pilares para el éxito. Nuestro equipo está dedicado a crear soluciones tecnológicas que ayuden a las personas y empresas a gestionar su tiempo y actividades de manera sencilla y efectiva. ¡Gracias por confiar en nosotros!</p>
        <a href="{{ url('/') }}" class="btn">Volver al Inicio</a>
    </section>
    <footer>
        <div>© 2025 Timely. Todos los derechos reservados.</div>
    </footer>
</body>
</html>
