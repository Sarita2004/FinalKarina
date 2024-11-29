<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Materias</title>
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
    <div class="bs-example">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <a href="../Controllers/createMateria.php" class="btn btn-success float-right">Nueva Materia</a>
                        <h2 class="pull-left">Lista de Materias</h2>
                    </div>
                    <table id="listaMaterias" class="table table-sm table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Carga Horaria</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($materias as $materia): ?>
                                <tr>
                                    <td><?= $materia->id_materia; ?></td>
                                    <td><?= $materia->nombre; ?></td>
                                    <td><?= $materia->carga_horaria; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="../Controllers/editarMateria.php?id_materia=<?= $materia->id_materia; ?>" class="btn btn-warning btn-sm">Editar</a>
                                            <a href="../Controllers/eliminarMateria.php?id_materia=<?= $materia->id_materia; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                            <a href="../Controllers/verAlumnosMaterias.php?id_materia=<?= $materia->id_materia; ?>" class="btn btn-info btn-sm">Ver Alumnos</a>
                                            <a href="../Controllers/verProfesoresMaterias.php?id_materia=<?= $materia->id_materia; ?>" class="btn btn-success btn-sm">Ver Profesores</a>
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
        $('#listaMaterias').DataTable();
    });
</script>

</html>