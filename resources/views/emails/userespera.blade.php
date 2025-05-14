<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>I.E.S.T.P Perú Japón Empleabilidad</title>
    <style>
        .card {
        width: 500px;
        border: 2px solid #ccc;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin: 0 auto;
        }
        .card-header{
            text-align: center;
        }
        .card-img {
            width: 60%;
            padding-top: 15px;
            display: inline-block;
        }

        .card-content {
        padding: 20px;
        }

        .card-title {
        font-size: 1.5rem;
        margin-bottom: 10px;
        text-align: center;
        }

        .card-description {
        font-size: 1rem;
        color: #302d2d;
        }

        .card-button {
        display: inline-block;
        padding: 8px 16px;
        background-color: blue;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        }

        .card-button:hover {
        background-color: navy;
        }
        
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <img src="https://sigad.idexperujapon.edu.pe/img/new-logo-azul.png" alt="Imagen del card" class="card-img">
        </div>
        <div class="card-content">
          <h2 class="card-title">SISTEMA DE EMPLEABILIDAD</h2>

            <p class="card-description"><b>Estimado usuario</b>,</p>
            <p class="card-description" style="text-align: justify">
                Nos complace informarte que hemos recibido exitosamente tu solicitud de registro en nuestro sistema. Queremos asegurarte que estamos trabajando diligentemente para revisar y confirmar tu solicitud lo más pronto posible.
                Una vez que tu registro sea aprobado, te enviaremos los datos de acceso a nuestra bolsa laboral a la dirección de correo electrónico que has proporcionado.
                Agradecemos tu interés en formar parte de nuestra comunidad. Si tienes alguna pregunta o necesitas más información, no dudes en ponerte en contacto con nuestro equipo de soporte.
            </p>
          <pre class="card-description">Atentamente,
El equipo de <strong>IEST Público Perú Japón</strong></pre>
          <a href="{{ route('home') }}" class="card-button" target="_blank"> <strong>Ir a nuestra WEB</strong></a>
        </div>
      </div>  
</body>
</html>