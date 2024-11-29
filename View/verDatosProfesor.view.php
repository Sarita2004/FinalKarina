<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Personales de Profesores</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../View/estilos2.css">

</head>
<body>

<div class="container mt-5">
    <h2>Datos Personales de <?= htmlspecialchars($profesor->nombre) ?> <?= htmlspecialchars($profesor->apellido) ?></h2>
    <div class="card">
        <div class="card-body">
            <p><strong>DNI:</strong> <?= htmlspecialchars($profesor->DNI) ?></p>
            <p><strong>Fecha de Nacimiento:</strong> <?= htmlspecialchars($profesor->fecha_nacimiento) ?></p>
            <p><strong>Teléfono:</strong> <?= htmlspecialchars($profesor->telefono) ?></p>
            <p><strong>Calle:</strong> <?= htmlspecialchars($profesor->calle) ?></p>
            <p><strong>Número:</strong> <?= htmlspecialchars($profesor->nro) ?></p>
            <p><strong>Código Postal:</strong> <?= htmlspecialchars($profesor->codigo_postal) ?></p>
            <p><strong>Estado Civil:</strong> <?= htmlspecialchars($profesor->estado_civil) ?></p>
            <p><strong>Género:</strong> <?= htmlspecialchars($profesor->genero) ?></p>
        </div>
    </div>
    <a href="../Controllers/indexProfesor.php" class="btn btn-primary mt-3">Volver a la Lista</a>
</div>

</body>
</html>