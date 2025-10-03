<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Modelos de Vehículos</title>
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
    <h3>Listado de Modelos de Vehículos</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Marca</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicleModels as $vehicleModel)
                <tr>
                    <td>{{ $vehicleModel->id }}</td>
                    <td>{{ $vehicleModel->name }}</td>
                    <td>{{ $vehicleModel->description }}</td>
                    <td>{{ $vehicleModel->brand->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
