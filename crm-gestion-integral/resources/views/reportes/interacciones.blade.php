<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8fafc;
            margin: 0;
            padding: 32px;
            color: #0f172a;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
        }
        h1 {
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px 14px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }
        th {
            background: #f8fafc;
        }
        .btn {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            background: #0f766e;
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a class="btn" href="{{ url('/') }}">Volver al dashboard</a>
        <h1>{{ $title }}</h1>

        <table>
            <thead>
                <tr>
                    <th>Asesor</th>
                    <th>Total de interacciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $row)
                    <tr>
                        <td>{{ $row->asesor }}</td>
                        <td>{{ $row->total_interacciones }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">No hay datos disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
