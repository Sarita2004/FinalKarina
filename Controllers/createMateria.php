<?php

require_once __DIR__ . '/../Model/Materia.php';

if (isset($_POST['enviarFormulario'])) {
    $nombre = $_POST['nombre'];
    $carga_horaria = $_POST['carga_horaria'];

    $materia = new Materia();
    $materia->nombre = $nombre;
    $materia->carga_horaria = $carga_horaria;

    $materia->create();
 
    header('Location: indexMateria.php');
    exit();
}

require_once __DIR__ . '/../View/createMateria.view.php';