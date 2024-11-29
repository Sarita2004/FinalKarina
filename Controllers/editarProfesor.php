<?php
require_once __DIR__ . '/../Model/Profesor.php';

    $id_profesor = $_GET['id_profesor'];
    $profesor = Profesor::getById($id_profesor); 

    if (isset($_POST['actualizarDatos'])) {
       
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $DNI = $_POST['DNI'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $telefono = $_POST['telefono'];
        $calle = $_POST['calle'];
        $nro = $_POST['nro'];
        $codigo_postal = $_POST['codigo_postal'];
        $estado_civil = $_POST['estado_civil'];
        $genero = $_POST['genero'];

        $profesor->nombre = $nombre;
        $profesor->apellido = $apellido;
        $profesor->DNI = $DNI;
        $profesor->fecha_nacimiento = $fecha_nacimiento;
        $profesor->telefono = $telefono;
        $profesor->calle = $calle;
        $profesor->nro = $nro;
        $profesor->codigo_postal = $codigo_postal;
        $profesor->estado_civil = $estado_civil;
        $profesor->genero = $genero;

        $profesor->update();
        
        header('Location: indexProfesor.php');
        exit();
    }


require_once __DIR__ . '/../View/editarProfesor.view.php';