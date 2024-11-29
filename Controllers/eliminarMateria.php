<?php
require_once __DIR__ . '/../Model/Materia.php';

    $id_materia = $_GET['id_materia'];
    $materia = Materia::getById($id_materia); 

    if ($materia) {
        $materia->delete(); 
        header('Location: indexMateria.php');
        exit();
    }