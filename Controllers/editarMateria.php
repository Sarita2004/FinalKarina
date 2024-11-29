<?php
require_once __DIR__ . '/../Model/Materia.php';

    $id_materia= $_GET['id_materia'];
    $materia = Materia::getById($id_materia);

    if (isset($_POST['actualizarDatos'])) {
       
        $nombre = $_POST['nombre'];
        $carga_horaria = $_POST['carga_horaria'];
        
        $materia->nombre = $nombre;
        $materia->carga_horaria = $carga_horaria;

        $materia->update();

        header('Location: indexMateria.php');
        exit();
    }


require_once __DIR__ . '/../View/editarMateria.view.php';