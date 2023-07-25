<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>APELLIDOS, Nombres</th>
                <th>Empleo</th>
                <th>Ubicación</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @isset($postulaciones)
                @foreach ($postulaciones as $key => $postulacione)
                    <tr>
                        <td>{{ $key +1 }}</td>
                        <td>{{ $postulacione->user->ucliente->cliente->apellido }}, {{ $postulacione->user->ucliente->cliente->nombre }}</td>
                        <td>{{ $postulacione->empleo->titulo }}</td>
                        <td>{{ $postulacione->empleo->ubicacione->nombre }}</td>
                        <td>{{ date('d-m-Y',strtotime($postulacione->fecha)) }}</td>
                    </tr>
                @endforeach
            @endisset
        </tbody>
    </table>
</body>
</html>