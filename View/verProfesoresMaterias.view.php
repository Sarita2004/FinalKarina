<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesores de <?= $ProfesoresXmateria->nombre; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../View/estilos.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Materias</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../View/Presentacion.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Controllers/indexProfesor.php">Profesores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Controllers/indexAlumno.php">Alumnos</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1 class="mb-4">Profesores de <?= $ProfesoresXmateria->nombre; ?></h1>
        <div class="list-group">
            <?php foreach ($ProfesoresXmateria->profesores() as $Profesor) { ?>
                <div class="list-group-item">
                    <h5 class="mb-1"><?= $Profesor->nombre; ?> <?= $Profesor->apellido; ?></h5>
                    <a href="../Controllers/desasignarMateriasProfesor.php?id_profesor=<?= $Profesor->id_profesor; ?>&id_materia=<?= $ProfesoresXmateria->id_materia; ?>"  class="btn btn-danger btn-sm">
                    <i class="fas fa-user-minus"></i> Eliminar</a>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>