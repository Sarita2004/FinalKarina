<?php
require_once __DIR__ . '/../Model/Alumno.php';
require_once __DIR__ . '/../Model/Materia.php';

$id_materia = $_GET['id_materia']; 
$AlumnosXmateria = Materia::getById($id_materia);

require_once __DIR__ . '/../View/verAlumnosMaterias.view.php';