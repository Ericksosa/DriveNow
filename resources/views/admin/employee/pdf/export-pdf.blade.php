<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Empleados</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size:12px; }
        table { width:100%; border-collapse: collapse; }
        th, td { border:1px solid #444; padding:4px; text-align:left; }
        th { background:#eee; }
    </style>
</head>
<body>
<h3>Listado de Empleados</h3>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Cédula</th>
        <th>Comisión</th>
        <th>Tanda</th>
    </tr>
    </thead>
    <tbody>
    @foreach($employees as $e)
        <tr>
            <td>{{ $e->id }}</td>
            <td>{{ $e->user->name }}</td>
            <td>{{ $e->user->last_name }}</td>
            <td>{{ $e->id_card_number }}</td>
            <td>{{ $e->commission_percentage }}%</td>
            <td>{{ $e->shift }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
