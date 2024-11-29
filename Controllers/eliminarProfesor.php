<?php
require_once __DIR__ . '/../Model/Profesor.php';

$id_profesor = $_GET['id_profesor'];
$profesor = Profesor::getById($id_profesor); 

if ($profesor) {
    $profesor->delete(); 
    header('Location: indexProfesor.php'); 
    exit();
}
