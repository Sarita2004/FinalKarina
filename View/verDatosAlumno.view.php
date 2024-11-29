<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Personales de Alumno</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../View/estilos2.css">

</head>
<body>

<div class="container mt-5">
    <h2>Datos Personales de <?= htmlspecialchars($alumno->nombre) ?> <?= htmlspecialchars($alumno->apellido) ?></h2>
    <div class="card">
        <div class="card-body">
            <p><strong>DNI:</strong> <?= htmlspecialchars($alumno->DNI) ?></p>
            <p><strong>Fecha de Nacimiento:</strong> <?= htmlspecialchars($alumno->fecha_nacimiento) ?></p>
            <p><strong>Teléfono:</strong> <?= htmlspecialchars($alumno->telefono) ?></p>
            <p><strong>Calle:</strong> <?= htmlspecialchars($alumno->calle) ?></p>
            <p><strong>Número:</strong> <?= htmlspecialchars($alumno->nro) ?></p>
            <p><strong>Código Postal:</strong> <?= htmlspecialchars($alumno->codigo_postal) ?></p>
            <p><strong>Estado Civil:</strong> <?= htmlspecialchars($alumno->estado_civil) ?></p>
            <p><strong>Género:</strong> <?= htmlspecialchars($alumno->genero) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($alumno->email) ?></p>
        </div>
    </div>
    <a href="../Controllers/indexAlumno.php" class="btn btn-primary mt-3">Volver a la Lista</a>
</div>

</body>
</html>
