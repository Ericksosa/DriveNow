<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Vehiculos</title>
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
    <h3>Listado de Vehículos</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Número de chásis</th>
                <th>Número de Motor</th>
                <th>Número de placa</th>
                <th>Color</th>
                <th>Año de lanzamiento</th>
                <th>Categoria</th>
                <th>Número de puertas</th>
                <th>Número de asientos</th>
                <th>Transmisión</th>
                <th>Tipo de Vehículo</th>
                <th>Marca</th>
                <th>Combustible</th>
                <th>Modelo</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->id }}</td>
                    <td>{{ $vehicle->name }}</td>
                    <td>{{ $vehicle->description }}</td>
                    <td>{{ $vehicle->chasis_number }}</td>
                    <td>{{ $vehicle->engine_number }}</td>
                    <td>{{ $vehicle->plate_number }}</td>
                    <td>{{ $vehicle->color }}</td>
                    <td>{{ $vehicle->launching_year }}</td>
                    <td>{{ $vehicle->category }}</td>
                    <td>{{ $vehicle->number_of_doors }}</td>
                    <td>{{ $vehicle->number_of_seats }}</td>
                    <td>{{ $vehicle->transmission }}</td>
                    <td>{{ $vehicle->vehicleType->name }}</td>
                    <td>{{ $vehicle->vehicleModel->brand->name }}</td>
                    <td>{{ $vehicle->fuelType->name }}</td>
                    <td>{{ $vehicle->vehicleModel->name }}</td>
                    <td>{{ $vehicle->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
