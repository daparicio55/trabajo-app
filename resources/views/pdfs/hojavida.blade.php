<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $user->name }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #3498db;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        header img {
            border-radius: 50%;
            margin-top: 10px;
        }

        section {
            max-width: 800px;
            margin: 10px auto;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
        }

        h2 {
            color: #3498db;
            margin: 0px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 5px;
            
        }
        h1 {
            margin: 0px;
        }
        h3 {
            margin-top: 1px;
            margin-bottom: 5px;
        }
        p {
            margin: 0px;
        }
    </style>
</head>
<body>
    <header>
        <img style="max-width: 150px" src="{{ asset(Storage::url($user->ucliente->cliente->postulaciones[0]->url)) }}" alt="Tu Foto">
        <h1>{{ $user->name }}</h1>
        <p>{{ $user->ucliente->cliente->dniRuc }}</p>
        
        {{-- <p>{{ Storage::url($user->ucliente->cliente->postulaciones[0]->url) }}</p> --}}
    </header>
    <section id="about">
        <h3>Programa de Estudios</h3>
        @foreach ($estudiantes as $estudiante)
            <h2>{{ $estudiante->postulante->carrera->nombreCarrera }}</h2>
        @endforeach
    </section>

    <section id="experience">
        <h2>Experiencia Laboral</h2>
        @foreach ($user->experiencias()->orderBy('exinicio','desc')->get() as $experiencia)
            <h3>{{ $experiencia->cargo }} - {{ $experiencia->empresa }}</h3>
            <p>
                Inicio: {{ date('d-m-Y',strtotime($experiencia->exinicio)) }}
                @if ($experiencia->actual == true)
                    <b>Trabajo Actual.</b>
                @else
                    al  {{ date('d-m-Y',strtotime($experiencia->exfin)) }}
                @endif
            </p>
        @endforeach
    </section>

    <section id="education">
        <h2>Capacitaciones - Cursos</h2>
        @foreach ($user->cursos()->orderBy('inicio','desc')->get() as $curso)
            <h3>{{ $curso->mension }} - {{ $curso->institucion }}</h3>
            <p>
                Del {{ date('d-m-Y',strtotime($curso->inicio)) }} al {{ date('d-m-Y',strtotime($curso->fin)) }} Créditos/Horas: {{ $curso->horas }}
            </p>
            
        @endforeach
    </section>

    <section id="skills">
        <h2>EFSRT</h2>
        <p>Experiencias formativas en situaciones reales de trabajo</p>

        @foreach ($estudiantes as $estudiante)
        <h3>{{ $estudiante->postulante->carrera->nombreCarrera }}</h3>
            <ul>
                @foreach ($estudiante->practicas as $practica)
                    <li>
                        {{ $practica->modulo->nombre }}
                        <span style="display: block; margin-top: 4px">
                            Empresa: {{ $practica->empresa->razonSocial }} Calificación: {{ $practica->calificacionEmpresa }}
                            
                        </span>
                    </li>
                    
                @endforeach
            </ul>
        @endforeach
    </section>

    <section id="contact">
        <h2>Contacto</h2>
        <p>Email: {{ $user->email }}</p>
        <p>Teléfono: {{ $user->ucliente->cliente->telefono }}</p>
    </section>
</body>
</html>