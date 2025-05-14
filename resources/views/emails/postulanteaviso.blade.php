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
        color: #fff;
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
          <img src="https://sigad.idexperujapon.edu.pe/img/new-logo-azul.png" alt="Imagen"/>
          <p>
            Se registró de manera satisfactoria tu postulación al empleo: {{ $postulacione->empleo->titulo }} en la empresa: {{ $postulacione->empleo->empresa->razonSocial }} de nuestra bolsa laboral.
          </p>
          <p>
            El empleador revisará tu hoja de vida y de ser el caso te contactará usando tus datos registrados.
          </p>
        </div>
        <div class="footer">
          <p>IEST Público Perú Japón - Rumbo al Licenciamiento... </p>
        </div>
      </div>
</body>
</html>