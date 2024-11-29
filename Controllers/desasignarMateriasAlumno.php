<?php
require_once __DIR__ . '/../Model/Materia.php';
require_once __DIR__ . '/../Model/Alumno.php';

$id_alumno = $_GET['id_alumno'];
$id_materia = $_GET['id_materia'];

$materia = Materia::getById($id_materia);

if ($materia) {
    $materia->desasignarAlumno($id_alumno);
    header("Location: verAlumnosMaterias.php?id_materia=$id_materia");
    exit();
}
?>

