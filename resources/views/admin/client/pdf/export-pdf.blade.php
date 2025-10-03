<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Clientes</title>
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
    <h3>Listado de Clientes</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Cédula</th>
                <th>Límite de crédito</th>
                <th>Tipo de Persona</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->user->name }}</td>
                    <td>{{ $customer->user->last_name }}</td>
                    <td>{{ $customer->id_card_number }}</td>
                    <td>{{ $customer->credit_limit }}</td>
                    <td>{{ $customer->person_type }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
