<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hover Imagen con Menú</title>
    <style>
        .contenedor-imagen {
            position: relative;
            display: inline-block;
        }
        .imagen {
            display: block;
        }
        .menu-informacion {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: white;
            border: 1px solid #ccc;
            padding: 10px;
            width: 100%;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .contenedor-imagen:hover .menu-informacion {
            display: block;
        }
    </style>
</head>
<body>
    <div class="contenedor-imagen">
        <img src="tu-imagen.jpg" alt="Imagen Descriptiva" class="imagen">
        <div class="menu-informacion">
            <p>Información adicional sobre la imagen.</p>
            <p>Puedes agregar más detalles aquí.</p>
        </div>
    </div>
</body>
</html>