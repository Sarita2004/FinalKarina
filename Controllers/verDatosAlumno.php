<?php
require_once '../Model/Usuario.php';

if (isset($_GET['id_alumno'])) {
    $id_alumno = intval($_GET['id_alumno']);
    $alumno = Usuario::getById($id);
    }
require_once '../View/verDatosAlumno.view.php';
?>
