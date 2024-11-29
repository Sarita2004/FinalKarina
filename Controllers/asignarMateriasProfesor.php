<?php
require_once __DIR__ .'/../Model/Profesor.php';
require_once __DIR__ .'/../Model/Materia.php';

$id_profesor = $_GET['id_profesor']; 
$profesor = Profesor::getById($id_profesor); 
$todasLasMaterias = Materia::all(); 


if (isset($_POST['guardarMaterias'])) {
    $profesor->desasignarTodasLasMaterias(); 

    if (isset($_POST['materias'])) {

        foreach ($_POST['materias'] as $id_materia) {
            $profesor->asignarMateria($id_materia);

        }
    }

    header('Location: indexProfesor.php');
    exit;
}

require_once __DIR__ . '/../View/asignarMateriasProfesor.view.php';