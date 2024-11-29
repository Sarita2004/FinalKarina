<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesores</title>
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
        <a class="navbar-brand" href="#">Profesores</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../View/Presentacion.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Controllers/indexAlumno.php">Alumnos</a>
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
                    <div class="page-header clearfix">
                        <a href="../Controllers/createProfesor.php" class="btn btn-success float-right">Agregar Profesor</a>
                        <h2 class="pull-left">Lista de Profesores</h2>
                    </div>
                    <table id="profesoresTable" class="table table-sm table-striped table-bordered" style="width:100%">
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
                            <?php foreach ($profesores as $profesor): ?>
                                <tr>
                                    <td><?= $profesor->id_profesor; ?></td>
                                    <td><?= $profesor->nombre; ?></td>
                                    <td><?= $profesor->apellido; ?></td>
                                    <td><?= $profesor->DNI; ?></td>

                                    <td>
                                        <div class="btn-group">
                                            <a href="../Controllers/editarProfesor.php?id_profesor=<?= $profesor->id_profesor; ?>" class="btn btn-warning btn-sm">Editar</a>
                                            <a href="../Controllers/verDatosProfesor.php?id_profesor=<?= $profesor->id_profesor; ?>" class="btn btn-info">Ver Datos</a>
                                            <a href="../Controllers/eliminarProfesor.php?id_profesor=<?= $profesor->id_profesor; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                            <a href="../Controllers/asignarMateriasProfesor.php?id_profesor=<?= $profesor->id_profesor; ?>" class="btn btn-success">Asignar Materias</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>DNI</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#profesoresTable').DataTable();
        });
    </script>
</body>

</html>