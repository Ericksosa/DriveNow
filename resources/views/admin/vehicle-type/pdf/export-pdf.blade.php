<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Tipos de Vehículos</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 4px;
            text-align: left;
        }

        th {
            background: #eee;
        }
    </style>
</head>

<body>
    <h3>Listado de Tipos de Vehículos</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicleTypes as $vehicleType)
                <tr>
                    <td>{{ $vehicleType->id }}</td>
                    <td>{{ $vehicleType->name }}</td>
                    <td>{{ $vehicleType->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
