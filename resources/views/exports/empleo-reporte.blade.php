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
                <th>Empresa</th>
                <th>Oferta Laboral</th>
                <th>Ubicación</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleos as $key=>$empleo)
                <tr>
                    <td>{{ $key +1 }}</td>
                    <td>{{ $empleo->empresa->razonSocial }}</td>
                    <td>{{ $empleo->titulo }}</td>
                    <td>{{ $empleo->ubicacione->nombre }}</td>
                    <td>{{ date('d-m-Y',strtotime($empleo->fecha_registro)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>