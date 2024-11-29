<?php
require_once __DIR__ . '/../Model/Usuario.php';
require_once __DIR__ . '/../Model/Materia.php';

$id = $_GET['id']; // Identificador del usuario
$usuario = Usuario::getById($id); // Obtener el usuario por su ID
$todasLasMaterias = Materia::all(); // Obtener todas las materias disponibles

if (isset($_POST['guardarMaterias'])) {
    $usuario->desasignarTodasLasMaterias(); // Eliminar todas las asignaciones actuales

    if (isset($_POST['materias'])) {
        foreach ($_POST['materias'] as $id_materia) {
            $usuario->asignarMateria($id_materia); // Asignar cada materia seleccionada al usuario
        }
    }

    header('Location: indexAlumno.php'); // Redirigir a la lista de usuarios
    exit;
}

require_once __DIR__ . '/../View/asignarMateriasAlumno.view.php';
