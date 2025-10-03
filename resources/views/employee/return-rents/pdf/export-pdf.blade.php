<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Rentas y Retornos</title>
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
    <h3>Listado de Rentas y Retornos</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Empleado</th>
                <th>Cliente</th>
                <th>Vehículo</th>
                <th>Fecha de Renta</th>
                <th>Fecha de Retorno</th>
                <th>Monto X Día</th>
                <th>Comentarios</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($returnsAndRents as $returnRent)
                <tr>
                    <td>{{ $returnRent->id }}</td>
                    <td>{{ $returnRent->employee && $returnRent->employee->user ? $returnRent->employee->user->name . ' ' . $returnRent->employee->user->last_name : 'N/A' }}</td>
                    <td>{{ $returnRent->customer->user->name . ' ' . $returnRent->customer->user->last_name }}</td>
                    <td>{{ $returnRent->vehicle->name }}</td>
                    <td>{{ $returnRent->rent_date }}</td>
                    <td>{{ $returnRent->return_date }}</td>
                    <td>{{ $returnRent->total_amount }}</td>
                    <td>{{ $returnRent->comments }}</td>
                    <td>{{ $returnRent->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
