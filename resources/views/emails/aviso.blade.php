<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aviso de Postulacion</title>
    <style>
       .card {
        width: 400px;
        background-color: #f1f1f1;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        }

        .header {
        text-align: center;
        margin-bottom: 20px;
        }

        .header h2 {
        color: #333;
        font-size: 24px;
        }

        .body img {
            /* width: 100px; */
            height: 100px;
            /* object-fit: cover; */
            border-radius: 10%;
            margin: auto;
            display: block;
        }

        .body p {
        color: #555;
        }

        .button {
        display: inline-block;
        padding: 8px 16px;
        background-color: #007bff;
        color: #000000;
        text-decoration: none;
        border-radius: 4px;
        }

        .footer {
        margin-top: 20px;
        color: #777;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
          <h2>SISTEMA DE EMPLEABILIDAD</h2>
        </div>
        <div class="body">
          <img src="https://idexperujapon.edu.pe/wp-content/uploads/2023/04/logo-300x93.png" alt="Imagen" />
          <p>Este correo se envia de forma automatica por la reciente postulacion del usuario <strong>{{ Str::upper($postulacione->user->name) }}</strong> a la oferta de empleo llamada <strong>{{ Str::upper($postulacione->empleo->titulo) }}</strong>, en la empresa <strong> {{ $postulacione->empleo->empresa->razonSocial }}</strong></p>
          <a href="{{ route('dashboard.empleos.index') }}" class="button">Revizar ACA..</a>
        </div>
        <div class="footer">
          <p>I.E.S.T. Público Perú Japón - Rumbo al Licenciamiento... </p>
        </div>
      </div>
</body>
</html>