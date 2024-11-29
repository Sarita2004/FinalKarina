
</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Alumno</title>
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
                        <h3>Editar Alumno - ID: <?= $alumno->id ?></h3>
                    </div>
                    <div class="card-body">
                        <form action="../Controllers/editarAlumno.php?id_alumno=<?= $alumno->id ?>" method="post">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" value="<?= $alumno->nombre ?>" name="nombre" id="nombre" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" value="<?= $alumno->apellido ?>" name="apellido" id="apellido" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" value="<?= $alumno->email ?>" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="DNI">DNI</label>
                                <input type="text" value="<?= $alumno->DNI ?>" name="DNI" id="DNI" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" value="<?= $alumno->telefono ?>" name="telefono" id="telefono" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="calle">Calle</label>
                                <input type="text" value="<?= $alumno->calle ?>" name="calle" id="calle" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="nro">Número</label>
                                <input type="text" value="<?= $alumno->nro ?>" name="nro" id="nro" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="codigo_postal">Código Postal</label>
                                <input type="text" value="<?= $alumno->codigo_postal ?>" name="codigo_postal" id="codigo_postal" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="estado_civil">Estado Civil</label>
                                <select name="estado_civil" id="estado_civil" class="form-control" required>
                                    <option value="Soltero/a" <?= $alumno->estado_civil == "Soltero/a" ? 'selected' : '' ?>>Soltero/a</option>
                                    <option value="Casado/a" <?= $alumno->estado_civil == "Casado/a" ? 'selected' : '' ?>>Casado/a</option>
                                    <option value="Divorciado/a" <?= $alumno->estado_civil == "Divorciado/a" ? 'selected' : '' ?>>Divorciado/a</option>
                                    <option value="Viudo/a" <?= $alumno->estado_civil == "Viudo/a" ? 'selected' : '' ?>>Viudo/a</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="genero">Género</label>
                                <select name="genero" id="genero" class="form-control" required>
                                    <option value="Masculino" <?= $alumno->genero == "Masculino" ? 'selected' : '' ?>>Masculino</option>
                                    <option value="Femenino" <?= $alumno->genero == "Femenino" ? 'selected' : '' ?>>Femenino</option>
                                    <option value="Otro" <?= $alumno->genero == "Otro" ? 'selected' : '' ?>>Otro</option>
                                    <option value="Prefiero no decirlo" <?= $alumno->genero == "Prefiero no decirlo" ? 'selected' : '' ?>>Prefiero no decirlo</option>
                                </select>
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
