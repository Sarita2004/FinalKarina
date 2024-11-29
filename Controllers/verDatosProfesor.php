<?php
require_once '../Model/Profesor.php';

if (isset($_GET['id_profesor'])) {
    $id = intval($_GET['id_profesor']);
    $profesor = Profesor::getById($id);
    
}
require_once '../View/verDatosProfesor.view.php';
?>