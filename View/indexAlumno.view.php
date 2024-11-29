<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Alumnos</title>
    <!-- DataTables CSS library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" />
    <script src="//code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="../View/estilos.css">

    <style type="text/css">
        .bs-example {
            margin: 20px;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Alumnos</a>
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
                    <a class="nav-link" href="../Controllers/indexMateria.php">Materias</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="bs-example">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table id="listaAlumnos" class="table table-sm table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>DNI</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($alumnos as $alumno): ?>
                                <tr>
                                    <td><?= $alumno->id; ?></td>
                                    <td><?= $alumno->nombre; ?></td>
                                    <td><?= $alumno->apellido; ?></td>
                                    <td><?= $alumno->DNI; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="../Controllers/editarAlumno.php?id=<?= $alumno->id; ?>" class="btn btn-warning btn-sm">Editar</a>
                                            <a href="../Controllers/verDatosAlumno.php?id=<?= $alumno->id; ?>" class="btn btn-info">Ver Datos</a>
                                            <a href="../Controllers/eliminarAlumno.php?id=<?= $alumno->id; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                            <a href="../Controllers/asignarMateriasAlumno.php?id=<?= $alumno->id; ?>" class="btn btn-success">Asignar Materias</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('#listaAlumnos').DataTable();
    });
</script>

</html>
