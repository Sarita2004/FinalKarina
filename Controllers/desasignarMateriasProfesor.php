<?php
require_once __DIR__ . '/../Model/Materia.php';
require_once __DIR__ . '/../Model/Profesor.php';

$id_profesor = $_GET['id_profesor'];
$id_materia = $_GET['id_materia'];

$materia = Materia::getById($id_materia);

if ($materia) {
    $materia->desasignarProfesor($id_profesor);
    header("Location: verProfesoresMaterias.php?id_materia=$id_materia");
    exit();
}
?>
