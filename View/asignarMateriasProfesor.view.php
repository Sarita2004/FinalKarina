<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Materias</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../View/estilos2.css">

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Asignar Materias</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../Controllers/indexAlumno.php">Alumnos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Controllers/indexProfesor.php">Profesores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Controllers/indexMateria.php">Materias</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h1 class="mb-4">Asignar Materias a <?= $profesor->nombre . ' ' . $profesor->apellido ?></h1>
        <form action="" method="post"> 
            <div class="form-group"> 
                 <?php foreach ($todasLasMaterias as $materia): ?>
                    <div class="custom-control custom-switch mb-2">
                    <input type="checkbox" class="custom-control-input" id="materia_<?= $materia->id_materia ?>"name="materias[]" value="<?= $materia->id_materia ?>"
<?= in_array($materia, $profesor->materias()) ? 'checked' : '' ?>>
<label class="custom-control-label" for="materia_<?= $materia->id_materia ?>"><?= $materia->nombre ?></label>


                    </div>
                <?php endforeach; ?>
            </div>
            <button type="submit" name="guardarMaterias" class="btn btn-primary">
                <i class="fas fa-save"></i> Guardar Cambios
            </button>
        </form>
    </div>
</body>

</html>