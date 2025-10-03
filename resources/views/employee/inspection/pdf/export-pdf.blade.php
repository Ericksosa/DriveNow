<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Inspecciones</title>
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
    <h3>Listado de Inspecciones</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Vehículo</th>
                <th>Cliente</th>
                <th>Tiene rayaduras?</th>
                <th>Cantidad de combustible</th>
                <th>Tiene llanta de repuesto?</th>
                <th>Tiene gato hidraulico?</th>
                <th>Tiene cristal roto?</th>
                <th>Estado llanta izquierda delantera</th>
                <th>Estado llanta derecha delantera</th>
                <th>Estado llanta izquierda trasera</th>
                <th>Estado llanta derecha trasera</th>
                <th>Fecha de Inspección</th>
                <th>Empleado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inspections as $inspection)
                <tr>
                    <td>{{ $inspection->id }}</td>
                    <td>{{ $inspection->vehicle->name }}</td>
                    <td>{{ $inspection->customer->user->name . ' ' . $inspection->customer->user->last_name }}</td>
                    <td>{{ $inspection->has_scratches ? 'Sí' : 'No' }}</td>
                    <td>{{ $inspection->fuel_level }}</td>
                    <td>{{ $inspection->has_spare_tire ? 'Sí' : 'No' }}</td>
                    <td>{{ $inspection->has_jack ? 'Sí' : 'No' }}</td>
                    <td>{{ $inspection->has_broken_glass ? 'Sí' : 'No' }}</td>
                    <td>{{ $inspection->front_left_tire }}</td>
                    <td>{{ $inspection->front_right_tire }}</td>
                    <td>{{ $inspection->rear_left_tire }}</td>
                    <td>{{ $inspection->rear_right_tire }}</td>
                    <td>{{ $inspection->inspection_date }}</td>
                    <td>{{ $inspection->employee && $inspection->employee->user ? $inspection->employee->user->name . ' ' . $inspection->employee->user->last_name : 'N/A' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
