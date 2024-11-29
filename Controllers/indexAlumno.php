
<?php
require_once __DIR__ . '/../Model/Usuario.php';

// Obtener todos los usuarios con rol 'alumno'
$alumnos = Usuario::all('alumno');

// Cargar la vista correspondiente
require_once __DIR__ . '/../View/indexAlumno.view.php';
