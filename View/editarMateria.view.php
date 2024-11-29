<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar materia</title>
    <!-- Include bootstrap last version -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include jQuery last version -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Include fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="stylesheet" href="../View/estilos.css">

</head>

<body>

    <div class="container">
        <div class="row mt-5">
            <div class="col col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Editar Materia - ID: <?= $materia->id_materia ?></h3>
                    </div>
                    <div class="card-body">
                        <form action="../Controllers/editarmateria.php?id_materia=<?= $materia->id_materia ?>" method="post">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" value="<?= $materia->nombre ?>" name="nombre" id="nombre" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="carga_horaria">Carga Horaria</label>
                                <input type="text" value="<?= $materia->carga_horaria ?>" name="carga_horaria" id="carga_horaria" class="form-control" required>
                            </div>
                            <button type="submit" name="actualizarDatos" class="btn btn-primary">
                                <i class="fas fa-send"></i> Actualizar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>