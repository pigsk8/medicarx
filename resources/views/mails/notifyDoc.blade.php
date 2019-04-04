<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Medicarx</title>
    <style>
        body{
            font-family: sans-serif;
            border: 2px solid #044ACD;
            border-radius: 6px;
            padding: 20px;
        }
        .primer{
            text-align: center;
        }
        .nombre{
            color: #FFC400;
        }
    </style>
</head>
<body>

    <div class="primer">
        <h1 class="bienvenido">Medicarx Consultas</h1>
    </div>

    <p class="texto-saludo">Hola <span class=" nombre">{{ $name }},</span> informamos que tiene una consulta asignada para su diagnostico</p>
    
</body>
</html>