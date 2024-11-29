<?php
require_once __DIR__ . '/../Model/Profesor.php';
require_once __DIR__ . '/../Model/Materia.php';

$id_materia = $_GET['id_materia']; 
$ProfesoresXmateria = Materia::getById($id_materia);

require_once __DIR__ . '/../View/verProfesoresMaterias.view.php';