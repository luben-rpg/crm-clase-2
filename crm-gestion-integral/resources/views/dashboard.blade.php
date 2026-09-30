<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            margin: 0;
            padding: 32px;
            color: #1f2937;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        }
        h1 {
            margin-top: 0;
            font-size: 2rem;
        }
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
            margin-top: 24px;
        }
        .card {
            background: linear-gradient(135deg, #eef4ff, #f8fafc);
            border: 1px solid #dfe7f5;
            border-radius: 14px;
            padding: 20px;
        }
        .card h2 {
            margin: 0 0 12px;
            font-size: 1.1rem;
        }
        .card a {
            display: inline-block;
            margin-top: 8px;
            text-decoration: none;
            background: #2563eb;
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>CRM Dashboard</h1>
        <p>Panel principal del sistema con reportes del negocio.</p>

        <div class="cards">
            <div class="card">
                <h2>Clientes por zona</h2>
                <p>Resumen por ubicación geográfica.</p>
                <a href="{{ route('reportes.zonas') }}">Ver reporte</a>
            </div>

            <div class="card">
                <h2>Interacciones por asesor</h2>
                <p>Conteo de seguimiento por usuario.</p>
                <a href="{{ route('reportes.interacciones') }}">Ver reporte</a>
            </div>
        </div>
    </div>
</body>
</html>
